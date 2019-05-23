<?php

/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ['namespace' => 'Web\Booking', ],
    function () {
        Route::get('/workshop-booking', 'BookingController@index')->name('booking');

        Route::group(
            ['middleware' => ['request.transform', 'check.slots', ], ],
            function () {
                Route::post('/workshop-booking', 'BookingController@store')->name('booking.store');
            }
        );

    }
);
