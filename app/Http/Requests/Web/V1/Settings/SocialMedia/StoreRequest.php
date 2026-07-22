<?php

namespace App\Http\Requests\Web\V1\Settings\SocialMedia;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'social_media'      => ['required', 'array'],
            'social_media.*'    => ['required', 'string', 'max:50'],
            'profile_link'      => ['required', 'array'],
            'profile_link.*'    => ['required', 'url', 'max:500'],
            'social_media_id'   => ['sometimes', 'nullable', 'array'],
            'social_media_id.*' => ['nullable', 'integer', 'exists:social_media,id'],
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
            'social_media.required'    => 'Please select at least one social media platform.',
            'social_media.*.required'  => 'Each social media platform must be selected.',
            'profile_link.*.required'  => 'Each profile link is required.',
            'profile_link.*.url'       => 'Each profile link must be a valid URL.',
            'social_media_id.*.exists' => 'One or more social media records no longer exist.',
        ];
    }
}
