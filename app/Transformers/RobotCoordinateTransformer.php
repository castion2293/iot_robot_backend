<?php

namespace App\Transformers;

use Yish\Generators\Foundation\Transform\TransformContract;

class RobotCoordinateTransformer implements TransformContract
{
    public function transformCollection($attributes)
    {

    }

    public function transformInstance($attribute)
    {
        $coordinate = $attribute->payload['data'];

        return collect([
            'JOINT' => $coordinate['JOINT'],
            'WORLD' => $coordinate['WORLD'],
            'WORK' => $coordinate['WORK'],

            'ID' => $attribute->payload['ID'],
            'DATETIME' => $attribute->payload['DATETIME']
        ]);
    }
}
