<?php

namespace App\Services\Web\V1\Settings\SocialMedia;

use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SocialMediaService
{
    /**
     * Find social media link by ID.
     */
    public function find(int $id): Model | Collection | Builder | array | null
    {
        return SocialMedia::query()->findOrFail($id);
    }

    /**
     * Get all social media links ordered by latest.
     */
    public function getAll(): Collection
    {
        return SocialMedia::latest('id')->get();
    }

    /**
     * Create a new social media link.
     */
    public function create(array $data): Model | Builder
    {
        return SocialMedia::query()->create([
            'social_media' => $data['social_media'],
            'profile_link' => $data['profile_link'],
        ]);
    }

    /**
     * Update an existing social media link.
     */
    public function update(int $id, array $data): Model | Collection | Builder | array | null
    {
        $socialMedia = $this->find($id);
        $socialMedia->update([
            'social_media' => $data['social_media'],
            'profile_link' => $data['profile_link'],
        ]);

        return $socialMedia->fresh();
    }

    /**
     * Bulk save social media links (create new + update existing).
     */
    public function bulkSave(array $socialMedia, array $profileLinks, array $ids = []): void
    {
        $processedIds = [];

        foreach ($socialMedia as $index => $media) {
            if (empty($media) || empty($profileLinks[$index] ?? null)) {
                continue;
            }

            $socialMediaId = $ids[$index] ?? null;

            if ($socialMediaId) {
                $this->update($socialMediaId, [
                    'social_media' => $media,
                    'profile_link' => $profileLinks[$index],
                ]);
                $processedIds[] = $socialMediaId;
            } else {
                $link = $this->create([
                    'social_media' => $media,
                    'profile_link' => $profileLinks[$index],
                ]);
                $processedIds[] = $link->id;
            }
        }

        // Delete any IDs that were submitted but no longer present
        $submittedIds = array_filter($ids);
        $idsToDelete  = array_diff($submittedIds, $processedIds);

        if (! empty($idsToDelete)) {
            SocialMedia::whereIn('id', $idsToDelete)->delete();
        }
    }

    /**
     * Delete a social media link by ID.
     */
    public function delete(int $id): ?bool
    {
        return $this->find($id)->delete();
    }
}
