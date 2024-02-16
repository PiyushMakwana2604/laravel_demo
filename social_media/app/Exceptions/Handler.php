<?php

namespace App\Exceptions;

use App\Helpers\CommonHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use \Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    // protected $levels = [
    //     //
    // ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, Throwable $exception)
    {
        // dd($request->is('api/*'));
        if ($request->is('api/*')) {
            // dd($request->is('api/*'));
            if ($exception instanceof AuthenticationException) {
            // if ($exception) {
                return response()->json([
                    'code' => 0,
                    'data' => new \stdClass(),
                    'message' => 'Unauthorized'
                ], 401);
            }
        } 
        else {
            if ($exception instanceof AuthenticationException) {
                // dd('djlkdhkjd');
                return redirect()->route('login');
            }
        }
        return parent::render($request, $exception);
    }
        /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        // dd($request);
        $path = explode('/', $request->path());

        $isApi = (isset($path[0]) && $path[0] == 'api') ? true : false;

        if ($e->response) {
            return $e->response;
        }

        return ($this->shouldReturnJson($request, $e) || $isApi)
            ? $this->invalidJson($request, $e)
            : $this->invalid($request, $e);
    }

 /**
     * Convert a validation exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function invalid($request, ValidationException $exception)
    {
        return redirect($exception->redirectTo ?? url()->previous())
            ->withInput(\Arr::except($request->input(), $this->dontFlash))
            ->withErrors($exception->errors(), $request->input('_error_bag', $exception->errorBag));
    }

    

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {   
        $errors = $exception->errors();

        $messages = '';

        if(!empty($errors)){
            $messages = $errors;
        }

        
        return response()->json(CommonHelper::bodyEncrypt(json_encode([
           'code' => 1,
           'data' => \Str::class,
           'message' => $messages 
        ])), 200);
    }


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
}
