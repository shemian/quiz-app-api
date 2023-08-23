<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use App\Models\EducationSystem;
use App\Models\Subject;
use App\Models\SubTopicSubStrand;
use App\Models\TopicStrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TopicsAndStrandsController extends Controller
{

    public function index()
    {
        // Retrieve the EducationLevel, EducationSystem, and subjectId from session variables
        $educationSystemId = session('educationSystemId');
        $educationLevelId = session('educationLevelId');
        $subjectId = session('subjectId');
        $education_systems = EducationSystem::all();

        // Fetch the TopicStrands with the associated subject, education system, and education level
        $topicStrands = TopicStrand::with('subject.educationSystem', 'subject.educationLevel')->get();

        // Fetch the EducationLevel, EducationSystem, and subject based on the retrieved IDs
        $educationLevelId = EducationLevel::find($educationLevelId);
        $educationSystemId = EducationSystem::find($educationSystemId);
        $subjectId = Subject::find($subjectId); // Assuming you have a model named 'Subject'

        // Pass the data to the Blade view
        return view('teachers.create_topics_strands', compact('topicStrands', 'educationSystemId', 'educationLevelId', 'subjectId', 'education_systems'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'topic_strand' => 'required|string',
            'education_system_id' => 'required|string',
            'education_level_id' => 'required|string',
            'subject_id' => 'required|string',
        ]);

        // Create a new topic/strand record in the topic_strands table
        $topicStrand = TopicStrand::create([
            'subject_id' => $validatedData['subject_id'],
            'topic_strand' => $validatedData['topic_strand'],
        ]);

        // Optionally, you can return a response or redirect as needed
        return redirect()->route('topics_strands.index', [
            'educationSystemId' => $validatedData['education_system_id'],
            'educationLevelId' => $validatedData['education_level_id'],
            'subjectId' => $validatedData['subject_id'],
        ])->with('success', 'Topic/Strand created successfully');
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
