<?php

namespace App\Http\Controllers\Api\v1\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{

    /**
     * Test controller
     *
     * @param Request   $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dump('test');

        return response()->json(['status' => 'ok']);
    }

}
