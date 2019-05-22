<?php

namespace App\Http\Controllers\Web\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contracts\Booking\CreateBookingRequest;
use App\Src\Booking\Contracts\BookingManageService;

class BookingController extends Controller
{

    /**
     * @var BookingManageService
     */
    private $bookingManageService;

    /**
     * Controller constructor.
     * @param BookingManageService $bookingManageService
     */
    public function __construct(BookingManageService $bookingManageService)
    {
        $this->bookingManageService = $bookingManageService;
    }

    /**
     * Shows form to create booking record
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('booking.form');
    }

    /**
     * Save booking record
     *
     * @param CreateBookingRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(CreateBookingRequest $request)
    {
        //$bookingData = new BookingDTO($request->validated());
        $booking = $this->bookingManageService->create(/*$bookingData*/);

        return $booking
            ? redirect()->route('booking')
            : redirect()->back()->with('error', [trans('An error occurred.'), ]);
    }

}
