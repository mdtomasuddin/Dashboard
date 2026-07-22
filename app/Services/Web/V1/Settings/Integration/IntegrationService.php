<?php

namespace App\Services\Web\V1\Settings\Integration;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class IntegrationService
{
    /**
     * Update .env file with the given key-value pairs.
     *
     * @param  array<string, string|null>  $settings  Associative array of env key => value
     *
     * @throws Exception
     */
    public function updateEnvSettings(array $settings): void
    {
        try {
            $envPath = base_path('.env');
            if (! File::exists($envPath)) {
                throw new Exception('.env file not found at: ' . $envPath);
            }

            $envContent = File::get($envPath);

            foreach ($settings as $key => $value) {
                $pattern = '/^' . preg_quote($key, '/') . '=.*$/m';
                if ($value !== null && $value !== '') {
                    $formattedValue = '"' . str_replace(['\\', '"'], ['\\\\', '\"'], $value) . '"';
                } else {
                    $formattedValue = '';
                }
                $replacement = $key . '=' . $formattedValue;

                if (preg_match($pattern, $envContent)) {
                    $envContent = preg_replace($pattern, $replacement, $envContent);
                } else {
                    $envContent .= PHP_EOL . $replacement;
                }
            }

            File::put($envPath, $envContent);
        } catch (Exception $e) {
            Log::error(self::class . ':updateEnvSettings', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Update Google OAuth credentials.
     *
     * @throws Exception
     */
    public function updateGoogleCredentials(array $data): void
    {
        $this->updateEnvSettings([
            'GOOGLE_CLIENT_ID'     => $data['GOOGLE_CLIENT_ID'] ?? null,
            'GOOGLE_CLIENT_SECRET' => $data['GOOGLE_CLIENT_SECRET'] ?? null,
        ]);
    }

    /**
     * Update Facebook OAuth credentials.
     *
     * @throws Exception
     */
    public function updateFacebookCredentials(array $data): void
    {
        $this->updateEnvSettings([
            'FACEBOOK_CLIENT_ID'     => $data['FACEBOOK_CLIENT_ID'] ?? null,
            'FACEBOOK_CLIENT_SECRET' => $data['FACEBOOK_CLIENT_SECRET'] ?? null,
        ]);
    }

    /**
     * Update Apple Sign-In credentials.
     *
     * @throws Exception
     */
    public function updateAppleCredentials(array $data): void
    {
        $this->updateEnvSettings([
            'APPLE_CLIENT_ID' => $data['APPLE_CLIENT_ID'] ?? null,
            'APPLE_TEAM_ID'   => $data['APPLE_TEAM_ID'] ?? null,
            'APPLE_KEY_ID'    => $data['APPLE_KEY_ID'] ?? null,
        ]);
    }

    /**
     * Update Twilio credentials.
     *
     * @throws Exception
     */
    public function updateTwilioCredentials(array $data): void
    {
        $this->updateEnvSettings([
            'TWILIO_SID'          => $data['TWILIO_SID'] ?? null,
            'TWILIO_AUTH_TOKEN'   => $data['TWILIO_AUTH_TOKEN'] ?? null,
            'TWILIO_PHONE_NUMBER' => $data['TWILIO_PHONE_NUMBER'] ?? null,
        ]);
    }

    /**
     * Update Stripe API keys.
     *
     * @throws Exception
     */
    public function updateStripeCredentials(array $data): void
    {
        $this->updateEnvSettings([
            'STRIPE_KEY'            => $data['STRIPE_KEY'] ?? null,
            'STRIPE_SECRET'         => $data['STRIPE_SECRET'] ?? null,
            'STRIPE_WEBHOOK_SECRET' => $data['STRIPE_WEBHOOK_SECRET'] ?? null,
        ]);
    }
}
