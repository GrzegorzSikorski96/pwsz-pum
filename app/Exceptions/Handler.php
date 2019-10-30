<?php

declare(strict_types=1);

namespace APP\Exceptions;

use App\Helpers\ApiResponse;
use Exception;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    protected $apiResponse;

    public function __construct(Container $container, ApiResponse $apiResponse)
    {
        parent::__construct($container);
        $this->apiResponse = $apiResponse;
    }

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return $this->apiResponse
                ->setMessage(__('messages.exceptions.not_found'))
                ->setFailureStatus(404)
                ->getResponse();
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->apiResponse
                ->setMessage(__('messages.exceptions.not_found'))
                ->setFailureStatus(404)
                ->getResponse();
        }

        if ($exception instanceof UnauthorizedException || $exception instanceof UnauthorizedHttpException) {
            return $this->apiResponse
                ->setMessage(__('messages.exceptions.unauthorized'))
                ->setFailureStatus(401)
                ->getResponse();
        }

        return parent::render($request, $exception);
    }
}
