<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'items' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            // 'user_id.integer' => 'User ID must be an integer.',
            'user_id.exists' => 'User ID does not exist.',
            'items.required' => 'Items are required.',
            'items.array' => 'Items must be an array.',
        ];
    }
}
