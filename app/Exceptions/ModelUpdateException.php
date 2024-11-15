<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ModelUpdateException extends Exception
{
    /**
     * ModelUpdateException constructor.
     *
     * @param string $message
     * @param int    $code
     */
    public function __construct(string $message = "Failed to update the model", int $code = 500)
    {
        parent::__construct($message, $code);
    }

    /**
     * Exception durumunda dönecek yanıtı özelleştirin.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}