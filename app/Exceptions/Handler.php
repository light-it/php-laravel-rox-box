<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \LogicException::class,
        AuthenticationException::class,
        AuthorizationException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            return response()->json(
                $this->getDataJSON($request, $exception),
                $this->getHttpStatusCode($exception)
            );
        } elseif ($request->input('_token')) {
            return parent::render($request, $exception);
        } elseif ($exception instanceof ModelNotFoundException) {
            return parent::render($request, $exception);
        }

        $needFullTrace = config('app.debug') && $this->getHttpStatusCode($exception) === 500;

        if ($needFullTrace) {
            return parent::render($request, $exception);
        }

        return response()->json(trans('api.109'));
    }

    /**
     * Returns array of exception data for response in JSON.
     *
     * @param Request $request
     * @param Exception $e
     *
     * @return array
     */
    protected function getDataJSON($request, Exception $e)
    {
        $data = [];
        $httpStatusCode = $this->getHttpStatusCode($e);
        $data['status_code'] = $httpStatusCode;
        $needShortMessages = config('app.env') === 'production' && $httpStatusCode === 500;
        $data['message'] = $needShortMessages ? trans('api.109') : $this->getMessage($e);

        switch (true) {
            case $e instanceof ValidationException:
                $data['errors'] = $e->validator->errors()->getMessages();
                break;
            case !$this->canShowAdditionalInfo():
                return $data;
                break;
            case $e instanceof ModelNotFoundException:
                $data['info'] = 'ModelNotFoundException: ' . $e->getModel();
                break;
            case $request->input('_trace'):
                $data['trace'] = $e->getTrace();
                break;
        }
        return $data;
    }

    private function canShowAdditionalInfo()
    {
        return in_array(\App::environment(), ['local', 'dev', 'staging']);
    }

    /**
     * Returns HTTP status code by given exception.
     *
     * @param  \Exception $e
     *
     * @return integer
     */
    protected function getHttpStatusCode(\Exception $e)
    {
        switch (true) {
            case $e instanceof AuthenticationException:
                return 401;
            case $e instanceof ModelNotFoundException:
                return 404;
            case $e instanceof ValidationException:
            case $e instanceof \LogicException:
                return 422;
            default:
                return 500;
        }
    }

    /**
     * Returns message of given exception.
     *
     * @param  \Exception $e
     *
     * @return string
     */
    protected function getMessage(\Exception $e)
    {
        switch (true) {
            case $e instanceof ModelNotFoundException:
            case $e instanceof NotFoundHttpException:
                return trans('api.202');
                break;
            case $e instanceof MethodNotAllowedHttpException:
                return trans('api.204');
                break;
            case $e instanceof \LogicException:
                return $e->getMessage() ? $e->getMessage() : trans('api.' . $e->getCode());
                break;
            default:
                return $e->getMessage();
                break;
        }
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated(
        $request,
        AuthenticationException $exception
    ) {
        return response()->error(203, 401);
    }
}
