<?php

namespace App\Services;

use Carbon\Carbon;
use \Yasumi\Yasumi;

class CalcService
{

    private \Yasumi\ProviderInterface $holidays;

    public function __construct()
    {
        $this->holidays = Yasumi::create('Japan', 2026, 'ja_JP');
    }

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

    public function calc(Carbon $startDate, int $ticketPeriodMonth)
    {
        $endDate = $startDate->copy()->addMonthsNoOverflow($ticketPeriodMonth);

        $holidayCount = $this->countWorkdays($startDate, $endDate);

        return $holidayCount;
    }

    private function countWorkdays(Carbon $startDate, Carbon $endDate)
    {
        $holidays = $this->holidays;
        $days = $startDate->diffInDaysFiltered(
            fn (Carbon $date) => !$date->isWeekend() && !$holidays->isHoliday($date),
            $endDate
        );
        return $days;
    }
}
