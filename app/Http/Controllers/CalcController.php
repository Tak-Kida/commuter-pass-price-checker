<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function calc(Request $request)
    {
        // dd($request->all());
        $cheaper_kind = "定期券";
        $additional_info = [
            'weekdays' => 20,
            'ticket_price_sum' => 11500,
            'subscription_price' => 10000,
        ];
        return view('top', compact('cheaper_kind', 'additional_info'));
    }
}
