<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class ApiRequest extends FormRequest
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct();
        $this->apiResponse = $apiResponse;
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException($this->apiResponse
            ->setData([$validator->errors()])
            ->setFailureStatus(400)
            ->getResponse());
    }
}
