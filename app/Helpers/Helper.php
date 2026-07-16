<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{
    // Upload a file to the specified directory and return its storage path.
    public static function uploadFile($file, $directory)
    {
        try {
            $directory     = 'uploads/' . trim($directory, '/'); // Ensure the directory exists
            $imageFileName = uniqid('image_') . '.' . $file->getClientOriginalExtension();
            $file->storeAs($directory, $imageFileName, 'public');

            // Return the relative path to the stored file
            return 'storage/' . $directory . '/' . $imageFileName;
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    // Delete a file from storage based on its URL.
    public static function deleteFile($imageUrl)
    {
        try {
            if (! is_string($imageUrl) || empty($imageUrl)) {
                return false;
            }
            // Parse the URL to get the relative path
            $parsedUrl    = parse_url($imageUrl);
            $relativePath = $parsedUrl['path'] ?? '';
            $relativePath = preg_replace('/^\/?storage\//', '', $relativePath);

            // Check if the file exists before attempting to delete it
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
                return true;
            }

            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Helper function to return a standardized success JSON response.
    public static function success($code = 200, $message = null, $data = []): JsonResponse
    {
        return response()->json([
            'success'   => (bool) true,
            'code'      => (int) $code,
            'message'   => $message,
            'data'      => $data,
            'timestamp' => now()->toIso8601String() . ' GMT' . now()->format('P'),
        ], $code);
    }

    // Helper function to return a standardized error JSON response.
    public static function error($code = 500, $message = null, $error = []): JsonResponse
    {
        return response()->json([
            'status'    => (bool) false,
            'code'      => (int) $code,
            'message'   => $message,
            'error'     => $error,
            'timestamp' => now()->toIso8601String() . ' GMT' . now()->format('P'),
        ], $code);
    }

    // Generate a unique slug with random suffix if needed.
    public static function makeSlug(string $title, $table): string
    {
        $slug = Str::slug($title);
        while (DB::table($table)->where('slug', $slug)->exists()) {
            $randomString = Str::random(5);
            $slug         = Str::slug($title) . '-' . $randomString;
        }

        return $slug;
    }

    // Generate a unique slug based on the title and existing slugs in the database.
    public static function generateUniqueSlug($title, $table, $slugColumn = 'slug')
    {
        // Generate initial slug
        $slug = Str::slug($title);
        // Check if the slug exists
        $count = DB::table($table)->where($slugColumn, 'LIKE', "$slug%")->count();

        // If it exists, append the count
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
