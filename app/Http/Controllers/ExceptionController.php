<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ExceptionController extends Controller
{
    public function getNotFoundResponse(): JsonResponse
    {
        return $this->apiResponse
            ->setMessage(__('messages.not_found'))
            ->setFailureStatus(404)
            ->getResponse();
    }

    public function getEmptyResponse(): JsonResponse
    {
        return $this->apiResponse
            ->setSuccessStatus()
            ->getResponse();
    }
}
