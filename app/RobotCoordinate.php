<?php

namespace App;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class RobotCoordinate extends DynamoDbModel
{
    protected $table = 'Robot_Coordinate';
}
