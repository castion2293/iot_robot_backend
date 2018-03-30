<?php
/**
 * Created by PhpStorm.
 * User: robotech
 * Date: 2018/3/30
 * Time: 上午 08:41
 */

namespace App\Filters;


class ThroughputFilters extends QueryFilter
{
    public function product_id($product_id)
    {
        return $this->builder->where('PRODUCT_ID', (int)$product_id);
    }

    public function today($today)
    {
        return $this->builder->where('DATE', $today);
    }
}