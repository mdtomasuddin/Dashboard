<?php
namespace App\Http\Controllers\Api\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Settings\Content\ContentResource;
use App\Models\Content;
use App\Traits\Api\V1\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    //Trait For Api Response
    use ApiResponse;

    /**
     * Display a listing of contents.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            //params
            $type  = $request->query('type');
            $query = Content::where('status', 'active')->orderBy('created_at', 'desc');

            //Handle filtering by type if provided
            if (! empty($type)) {
                $query->where('type', $type);
            }

            $contents = $query->get();
            return $this->success(ContentResource::collection($contents), 'Data retrieved successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified content by type, slug, or ID.
     */
    public function show(string $identifier): JsonResponse
    {
        try {
            //Database Query
            $content = Content::where('status', 'active')->where(function ($q) use ($identifier) {
                $q->where('type', $identifier)->orWhere('slug', $identifier)->orWhere('id', $identifier);
            })->first();

            //Check exists
            if (! $content) {
                return $this->error('Data not found.', 404);
            }

            return $this->success(new ContentResource($content), 'Data details retrieved successfully.', 200);
        } catch (Exception $e) {
            return $this->error('Something went wrong: ' . $e->getMessage(), 500);
        }
    }
}
