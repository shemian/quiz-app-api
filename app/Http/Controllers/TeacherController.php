<?php

namespace App\Http\Controllers;

use App\Models\EducationSystem;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        $subject_count = Subject::where('teacher_id', $teacher->id)->count();
        $exam_count = Exam::where('teacher_id', $teacher->id)->count();
        $education_systems = EducationSystem::all();

        $exams = $teacher->exams()
            ->with(['subject.educationLevel', 'subject.educationSystem'])
            ->withCount('questions')
            ->get();

        $topics_subtopics_counts = [];
        $questionCount = 0;

        foreach ($exams as $exam) {
            $topicStrands = $exam->questions()->distinct('topic_strand_id')->count('topic_strand_id');
            $subTopicStrands = $exam->questions()->distinct('sub_topic_sub_strand_id')->count('sub_topic_sub_strand_id');
            $topics_subtopics_counts[$exam->id] = ['topicStrands' => $topicStrands, 'subTopicStrands' => $subTopicStrands];
            $questionCount += $exam->questions_count;
        }

    return view('teachers.dashboard', compact('education_systems', 'exams', 'topics_subtopics_counts', 'subject_count', 'exam_count', 'questionCount'));
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
