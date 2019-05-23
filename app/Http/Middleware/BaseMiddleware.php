<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BaseMiddleware
{
    /**
     * Returns error message
     *
     * @param  Request $request Request instance
     * @param string $message Message string
     * @param string|null $field Field name for error
     *
     * @return mixed
     */
    protected function error(Request $request, string $message = '', ?string $field = 'token')
    {
        if ($request->wantsJson() && !$request->has('_token')) {
            return response()->error($message);
        } elseif ($request->has('_token')) {
            throw ValidationException::withMessages([
                $field => [$message],
            ]);
        } else {
            abort(403, trans('api.' . $message));
        }
    }
}
