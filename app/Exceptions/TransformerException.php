<?php namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class TransformerException extends HttpException
{
    public function __construct ($message = "Transformer's transformCollection requires Collection or Paginator instance.") {
        parent::__construct($message, 500);
    }
}