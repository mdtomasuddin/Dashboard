<?php

namespace App\Http\Controllers\Web\V1\Settings\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\Content\ContentRequest;
use App\Models\Content;
use App\Services\Web\V1\Settings\Content\ContentService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class TermsAndConditionsController extends Controller
{
    /**
     * TermsAndConditionsController constructor.
     */
    public function __construct(
        protected ContentService $contentService
    ) {}

    /**
     * Display the Terms & Conditions edit form.
     */
    public function index(): View
    {
        $terms_and_conditions = Content::query()->where('type', 'termsAndConditions')->first();
        return view('backend.settings.content.terms-and-conditions', [
            'terms_and_conditions' => $terms_and_conditions,
        ]);
    }

    /**
     * Update or create Terms & Conditions content.
     */
    public function store(ContentRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->contentService->updateOrCreate('termsAndConditions', $data);

            return redirect()->route('terms-and-conditions.index')->with('t-success', 'Terms & Conditions updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('terms-and-conditions.index')->with('t-error', 'Failed to update Terms & Conditions. Please try again.');
        }
    }
}
