<?php

namespace App\Transformers;

class RobotTotalStatusTransformer
{
    public function transformInstance($attribute)
    {
        $total_status = $attribute->payload['data'];

        return collect([
            'SERVO' => $total_status['SERVO'],
            'EMG' => $total_status['EMG'],
            'EXE_LINE' => $total_status['EXE_LINE'],
            'ANA_LINE' => $total_status['ANA_LINE'],
            'EXE_TASK' => $total_status['EXE_TASK'],
            'ANA_TASK' => $total_status['ANA_TASK'],
            'FREEHOLD' => $total_status['FREEHOLD'],
            'COORDINATE' => $total_status['COORDINATE'],
            'RATE' => $total_status['RATE'],
            'MODE' => $total_status['MODE'],
            'MASTER' => $total_status['MASTER'],

            'DIN_1_16' => $total_status['DIN_1_16'],
            'DIN_17_32' => $total_status['DIN_17_32'],
            'DIN_33_48' => $total_status['DIN_33_48'],
            'DIN_49_64' => $total_status['DIN_49_64'],
            'DIN_101_116' => $total_status['DIN_101_116'],
            'DIN_117_132' => $total_status['DIN_117_132'],
            'DIN_133_148' => $total_status['DIN_133_148'],
            'DIN_149_164' => $total_status['DIN_149_164'],
            'DIN_201_216' => $total_status['DIN_201_216'],
            'DIN_217_232' => $total_status['DIN_217_232'],
            'DIN_233_248' => $total_status['DIN_233_248'],
            'DIN_249_264' => $total_status['DIN_249_264'],

            'DOUT_1_16' => $total_status['DOUT_1_16'],
            'DOUT_17_32' => $total_status['DOUT_17_32'],
            'DOUT_33_48' => $total_status['DOUT_33_48'],
            'DOUT_49_64' => $total_status['DOUT_49_64'],
            'DOUT_101_116' => $total_status['DOUT_101_116'],
            'DOUT_117_132' => $total_status['DOUT_117_132'],
            'DOUT_133_148' => $total_status['DOUT_133_148'],
            'DOUT_149_164' => $total_status['DOUT_149_164'],
            'DOUT_201_216' => $total_status['DOUT_201_216'],
            'DOUT_217_232' => $total_status['DOUT_217_232'],
            'DOUT_233_248' => $total_status['DOUT_233_248'],
            'DOUT_249_264' => $total_status['DOUT_249_264'],

            'ID' => $attribute->payload['ID'],
            'DATETIME' => $attribute->payload['DATETIME']
        ]);
    }
}
