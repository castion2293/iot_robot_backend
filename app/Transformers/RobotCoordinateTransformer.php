<?php

namespace App\Transformers;

class RobotCoordinateTransformer
{
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
