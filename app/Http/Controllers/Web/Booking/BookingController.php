<?php

namespace App\Http\Controllers\Web\Booking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Booking\CreateBookingRequest;
use App\Jobs\CreateBookingRecordJob;
use App\Models\Workshop;
use App\Src\Booking\Contracts\BookingManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;

class BookingController extends Controller
{

    /**
     * @var BookingManageService
     */
    private $bookingManageService;

    /**
     * @var WorkshopManageService
     */
    private $workshopManageService;

    /**
     * Controller constructor.
     * @param BookingManageService $bookingManageService
     * @param WorkshopManageService $workshopManageService
     */
    public function __construct(
        BookingManageService $bookingManageService,
        WorkshopManageService $workshopManageService
    ) {
        $this->bookingManageService = $bookingManageService;
        $this->workshopManageService = $workshopManageService;
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
        $invalides = false;
        $dtStart = $request->get($request::DATE);
        //$dtStart = \Carbon\Carbon::parse('2019-06-01 09:00:00');
        $data = [];

        /** @var Workshop $workshop */
        $workshop = $this->workshopManageService->findByDTStart($dtStart);
        $availableVisitors = $this->workshopManageService->getQtyAvailableVisitors($workshop);

        CreateBookingRecordJob::dispatch($workshop, $data)->onQueue('booking');

        return $invalides
            ? redirect()->back()->with('error', [trans('messages.No more spots', ['qty' => $availableVisitors, ]), ])
            : redirect()->back()->with('success', [trans('messages.Booking saved')]);
    }

}
