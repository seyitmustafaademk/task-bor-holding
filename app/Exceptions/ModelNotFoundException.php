<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    /**
     * ModelNotFoundException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = "The requested model was not found", int $code = 404)
    {
        parent::__construct($message, $code);
    }

    /**
     * Exception durumunda dönecek yanıtı özelleştirin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
