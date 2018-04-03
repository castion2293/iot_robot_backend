<?php
/**
 * Created by PhpStorm.
 * User: robotech
 * Date: 2018/4/3
 * Time: 下午 01:22
 */

namespace App\Filters;


use Carbon\Carbon;

class AlarmFilters extends QueryFilter
{
    public function product_id($product_id)
    {
        return $this->builder->where('ROBOT_ID', (int)$product_id);
    }

    public function interval($interval)
    {
        $start_end = explode('/', $interval);

        $first = Carbon::parse($start_end[0]);
        $end = Carbon::parse($start_end[1]);

        $inv = $first->diffInDays($end);

        $dates = [];
        array_push($dates, $end->toDateString());

        for ($i = 0; $i < $inv; $i++) {
            array_push($dates, $end->subDay()->toDateString());
        }

        return $this->builder->wherein('ALARM_DATE', $dates);
    }
}