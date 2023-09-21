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
		$user = User::where('id', $id)->delete();
		return $user;
	}

	public function update($id, array $data)
	{
		$user = User::find($id);

		$user = $user->update([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => $data['password']
		]);
		return $user;
	}
}