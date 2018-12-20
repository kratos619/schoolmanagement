<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_department = Department::all();
        return response()->json($all_department, 200);
    }

    public function totalNumberDepartment()
    {
        $all_Departments = Department::all()->count();
        return response()->json($all_Departments, 200);
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
           'department_id' => 'required'
       ]);
       
        Department::create([
           'department_id' => $request->department_id
       ]);
        return response()->json("Success", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $select_department  = Department::findOrFail($id);
        return response()->json($select_department, 200);
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
        $slecte_depertment = Department::findOrFail($id);
        $this->validate($request, [
           'department_id' => 'required'
       ]);
        $slecte_depertment->update($request->all());
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
        $selecet_depertment = Department::find($id);
        $selecet_depertment->delete();
        return response()->json($selecet_depertment, 200);
    }
}
