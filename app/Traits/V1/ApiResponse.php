<?php

namespace App\Traits\V1;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param  mixed  $data  Payload data, Resource, or Paginator instance
     * @param  string|null  $message  Success message
     * @param  int  $code  HTTP status code
     * @param  bool|null  $isPaginated  Force pagination state explicitly
     */
    public function success(mixed $data = [], ?string $message = null, int $code = 200, ?bool $isPaginated = null): JsonResponse
    {
        $shouldPaginate = $isPaginated ?? $this->isPaginatedData($data);

        $response = [
            'success' => true,
            'code'    => $code,
            'message' => $message,
            'data'    => $data,
        ];

        if ($shouldPaginate) {
            [$items, $pagination]   = $this->formatPagination($data);
            $response['data']       = $items;
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string|null  $message  Error message
     * @param  int  $code  HTTP status code
     * @param  mixed  $errors  Error details
     */
    public function error(?string $message = null, int $code = 500, mixed $errors = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'code'    => $code,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }

    /**
     * Return a 201 Created JSON response.
     */
    public function created(mixed $data = [], ?string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->success(data: $data, message: $message, code: 201);
    }

    /**
     * Return a 400 Bad Request JSON response.
     */
    public function badRequest(?string $message = 'Bad Request', mixed $errors = []): JsonResponse
    {
        return $this->error(message: $message, code: 400, errors: $errors);
    }

    /**
     * Return a 401 Unauthorized JSON response.
     */
    public function unauthorized(?string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error(message: $message, code: 401);
    }

    /**
     * Return a 403 Forbidden JSON response.
     */
    public function forbidden(?string $message = 'Forbidden'): JsonResponse
    {
        return $this->error(message: $message, code: 403);
    }

    /**
     * Return a 404 Not Found JSON response.
     */
    public function notFound(?string $message = 'Resource not found'): JsonResponse
    {
        return $this->error(message: $message, code: 404);
    }

    /**
     * Return a 422 Unprocessable Entity JSON response.
     */
    public function unprocessableEntity(mixed $errors = [], ?string $message = 'Validation failed'): JsonResponse
    {
        return $this->error(message: $message, code: 422, errors: $errors);
    }

    /**
     * Check if the payload is paginated.
     */
    protected function isPaginatedData(mixed $data): bool
    {
        if ($data instanceof Paginator || $data instanceof LengthAwarePaginator || $data instanceof AbstractPaginator) {
            return true;
        }

        if ($data instanceof ResourceCollection && $data->resource instanceof AbstractPaginator) {
            return true;
        }

        if (is_array($data) && isset($data['data'], $data['current_page'])) {
            return true;
        }

        return false;
    }

    /**
     * Extract items and metadata from paginated data.
     *
     * @return array{0: mixed, 1: array<string, mixed>}
     */
    protected function formatPagination(mixed $data): array
    {
        if ($data instanceof Paginator || $data instanceof LengthAwarePaginator || $data instanceof AbstractPaginator) {
            return [
                $data->items(),
                [
                    'total'        => method_exists($data, 'total') ? $data->total() : null,
                    'count'        => $data->count(),
                    'per_page'     => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'total_pages'  => method_exists($data, 'lastPage') ? $data->lastPage() : null,
                    'has_more'     => $data->hasMorePages(),
                ],
            ];
        }

        if ($data instanceof ResourceCollection && $data->resource instanceof AbstractPaginator) {
            $paginator = $data->resource;

            return [
                $data->resolve(),
                [
                    'total'        => method_exists($paginator, 'total') ? $paginator->total() : null,
                    'count'        => $paginator->count(),
                    'per_page'     => $paginator->perPage(),
                    'current_page' => $paginator->currentPage(),
                    'total_pages'  => method_exists($paginator, 'lastPage') ? $paginator->lastPage() : null,
                    'has_more'     => $paginator->hasMorePages(),
                ],
            ];
        }

        if (is_array($data) && isset($data['data'], $data['current_page'])) {
            return [
                $data['data'],
                [
                    'total'        => $data['total'] ?? null,
                    'count'        => is_countable($data['data']) ? count($data['data']) : 0,
                    'per_page'     => $data['per_page'] ?? null,
                    'current_page' => $data['current_page'] ?? 1,
                    'total_pages'  => $data['last_page'] ?? null,
                    'has_more'     => isset($data['last_page'], $data['current_page']) ? $data['current_page'] < $data['last_page'] : false,
                ],
            ];
        }

        return [$data, []];
    }
}

