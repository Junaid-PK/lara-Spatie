<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class PostMessageRequest extends FormRequest
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
			'message' => 'required|min:1|max:255',
			'teammember_id' => 'required|numeric',
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
			'message.required' => 'Message is required',
			'message.min' => 'Message must be at least 1 character',
			'message.max' => 'Message must be at most 255 characters',
			'teammember_id.required' => 'Team Member ID is required',
			'teammember_id.numeric' => 'Team Member ID must be a number',
		];
	}
}
