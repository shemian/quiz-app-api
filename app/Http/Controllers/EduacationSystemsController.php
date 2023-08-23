<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEducationLevelRequest;
use App\Http\Requests\CreateEducationSystemsRequest;
use Illuminate\Http\Request;
use App\Models\EducationSystem;
use App\Models\EducationLevel;

class EduacationSystemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_education_system()
    {
        $education_systems = EducationSystem::all();
        return view('admin.education_system', compact('education_systems'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store_education_system(CreateEducationSystemsRequest $request)
    {
        $data = $request->validated();

        $newEducationSystems = new EducationSystem();
        $newEducationSystems->name = $data['name'];
        $newEducationSystems->save();

        return redirect()->route('get_education_system')->with('success', 'Eduaction added successfully!');
    }



    public function store_education_level(CreateEducationLevelRequest $request)
    {

        $educationSystemId = $request->input('education_system_id');
        $name = $request->input('name');

        // Create a new EducationLevel instance
        $educationLevel = new EducationLevel();
        $educationLevel->education_system_id = $educationSystemId;
        $educationLevel->name = $name;
        $educationLevel->save();

        return redirect()->route('get_education_level')->with('success', 'Education Level added successfully!');
    }


    public function get_education_level(){
        $education_systems = EducationSystem::all();
        $education_levels = EducationLevel::with('educationSystem')->get();
        return view('admin.education_level', compact('education_levels', 'education_systems'));
    }

    //display the education Level s that belong to and Education system
    public function getEducationLevels(Request $request)
    {
        $educationSystemId = $request->input('education_system_id');
        $educationLevels = EducationLevel::where('education_system_id', $educationSystemId)->get();

        return response()->json($educationLevels);
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
