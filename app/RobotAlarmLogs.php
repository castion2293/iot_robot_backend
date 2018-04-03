<?php

namespace App;

use App\Filters\QueryFilter;
use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class RobotAlarmLogs extends DynamoDbModel
{
    protected $table = 'Robot_Alarm_Log';

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
