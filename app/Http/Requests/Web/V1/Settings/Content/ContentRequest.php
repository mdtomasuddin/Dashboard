<?php

namespace App\Http\Requests\Web\V1\Settings\Content;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            'status'  => ['nullable', 'string', 'in:active,inactive'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'The title field is required.',
            'title.max'        => 'The title may not be greater than 255 characters.',
            'content.required' => 'The content field is required.',
            'content.min'      => 'The content must be at least 10 characters.',
            'status.in'        => 'The status must be either active or inactive.',
        ];
    }
}
