<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_courses = Courses::all();
        return response()->json($all_courses, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'years' => 'required'
        ]);
        
        Courses::create([
            'name' => $request->name,
            'years' => $request->years
        ]);

        return response()->json("data added Successfully", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selected_course = Courses::findeOrFail($id);
        return response()->json($selected_course, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $selected_course = Courses::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'years' => 'required'
        ]);

        $selected_course->update($request->all());
        return response()->json("Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $select_course = Courses::findOrFail($id);
        $select_course->delete();
        return response()->json("success", 200);
    }
}
