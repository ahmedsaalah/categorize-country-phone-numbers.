<?php

namespace App\Exceptions;
use \App\Constants\Error;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $throwable)
    {
        \Log::channel('elasticsearch')->error($throwable);
        if (is_a($throwable, 'App\Exceptions\ValidationException')) {
            \Log::channel('elasticsearch')->error($throwable->errors);
            return \App\Services\GeneralService::getErrorResponse(array($throwable->getCode()), $throwable->getHttpCode(), $throwable->errors, $throwable->getDataArr(), isset($throwable->uuid) ? $throwable->uuid : null);
        }  elseif (is_a($throwable, 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException')) {
            \Log::channel('elasticsearch')->error(Error::ROUTE_NOT_FOUND);
            throw new RouteException(Error::ROUTE_NOT_FOUND);
        } elseif (is_a($throwable, 'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException')) {
            \Log::channel('elasticsearch')->error(Error::METHOD_NOT_ALLOWED);
            throw new RouteException(Error::METHOD_NOT_ALLOWED);
        } elseif (is_a($throwable, 'App\Exceptions\BaseException')) {
            return \App\Services\GeneralService::getErrorResponse(array($throwable->getCode()), $throwable->getHttpCode(), null, $throwable->getDataArr(), isset($throwable->uuid) ? $throwable->uuid : null);
        }else {
            $genericException = new GeneralException(Error::UNKNOWN_ERROR);
             $genericException->caused_by = array("message" => $throwable->getMessage(), "code" => $throwable->getCode(), "file" => $throwable->getFile(), "line" => $throwable->getLine(), "uuid" => isset($throwable->uuid) ? $throwable->uuid : null);
            throw $genericException;
        }
        
        return \App\Services\GeneralService::getErrorResponse(array($throwable->getCode()), $throwable->getHttpCode(), null, $throwable->getDataArr(), isset($throwable->uuid) ? $throwable->uuid : null);
    }
}
