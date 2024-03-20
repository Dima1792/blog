<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

    }
    public function render($request, Throwable $e)
    {
        if ($this->isHttpException($e)) {
            /** @var HttpExceptionInterface $e */
            if ($e->getStatusCode() === 404) {
                return response()->view('404', [], 404);
            }
        }

        return parent::render($request, $e);
    }
}
