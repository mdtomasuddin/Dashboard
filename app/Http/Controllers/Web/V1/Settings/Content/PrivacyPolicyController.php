<?php

namespace App\Http\Controllers\Web\V1\Settings\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\Content\ContentRequest;
use App\Models\Content;
use App\Services\Web\V1\Settings\Content\ContentService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PrivacyPolicyController extends Controller
{
    /**
     * PrivacyPolicyController constructor.
     */
    public function __construct(
        protected ContentService $contentService
    ) {}

    /**
     * Display the Privacy Policy edit form.
     */
    public function index(): View
    {
        $privacy_policy = Content::query()->where('type', 'privacyPolicy')->first();
        return view('backend.settings.content.privacy-policy', [
            'privacy_policy' => $privacy_policy,
        ]);
    }

    /**
     * Update or create Privacy Policy content.
     */
    public function store(ContentRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->contentService->updateOrCreate('privacyPolicy', $data);

            return redirect()->route('privacy-policy.index')->with('t-success', 'Privacy Policy updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('privacy-policy.index')->with('t-error', 'Failed to update Privacy Policy. Please try again.');
        }
    }
}
