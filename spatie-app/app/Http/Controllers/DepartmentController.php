<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

// use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function postDepartments(PostDepartmentRequest $request, DepartmentService $departmentService)
    {

        $validated = $request->validated();
        $department = $departmentService->postDepartment($validated);
        if (!$department) {
            return response()->json([
                'message' => 'Failed to create a new Department'
            ]);
        }
        return response()->json([
            'message' => 'Department Created Successfully'
        ],200);
    }
    public function getDepartments(DepartmentService $departmentService)
    {
        $response = $departmentService->getDepartment();
        return $response;
    }
    public function showDepartments($id, DepartmentService $departmentService)
    {
        $department = $departmentService->showDepartment($id);
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json($department);
    }
    public function updateDepartments($id, UpdateDepartmentRequest $request, DepartmentService $departmentService)
    {
        $validated = $request->validated();
        $department= $departmentService->updateDepartment($id, $validated);
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json([
            'message' => "Department Updated Successfully"
        ]);
    }

    public function deleteDepartments($id, DepartmentService $departmentService)
    {
        $department = $departmentService->deleteDepartment($id);
        if (!$department) {
            return response()->json(['message' => 'Department not found'], 404);
        }
        return response()->json(['message' => 'Department Deleted Duccessfully']);
    }
}