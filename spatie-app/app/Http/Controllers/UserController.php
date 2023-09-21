<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Permission;
use App\Services\PermissionService;
use App\Services\UserService;

class UserController extends Controller
{
	public function registerUser(RegisterUserRequest $request, UserService $userService)
	{

		$validate = $request->validated();
		$user = $userService->register($validate);
		if (!$user) {
			return response()->json([
				'message' => 'Something went wrong',
			], 500);
		}

		return response()->json([
			'message' => 'Registeration Successfull',
			'data' => $user,
		], 200);
	}

	public function loginUser(LoginUserRequest $request, UserService $userService, PermissionService $permissionService)
	{
		$validate = $request->validated();
		$user = $userService->login($validate);

		if (!$user) {
			return response()->json([
				'message' => 'Invalid Credentials',
			], 401);
		}

		$userPermissions = $permissionService->getUserPermissions($user->id);
		$user['permissions'] = $userPermissions;

		$token = $user->createToken('token')->plainTextToken;
		return response()->json([
			'message' => 'Login Successfull',
			'token' => $token,
			'user' => $user
		], 200);
	}

	public function logoutUser(UserService $userService)
	{
		$response = $userService->logout();
		if (!$response) {
			return response()->json(['message' => 'Something went wrong'], 500);
		}
		return response()->json(['message' => 'Logout Successfull'], 200);
	}

	public function getUsers(UserService $userService)
	{
		$user = $userService->show_all();
		return response()->json([
			'message' => 'All users Data',
			'data' => $user,
		], 200);
	}

	public function getUser($id, UserService $userService)
	{
		$user = $userService->show($id);

		if (!$user) {
			return response()->json([
				'message' => 'User not found',
			]);
		}

		return response()->json([
			'message' => 'Found',
			'data' => $user,
		], 200);
	}

	public function deleteUser($id, UserService $userService)
	{
		$user = $userService->delete($id);
		if ($user) {
			return response()->json([
				'message' => 'Successfully Deleted',
			], 200);
		}
		return response()->json([
			'message' => 'User not found',
		], 404);
	}

	public function updateUser($id, UpdateUserRequest $request, UserService $userService)
	{
		$validate = $request->validated();
		$user = $userService->update($id, $validate);
		if ($user) {
			return response()->json([
				'message' => "User Updated"
			], 200);
		}
		return response()->json([
			'message' => 'User not found',
		], 404);
	}
}
