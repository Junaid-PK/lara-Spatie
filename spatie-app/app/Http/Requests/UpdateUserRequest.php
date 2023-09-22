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
            'name' => 'sometimes|required', // 'name' is optional, but if provided, it must not be empty.
            'password' => 'sometimes|required|min:8', // 'password' is optional, but if provided, it must not be empty and must be at least 8 characters long.
            'confirm_password' => 'sometimes|required|same:password', // 'confirm_password' is optional, but if provided, it must not be empty and must match the 'password' field.
        ];
    }
}
