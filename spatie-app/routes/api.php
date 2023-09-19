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




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/users', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users');


    // Route for TaskController
    Route::post('/tasks', [TaskController::class, 'postTasks'])->middleware('permission:can-create-task');
    Route::get('/tasks', [TaskController::class, 'getTasks'])->middleware('permission:can-view-task');
    Route::get('/tasks/{id}', [TaskController::class, 'showTasks'])->middleware('permission:can-view-task');
    Route::delete('/tasks/{id}', [TaskController::class, 'deleteTasks'])->middleware('permission:can-delete-task');
    Route::put('/tasks/{id}', [TaskController::class, 'updateTasks'])->middleware('permission:can-update-task'); // for updating complete start
    Route::put('/tasks/reassign/{id}', [TaskController::class, 'reassignTasks'])->middleware('permission:can-reassign-task'); // for reassigning the task


    // Routes for TeamController
    Route::get('/teams', [TeamController::class, 'index'])->middleware('permission:can-view-teams');
    Route::post('/team/add', [TeamController::class, 'store'])->middleware('permission:can-create-teams');
    Route::get('/team/show', [TeamController::class, 'show'])->middleware('permission:can-view-specific-team');
    Route::put('/team/update/{id}', [TeamController::class, 'update'])->middleware('permission:can-update-teams');
    Route::delete('/team/delete/{id}', [TeamController::class, 'destroy'])->middleware('permission:can-delete-team');



    // Routes for TeamMemberController
    Route::get('/members', [TeamMemberController::class, 'index'])->middleware('permission:can-view-members');
    Route::post('/member/add', [TeamMemberController::class, 'store'])->middleware('permission:can-create-members');
    Route::get('/member/show', [TeamMemberController::class, 'show'])->middleware('permission:can-view-specific-member');
    Route::put('/member/update', [TeamMemberController::class, 'update'])->middleware('permission:can-update-member');
    Route::delete('/member/delete', [TeamMemberController::class, 'destroy'])->middleware('permission:can-delete-member');



    // Routes for DepartmentController
    Route::post('/departments', [DepartmentController::class, 'postDepartments'])->middleware('permission:can-add-department');
    Route::put('/departments/{id}', [DepartmentController::class, 'updateDepartments'])->middleware('permission:can-update-department');
    Route::delete('/departments/{id}', [DepartmentController::class, 'deleteDepartments'])->middleware('permission:can-delete-department');
    Route::get('/departments', [DepartmentController::class, 'getDepartments'])->middleware('permission:can-view-department');
    Route::get('/departments/{id}', [DepartmentController::class, 'showDepartments'])->middleware('permission:can-view-department');
});