@extends('teachers.master')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teacher</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Questions</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">PostQuestions</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Post Questions</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#education" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Set Up Questions
                                </a>
                            </li>
                        </ul> <!-- end nav-->

                        <form method="POST" action="{{route('store_questions')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ ($exam->id) }}">

                            <div id="question-container">
                                <!-- Dynamic question form container -->
                            </div>
                            <br>

                            <div class="row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="button" class="btn btn-primary mr-2" id="add-question-btn">Add Question</button>
                                    <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                                </div>
                            </div>

                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div><!-- end row-->
    </div> <!-- container -->
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Topic List
            let topicList = [];
            let educationLevels = [];
            const exam = @json($exam);
            let selectedQuestion = 0;

            $.ajax({
                url: `/teacher/get-topics/${exam.subject_id}`,
                type: 'GET',
                success: function (data) {
                    topicList = data.topicStrands;
                }
            });

            console.log(exam.subject_id);
            $.ajax({
                url: '/teacher/get-education-levels',
                type: 'GET',
                data: {educationSystemId: exam.subject.education_system_id},
                success: function (data) {
                    educationLevels = data.educationLevels;
                }
            });

            // Function to populate subtopics based on topic selection
            function populateSubtopics(questionCount, topicId) {
                $.ajax({
                    url: '/teacher/get-subtopics',
                    type: 'GET',
                    data: { topicId: topicId },
                    success: function (data) {
                        var options = '<option value="">Select Subtopic</option>';

                        $.each(data.subtopics, function (key, subtopic) {
                            options += '<option value="' + subtopic.id + '">' + subtopic.name + '</option>';
                        });

                        $(`[id^=question_${questionCount}] #subtopic`).html(options);
                    }
                });
            }

            // Populate subjects based on education system and education level selection
            $('#education_level').on('change', function () {
                var educationSystemId = $('#education_system').val();
                var educationLevelId = $(this).val();

                $.ajax({
                    url: '/teacher/get-subjects',
                    type: 'GET',
                    data: {
                        educationSystemId: educationSystemId,
                        educationLevelId: educationLevelId
                    },
                    success: function (data) {
                        var options = '<option value="">Select Subject</option>';

                        $.each(data.subjects, function (key, subject) {
                            options += '<option value="' + subject.id + '">' + subject.name + '</option>';
                        });

                        $('#subject').html(options);
                    }
                });
            });

            // Populate topics based on subject selection
            // $('#subject').on('change', function () {
            //     var subjectId = $(this).val();
            // });

            // Populate subtopics based on topic selection
            $(document).on('change', '[id^=question] #topic', function () {
                var topicId = $(this).val();
                var questionCount = $(this).attr("class").split(" ")[0].split("_")[1];
                populateSubtopics(questionCount, topicId);
            });

            // Function to update the question count
            function updateQuestionCount() {
                var questionCount = $('.question-form').length;
                $('.question-count').text(questionCount);
            }

            // Function to add a new question form
            function addQuestionForm() {
                var questionCount = $('.question-form').length + 1;

                var options = '<option value="">Select Topic</option>';
                $.each(topicList, function (key, topic) {
                    options += '<option value="' + topic.id + '">' + topic.topic_strand + '</option>';
                });


                var education_level_options = '<option value="">Select Education Level</option>';

                $.each(educationLevels, function (key, educationLevel) {
                    education_level_options += '<option value="' + educationLevel.id + '">' + educationLevel.name + '</option>';
                });

                $('#education_level').html(education_level_options);

                var questionForm = `
                <div class="card form-group question-form" id="question_${questionCount}">
                    <div class="card-body">
                        <h5 class="card-title">Question Card</h5>
                        <hr>
                        <label for="question_${questionCount}">Question ${questionCount}</label>

                             <div class="row mb-3">-
                                <label for="Belongs To Education Level" class="col-md-4 col-form-label text-md-end">{{ __('Belongs To Eduction Level') }}</label>
                                <div class="col-md-6">
                                    <select id="education_level_id"  name="education_level_id[]" class="topicq_${questionCount} form-control" >
                                        ${education_level_options}
                                    </select>
                                    @error('education_level_id')
                                       <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                       </span>
                                    @enderror
                                </div>
                             </div>


              <div class="row mb-3">
                <label for="topic" class="col-md-4 col-form-label text-md-end">{{ __('Topic') }}</label>
                                <div class="col-md-6">
                                    <select id="topic" name="topic_id" class="topicq_${questionCount} form-control">
                                        ${options}
                                    </select>
                                    @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>

                            <div class="row mb-3">
                                <label for="subtopic" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic') }}</label>
                                <div class="col-md-6">
                                    <select id="subtopic" name="subtopic_id" class="form-control">
                                        <option value="">Select Subtopic</option>
                                    </select>
                                    @error('subtopic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>


        <div class="row mb-3">
          <label for="question" class="col-md-4 col-form-label text-md-end">Question ${questionCount}</label>
          <div class="col-md-6">
            <input id="question_${questionCount}" type="text" class="form-control @error('questions') is-invalid @enderror" name="questions[]" required>
            @error('questions')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
            </span>
            @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="option1" class="col-md-4 col-form-label text-md-end">{{ __('Option 1') }}</label>
                <div class="col-md-6">
                    <input id="option1_${questionCount}" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1[]" required>
                    @error('option1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="option2" class="col-md-4 col-form-label text-md-end">{{ __('Option 2') }}</label>
                <div class="col-md-6">
                    <input id="option2_${questionCount}" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2[]" required>
                    @error('option2')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="option3" class="col-md-4 col-form-label text-md-end">{{ __('Option 3') }}</label>
                    <div class="col-md-6">
                        <input id="option3_${questionCount}" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3[]" required>
                        @error('option3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="option4" class="col-md-4 col-form-label text-md-end">{{ __('Option 4') }}</label>
          <div class="col-md-6">
            <input id="option4_${questionCount}" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4[]" required>
            @error('option4')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
            </span>
            @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="answer" class="col-md-4 col-form-label text-md-end">{{ __('Correct Answer') }}</label>
          <div class="col-md-6">
            <select id="answer_${questionCount}" name="answer[]" class="form-control @error('answer') is-invalid @enderror">
              <option value="">Select Correct Answer</option>
              <option value="option1">Option 1</option>
              <option value="option2">Option 2</option>
              <option value="option3">Option 3</option>
              <option value="option4">Option 4</option>
            </select>

            @error('answer')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
            </span>
            @enderror
                </div>
              </div>

              <div class="row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
          <div class="col-md-6">

            <input id="image_${questionCount}" type="file" class="form-control-file" name="image_${questionCount}">

          </div>
        </div>

        <div>
          <button type="button" class="btn btn-danger mr-2 remove-question-btn">Remove</button>
        </div>

        </div>
    </div>
</div>`;

                $('#question-container').append(questionForm);
                var newQuestionForm = $('.card').last().find('.question-form');
                // var topicDropdown = newQuestionForm.find('#topic');
                //
                // // Attach event handler to topic dropdown for dynamic population of subtopics
                // topicDropdown.on('change', function () {
                //     populateSubtopics($(this));
                // });
                // populateSubtopics(topicDropdown);
            }

            // $('#topic').on('change', function () {
            //     populateSubtopics();
            // });

            // Event delegation for the "Add Question" button click
            $('#add-question-btn').click(function () {
                addQuestionForm();
            });

            // Event delegation for the "Remove" button click
            $(document).on('click', '.remove-question-btn', function () {
                $(this).closest('.form-group').prev('hr').remove(); // Remove the previous <hr> element
                $(this).closest('.form-group').remove(); // Remove the question form group

                // Update the question count
                updateQuestionCount();
            });
        });
    </script>

@endsection
