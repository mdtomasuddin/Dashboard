<?php

namespace App\Services\Web\V1\Settings\Content;

use App\Helpers\Helper;
use App\Models\Content;
use Illuminate\Database\Eloquent\Model;

class ContentService
{
    /**
     * Create or update content by type.
     */
    public function updateOrCreate(string $type, array $data): Model
    {
        $existing = Content::query()->where('type', $type)->first();
        // Generate slug using the title
        $data['slug'] = Helper::makeSlug($data['title'], 'contents');

        return Content::updateOrCreate(
            ['type' => $type],
            [
                'title'   => $data['title'],
                'slug'    => $data['slug'],
                'content' => $data['content'],
                'status'  => $data['status'] ?? 'active',
            ]
        );
    }
}
