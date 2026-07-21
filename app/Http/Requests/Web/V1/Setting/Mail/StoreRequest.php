<?php
namespace App\Http\Requests\Web\V1\Setting\Mail;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mail_mailer'     => ['required', 'string', 'in:smtp,sendmail,mailgun,postmark,log,ses'],
            'mail_host'       => ['required', 'string', 'max:255'],
            'mail_port'       => ['required', 'string', 'max:10'],
            'mail_username'   => ['nullable', 'email'],
            'mail_password'   => ['nullable', 'string'],
            'mail_encryption' => ['nullable', 'string', 'in:tls,ssl,null'],
            'mail_address'    => ['required', 'email'],
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
            'mail_mailer.required'  => 'The mailer type is required.',
            'mail_mailer.in'        => 'The selected mailer is invalid. Choose smtp, sendmail, mailgun, postmark, log, or ses.',
            'mail_host.required'    => 'The SMTP host is required.',
            'mail_port.required'    => 'The SMTP port is required.',
            'mail_username.email'   => 'Please enter a valid email username.',
            'mail_encryption.in'    => 'Encryption must be tls, ssl, or none.',
            'mail_address.required' => 'The from address is required.',
            'mail_address.email'    => 'Please enter a valid email address.',
        ];
    }
}
