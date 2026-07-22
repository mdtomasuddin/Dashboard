<?php

namespace App\Http\Controllers\Web\V1\Settings\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\Mail\StoreRequest;
use App\Services\Web\V1\Settings\Mail\MailService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * MailController constructor.
     * @param MailService $mailService
     */
    public function __construct(
        protected MailService $mailService
    ) {}

    /**
     * Display the mail settings form.
     * @return View
     */
    public function index(): View
    {
        return view('backend.settings.mail.index');
    }

    /**
     * Update mail configuration settings.
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->mailService->updateMailConfig($data);
            return back()->with('t-success', 'Mail settings updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update mail settings. Please try again.');
        }
    }

    /**
     * Send a test email to verify SMTP configuration.
     * @param Request $request
     * @return JsonResponse
     */
    public function test(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $recipient = $request->input('email');
            Mail::raw('This is a test email from ' . config('app.name') . '. Your SMTP configuration is working correctly!', function ($message) use ($recipient) {
                $message->to($recipient)
                    ->subject('Test Email - ' . config('app.name'));
            });

            return response()->json([
                't-success' => true,
                'message'   => 'Test email sent successfully to ' . $recipient . '.',
            ]);
        } catch (Exception $e) {
            Log::error(self::class . ':test', ['error' => $e->getMessage()]);
            return response()->json([
                't-error' => true,
                'message' => 'Failed to send test email: ' . $e->getMessage(),
            ], 500);
        }
    }
}
