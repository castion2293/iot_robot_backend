<?php

namespace App;

use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends DynamoDbModel
{
    protected $table = 'user_setting';
}
