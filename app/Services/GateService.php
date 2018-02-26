<?php

namespace App\Services;

use Gate;
use Yish\Generators\Foundation\Service\Service;

class GateService extends Service
{
    protected $id;

    public function userIdCheck($id = null)
    {
        count($id) ?: $id = $this->id;
        if (Gate::denies('UserIDCheck', $id)) {
            abort(403);
        }
        return $this;
    }
}
