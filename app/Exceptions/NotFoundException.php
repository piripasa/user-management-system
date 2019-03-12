<?php namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotFoundException extends HttpException
{
    public function __construct ($message = "Not found.") {
        parent::__construct($message, 404);
    }
}