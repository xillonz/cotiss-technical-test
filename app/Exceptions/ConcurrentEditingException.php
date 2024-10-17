<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConcurrentEditingException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }
 
    /**
     * Render the exception into an HTTP response.
     */
    public function render(): Response
    {
        return response("Resource has already been edited, use the latest version to update", 400);
    }
}
