<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Get the failed validation response for the request.
     *
     * @param array     $errors
     *
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        return response()->json(
            $errors,
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * Adds given prefix to array keys.
     *
     * @param array     $array
     * @param string    $prefix
     *
     * @return array
     *
     * @throws \InvalidArgumentException If array contains keys with this prefix.
     */
    protected function addPrefix(array $array, $prefix)
    {
        foreach ($array as $k => $v)
        {
            if (isset($array[$prefix . $k])) {
                throw new \InvalidArgumentException(
                    'Array already contains keys with this prefix.'
                );
            }
            $array[$prefix . $k] = $v;
            unset($array[$k]);
        }

        return $array;
    }

    /**
     * On failed validation of get parameters
     *
     * @param $validator    Validator
     */
    protected function failedValidation(Validator $validator)
    {
        $response = $this->response($validator->errors()->all());

        throw new ValidationException(
            $validator,
            $response
        );
    }
}
