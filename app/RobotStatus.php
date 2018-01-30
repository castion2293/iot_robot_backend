<?php

namespace App;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class RobotStatus extends DynamoDbModel
{
    protected $table = 'Robot_SU_Status';
}
