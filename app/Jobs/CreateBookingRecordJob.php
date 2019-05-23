<?php

namespace App\Jobs;

use App\DTO\VisitorDTO;
use App\Models\Booking;
use App\Models\BookingVisitor;
use App\Models\Visitor;
use App\Models\Workshop;
use App\Src\Booking\Contracts\BookingManageService;
use App\Src\BookingVisitor\Contracts\BookingVisitorManageService;
use App\Src\Visitor\Contracts\VisitorManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;
use App\Utilites\Weather\Contracts\WeatherService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;

class CreateBookingRecordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var VisitorDTO
     */
    private $leaderDTO;

    /**
     * @var array[VisitorDTO]
     */
    private $guests;

    /**
     * @var Workshop
     */
    private $workshop;

    /**
     * Create a new job instance.
     *
     * @param Workshop $workshop
     * @param VisitorDTO $leaderDTO
     * @param array[VisitorDTO]|null $guests
     */
    public function __construct(
        Workshop $workshop,
        VisitorDTO $leaderDTO,
        ?array $guests = []
    ) {
        $this->workshop = $workshop;
        $this->leaderDTO = $leaderDTO;
        $this->guests = $guests;
    }

    /**
     * Execute the job.
     *
     * @param BookingManageService $bookingManageService
     * @param BookingVisitorManageService $bookingVisitorManageService
     * @param VisitorManageService $visitorManageService
     * @param WorkshopManageService $workshopManageService
     * @param WeatherService $weatherService
     * @return mixed
     */
    public function handle(
        BookingManageService $bookingManageService,
        BookingVisitorManageService $bookingVisitorManageService,
        VisitorManageService $visitorManageService,
        WorkshopManageService $workshopManageService,
        WeatherService $weatherService
    ) {
        DB::beginTransaction();
        try {
            /** @var Booking $booking */
            $booking = $bookingManageService->createByWorkshop($this->workshop);

            /** @var Visitor $leader */
            $leader = $visitorManageService->findOrCreate($this->leaderDTO);

            /** @var BookingVisitor $leaderBooking */
            $leaderBooking = $bookingVisitorManageService
                ->findOrCreate($booking, $leader);

            /** @var VisitorDTO $guestDTO */
            foreach ($this->guests as $guestDTO) {
                /** @var Visitor $visitor */
                $visitor = $visitorManageService->findOrCreate($guestDTO);

                /** @var BookingVisitor $visitorBooking */
                $visitorBooking = $bookingVisitorManageService
                    ->findOrCreate($booking, $visitor, $leaderBooking);
            }

            /** @var string $weather */
            $weather = $weatherService->getWeather();
            //TODO: store weather to database, create migration, service, repository, model

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

}
