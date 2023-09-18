<?php

 namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{   
    public function addDepartment(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        return Department::create([
            'name'=>$request->input('name'),
        ]);
    }

    // /**
    //  * Summary of updateDepartment
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\JsonResponse|mixed
    //  */
    public function updateDepartment(Request $request, $id)
    {
        $items= Department::find($id);
        $items->name=$request->name;
        $items->update();
        return response()->json([
            'message' => 'Department Updated Successfully'
        ]);
    }

    public function deleteDepartment(Request $request,$id)
    {
        Department::findorfail($id)->delete();
        return response()->json([
            'message' =>'Department deleted Succesfully'
        ]);
    }
    public function getDepartments()
    {
        $items= Department::all();
        return $items;
    }

    public function getDepartment(Request $request)
    {
        $department = Department::find($request->department_id);
        return $department;
    }
}