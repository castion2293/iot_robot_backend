<?php

namespace App;

use App\Filters\QueryFilter;
use BaoPham\DynamoDb\DynamoDbModel;
use Illuminate\Database\Eloquent\Model;

class ThroughputForOK extends DynamoDbModel
{
    protected $table = 'OK_Products';

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
