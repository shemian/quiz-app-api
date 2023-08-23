<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OTPVerificationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SubTopicSubStrandController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\EduacationSystemsController;
use App\Http\Controllers\EducationSystemLevelSubjectController;
use App\Http\Controllers\TopicsAndStrandsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/otp/enter', [OTPVerificationController::class, 'enterOTP'])->name('otp.enter');
Route::post('/otp/validate', [OTPVerificationController::class, 'validateOTP'])->name('otp.validate');

Route::prefix('/admin')->middleware(['isAdmin'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/teachers', [AdminController::class, 'get_teachers'])->name('get_teachers');
    Route::post('/teachers', [AdminController::class, 'store_teachers'])->name('store_teachers');
    Route::get('/getTeachers', [AdminController::class, 'display_Teachers'])->name('teachers.list');
    Route::get('/teacher-profile', [AdminController::class, 'teacher_profile'])->name('teacher_profile');

    Route::get('/customers', [AdminController::class, 'get_customers'])->name('get_customers');
    Route::get('/view_students', [AdminController::class, 'get_students'])->name('view_students');
    Route::put('/edit_account_status/{id}', [AdminController::class, 'update_student_account'])->name('update_student_account_status');
    Route::delete('/delete-students/{id}', [AdminController::class, 'destroy_student_account'])->name('destroy_student_account');

    Route::get('/transactions', [AdminController::class, 'get_transactions'])->name('get_transactions');


    Route::get('/education_system', [EduacationSystemsController::class, 'get_education_system'])->name('get_education_system');
    Route::post('/education_system', [EduacationSystemsController::class, 'store_education_system'])->name('store_education_system');

    Route::get('/education_level', [EduacationSystemsController::class, 'get_education_level'])->name('get_education_level');
    Route::post('/education_level', [EduacationSystemsController::class, 'store_education_level'])->name('store_education_level');

    Route::get('/sms', [AdminController::class, 'get_sms'])->name('get_sms');

    // Subscriptions Plan Routes
    Route::resource('subscriptions', SubscriptionPlanController::class);

    Route::get('/view-parent/{id}', [AdminController::class,'parent_details'])->name('view_parent_details');
});

Route::prefix('parent')->middleware(['isParent'])->group(function(){
    Route::get('/', [GuardianController::class, 'index'])->name('parent.dashboard');
    Route::get('/create_students', [GuardianController::class, 'createStudent'])->name('get_students');
    Route::post('/students', [GuardianController::class, 'store'])->name('store_student');
    Route::post('/education-levels', [EduacationSystemsController::class, 'getEducationLevels'])->name('get_education_levels');
    Route::post('/stk-push', [GuardianController::class, 'activateStudent'])->name('stk_push');
    Route::post('/edit-students/{id}', [GuardianController::class, 'update'])->name('update_student');
    Route::delete('/delete-students/{id}', [GuardianController::class, 'destroy'])->name('delete_student');

    Route::get('/view-students/{id}', [GuardianController::class,'student_details'])->name('view_student_details');
    Route::get('/profile', [GuardianController::class, 'parent_profile'])->name('parent_profile');

});

Route::prefix('teacher')->middleware([ 'isTeacher'])->group(function(){
    Route::get('/', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('get_subjects');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('store_subjects');
    Route::post('/edit-subjects/{id}', [SubjectController::class, 'update'])->name('update_subjects');
    Route::delete('/delete-subjects/{id}', [SubjectController::class, 'destroy'])->name('delete_subjects');

    Route::get('/questions', [QuestionController::class, 'index'])->name('get_questions');

    Route::get('/get-education-levels', [QuestionController::class, 'getEducationLevels']);
    Route::get('/get-subjects', [QuestionController::class, 'getSubjects']);
    Route::get('/get-topics/{subjectId}', [QuestionController::class, 'getTopics']);
    Route::get('/get-subtopics', [QuestionController::class, 'getSubtopics']);

    Route::get('/create_question/{examId}', [QuestionController::class, 'create_question'])->name('create_question');


    Route::get('/create_topics_and_strands/', [TopicsAndStrandsController::class, 'index'])->name('topics_strands.index');
    Route::post('/create_topics_and_strands', [TopicsAndStrandsController::class, 'store'])->name('store_topics_and_strands');

    Route::get('/create_subtopics', [SubTopicSubStrandController::class, 'index'])->name('createSubtopicSubStrand');
    Route::post('/create_subtopics', [SubTopicSubStrandController::class, 'store'])->name('storeSubtopicSubStrand');

    Route::post('/questions', [QuestionController::class, 'store'])->name('store_questions');
    Route::post('/display_education_level', [EduacationSystemsController::class, 'getEducationLevels'])->name('getEducationLevels');

    Route::get('/exams', [ExamController::class, 'index'])->name('get_exams');
    Route::post('/exams', [ExamController::class, 'store'])->name('store_exams');
    Route::post('/edit-exams/{id}', [ExamController::class, 'update'])->name('update_exams');
    Route::delete('/delete-exams/{id}', [ExamController::class, 'destroy'])->name('delete_exams');

});

Route::prefix('student')->middleware(['auth', 'isStudent'])->group(function(){
    Route::get('/', [StudentController::class, 'index'])->name('student.dashboard');
    Route::get('/view_exams', [StudentController::class, 'getExams'])->name('view_exams');
    Route::get('/brain_game', [StudentController::class, 'brainGame'])->name('student_brain_game');
    Route::get('/view_questions', [StudentController::class, 'getSubjects'])->name('view_questions');
    Route::get('/questions/{exam}', [StudentController::class, 'showQuestions'])->name('show_questions');
    Route::post('/questions/{exam}', [StudentController::class, 'submitAnswers'])->name('questions.submit');
    Route::get('/view_result/{result}', [StudentController::class, 'viewResult'])->name('students.view_results');
    Route::post('/brain_game', [StudentController::class, 'submitBrainGame'])->name('brain_game.submit');
});
