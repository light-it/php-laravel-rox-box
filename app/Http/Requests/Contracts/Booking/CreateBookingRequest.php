<?php

namespace App\Http\Requests\Contracts\Booking;

interface CreateBookingRequest
{
    const DATE = 'date';
    const TIME = 'time';
    const CUSTOMER_NAME = 'customer_name';
    const CUSTOMER_PHONE = 'customer_phone';
    const GUEST = 'guest';
    const NAME = 'name';
    const EMAIL = 'email';

    const DATETIME = 'datetime';
    const LEADER = 'leader';
    const VISITORS = 'visitors';
    const QTY = 'qty';

}
