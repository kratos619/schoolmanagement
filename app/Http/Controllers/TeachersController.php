<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Department;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
           

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$all_techer = Teachers::all();
        //\dd($all_data);
        // $all_techer = DB::table('teachers')
        // ->selectRaw('select teachers.name , department.name from teachers inner join departments on teachers.id = departments.id')
        // -get();
        
        // $all_data = Teachers::all();
        // ->select('department_id')
        // ->get();
        
        // $all_department = DB::table('departments')
        // ->select('name')
        // ->where($all_techer);
        //\dd($all_techer->department_id);
        $all_data = DB::table('teachers')
        ->select('*', 'departments.department_id')
        ->join('departments', 'departments.id', '=', 'teachers.department_id')
        ->get();
        return response()->json($all_data, 200);
    }
    
    public function totalNumberTeacher()
    {
        $all_teachers = Teachers::all()->count();
        return response()->json($all_teachers, 200);
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
            'name' => 'required|string|max:255',
            'mobile' => 'required',
            'department_id' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        Teachers::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'department_id' =>$request->department_id,
            'gender' => $request->gender,
            'address' => $request->address
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $find_teachers_by_id = Teachers::find($id);
        return response()->json($find_teachers_by_id, 200);
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
        $update_teachers = Teachers::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'mobile' => 'required',
            'department_id' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        $update_teachers->update($request->all());

        return response()->json($update_teachers, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Teachers::find($id);
        $item->delete();
        return response()->json('success');
    }
}
