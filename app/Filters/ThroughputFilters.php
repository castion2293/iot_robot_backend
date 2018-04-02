<?php
/**
 * Created by PhpStorm.
 * User: robotech
 * Date: 2018/3/30
 * Time: 上午 08:41
 */

namespace App\Filters;


use Carbon\Carbon;

class ThroughputFilters extends QueryFilter
{
    public function product_id($product_id)
    {
        return $this->builder->where('PRODUCT_ID', (int)$product_id);
    }

    public function today($today)
    {
        $date = Carbon::parse($today);

        return $this->builder->where('DATE', $date->toDateString());
    }

    public function two_week($today)
    {
        $date = Carbon::parse($today);
        $dates = [];
        array_push($dates, $date->toDateString());

        for ($i = 0; $i < 13; $i++) {
            array_push($dates, $date->subDay()->toDateString());
        }

        return $this->builder->wherein('DATE', $dates);
    }

    public function monthly($month)
    {
        $date = Carbon::parse($month);
        $dates = [];
        array_push($dates, $date->toDateString());

        for ($i = 0; $i < $date->daysInMonth - 1; $i++) {
            array_push($dates, $date->addDay()->toDateString());
        }

        return $this->builder->wherein('DATE', $dates);
    }
}