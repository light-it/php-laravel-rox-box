<?php

namespace App\Http\Requests\Api\Booking;

use App\Http\Requests\Contracts\Booking\CreateBookingRequest as BookingRequestInterface;
use App\Http\Requests\Api\Request;

class BookingRequest extends Request implements BookingRequestInterface
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::DATETIME => 'required|date_format:Y-m-d H:i:s',
            self::QTY      => 'required|integer',
        ];
    }

}
