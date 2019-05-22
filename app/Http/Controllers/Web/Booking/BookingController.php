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
        $schedule = [];
        $workshops = $this->workshopManageService->getAll();
        $workshops->each(function($workshop) use (&$schedule) {
            $date = $workshop->getDTStart()->format('Y-m-d');
            $item = data_get($schedule, $date);
            if (!$item) {
                $item = [
                    'title' => $workshop->getDTStart()->format('M jS'),
                    'time'  => [],
                ];
            }

            $item['time'][] = [
                'title' => sprintf(
                    '%1s - %2s',
                    $workshop->getDTStart()->format('gA'),
                    $workshop->getDTEnd()->format('gA')
                ),
                'value' => $workshop->getDTStart()->format('H:i:s'),
            ];

            $schedule[$date] = $item;
        });

        return view('booking.form', compact('schedule'));
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
        $guests = $request->get($request::GUEST, []);
        $dtStart = Carbon::parse(sprintf('%1s %2s', $request->get($request::DATE), $request->get($request::TIME)));

        /** @var Workshop $workshop */
        $workshop = $this->workshopManageService->findByDTStart($dtStart);
        $availableVisitors = $this->workshopManageService->getQtyAvailableVisitors($workshop);

        if (($availableVisitors - count($guests)) < 0) {
            return redirect()->back()->with('error', [trans('messages.No more spots', ['qty' => $availableVisitors, ]), ]);
        }

        /** @var VisitorDTO $leaderDTO */
        $leaderDTO = new VisitorDTO([
            VisitorDTO::NAME  => $request->get($request::CUSTOMER_NAME),
            VisitorDTO::PHONE => $request->get($request::CUSTOMER_PHONE),
        ]);

        $visitors = [];

        foreach ($guests as $guest) {
            /** @var array[VisitorDTO] $visitors */
            $visitors[] = new VisitorDTO([
                VisitorDTO::NAME  => $guest[CreateBookingRequest::NAME],
                VisitorDTO::EMAIL => $guest[CreateBookingRequest::EMAIL],
            ]);
        }

        CreateBookingRecordJob::dispatch($workshop, $leaderDTO, $visitors)->onQueue('booking');

        return redirect()->back()->with('success', [trans('messages.Booking saved')]);
    }

}
