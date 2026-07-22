<?php
namespace App\Services\Web\V1\Settings\Mail;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MailService
{
    /**
     * Mapping between request field names and .env variable names.
     */
    private const ENV_MAP = [
        'mail_mailer'     => 'MAIL_MAILER',
        'mail_host'       => 'MAIL_HOST',
        'mail_port'       => 'MAIL_PORT',
        'mail_username'   => 'MAIL_USERNAME',
        'mail_password'   => 'MAIL_PASSWORD',
        'mail_encryption' => 'MAIL_ENCRYPTION',
        'mail_address'    => 'MAIL_FROM_ADDRESS',
    ];

    /**
     * Update the .env file with new mail configuration values.
     *
     * @throws Exception
     */
    public function updateMailConfig(array $data): void
    {
        try {
            // Path to the .env file
            $envPath = base_path('.env');
            if (! File::exists($envPath)) {
                throw new Exception('.env file not found at: ' . $envPath);
            }

            // Read the current .env content
            $envContent = File::get($envPath);

            foreach (self::ENV_MAP as $field => $envKey) {
                if (! array_key_exists($field, $data)) {
                    continue;
                }
                $value = $data[$field];

                // Handle empty/null values — write empty value instead of 'null' string
                if ($field === 'mail_encryption' && ($value === 'null' || $value === null)) {
                    $value = '';
                }

                // Wrap mail address in quotes if not empty
                if ($field === 'mail_address' && ! empty($value)) {
                    $value = '"' . $value . '"';
                }

                // Build regex to find existing env key
                $pattern     = '/^' . preg_quote($envKey, '/') . '=.*$/m';
                $replacement = $envKey . '=' . ($value ?? '');

                // Replace existing key or append if not found
                if (preg_match($pattern, $envContent)) {
                    $envContent = preg_replace($pattern, $replacement, $envContent);
                } else {
                    // Append if key doesn't exist
                    $envContent .= PHP_EOL . $replacement;
                }
            }

            // Write the updated content back to the .env file
            File::put($envPath, $envContent);

            // Update Laravel's runtime configuration to reflect the new settings without requiring a restart
            foreach (self::ENV_MAP as $field => $envKey) {
                if (! array_key_exists($field, $data)) {
                    continue;
                }
                $value = $data[$field];

                // Map ENV keys to Laravel config keys
                match ($envKey) {
                    'MAIL_MAILER'       => config(['mail.default' => $value]),
                    'MAIL_HOST'         => config(['mail.mailers.smtp.host' => $value]),
                    'MAIL_PORT'         => config(['mail.mailers.smtp.port' => $value]),
                    'MAIL_USERNAME'     => config(['mail.mailers.smtp.username' => $value]),
                    'MAIL_PASSWORD'     => config(['mail.mailers.smtp.password' => $value]),
                    'MAIL_ENCRYPTION'   => config(['mail.mailers.smtp.encryption' => $value]),
                    'MAIL_FROM_ADDRESS' => config(['mail.from.address' => $value]),
                    default             => null,
                };
            }
        } catch (Exception $e) {
            Log::error(self::class . ':updateMailConfig', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
