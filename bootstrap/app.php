<?php

use App\Traits\Api\V1\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/web.php',
        api: __DIR__ . '/../routes/api/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*') || $request->wantsJson(),
        );
        // API Global Exception Handler
        $exceptions->render(function (Throwable $e, Request $request) {
            if (! $request->is('api/*') && ! $request->wantsJson()) {
                return null;
            }
            //Trait instance to use ApiResponse methods
            $responder = new class
            {
                use ApiResponse;
            };
            // 401 Unauthorized
            if ($e instanceof AuthenticationException) {
                return $responder->unauthorized($e->getMessage() ?: 'Unauthenticated. Token is missing or invalid.');
            }
            // 403 Forbidden
            if ($e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException) {
                return $responder->forbidden($e->getMessage() ?: 'This action is unauthorized.');
            }
            // 404 Not Found
            if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return $responder->notFound($e->getMessage() ?: 'The requested resource or endpoint was not found.');
            }
            // 405 Method Not Allowed
            if ($e instanceof MethodNotAllowedHttpException) {
                return $responder->error($e->getMessage() ?: 'The HTTP method for this request is not supported.', 405);
            }
            // 422 Validation Error
            if ($e instanceof ValidationException) {
                return $responder->unprocessableEntity($e->errors(), $e->getMessage() ?: 'The given data was invalid.');
            }
            // 429 Too Many Requests
            if ($e instanceof ThrottleRequestsException) {
                return $responder->error($e->getMessage() ?: 'Too many requests. Please slow down.', 429);
            }
            // Generic HTTP Exception
            if ($e instanceof HttpException) {
                return $responder->error($e->getMessage() ?: 'HTTP Exception occurred.', $e->getStatusCode());
            }
            // 500 Internal Server Error
            $statusCode = ($e->getCode() >= 400 && $e->getCode() < 600) ? (int) $e->getCode() : 500;
            $isDebug    = config('app.debug', false);
            $errors     = $isDebug ? [
                'exception' => get_class($e),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ] : [];
            return $responder->error($e->getMessage() ?: 'Something went wrong on the server.', $statusCode, $errors);
        });
    })->create();
