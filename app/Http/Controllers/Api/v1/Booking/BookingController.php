<?php

namespace App\Http\Controllers\Api\v1\Booking;

use App\Http\Requests\Api\Booking\BookingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    /**
     * Returns qty of available slots
     *
     * @param BookingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function checkSlots(BookingRequest $request)
    {
        $availableVisitors = $request->get(BookingRequest::AVAILABLE_VISITORS, 0);
        $message = trans('messages.available_slots', ['qty' => $availableVisitors, ]);

        return response()->success(['message' => $message]);
    }

}
