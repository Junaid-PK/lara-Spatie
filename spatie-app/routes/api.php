<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Models\User;

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
    Route::get('/users', [UserController::class, 'getUsers'])->middleware('permission:can-access-all-users');
    Route::post('/create', [TaskController::class, 'assignTask'])->middleware('permission:can-create-task');
    Route::post('/show', [TaskController::class, 'show'])->middleware('permission:can-view-task');
    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])->middleware('permission:can-delete-task');
    Route::put('/update/{id}', [TaskController::class, 'Update_task'])->middleware('permission:can-update-task'); // for updating complete start
    Route::put('/reassign/{id}', [TaskController::class, 'reassign_task'])->middleware('permission:can-reassign-task'); // for reassigning the task
});


// Routes for TeamController
Route::middleware('auth:sanctum')->group(function(){
Route::get('/teamindex', [TeamController::class, 'index'])->middleware('permission:can-view-teams');
Route::post('/teamcreate', [TeamController::class, 'store'])->middleware('permission:can-create-teams');
Route::get('/teamshow/{id}', [TeamController::class, 'show'])->middleware('permission:can-view-specific-team');
Route::put('/teamupdate', [TeamController::class, 'update'])->middleware('permission:can-update-teams');
Route::delete('/teamdestroy/{id}', [TeamController::class, 'destroy'])->middleware('permission:can-delete-team');
});

// Routes for TeamMemberController
Route::middleware('auth:sanctum')->group(function(){
Route::get('/memberindex', [TeamMemberController::class, 'index'])->middleware('permission:can-view-members');
Route::post('/membercreate', [TeamMemberController::class, 'store'])->middleware('permission:can-create-members');
Route::get('/membershow/{id}', [TeamMemberController::class, 'show'])->middleware('permission:can-view-specific-member');
Route::put('/memberupdate/{id}', [TeamMemberController::class, 'update'])->middleware('permission:can-update-member');
Route::delete('/memberdestroy/{id}', [TeamMemberController::class, 'destroy'])->middleware('permission:can-delete-member');
});




Route::middleware()->group(function(){
    Route::post('add',[DepartmentController::class,'adding'])->middleware('permission:can-add-department');
    Route::put('update/{id}',[DepartmentController::class,'updating'])->middleware('permission:can-update-department');
    Route::delete('delete/{id}',[DepartmentController::class,'delete'])->middleware('permission:can-delete-department');
    Route::get('get',[DepartmentController::class,'getData'])->middleware('permission:can-view-department');
});



