<?php

namespace App\Http\Controllers\Web\Booking;

use App\DTO\VisitorDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Booking\CreateBookingRequest;
use App\Jobs\CreateBookingRecordJob;
use App\Models\Workshop;
use App\Src\Booking\Contracts\BookingManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;
use App\Utilites\Shopify\Contracts\ShopifyService;
use Carbon\Carbon;
use Illuminate\Support\Collection;

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
     * @var ShopifyService
     */
    private $shopifyService;

    /**
     * Controller constructor.
     * @param BookingManageService $bookingManageService
     * @param WorkshopManageService $workshopManageService
     * @param ShopifyService $shopifyService
     */
    public function __construct(
        BookingManageService $bookingManageService,
        WorkshopManageService $workshopManageService,
        ShopifyService $shopifyService
    ) {
        $this->bookingManageService = $bookingManageService;
        $this->workshopManageService = $workshopManageService;
        $this->shopifyService = $shopifyService;
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
        /** @var Collection $customers */
        $customers = $this->shopifyService->getCustomers();

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
