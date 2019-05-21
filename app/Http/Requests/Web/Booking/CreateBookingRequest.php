<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\Contracts\Booking\CreateBookingRequest as CreateBookingRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest implements CreateBookingRequestInterface
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
    public function rules()
    {
        return [
            self::DATE => 'required|date_format:m/d/Y',
        ];
    }
}
