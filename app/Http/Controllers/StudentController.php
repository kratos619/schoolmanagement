<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_students = Student::latest()->paginate(10);
        return response()->json($all_students, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $erors =  $this->validate($request, [
            'name' => 'required|string|max:255',
            'mobile' => 'required|unique:students',
            'dob' => 'required',
            'course' => 'required',
            'rollnumber' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        $student = Student::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'dob' => $request->dob ,
            'course' =>$request->course,
            'rollnumber' => $request->rollnumber,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

        if ($student) {
            return response()->json($student, 200);
        } else {
            return response()->json($erors, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find_student_by_id = Student::find($id);
        return response()->json($find_student_by_id, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $update_students = Student::find($id);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'mobile' => 'required|unique:students',
            'dob' => 'required',
            'course' => 'required',
            'rollnumber' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        $update_students->update();

        return response()->json($update_students, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Student::find($id);
        $item->delete();
        return response()->json('success');
    }
}
