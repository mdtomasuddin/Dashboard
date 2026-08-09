<?php

namespace App\Http\Requests\Web\V1\Settings\SystemSetting;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingRequest extends FormRequest
{
    // Determine if the user is authorized to make this request.
    public function authorize(): bool
    {
        return true;
    }

    // Get the validation rules that apply to the request.
    public function rules(): array
    {
        return [
            'title'               => ['nullable', 'string', 'max:255'],
            'system_name'         => ['nullable', 'string', 'max:255'],
            'email'               => ['nullable', 'string', 'email', 'max:255'],
            'phone'               => ['nullable', 'string', 'max:50'],
            'address'             => ['nullable', 'string', 'max:500'],
            'copyright_text'      => ['nullable', 'string', 'max:500'],
            'description'         => ['nullable', 'string'],
            'logo'                => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'favicon'             => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,ico,webp', 'max:2048'],
            'timezone'            => ['nullable', 'string', 'max:100'],
            'maintenance_mode'    => ['nullable', 'boolean'],
            'maintenance_message' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
