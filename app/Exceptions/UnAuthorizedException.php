<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UnAuthorizedException extends HttpException
{
    public function __construct($message = 'Unauthorized')
    {
        parent::__construct(403, $message);
    }
}
