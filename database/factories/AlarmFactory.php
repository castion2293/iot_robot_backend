<?php

use Faker\Generator as Faker;

$factory->define(App\Alarm::class, function (Faker $faker) {
    return [
        'alarm_code' => '008-014',
        'description' => '緊急停止按鈕已被按下',
        'cause' => '緊急停止按鈕已被按下',
        'remedy' => '緊急停止按鈕位於控制器的控制面板、ＴＰ、外部的三個部位。按鈕未被按下時，請檢查確認是否有開關不良、配線不良。考慮是內部接插口的接觸不良時，請再次確認連接情況。※不使用Ｔ／Ｐ時，請連接仿真插頭（防意外用模擬插頭）',
        'remarks' => '外部緊急停止時連接於ＥＭＳ接插口。不使用時請套上防護外罩'
    ];
});
