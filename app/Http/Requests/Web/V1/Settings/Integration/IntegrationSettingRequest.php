<?php

namespace App\Http\Requests\Web\V1\Settings\Integration;

use Illuminate\Foundation\Http\FormRequest;

class IntegrationSettingRequest extends FormRequest
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
        $route = $this->route()?->getName();

        return match ($route) {
            'google.update'   => [
                'GOOGLE_CLIENT_ID'     => ['nullable', 'string', 'max:255'],
                'GOOGLE_CLIENT_SECRET' => ['nullable', 'string', 'max:255'],
            ],
            'facebook.update' => [
                'FACEBOOK_CLIENT_ID'     => ['nullable', 'string', 'max:255'],
                'FACEBOOK_CLIENT_SECRET' => ['nullable', 'string', 'max:255'],
            ],
            'apple.update'    => [
                'APPLE_CLIENT_ID' => ['required', 'string', 'max:255'],
                'APPLE_TEAM_ID'   => ['required', 'string', 'max:255'],
                'APPLE_KEY_ID'    => ['required', 'string', 'max:255'],
            ],
            'twilio.update'   => [
                'TWILIO_SID'          => ['required', 'string', 'max:255'],
                'TWILIO_AUTH_TOKEN'   => ['required', 'string', 'max:255'],
                'TWILIO_PHONE_NUMBER' => ['required', 'string', 'max:20'],
            ],
            'stripe.update'   => [
                'STRIPE_KEY'            => ['nullable', 'string', 'max:255'],
                'STRIPE_SECRET'         => ['nullable', 'string', 'max:255'],
                'STRIPE_WEBHOOK_SECRET' => ['nullable', 'string', 'max:255'],
            ],
            default           => [],
        };
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'GOOGLE_CLIENT_ID.string'       => 'The Google Client ID must be a valid string.',
            'GOOGLE_CLIENT_SECRET.string'   => 'The Google Client Secret must be a valid string.',
            'FACEBOOK_CLIENT_ID.string'     => 'The Facebook Client ID must be a valid string.',
            'FACEBOOK_CLIENT_SECRET.string' => 'The Facebook Client Secret must be a valid string.',
            'APPLE_CLIENT_ID.required'      => 'The Apple Client ID is required.',
            'APPLE_TEAM_ID.required'        => 'The Apple Team ID is required.',
            'APPLE_KEY_ID.required'         => 'The Apple Key ID is required.',
            'TWILIO_SID.required'           => 'The Twilio SID is required.',
            'TWILIO_AUTH_TOKEN.required'    => 'The Twilio Auth Token is required.',
            'TWILIO_PHONE_NUMBER.required'  => 'The Twilio Phone Number is required.',
            'STRIPE_KEY.string'             => 'The Stripe Key must be a valid string.',
            'STRIPE_SECRET.string'          => 'The Stripe Secret must be a valid string.',
            'STRIPE_WEBHOOK_SECRET.string'  => 'The Stripe Webhook Secret must be a valid string.',
        ];
    }
}
