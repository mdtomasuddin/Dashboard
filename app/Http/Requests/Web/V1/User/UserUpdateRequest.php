<?php

namespace App\Http\Requests\Web\V1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['nullable', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'phone'      => ['nullable', 'string', 'max:20'],
            'password'   => ['nullable', 'string', Password::defaults()],
            'role'       => ['nullable', 'string', 'in:user,admin,super_admin,author,hr'],
            'status'     => ['nullable', 'string', 'in:active,inactive,suspended'],
            'avatar'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'cover'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'bio'        => ['nullable', 'string', 'max:500'],
            'location'   => ['nullable', 'string', 'max:255'],
            'birthday'   => ['nullable', 'date'],
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
            'first_name.required' => 'The first name field is required.',
            'email.unique'        => 'This email address is already registered.',
            'avatar.image'        => 'The avatar must be an image file.',
            'avatar.max'          => 'The avatar must not be larger than 2MB.',
            'cover.image'         => 'The cover photo must be an image file.',
            'cover.max'           => 'The cover photo must not be larger than 2MB.',
        ];
    }
}
