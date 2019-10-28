<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    private $success = false;
    private $statusCode;
    private $message = "";
    private $data = [];

    public function getResponse(): JsonResponse
    {
        return response()->json([
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ], $this->statusCode);
    }

    public function setFailureStatus(int $statusCode): ApiResponse
    {
        $this->success = false;
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setSuccessStatus(): ApiResponse
    {
        $this->success = true;
        $this->statusCode = 200;
        return $this;
    }

    public function setMessage(string $message): ApiResponse
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data): ApiResponse
    {
        $this->data = $data;
        return $this;
    }

    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
