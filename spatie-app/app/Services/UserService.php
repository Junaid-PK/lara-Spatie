<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserService
{
	public function register(array $data)
	{
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => $data['password'],
			'role' => 'user',
		]);
		return $user;
	}

	public function login(array $data)
	{
		$email = $data['email'];
		$password = $data['password'];

		try {
			$user = User::where('email', $email)->first();
			if (!$user || !Hash::check($password, $user->password)) {
				return [];
			}
			return $user;
		} catch (Exception $e) {
			return [];
		}
	}

	public function logout()
	{
		auth()->user()->tokens()->delete();
		return true;
	}

	public function show_all()
	{
		$user = User::all();
		return $user;
	}

	public function show($id)
	{
		$user = User::find($id);
		return $user;
	}

	public function delete($id)
	{
		$user = User::where('id', $id);
		$user->delete();
		return $user;
	}

	public function update($id, array $data)
	{
		$user = User::find($id);
		if (!$user) {
			return false;
		}

		// we have teammembers table, check for the $data->teamIds array that contains the list of team ids of a user.
		// if the $data->teamIds array is not empty, then we can update the teammembers table.
		if (!empty($data['teamIds'])) {
			\App\Models\Teammember::where('user_id', $id)->delete();
			foreach ($data['teamIds'] as $teamId) {
				\App\Models\Teammember::create([
					'user_id' => $id,
					'team_id' => $teamId,
				]);
			}
		}

		// update user department if the $data->department_id is not empty
		if (!empty($data['department_id'])) {
			// check if the department exists
			if (\App\Models\Department::find($data['department_id'])) {
				$user->department_id = $data['department_id'];
			}
		}

		// permissions is list of permissions to assign to user. but first we need to check if the permissions exists
		if (!empty($data['permissions'])) {
			$permissions = [];
			foreach ($data['permissions'] as $permission) {
				if (\App\Models\Permission::find($permission)) {
					$permissions[] = $permission;
				}
			}
			$user->syncPermissions($permissions);
		}

		$user->name = $data['name'];

		if (!empty($data['password'])) {
			$user->password = $data['password'];
		}

		$user->save();
		return $user;
	}

	public function user_check($id)
	{
		try {
			$user = User::find($id);
			return $user;
		} catch (\Throwable $th) {
			return false;
		}
	}
}
