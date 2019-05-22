<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\BookingVisitor;
use App\Models\Visitor;
use App\Models\Workshop;
use App\Src\Booking\Contracts\BookingManageService;
use App\Src\BookingVisitor\Contracts\BookingVisitorManageService;
use App\Src\Visitor\Contracts\VisitorManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class CreateBookingRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var array
     */
    private $data;

    /**
     * @var Workshop
     */
    private $workshop;

    /**
     * Create a new job instance.
     *
     * @param Workshop $workshop
     * @param array $data
     */
    public function __construct(Workshop $workshop, array $data)
    {
        $this->workshop = $workshop;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param BookingManageService $bookingManageService
     * @param BookingVisitorManageService $bookingVisitorManageService
     * @param VisitorManageService $visitorManageService
     * @param WorkshopManageService $workshopManageService
     * @return mixed
     */
    public function handle(
        BookingManageService $bookingManageService,
        BookingVisitorManageService $bookingVisitorManageService,
        VisitorManageService $visitorManageService,
        WorkshopManageService $workshopManageService
    ) {
        /** @var Booking $booking */
        $booking = $bookingManageService->findOrCreateByWorkshop($this->workshop);

        dd($this->data);
    }

}
