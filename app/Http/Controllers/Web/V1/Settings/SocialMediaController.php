<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\Settings\SocialMedia\StoreRequest;
use App\Services\Web\V1\Settings\SocialMedia\SocialMediaService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SocialMediaController extends Controller
{
    /**
     * SocialMediaController constructor.
     */
    public function __construct(
        protected SocialMediaService $socialMediaService
    ) {}

    /**
     * Display the social media settings page.
     */
    public function index(): View
    {
        $social_link = $this->socialMediaService->getAll();

        return view('backend.settings.socialMedia.index', compact('social_link'));
    }

    /**
     * Store or update social media links (bulk save).
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->socialMediaService->bulkSave(
                $data['social_media'] ?? [],
                $data['profile_link'] ?? [],
                $data['social_media_id'] ?? []
            );

            return back()->with('t-success', 'Social media links updated successfully.');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update social media links: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified social media link.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->socialMediaService->delete($id);

            return response()->json([
                't-success' => true,
                'message'   => 'Social media link deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                't-error' => true,
                'message' => 'Failed to delete social media link.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
