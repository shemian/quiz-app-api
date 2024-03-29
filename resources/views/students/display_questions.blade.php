@extends('students.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/quiz.css') }}" type="text/css">
    <link
        href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
        rel="stylesheet"  type='text/css'>
@endsection

@section('content')
    <h1>Subject: {{ $exam->subject->name }}</h1>
    @if ($questions->isEmpty())
        <p>No questions available for this exam.</p>
    @else
        <div class="start_btn"><button>Start Exam</button></div>
        <!-- Info Box -->
        <div class="info_box">
            <div class="info-title"><span>Some Rules of this Quiz</span></div>
            <div class="info-list">
                <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
                <div class="info">2. Once you select your answer, it can't be undone.</div>
                <div class="info">3. You can't select any option once time goes off.</div>
                <div class="info">4. You can't exit from the Quiz while you're playing.</div>
                <div class="info">5. You'll get points on the basis of your correct answers.</div>
            </div>
            <div class="buttons">
                <button class="quit">Exit Exam</button>
                <button class="restart">Continue</button>
            </div>
        </div>

        <!-- Quiz Box -->


            <div class="quiz_box">
                <header>
                    <div class="title">Awesome Quiz Application</div>
                    <div class="timer">
                        <div class="time_left_txt">Time Left</div>
                        <div class="timer_sec">15</div>
                    </div>
                    <div class="time_line"></div>
                </header>
                <section>
                    <div class="que_text">
                        <!-- Here I've inserted question from JavaScript -->

                    </div>
                    <div class="que_image">
                        <!-- The image will be displayed here -->
                    </div>
                    <div class="option_list">
                        <!-- Here I've inserted options from JavaScript -->
                    </div>
                </section>
                <!-- footer of Quiz Box -->
                <footer>
                    <div class="total_que">
                        <!-- Here I've inserted Question Count Number from JavaScript -->
                    </div>
                    <button class="next_btn">Next Que</button>
                </footer>
            </div>

    @endif
        <!-- Result Box -->
        <div class="result_box">
            <div class="icon">
                <i class="fas fa-crown"></i>
            </div>
            <div class="complete_text">You've completed the Quiz!</div>
            <div class="score_text">
                <!-- Here I've inserted Score Result from JavaScript -->
            </div>
            <div class="buttons">
                <button class="quit">Quit Quiz</button>
            </div>
        </div>

@endsection

