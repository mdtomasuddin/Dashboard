<?php

namespace App\Http\Controllers\Web\V1\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->scopes(['openid', 'profile', 'email'])
            ->with([
                'access_type' => 'offline',
                'prompt'      => 'consent',
            ])->redirect();
    }

    /**
     * Handle incoming OAuth callback from Google.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        $user = Socialite::driver('google')->stateless()->user();

        // Store the refresh token in session (no DB needed)
        Session::put('google_refresh_token', $user->refreshToken);

        dd([
            'access_token'  => $user->token,
            'refresh_token' => $user->refreshToken,
            'expires_in'    => $user->expiresIn,
        ]);
    }

    /**
     * Refresh Google Access Token using stored Refresh Token.
     */
    public function refreshGoogleToken(): mixed
    {
        $refreshToken = Session::get('google_refresh_token');
        if (! $refreshToken) {
            dd('No refresh token available in session.');
        }

        $client   = new GuzzleClient();
        $response = $client->post('https://www.googleapis.com/oauth2/v4/token', [
            'form_params' => [
                'grant_type'    => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id'     => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
            ],
        ]);

        $tokenData = json_decode($response->getBody(), true);
        dd($tokenData); // shows the new access token and expiry
    }
}
