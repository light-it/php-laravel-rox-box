<?php

use App\Models\Workshop;
use Carbon\Carbon;

return [

    // June 1st
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-01 09:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-01 12:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-01 12:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-01 15:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-01 15:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-01 18:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 7,
    ],

    // June 2st
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-02 09:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-02 12:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-02 12:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-02 15:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-02 15:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-02 18:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 12,
    ],

    // June 3st
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-03 09:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-03 12:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-03 12:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-03 15:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 7,
    ],
    [
        Workshop::COLUMN_DT_START     => Carbon::parse('2019-06-03 15:00:00'),
        Workshop::COLUMN_DT_END       => Carbon::parse('2019-06-03 18:00:00'),
        Workshop::COLUMN_MAX_VISITORS => 5,
    ],

];
