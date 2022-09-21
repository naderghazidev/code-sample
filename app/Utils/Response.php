<?php

namespace App\Utils;

use App\Exceptions\CustomHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Response
{
    /**
     * returns a successful response.
     *
     * @param  null  $result
     * @param  null  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public static function success($result = null, $message = null, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'result' => $result,
        ], $statusCode);
    }

    /**
     * returns an error response.
     *
     * @param  null  $message
     * @param  int  $statusCode
     * @param  null  $result
     * @return JsonResponse
     *
     * @throws CustomHttpException
     */
    public static function error($message = null, int $statusCode = 500, $result = null): JsonResponse
    {
        throw new CustomHttpException($message, $statusCode, $result);
    }

    public static function forbidden(): void
    {
        abort(HttpFoundationResponse::HTTP_FORBIDDEN, Constants::ABORT_MESSAGE_403);
    }

    public static function badRequest(): void
    {
        abort(HttpFoundationResponse::HTTP_BAD_REQUEST, Constants::ABORT_MESSAGE_400);
    }
}
