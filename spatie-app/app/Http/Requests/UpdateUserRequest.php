<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'sometimes|required',
			'password' => 'sometimes|required|min:8',
			'confirm_password' => 'sometimes|required|same:password',
			'permissions' => 'sometimes|required|array',
			'department_id' => 'sometimes|required|exists:departments,id',
			'teamids' => 'sometimes|required|array',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	 */
	public function messages(): array
	{
		return [
			'name.required' => 'Name is required',
			'password.required' => 'Password is required',
			'password.min' => 'Password must be atleast 8 characters',
			'confirm_password.required' => 'Confirm Password is required',
			'confirm_password.same' => 'Confirm Password must be same as Password',
			'permissions.required' => 'Permissions are required',
			'permissions.array' => 'Permissions must be an array',
			'department_id.required' => 'Department is required',
			'department_id.exists' => 'Department does not exist',
			'teamids.required' => 'Teams are required',
			'teamids.array' => 'Teams must be an array',
		];
	}
}
