<?php

namespace App\Services;


class CalcService
{
    public function returnDemoData()
    {
        $cheaper_kind = "定期券";
        $additional_info = [
            'weekdays' => 20,
            'ticket_price_sum' => 11500,
            'subscription_price' => 10000,
        ];
        return [
            'cheaper_kind' => $cheaper_kind,
            'additional_info' => $additional_info,
        ];
    }
}
