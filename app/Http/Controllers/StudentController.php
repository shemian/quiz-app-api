<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Enums\ExamType;
use App\Models\BrainGame;
use App\Models\Exam;
use App\Models\StudentSubscriptionPlan;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Result;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $student = Student::where('user_id', $user->id)->first();

        // Get the result of the student and display it on the dashboard because results has the exam_id and the student_id and exams has question so will dipslay the number of exams, questions in that exam and date of that result
        $question_exams_counts = Result::where('student_id', $student->id)->with('exam')->get();
        $results = Result::where('student_id', $student->id)->with('exam')->get();

        //create a variable to count the number of questions and exams a student has done depending on the results
        $questions_count = 0;
        $exams_count = 0;
        $exams = [];

        foreach ($question_exams_counts as $result) {
            $questions_count += $result->exam->questions->count();
            $exams_count += 1;
            $exams[] = $result->exam;
        }

        // Get the centy_balance of the student and account_balance and centiisObtained and display it on the dashboard
        $centy_balance = $student->centy_balance;
        $account_balance = $student->debit;
        $centiisObtained = $student->centiisObtained;
        return view('students.dashboard', compact('centy_balance', 'account_balance', 'centiisObtained', 'questions_count', 'exams_count', 'exams', 'results'));
    }

    public function getSubjects()
    {
        $user = Auth::user();
        $student = $user->student;

        $subjects = Subject::with(['educationLevel', 'educationSystem'])
            ->where('education_level_id', $student->educationLevel->id)
            ->where('education_system_id', $student->educationSystem->id)
            ->select('id', 'name', 'education_level_id', 'education_system_id', 'created_at')
            ->get();
        return view('students.get_subjects', compact('subjects'));
    }

    public function getExams()
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        //check if status is active and display the exam
        if ($student->account_status === AccountStatus::ACTIVE && isset($student->active_subscription) ) {
        $exams = Exam::with(['subject.educationLevel', 'subject.educationSystem'])
            ->whereHas('subject', function ($query) use ($student) {
                $query->where('education_level_id', $student->educationLevel->id)
                    ->where('education_system_id', $student->educationSystem->id);
            })
            ->select('id', 'name', 'subject_id', 'created_at')
            ->get();
        return view('students.get_exams', compact('exams'));
        } else {
            return redirect()->back()->with('error', 'Your account is not active. Please contact the administrator.');
        }

    }

    public function showQuestions($examId)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the corresponding student record based on the user's ID
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            // Handle the case where the student record does not exist
            return redirect()->back()->with('error', 'Student record not found.');
        }

        // Check if a result exists for the given student and exam
        $result = Result::where('student_id', $student->id)->where('exam_id', $examId)->first();

        if ($result) {
            // Redirect to the view_result route with the result ID parameter
            return redirect()->route('students.view_results', ['result' => $result]);
        }

        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions;

        $formatedQuestions = [];

        foreach ($questions as $key => $question) {
            $question = [
                'numb' => $key + 1,
                'question' => $question['question'],
                'answer' => $question['answer'],
                'options' => [
                    $question['option1'],
                    $question['option2'],
                    $question['option3'],
                    $question['option4']
                ],
                'image' => $question['image'],
            ];

            $formatedQuestions[] = $question;
        }
        Log::info($formatedQuestions);
        return view('students.display_questions', compact('exam', 'formatedQuestions', 'questions', 'student'));
    }

    public function submitAnswers(Request $request, $examId)
    {
        $request->validate([
            'yes_ans' => 'required',
            'no_ans' => 'required',
            'result_json' => 'required'
        ]);

        $exam = Exam::findOrFail($examId);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Retrieve the corresponding student record based on the user's ID
        $student = Student::where('user_id', $user->id)->first();

        if (!$student) {
            // Handle the case where the student record does not exist
            return redirect()->back()->with('error', 'Student record not found.');
        }

        $totalMarks = 0;
        $resultDetails = [];

//        foreach ($answers as $questionId => $selectedAnswer) {
//            $question = Question::find($questionId);
//
//            if (!$question || $question->exam_id !== $exam->id) {
//                // Handle the case where the question does not exist or does not belong to the exam
//                continue;
//            }
//
//            $correctAnswer = $question->answer;
////            $totalMarks += $question->marks;
//
//            if ($correctAnswer === $selectedAnswer) {
//                $resultDetails[$questionId] = 'correct';
//            } else {
//                $resultDetails[$questionId] = 'incorrect';
//            }
//        }

        $correctQuestionCount = intval($request->input('yes_ans')) ;
        $incorrectQuestionCount = intval($request->input('no_ans'));

        // Accumulate the total marks
        $totalMarks = $correctQuestionCount + $incorrectQuestionCount;
        $marksObtained = $totalMarks > 0 ? ($correctQuestionCount / $totalMarks) * 100 : 0;

        $result = Result::create([
            'student_id' => $student->id,
            'exam_id' => $examId,
            'subject_id' => $exam->subject_id,
            'yes_ans' => $correctQuestionCount, // Count the number of correct answers
            'no_ans' => $incorrectQuestionCount, // Count the number of incorrect answers
            'result_json' => json_encode($request->input('result_json')), // Store the answers in JSON format
            'marks_obtained' => $marksObtained, // Store the marks obtained
        ]);

        $result->save();

        if (!$result->isDirty()) {
            $studentSubPlan = StudentSubscriptionPlan::where([
                "id" => $student->active_subscription,
                "student_id" => $student->id,
            ])->first();

            Log::info("Active plan: " . $studentSubPlan->subscription_plan_id);

            $subscriptionPlan = $studentSubPlan->subscriptionPlan;
            Log::info("Subscription plan: " . $subscriptionPlan);

            // Divide the number of correct answers by the total number of questions and multiply by the price of the active subscription
            $centiisObtained = ($correctQuestionCount / $totalMarks) * ($subscriptionPlan->price / 2);

            Log::info("centiisObtained: " . $centiisObtained);
            $student->centy_balance = $student->centy_balance - floatval($centiisObtained);
            Log::info("centy_balance: " . $student->centy_balance);
            $student->debit = $student->debit + floatval($centiisObtained);
            Log::info("debit: " . $student->debit);
            $student->save();

            return redirect()->route('students.view_results', ['result' => $result->id])->with('success', 'Answers submitted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Your account is not active. Please contact the administrator.']);
        }
    }

    public function viewResult(Result $result)
    {
        // Retrieve the exam related to the result
        $exam = $result->exam;

        // Retrieve the exam ID from the result
        $examId = $result->exam_id;

        // Retrieve the questions related to the exam
        $questions = Question::where('exam_id', $examId)->get();

        // Decode the result JSON to retrieve the details of correct and incorrect answers
        $resultDetails = json_decode($result->result_json, true);

        // Create an array to store the details of correct and incorrect answers
        $answersDetails = [
            'correct' => [],
            'incorrect' => [],
        ];

        foreach ($questions as $question) {
            $questionId = $question->id;

            // Check if the result details array has an entry for the question ID
            if (array_key_exists($questionId, $resultDetails)) {
                $answerStatus = $resultDetails[$questionId];

                // If the answer is correct, add the question to the correct answers details array
                if ($answerStatus === 'correct') {
                    $answersDetails['correct'][] = $question;
                } else {
                    // If the answer is incorrect, add the question and its correct answer to the incorrect answers details array
                    $answersDetails['incorrect'][] = [
                        'question' => $question,
                        'correctAnswer' => $question->answer,
                    ];
                }
            }
        }

        return view('students.view_result', compact('result', 'exam', 'answersDetails'));
    }

    public function brainGame(Request $request)
    {
        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();


        // Retrieve questions
        $questions = Question::where('education_level_id', $student->educationLevel->id)
            ->inRandomOrder()
            ->take(10) // Change the number to the desired amount of questions
            ->get();

        Log::info('random questions'. $questions);
        $formatedQuestions = [];

        foreach ($questions as $key => $question) {
            $question = [
                'numb' => $key + 1,
                'question' => $question['question'],
                'answer' => $question['answer'],
                'options' => [
                    $question['option1'],
                    $question['option2'],
                    $question['option3'],
                    $question['option4']
                ]
            ];

            $formatedQuestions[] = $question;
        }

        Log::info($formatedQuestions);

        return view('students.brain_game', compact('formatedQuestions', 'questions', 'user', 'student'));
    }

    public function submitBrainGame(Request $request){

        $user = Auth::user();
        $student = Student::where('user_id', $user->id)->first();

        // fetch the users whose email is teacher@admin.com
//        $teacher_user = User::where('email', 'teacher@admin.com')->first();
//        $admin_teacher = Teacher::where('user_id', $teacher_user->id)->first();

        $correctQuestionCount = intval($request->input('yes_ans')) ;
        $incorrectQuestionCount = intval($request->input('no_ans'));

        // Accumulate the total marks
        $totalMarks = $correctQuestionCount + $incorrectQuestionCount;
        $marksObtained = $totalMarks > 0 ? ($correctQuestionCount / $totalMarks) * 100 : 0;

        $brain_result = BrainGame::create([
            'name' => $user->name ." 's Brain Game on ". date('m-d-Y'),
            'student_id' => $student->id,
            'yes_ans' => $correctQuestionCount, // Count the number of correct answers
            'no_ans' => $incorrectQuestionCount, // Count the number of incorrect answers
            'result_json' => json_encode($request->input('result_json')), // Store the answers in JSON format
            'marks_obtained' => $marksObtained, // Store the marks obtained
        ]);

        $brain_result->save();
        return redirect()->route('students.brain_game_results', ['result' => $brain_result->id])->with('success', 'Answers submitted successfully.');

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

