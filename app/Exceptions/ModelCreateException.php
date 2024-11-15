<?php

namespace App\Exceptions;

use Exception;

class ModelCreateException extends Exception
{
    /**
     * ModelCreateException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = "Model creation failed", int $code = 500)
    {
        parent::__construct($message, $code);
    }

    /**
     * Exception durumunda dönecek olan yanıtı özelleştirin.
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
