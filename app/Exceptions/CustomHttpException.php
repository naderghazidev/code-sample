<?php

namespace App\Exceptions;

use Exception;

class CustomHttpException extends Exception
{
    public function __construct(
        $message = null,
        $code = 500,
        $result = null,
    ) {
        parent::__construct($message, $code, null);

        $this->_result = $result;
    }

    public function getResult()
    {
        return $this->_result;
    }
}
