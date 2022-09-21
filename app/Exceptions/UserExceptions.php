<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;

class UserExceptions extends Exception
{
    /**
     * @throws AuthenticationException
     */
    public static function unauthenticated(string $message = null): static
    {
        throw new AuthenticationException($message);
    }

    /**
     * @param  null  $message
     * @return UserExceptions
     *
     * @throws AuthorizationException
     */
    public static function forbidden($message = null): static
    {
        throw new AuthorizationException($message);
    }

    /**
     * @throws CustomHttpException
     */
    public static function badInputProvided(): static
    {
        throw new CustomHttpException(__('Bad input provided!'), 400, null);
    }
}
