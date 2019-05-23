<?php

namespace App\Http\Middleware\Booking;

use App\DTO\VisitorDTO;
use App\Http\Middleware\BaseMiddleware;
use App\Http\Requests\Contracts\Booking\CreateBookingRequest;
use App\Src\Workshop\Contracts\WorkshopManageService;
use Closure;
use Carbon\Carbon;

class CheckSlotsMiddleware extends BaseMiddleware
{

    /**
     * @var WorkshopManageService
     */
    private $workshopManageService;

    /**
     * @param WorkshopManageService $workshopManageService
     */
    public function __construct(WorkshopManageService $workshopManageService)
    {
        $this->workshopManageService = $workshopManageService;
    }

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
        $dtStart = $request->get(CreateBookingRequest::DATETIME);
        /** @var int $qty */
        $qty = $request->get(CreateBookingRequest::QTY, 0);
        /** @var Workshop $workshop */
        $workshop = $this->workshopManageService->findByDTStart($dtStart);
        /** @var int $availableVisitors */
        $availableVisitors = $this->workshopManageService->getQtyAvailableVisitors($workshop);

        if (($availableVisitors - $qty) < 0) {
            /** @var string $message */
            $message = trans('messages.No more spots', ['qty' => $availableVisitors, ]);

            if ($request->wantsJson()) {
                return response()->error($message);
            } else {
                return redirect()->back()->with('error', [$message, ]);
            }
        }

        $request->merge([
            CreateBookingRequest::AVAILABLE_VISITORS => $availableVisitors,
        ]);

        return $next($request);
    }

}
