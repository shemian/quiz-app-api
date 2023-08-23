<?php

namespace App\Http\Controllers;

use App\Models\EducationSystem;
use App\Models\Teacher;
use App\Models\TopicStrand;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectsRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('educationSystem', 'educationLevel')->get();

        foreach ($subjects as $subject) {
            $count = TopicStrand::where('subject_id', $subject->id)->count();
            $subject->topicsCount = $count;
        }

        $education_systems = EducationSystem::all();

        return view('teachers.subjects', compact('subjects', 'education_systems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectsRequest $request)
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

        $newSubject = new Subject();
        $newSubject->name = $data['name'];
        $newSubject->teacher_id = $teacher->id;
        $newSubject->education_system_id = $data['education_system_id'];
        $newSubject->education_level_id = $data['education_level_id'];
        $newSubject->save();

        return redirect()->route('get_subjects')->with('success', 'Subject created successfully!');
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
    public function update(SubjectsRequest $request, string $id)
    {
        $data = $request->validated();

        $subject = Subject::findOrFail($id);

        $subject->name = $data['name'];
        $subject->education_system_id = $data['education_system_id'];
        $subject->education_level_id = $data['education_level_id'];
        $subject->save();

        return redirect()->route('get_subjects')->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('get_subjects')->with('success', 'Subject deleted successfully!');
    }
}
