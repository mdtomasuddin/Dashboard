<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Verification Code - {{ $appName }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@700&display=swap"
        rel="stylesheet">

    <style>
        /* Reset Styles */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background-color: #F6F7F9;
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            box-sizing: border-box;
        }

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            outline: none;
            text-decoration: none;
        }

        /* Layout & Components */
        .email-wrapper {
            width: 100%;
            background-color: #F6F7F9;
            padding: 48px 16px;
        }

        .email-card {
            background-color: #FFFFFF;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            max-width: 560px;
            width: 100%;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            overflow: hidden;
        }

        .glow-accent {
            background: linear-gradient(90deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
            height: 4px;
            width: 100%;
        }

        .card-body {
            padding: 44px 40px;
        }

        .brand-logo {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.6px;
            color: #0f172a;
            text-decoration: none;
            display: inline-block;
        }

        .brand-dot {
            color: #6366f1;
        }

        .badge-tag {
            display: inline-block;
            padding: 6px 14px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            color: #4f46e5;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .heading {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 12px 0;
            line-height: 1.25;
            letter-spacing: -0.5px;
        }

        .description {
            font-size: 15px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 32px 0;
        }

        /* OTP Code Container */
        .otp-container {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 32px 24px;
            text-align: center;
            margin: 28px 0 32px 0;
        }

        .otp-label {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748b;
            margin-bottom: 16px;
        }

        .otp-digits {
            font-family: 'JetBrains Mono', 'Courier New', Courier, monospace;
            font-size: 42px;
            font-weight: 800;
            letter-spacing: 14px;
            color: #4f46e5;
            margin: 0;
            padding-left: 14px;
            /* offset for letter-spacing */
        }

        .timer-badge {
            display: inline-block;
            margin-top: 18px;
            padding: 6px 14px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            color: #dc2626;
        }

        /* Security Box */
        .security-box {
            background-color: #f1f5f9;
            border-left: 3px solid #6366f1;
            border-radius: 0 12px 12px 0;
            padding: 16px 20px;
            margin-bottom: 32px;
        }

        .security-text {
            font-size: 13px;
            color: #334155;
            line-height: 1.55;
            margin: 0;
        }

        .security-title {
            font-weight: 700;
            color: #0f172a;
        }

        /* Footer */
        .card-footer {
            padding: 28px 40px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .footer-text {
            font-size: 12px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        .footer-link {
            color: #818cf8;
            text-decoration: none;
        }

        /* Responsive Breakpoints */
        @media screen and (max-width: 600px) {
            .email-wrapper {
                padding: 24px 12px !important;
            }

            .card-body {
                padding: 32px 24px !important;
            }

            .card-footer {
                padding: 24px 20px !important;
            }

            .heading {
                font-size: 24px !important;
            }

            .otp-digits {
                font-size: 32px !important;
                letter-spacing: 8px !important;
                padding-left: 8px !important;
            }
        }
    </style>
</head>

<body>
    <!--begin::Email Wrapper-->
    <div class="email-wrapper">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <!--begin::Email Card-->
                    <div class="email-card">
                        <!--begin::Glow Accent-->
                        <div class="glow-accent"></div>
                        <!--end::Glow Accent-->

                        <!--begin::Card Body-->
                        <div class="card-body">
                            <!--begin::Header Logo-->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="padding-bottom: 24px;">
                                        <span class="brand-logo">
                                            {{ $appName }}<span class="brand-dot">.</span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <!--end::Header Logo-->

                            <!--begin::Badge Tag-->
                            <div class="badge-tag">Authentication</div>
                            <!--end::Badge Tag-->

                            <!--begin::Title & Lead-->
                            <h1 class="heading">Verification Code</h1>
                            <p class="description">
                                Hello {{ $user->first_name ?? 'there' }}, use the one-time verification code below to
                                authorize your authentication attempt.
                            </p>
                            <!--end::Title & Lead-->

                            <!--begin::OTP Container-->
                            <div class="otp-container">
                                <!--begin::OTP Label-->
                                <div class="otp-label">One-Time Password</div>
                                <!--end::OTP Label-->

                                <!--begin::OTP Digits-->
                                <div class="otp-digits">{{ $otp }}</div>
                                <!--end::OTP Digits-->

                                <!--begin::Timer Badge-->
                                <div class="timer-badge">
                                    Expires in {{ $expiresInMinutes }} minutes
                                </div>
                                <!--end::Timer Badge-->
                            </div>
                            <!--end::OTP Container-->

                            <!--begin::Security Box-->
                            <div class="security-box">
                                <p class="security-text">
                                    <span class="security-title">Security Tip:</span> Never share this verification code
                                    with anyone. Official representatives will never ask for your code or password.
                                </p>
                            </div>
                            <!--end::Security Box-->

                            <!--begin::Notice Note-->
                            <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin: 0;">
                                If you did not initiate this request, no further action is required. Your account
                                remains secure.
                            </p>
                            <!--end::Notice Note-->
                        </div>
                        <!--end::Card Body-->

                        <!--begin::Card Footer-->
                        <div class="card-footer">
                            <p class="footer-text">
                                &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
                            </p>
                            <p class="footer-text" style="margin-top: 4px;">
                                Secure automated authentication service.
                            </p>
                        </div>
                        <!--end::Card Footer-->
                    </div>
                    <!--end::Email Card-->
                </td>
            </tr>
        </table>
    </div>
    <!--end::Email Wrapper-->
</body>

</html>
