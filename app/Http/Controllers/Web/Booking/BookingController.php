<?php

namespace App\Http\Controllers\Web\Booking;

use App\DTO\VisitorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Booking\CreateBookingRequest;
use App\Jobs\CreateBookingRecordJob;
use App\Models\Workshop;
use App\Src\Booking\Contracts\BookingManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;
use Carbon\Carbon;

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
        /** @var array $schedule */
        $schedule = $this->workshopManageService->getSchdedule();

        $customers = [
            ['name' => 'aaaa', 'phone' => '123', ],
            ['name' => 'bbbb', 'phone' => '321', ],
        ];

        return view('booking.form', compact('schedule', 'customers'));
    }

    /**
     * Save booking record
     *
     * @param CreateBookingRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(CreateBookingRequest $request)
    {
        /** @var Carbon $dtStart */
        $dtStart = $request->get(CreateBookingRequest::DATETIME);
        /** @var VisitorDTO $leaderDTO */
        $leaderDTO = $request->get(CreateBookingRequest::LEADER);
        /** @var array[VisitorDTO] $visitors */
        $visitors = $request->get(CreateBookingRequest::VISITORS);

        /** @var Workshop $workshop */
        $workshop = $this->workshopManageService->findByDTStart($dtStart);

        CreateBookingRecordJob::dispatch($workshop, $leaderDTO, $visitors)->onQueue('booking');

        return redirect()->back()->with('success', [trans('messages.Booking saved')]);
    }

}
