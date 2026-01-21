<?php

namespace App\Http\Controllers;

use App\Services\CalcService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function __construct(private CalcService $calcService) {}

    public function calc(Request $request)
    {
        // return response()->json($this->calcService->returnDemoData());

        $requestData = $request->all();
        $startDate = Carbon::parse($requestData['start_date']);
        $ticketPeriodMonth = $requestData['ticket_period_month'];

        $result = $this->calcService->calc($startDate, $ticketPeriodMonth);
        return response()->json(['result' => $result]);
    }
}
