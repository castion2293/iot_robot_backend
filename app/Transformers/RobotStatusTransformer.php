<?php

namespace App\Transformers;

class RobotStatusTransformer
{
    public function transformInstance($attribute)
    {
        $status = $attribute->payload['data'];

        return collect([
            'MODE' => $status['MODE'],
            'LSPEED' => $status['LSPEED'],
            'OVRD' => $status['OVRD'],
            'FILE' => $status['FILE'],
            'MACHINE' => $status['MACHINE'],
            'STATUS' => $status['STATUS'],

            'ID' => $attribute->payload['ID'],
            'DATETIME' => $attribute->payload['DATETIME']
        ]);
    }
}
