<?php

namespace App\Services\Web\V1\Settings\FAQ;

use App\Models\FAQ;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FAQService
{
    /**
     * Create a new FAQ record.
     */
    public function create(array $data): Model | Builder
    {
        return FAQ::query()->create([
            'question' => $data['question'],
            'answer'   => $data['answer'],
            'status'   => $data['status'] ?? 'active',
        ]);
    }

    /**
     * Update an existing FAQ record.
     */
    public function update(int $id, array $data): Model | Collection | Builder | array | null
    {
        $faq = FAQ::query()->findOrFail($id);
        $faq->update([
            'question' => $data['question'],
            'answer'   => $data['answer'],
            'status'   => $data['status'] ?? $faq->status,
        ]);

        return $faq->fresh();
    }
}


