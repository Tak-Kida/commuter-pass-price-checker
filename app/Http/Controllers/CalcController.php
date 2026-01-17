<?php

namespace App\Http\Controllers;

use App\Services\CalcService;
use Illuminate\Http\Request;

class CalcController extends Controller
{
    public function __construct(private CalcService $calcService) {}

    public function calc()
    {
        return response()->json($this->calcService->calc());
    }
}
