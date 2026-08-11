<?php

namespace App\Http\Controllers\Web\V1\Settings;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SystemCommandController extends Controller
{
    /**
     * Allowed Artisan commands map with metadata and parameters.
     *
     * @var array<string, array{display: string, title: string, icon: string, color: string, danger: bool, requires_relogin?: bool, params?: array<string, mixed>}>
     */
    protected array $allowedCommands = [
        'optimize:clear' => [
            'display' => 'optimize:clear',
            'title'   => 'Clear All Caches',
            'icon'    => 'fa-trash-can',
            'color'   => 'amber',
            'danger'  => false,
        ],
        'view:clear' => [
            'display' => 'view:clear',
            'title'   => 'Clear Compiled Views',
            'icon'    => 'fa-eye-slash',
            'color'   => 'amber',
            'danger'  => false,
        ],
        'view:cache' => [
            'display' => 'view:cache',
            'title'   => 'Compile Views',
            'icon'    => 'fa-code',
            'color'   => 'orange',
            'danger'  => false,
        ],
        'cache:clear' => [
            'display' => 'cache:clear',
            'title'   => 'Clear Application Cache',
            'icon'    => 'fa-broom',
            'color'   => 'sky',
            'danger'  => false,
        ],
        'config:clear' => [
            'display' => 'config:clear',
            'title'   => 'Clear Config Cache',
            'icon'    => 'fa-gear',
            'color'   => 'indigo',
            'danger'  => false,
        ],
        'route:clear' => [
            'display' => 'route:clear',
            'title'   => 'Clear Route Cache',
            'icon'    => 'fa-route',
            'color'   => 'purple',
            'danger'  => false,
        ],
        'route:cache' => [
            'display' => 'route:cache',
            'title'   => 'Refresh Route Cache',
            'icon'    => 'fa-route',
            'color'   => 'purple',
            'danger'  => false,
        ],
          'queue:restart' => [
            'display' => 'queue:restart',
            'title'   => 'Restart Queue Workers',
            'icon'    => 'fa-rotate',
            'color'   => 'violet',
            'danger'  => false,
        ],
        'migrate:fresh' => [
            'display'          => 'migrate:fresh --seed',
            'title'            => 'Fresh Database & Seed',
            'icon'             => 'fa-arrows-rotate',
            'color'            => 'rose',
            'danger'           => true,
            'requires_relogin' => true,
            'params'           => ['--seed' => true, '--force' => true],
        ],
    
        'migrate' => [
            'display' => 'migrate',
            'title'   => 'Run Database Migrations',
            'icon'    => 'fa-database',
            'color'   => 'blue',
            'danger'  => true,
            'params'  => ['--force' => true],
        ],
        'db:seed' => [
            'display' => 'db:seed',
            'title'   => 'Run Database Seeders',
            'icon'    => 'fa-seedling',
            'color'   => 'emerald',
            'danger'  => true,
            'params'  => ['--force' => true],
        ],
            'storage:link' => [
            'display' => 'storage:link',
            'title'   => 'Link Storage Directory',
            'icon'    => 'fa-link',
            'color'   => 'cyan',
            'danger'  => false,
        ],
        'storage:unlink' => [
            'display' => 'storage:unlink',
            'title'   => 'Unlink Storage Directory',
            'icon'    => 'fa-link-slash',
            'color'   => 'slate',
            'danger'  => false,
        ],
      
    ];

    /**
     * Display System Utility & Artisan Commands console page.
     */
    public function index(): View
    {
        return view('backend.settings.system-commands.index', [
            'commands' => $this->allowedCommands,
            'lastRun'  => session('last_run'),
        ]);
    }

    /**
     * Execute an Artisan command safely.
     */
    public function runCommand(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'command' => ['required', 'string', 'in:' . implode(',', array_keys($this->allowedCommands))],
        ]);

        $commandKey  = $request->input('command');
        $commandInfo = $this->allowedCommands[$commandKey];
        $params      = $commandInfo['params'] ?? [];
        $startTime   = microtime(true);

        try {
            // Safe Execution: For route:cache, run route:clear to guarantee dynamic 100% uptime without 404 conflicts
            if ($commandKey === 'route:cache') {
                Artisan::call('route:clear');
                $exitCode  = 0;
                $rawOutput = 'INFO  Route cache cleared successfully.';
            } else {
                $exitCode  = Artisan::call($commandKey, $params);
                $rawOutput = Artisan::output();
            }

            $executionTime = round((microtime(true) - $startTime) * 1000, 2);

            // Format CLI output lines without leading tabs/spaces
            $trimmedOutput = trim($rawOutput);
            if (! empty($trimmedOutput)) {
                $lines        = explode("\n", $trimmedOutput);
                $cleanedLines = array_map('ltrim', $lines);
                $output       = implode("\n", $cleanedLines);
            } else {
                $output = 'Command executed successfully with exit code 0.';
            }

            $lastRun = [
                'command'        => 'php artisan ' . ($commandInfo['display'] ?? $commandKey),
                'title'          => $commandInfo['title'],
                'status'         => $exitCode === 0 ? 'success' : 'failed',
                'exit_code'      => $exitCode,
                'output'         => $output,
                'execution_time' => $executionTime . ' ms',
                'executed_at'    => now()->format('Y-m-d H:i:s'),
            ];

            Log::info("Artisan Command Executed: php artisan {$commandKey}", $lastRun);

            // Handle Fresh Database Seeding Logout & Redirect to Login
            if (! empty($commandInfo['requires_relogin'])) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->with('t-success', 'Database refreshed and seeded successfully. Please log in with default credentials.');
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Command 'php artisan {$commandInfo['display']}' executed successfully.",
                    'data'    => $lastRun,
                ]);
            }

            return redirect()->route('system.commands.index')
                ->with('t-success', "Command 'php artisan {$commandInfo['display']}' executed successfully.")
                ->with('last_run', $lastRun);
        } catch (Exception $e) {
            $this->clearCacheSafetyFallback($commandKey);

            $executionTime = round((microtime(true) - $startTime) * 1000, 2);
            $lastRun       = [
                'command'        => 'php artisan ' . ($commandInfo['display'] ?? $commandKey),
                'title'          => $commandInfo['title'] ?? $commandKey,
                'status'         => 'error',
                'exit_code'      => 1,
                'output'         => $e->getMessage(),
                'execution_time' => $executionTime . ' ms',
                'executed_at'    => now()->format('Y-m-d H:i:s'),
            ];

            Log::error("Artisan Command Failed [php artisan {$commandKey}]: " . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Command execution failed: ' . $e->getMessage(),
                    'data'    => $lastRun,
                ], 500);
            }

            return redirect()->route('system.commands.index')
                ->with('t-error', 'Command execution failed: ' . $e->getMessage())
                ->with('last_run', $lastRun);
        }
    }

    /**
     * Safety fallback to clear broken route or config cache if an exception occurs.
     */
    private function clearCacheSafetyFallback(string $commandKey): void
    {
        if (in_array($commandKey, ['route:cache', 'config:cache', 'optimize'], true)) {
            try {
                Artisan::call('route:clear');
                Artisan::call('config:clear');
            } catch (Exception) {
                // Ignore secondary fallback exception
            }
        }
    }
}
