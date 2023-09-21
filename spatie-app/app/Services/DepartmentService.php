<?php
namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class DepartmentService
{
    public function postDepartment(array $data)
    {
        $name = $data['name'];
        $department = Department::create([
            'name' => $name,
        ]);
        return $department;
        

    }

    public function getDepartment()
    {
        $departments = Department::paginate(15);
        return $departments;
    }
    public function showDepartment($id)
    {
        $department = Department::find($id);
        return $department;
       
    }

    public function updateDepartment($id, array $data)
    {
        $department = Department::find($id);
        $department->name = $data['name'];
        // Save the updated department
        $department=$department->save();
       return $department;
    }

    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        $department=$department->delete();
        return $department;
        
    }

}
?>