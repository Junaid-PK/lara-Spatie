<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);




Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/users', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users');


    // Route for TaskController
    Route::post('/task/create', [TaskController::class, 'assignTask'])->middleware('permission:can-create-task');
    Route::post('/task/show', [TaskController::class, 'show'])->middleware('permission:can-view-task');
    Route::delete('/task/delete', [TaskController::class, 'destroy'])->middleware('permission:can-delete-task');
    Route::put('/task/update', [TaskController::class, 'Update_task'])->middleware('permission:can-update-task'); // for updating complete start
    Route::put('/task/reassign', [TaskController::class, 'reassign_task'])->middleware('permission:can-reassign-task'); // for reassigning the task



    // Routes for TeamController
    Route::get('/teams', [TeamController::class, 'index'])->middleware('permission:can-view-teams');
    Route::post('/team/add', [TeamController::class, 'store'])->middleware('permission:can-create-teams');
    Route::get('/team/show', [TeamController::class, 'show'])->middleware('permission:can-view-specific-team');
    Route::put('/team/update', [TeamController::class, 'update'])->middleware('permission:can-update-teams');
    Route::delete('/team/delete', [TeamController::class, 'destroy'])->middleware('permission:can-delete-team');



    // Routes for TeamMemberController
    Route::get('/members', [TeamMemberController::class, 'index'])->middleware('permission:can-view-members');
    Route::post('/member/add', [TeamMemberController::class, 'store'])->middleware('permission:can-create-members');
    Route::get('/member/show', [TeamMemberController::class, 'show'])->middleware('permission:can-view-specific-member');
    Route::put('/member/update', [TeamMemberController::class, 'update'])->middleware('permission:can-update-member');
    Route::delete('/member/delete', [TeamMemberController::class, 'destroy'])->middleware('permission:can-delete-member');



    // Routes for DepartmentController
    Route::post('/department/add',[DepartmentController::class,'addDepartment'])->middleware('permission:can-add-department');
    Route::put('/department/update',[DepartmentController::class,'updateDepartment'])->middleware('permission:can-update-department');
    Route::delete('/department/delete',[DepartmentController::class,'deleteDepartment'])->middleware('permission:can-delete-department');
    Route::get('/departments',[DepartmentController::class,'getDepartments'])->middleware('permission:can-view-department');
});