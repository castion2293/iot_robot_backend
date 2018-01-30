<?php

namespace App;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class RobotAlarmLogs extends DynamoDbModel
{
    protected $table = 'Robot_Alarm_Log';
}
