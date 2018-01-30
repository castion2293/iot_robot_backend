<?php

namespace App\Transformers;

use Yish\Generators\Foundation\Transform\TransformContract;

class RobotAlarmLogsTransformer implements TransformContract
{
    public function transformCollection($attributes)
    {
        return $attributes->map(function ($elements) {
            return collect($elements->payload['data']['ALARM'])->map(function ($alarm) {
                return [
                    'ALARM_TIME' => $alarm['ALARM_TIME'],
                    'ALARM_CODE' => $alarm['ALARM_CODE'],
                    'ALARM_DATE' => $alarm['ALARM_DATE'],
                    'ALARM_NAME' => $alarm['ALARM_NAME'],
                ];
            });
        });
    }

    public function transformInstance($attribute)
    {
        return collect($attribute->payload['data']['ALARM'])->map(function ($alarm) {
            return [
                'ALARM_TIME' => $alarm['ALARM_TIME'],
                'ALARM_CODE' => $alarm['ALARM_CODE'],
                'ALARM_DATE' => $alarm['ALARM_DATE'],
                'ALARM_NAME' => $alarm['ALARM_NAME'],
            ];
        });
    }
}
