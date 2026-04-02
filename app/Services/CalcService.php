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
        $endDate = $this->calculateExpirationDate($startDate, $ticketPeriodMonth);

        $holidayCount = $this->countWorkdays($startDate, $endDate);

        return $holidayCount;
    }

    private function countWorkdays(Carbon $startDate, Carbon $endDate)
    {
        $holidays = $this->holidays;
        $workDays = $startDate->diffInDaysFiltered(
            fn (Carbon $date) => !$date->isWeekend() && !$holidays->isHoliday($date),
            $endDate
        );
        return $workDays;
    }

    private function calculateExpirationDate(Carbon $startDate, int $months): Carbon
    {
        $originalDay = $startDate->day;

        // N ヶ月後の年・月を求める（日はオーバーフローさせない）
        $target = $startDate->copy()->addMonthsNoOverflow($months);
        $lastDayOfTargetMonth = $target->copy()->endOfMonth()->day;

        if ($originalDay > $lastDayOfTargetMonth) {
            // 応当日が存在しない → その月の末日に満了
            return $target->copy()->endOfMonth()->startOfDay();
        }

        // 応当日が存在する → 応当日の前日に満了
        return Carbon::create($target->year, $target->month, $originalDay)->subDay();
    }
}
