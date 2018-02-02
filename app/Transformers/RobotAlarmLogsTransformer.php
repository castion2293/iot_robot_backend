<?php

namespace App\Transformers;

use Yish\Generators\Foundation\Transform\TransformContract;

class RobotAlarmLogsTransformer implements TransformContract
{
    public function transformCollection($attributes)
    {
        return $attributes->map(function ($elements) {
            return collect($elements->payload['data']['ALARM'])->map(function ($alarm) use ($elements) {
                return [
                    'ID' => $elements->payload['ID'],
                    'DATETIME' => $elements->payload['DATETIME'],
                    'ROBOT_ID' => $elements->payload['ROBOT_ID'],
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
        return collect($attribute->payload['data']['ALARM'])->map(function ($alarm) use ($attribute) {
            return [
                'ID' => $attribute->payload['ID'],
                'DATETIME' => $attribute->payload['DATETIME'],
                'ROBOT_ID' => $attribute->payload['ROBOT_ID'],
                'ALARM_TIME' => $alarm['ALARM_TIME'],
                'ALARM_CODE' => $alarm['ALARM_CODE'],
                'ALARM_DATE' => $alarm['ALARM_DATE'],
                'ALARM_NAME' => $alarm['ALARM_NAME'],
            ];
        });
    }
}
