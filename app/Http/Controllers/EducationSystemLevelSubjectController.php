<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationSystemLevelSubject;

class EducationSystemLevelSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'education_system_id' => 'required',
            'education_level_id' => 'required',
            'subject_id' => 'required',
        ]);

        // Create EducationSystemLevelSubjects
        $education = new EducationSystemLevelSubject();
        $education->education_system_id = $request->education_system_id;
        $education->education_level_id = $request->education_level_id;
        $education->subject_id = $request->subject_id;
        $education->save();

        return redirect()->route('create_question')
            ->with('success', 'Subject For Education System and Education Level Created');

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
