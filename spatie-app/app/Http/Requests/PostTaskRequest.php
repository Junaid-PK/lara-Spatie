<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostTaskRequest extends FormRequest
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
			'name' => 'required',
			'status' => 'required',
			'comments' => 'required',
			'user_id' => 'required',
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 */
	public function messages(): array
	{
		return [
			'name.required' => 'A name is required',
			'status.required' => 'A status is required',
			'comments.required' => 'A comment is required',
			'user_id.required' => 'A user is required',
		];
	}
}
