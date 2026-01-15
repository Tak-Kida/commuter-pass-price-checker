<?php

namespace App\Http\Controllers;

use App\Services\CalcService;
use Illuminate\Http\Request;

class CalcController extends Controller
{
    private $calcService;

    public function __construct(CalcService $calcService)
    {
        $this->calcService = $calcService;
    }

    public function calc()
    {
        $calcResult = $this->calcService->calc();
        return response()->json($calcResult);
    }
}
