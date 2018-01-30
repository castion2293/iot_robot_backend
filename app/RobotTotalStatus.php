<?php

namespace App;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class RobotTotalStatus extends DynamoDbModel
{
    protected $table = 'Robot_Total_Status';
}