@section('scripts')
    <script>
        //selecting all required elements
        const start_btn = document.querySelector(".start_btn button");
        const info_box = document.querySelector(".info_box");
        const exit_btn = info_box.querySelector(".buttons .quit");
        const continue_btn = info_box.querySelector(".buttons .restart");
        const quiz_box = document.querySelector(".quiz_box");
        const result_box = document.querySelector(".result_box");
        const option_list = document.querySelector(".option_list");
        const time_line = document.querySelector("header .time_line");
        const timeText = document.querySelector(".timer .time_left_txt");
        const timeCount = document.querySelector(".timer .timer_sec");

        // Variable to store the user's score
        let answers = [];


        // if startQuiz button clicked
        start_btn.onclick = ()=>{
            info_box.classList.add("activeInfo"); //show info box
        }

        // if exitQuiz button clicked
        exit_btn.onclick = ()=>{
            info_box.classList.remove("activeInfo"); //hide info box
        }

        // if continueQuiz button clicked
        continue_btn.onclick = ()=>{
            info_box.classList.remove("activeInfo"); //hide info box
            quiz_box.classList.add("activeQuiz"); //show quiz box
            showQuetions(0); //calling showQestions function
            queCounter(1); //passing 1 parameter to queCounter
            startTimer(15); //calling startTimer function
            startTimerLine(0); //calling startTimerLine function
        }

        let timeValue =  15;
        let que_count = 0;
        let que_numb = 1;
        let userScore = 0;
        let counter;
        let counterLine;
        let widthValue = 0;

        const quit_quiz = result_box.querySelector(".buttons .quit");


        // if quitQuiz button clicked
        quit_quiz.onclick = ()=>{
            window.location.reload(); //reload the current window
        }

        const next_btn = document.querySelector("footer .next_btn");
        const bottom_ques_counter = document.querySelector("footer .total_que");

        let test_questions = {!! json_encode($formatedQuestions) !!};

        // if Next Que button clicked
        next_btn.onclick = ()=>{
            if(que_count < test_questions.length - 1){ //if question count is less than total question length
                que_count++; //increment the que_count value
                que_numb++; //increment the que_numb value
                showQuetions(que_count); //calling showQestions function
                queCounter(que_numb); //passing que_numb value to queCounter
                clearInterval(counter); //clear counter
                clearInterval(counterLine); //clear counterLine
                startTimer(timeValue); //calling startTimer function
                startTimerLine(widthValue); //calling startTimerLine function
                timeText.textContent = "Time Left"; //change the timeText to Time Left
                next_btn.classList.remove("show"); //hide the next button
            }else{
                clearInterval(counter); //clear counter
                clearInterval(counterLine); //clear counterLine
                showResult(); //calling showResult function
            }
        }


        // getting testq and options from array
        function showQuetions(index){
            const que_text = document.querySelector(".que_text");
            const que_image = document.querySelector(".que_image");

            //creating a new span and div tag for question and option and passing the value using array index
            let que_tag = '<span>'+ test_questions[index].numb + ". " + test_questions[index].question +'</span>';
            let option_tag = '<div class="option"><span>'+ test_questions[index].options[0] +'</span></div>'
                + '<div class="option"><span>'+ test_questions[index].options[1] +'</span></div>'
                + '<div class="option"><span>'+ test_questions[index].options[2] +'</span></div>'
                + '<div class="option"><span>'+ test_questions[index].options[3] +'</span></div>';
            que_text.innerHTML = que_tag; //adding new span tag inside que_tag
            option_list.innerHTML = option_tag; //adding new div tag inside option_tag

            // Check if the question has an image
            if (test_questions[index].image) {
                // If the question has an image, display it in the que_image element
                que_image.innerHTML = '<img src="/storage/assets/images/exam_images/' + test_questions[index].image + '" alt="Question Image">';

            } else {
                // If the question doesn't have an image, remove the image from the que_image element
                que_image.innerHTML = '';
            }

            // // Check if the question has an image URL
            // if (test_questions[index].image) {
            //     // If the question has an image, set the image source
            //     que_image.setAttribute("src", test_questions[index].image);
            //     que_image.style.display = "block"; // Show the image
            // } else {
            //     // If the question doesn't have an image, hide the image
            //     que_image.style.display = "none";
            // }

            const option = option_list.querySelectorAll(".option");

            // set onclick attribute to all available options
            for(i=0; i < option.length; i++){
                option[i].setAttribute("onclick", "optionSelected(this)");
            }
        }
        // creating the new div tags which for icons
        let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
        let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

        //

        //if user clicked on option
        function optionSelected(answer){
            clearInterval(counter); //clear counter
            clearInterval(counterLine); //clear counterLine
            let userAns = answer.textContent; //getting user selected option
            let correcAns = test_questions[que_count].answer; //getting correct answer from array
            const allOptions = option_list.children.length; //getting all option items

            if(userAns === correcAns){ //if user selected option is equal to array's correct answer
                userScore += 1; //upgrading score value with 1
                answer.classList.add("correct"); //adding green color to correct selected option
                answer.insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to correct selected option
                console.log("Correct Answer");
                console.log("Your correct answers = " + userScore);
            }else{
                answer.classList.add("incorrect"); //adding red color to correct selected option
                answer.insertAdjacentHTML("beforeend", crossIconTag); //adding cross icon to correct selected option
                console.log("Wrong Answer");

                for(i=0; i < allOptions; i++){
                    if(option_list.children[i].textContent === correcAns){ //if there is an option which is matched to an array answer
                        option_list.children[i].setAttribute("class", "option correct"); //adding green color to matched option
                        option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to matched option
                        console.log("Auto selected correct answer.");
                    }
                }
            }
            answers.push({
                question: test_questions[que_count].question,
                answer: userAns,
            });

            for(i=0; i < allOptions; i++){
                option_list.children[i].classList.add("disabled"); //once user select an option then disabled all options
            }
            next_btn.classList.add("show"); //show the next button if user selected any option
        }

        function showResult(){
            info_box.classList.remove("activeInfo"); //hide info box
            quiz_box.classList.remove("activeQuiz"); //hide quiz box
            result_box.classList.add("activeResult"); //show result box
            const scoreText = result_box.querySelector(".score_text");
            // Retrieve the CSRF token from a meta tag in your HTML layout or from a JavaScript variable
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const studentId = {!! json_encode($student->id) !!};
            const subjectId = {!! json_encode($exam->subject->id) !!};
            const examId = {!! json_encode($exam->id) !!};
            const yesAns = userScore;
            const noAns = test_questions.length - userScore;
            const questionId = {!! json_encode($exam->questions->pluck('id')) !!};
            const resultJson = {
                student_id: studentId,
                subject_id: subjectId,
                yes_ans: yesAns,
                no_ans: noAns,
                answers: answers,
            };
            const marksObtained = yesAns;

            const resultData = {
                student_id: studentId,
                subject_id: subjectId,
                yes_ans: yesAns,
                no_ans: noAns,
                result_json: resultJson,

                marks_obtained: marksObtained,
            };

            // Make an AJAX request to the Laravel endpoint
            fetch(`/student/questions/${examId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the request header
                },
                body: JSON.stringify(resultData),
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    console.log(data);
                    // You can perform further actions based on the response
                })
                .catch(error => {
                    // Handle any errors that occurred during the request
                    console.error(error);
                });


            if (userScore > 3){ // if user scored more than 3
                //creating a new span tag and passing the user score number and total question number
                let scoreTag = '<span>and congrats! 🎉, You got <p>'+ userScore +'</p> out of <p>'+ test_questions.length +'</p></span>';
                scoreText.innerHTML = scoreTag;  //adding new span tag inside score_Text
            }
            else if(userScore > 1){ // if user scored more than 1
                let scoreTag = '<span>and nice 😎, You got <p>'+ userScore +'</p> out of <p>'+ test_questions.length +'</p></span>';
                scoreText.innerHTML = scoreTag;
            }
            else{ // if user scored less than 1
                let scoreTag = '<span>and sorry 😐, You got only <p>'+ userScore +'</p> out of <p>'+ test_questions.length +'</p></span>';
                scoreText.innerHTML = scoreTag;
            }

        }

        function startTimer(time){
            counter = setInterval(timer, 1000);
            function timer(){
                timeCount.textContent = time; //changing the value of timeCount with time value
                time--; //decrement the time value
                if(time < 9){ //if timer is less than 9
                    let addZero = timeCount.textContent;
                    timeCount.textContent = "0" + addZero; //add a 0 before time value
                }
                if(time < 0){ //if timer is less than 0
                    clearInterval(counter); //clear counter
                    timeText.textContent = "Time Off"; //change the time text to time off
                    const allOptions = option_list.children.length; //getting all option items
                    let correcAns = test_questions[que_count].answer; //getting correct answer from array
                    for(i=0; i < allOptions; i++){
                        if(option_list.children[i].textContent === correcAns){ //if there is an option which is matched to an array answer
                            option_list.children[i].setAttribute("class", "option correct"); //adding green color to matched option
                            option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to matched option
                            console.log("Time Off: Auto selected correct answer.");
                        }
                    }
                    for(i=0; i < allOptions; i++){
                        option_list.children[i].classList.add("disabled"); //once user select an option then disabled all options
                    }
                    next_btn.classList.add("show"); //show the next button if user selected any option
                }
            }
        }

        function startTimerLine(time){
            counterLine = setInterval(timer, 29);
            function timer(){
                time += 1; //upgrading time value with 1
                time_line.style.width = time + "px"; //increasing width of time_line with px by time value
                if(time > 549){ //if time value is greater than 549
                    clearInterval(counterLine); //clear counterLine
                }
            }
        }

        function queCounter(index){
            //creating a new span tag and passing the question number and total question
            let totalQueCounTag = '<span><p>'+ index +'</p> of <p>'+ test_questions.length +'</p> Questions</span>';
            bottom_ques_counter.innerHTML = totalQueCounTag;  //adding new span tag inside bottom_ques_counter
        }

    </script>
@endsection

