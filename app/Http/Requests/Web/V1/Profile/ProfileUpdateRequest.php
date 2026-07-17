<?php

namespace App\Http\Requests\Web\V1\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            // Step 1: Personal Info
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['nullable', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'phone'      => ['nullable', 'string', 'max:20', 'regex:/^[+\-\d\s()]+$/'],
            'birthday'   => ['nullable', 'date', 'before:today'],
            'location'   => ['nullable', 'string', 'max:255'],
            // Step 2: Profile Media
            'bio'        => ['nullable', 'string', 'max:500'],
            'avatar'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'cover'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'email.unique'        => 'This email address is already taken.',
            'phone.regex'         => 'Please enter a valid phone number.',
            'birthday.before'     => 'Date of birth must be in the past.',
            'avatar.image'        => 'Avatar must be an image file (jpeg, png, jpg, gif, webp).',
            'avatar.max'          => 'Avatar must not exceed 2MB.',
            'cover.image'         => 'Cover photo must be an image file.',
            'cover.max'           => 'Cover photo must not exceed 5MB.',
        ];
    }
}
