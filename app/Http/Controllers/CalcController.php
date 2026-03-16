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
        $requestData = $request->all();
        $ticketPeriodMonth = $requestData['ticket_period_month']; // 1, 3, 6
        $startDate = Carbon::createFromFormat('Y-m-d', $requestData['start_date']);
        $workdaysCount = $this->calcService->calc($startDate, $ticketPeriodMonth);

        return response()->json([
            'startDate' => $requestData['start_date'],
            'ticketPeriodMonth' => $ticketPeriodMonth,
            'workdaysCount' => $workdaysCount,
        ]);
    }
}
