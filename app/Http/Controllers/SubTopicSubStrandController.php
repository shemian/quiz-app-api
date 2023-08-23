<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use App\Models\EducationSystem;
use App\Models\Subject;
use App\Models\SubTopicSubStrand;
use App\Models\TopicStrand;
use Illuminate\Http\Request;

class SubTopicSubStrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Retrieve the EducationLevel, EducationSystem, and subjectId from session variables
        $educationSystemId = session('educationSystemId');
        $educationLevelId = session('educationLevelId');
        $subjectId = session('subjectId');
        $education_systems = EducationSystem::all();

        // Fetch the TopicStrands with the associated subject, education system, and education level
        $topicStrands = TopicStrand::with('subject.educationSystem', 'subject.educationLevel')->get();
        $subtopics = SubTopicSubStrand::with('topicStrand')->get();

        // Fetch the EducationLevel, EducationSystem, and subject based on the retrieved IDs
        $educationLevelId = EducationLevel::find($educationLevelId);
        $educationSystemId = EducationSystem::find($educationSystemId);
        $subjectId = Subject::find($subjectId); // Assuming you have a model named 'Subject'

        // Pass the data to the Blade view
        return view('teachers.create_subtopic_substrand', compact('topicStrands', 'educationSystemId', 'educationLevelId', 'subjectId', 'education_systems', 'subtopics'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new subtopic/substrand for the given topic strand
        SubTopicSubStrand::create([
            'name' => $request->input('name'),
            'topic_strand_id' => $request->input('topic_strand_id'),
        ]);

        return redirect()->route('createSubtopicSubStrand')->with('success', 'Subtopic/Substrand added successfully');

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
