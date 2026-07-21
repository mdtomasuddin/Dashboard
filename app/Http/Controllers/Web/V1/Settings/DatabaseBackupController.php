<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Controllers\Controller;
use App\Services\Web\V1\Settings\DatabaseBackupService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class DatabaseBackupController extends Controller
{
    /**
     * DatabaseBackupController constructor.
     */
    public function __construct(
        protected DatabaseBackupService $backupService
    ) {}

    /**
     * Display the database backup management page.
     */
    public function index(): View
    {
        return view('backend.settings.database.index');
    }

    /**
     * Export the database and download as SQL file.
     */
    public function export(): Response | RedirectResponse
    {
        try {
            $sql = $this->backupService->export();

            $filename = 'backup-' . config('database.connections.mysql.database') . '-' . now()->format('Y-m-d-H-i-s') . '.sql';

            return response($sql, 200, [
                'Content-Type'        => 'application/sql',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length'      => strlen($sql),
                'Pragma'              => 'no-cache',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Expires'             => '0',
            ]);
        } catch (Exception $e) {
            Log::error(self::class . ':export', ['error' => $e->getMessage()]);

            return back()->with('t-error', 'Database backup failed. Please try again.');
        }
    }
}
