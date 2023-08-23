<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamRequest;
use App\Models\EducationSystem;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $user = auth()->user();
        $teacher = Teacher::where('user_id', $user->id)->first();
        $education_systems = EducationSystem::all();

        $exams = $teacher->exams()
            ->with(['subject.educationLevel', 'subject.educationSystem'])
            ->withCount('questions')
            ->get();

        $topics_subtopics_counts = [];
        foreach ($exams as $exam) {
            $topicStrands = $exam->questions()->distinct('topic_strand_id')->count('topic_strand_id');
            $subTopicStrands = $exam->questions()->distinct('sub_topic_sub_strand_id')->count('sub_topic_sub_strand_id');
            $topics_subtopics_counts[$exam->id] = ['topicStrands' => $topicStrands, 'subTopicStrands' => $subTopicStrands];
        }

        return view('teachers.exams', compact('education_systems', 'exams', 'topics_subtopics_counts'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CreateExamRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        if (!$user) {
            // Handle the case when the user is not authenticated
            return redirect()->back()->with('error', 'You must be logged in to create a subject.');
        }

        $teacher = Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            // Handle the case when the authenticated user is not a teacher
            return redirect()->back()->with('error', 'You must be a teacher to create a subject.');
        }


        $newExamRecord = new Exam();
        $newExamRecord->teacher_id = $teacher->id;
        $newExamRecord->name = $data['name'];
        $newExamRecord->subject_id = $data['subject_id'];
        $newExamRecord->save();

        return redirect()->route('get_exams')->with('success', 'Exam Created successfully!');
    }


    public function show(string $id)
    {
        $exam = Exam::find($id);

        if (!$exam) {
            return redirect()->back()->with('error', 'Exam not found.');
        }

        return view('exam.show', compact('exam'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validated();

        $exam = Exam::find($id);

        if (!$exam) {
            return redirect()->back()->with('error', 'Exam not found.');
        }

        $exam->name = $data['name'];
        $exam->subject_id = $data['subject_id'];
        $exam->save();

        return redirect()->route('get_exams')->with('success', 'Exam updated successfully!');
    }

    public function destroy(string $id)
    {
        $exam = Exam::find($id);

        if (!$exam) {
            return redirect()->back()->with('error', 'Exam not found.');
        }

        $exam->delete();

        return redirect()->route('get_exams')->with('success', 'Exam deleted successfully!');
    }

}
