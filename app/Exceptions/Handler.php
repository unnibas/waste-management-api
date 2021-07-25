<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\ApiResponser;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

        $this->renderable(function (ValidationException $e) {
            return response()->json($e->errors(), 422);
        });

        $this->renderable(function (AuthenticationException $e){
            return $this->errorResponse("Unauthenticated", 401);
        });

        $this->renderable(function (ModelNotFoundException $e){
            $model = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("Does not exist any {$model} model with specified identifier", 404);
        });

        $this->renderable(function(MethodNotAllowedHttpException $e){
            return $this->errorResponse("The specified method for the request is invalid", 405);
        });

        $this->renderable(function(NotFoundHttpException $e){
            return $this->errorResponse("The specified URL cannot be found", 404);
        });
    }
}
