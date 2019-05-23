<?php

namespace App\Http\Middleware\Booking;

use App\DTO\VisitorDTO;
use App\Http\Middleware\BaseMiddleware;
use App\Http\Requests\Contracts\Booking\CreateBookingRequest;
use Closure;
use Carbon\Carbon;

class RequestTransformMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var Carbon $dtStart */
        $dtStart = Carbon::parse(
            sprintf(
                '%1s %2s',
                $request->get(CreateBookingRequest::DATE),
                $request->get(CreateBookingRequest::TIME)
            )
        );

        /** @var VisitorDTO $leaderDTO */
        $leaderDTO = new VisitorDTO([
            VisitorDTO::NAME  => $request->get(CreateBookingRequest::CUSTOMER_NAME),
            VisitorDTO::PHONE => $request->get(CreateBookingRequest::CUSTOMER_PHONE),
        ]);

        $visitors = [];
        /** @var array $guests */
        $guests = $request->get(CreateBookingRequest::GUEST, []);
        foreach ($guests as $guest) {
            /** @var array[VisitorDTO] $visitors */
            $visitors[] = new VisitorDTO([
                VisitorDTO::NAME  => $guest[CreateBookingRequest::NAME],
                VisitorDTO::EMAIL => $guest[CreateBookingRequest::EMAIL],
            ]);
        }

        $request->merge([
            CreateBookingRequest::DATETIME => $dtStart,
            CreateBookingRequest::LEADER   => $leaderDTO,
            CreateBookingRequest::VISITORS => $visitors,
            CreateBookingRequest::QTY      => count($visitors) + 1,
        ]);

        return $next($request);
    }
}
