<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {

        // handle when resource is not found
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return $this->error(__('Resource not found!'), $e->getStatusCode(), null);
        });

        // handle when invalid input is provided
        $this->renderable(function (ValidationException $e, $request) {
            return $this->error(__('Invalid input provided!'), $e->status, $e->errors());
        });

        // handle when user is not authenticated to perform a specific action
        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            $previous = $e->getPrevious();

            if ($previous instanceof AuthorizationException) {
                $message = $previous->getMessage() === 'This action is unauthorized.'
                    ? __('Operation not permitted!')
                    : $previous->getMessage();

                return $this->error($message, 403);
            }

            return null;
        });

        // handle when user is not authenticated to perform a specific action
        $this->renderable(function (AuthenticationException $e, $request) {
            $message = $e->getMessage() === 'Unauthenticated.'
                ? __('Authentication Required!')
                : $e->getMessage();

            return $this->error($message, 401);
        });

        // handle when a http exception occurs
        $this->renderable(function (HttpException $e, $request) {
            return $this->error($e->getMessage(), $e->getStatusCode());
        });

        // handle when an unexpected custom exception happened in server
        $this->renderable(function (CustomHttpException $e, $request) {
            return $this->error($e->getMessage(), $e->getCode(), $e->getResult());
        });

        // handle when an unexpected exception happened in server
        $this->renderable(function (Throwable $e, $request) {
            return $this->error(__('Internal Server Error!'), 500);
        });
    }

    private function error($message = null, int $statusCode = 500, $result = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'result' => $result,
        ], $statusCode);
    }
}
