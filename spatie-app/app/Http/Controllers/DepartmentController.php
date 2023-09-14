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
    public function updateDepartment(Request $request)
    {
        $id = $request->department_id;
        $items= Department::find($id);
        $items->name=$request->name;
        $items->update();
        return response()->json([
            'message' => 'Department Updated Successfully'
        ]);
    }

    public function deleteDepartment(Request $request)
    {
        $department_id = $request->department_id;
        Department::findorfail($department_id)->delete();
        
        return response()->json([
            'message' =>'Department deleted Succesfully'
        ]);
    }
    public function getDepartments()
    {
        $items= Department::all();
        return response()->json([
            'message' => $items
        ]);
    }
}