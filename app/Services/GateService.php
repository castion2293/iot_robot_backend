<?php

namespace App\Services;

use App\User;
use Gate;
use Yish\Generators\Foundation\Service\Service;

class GateService extends Service
{
    protected $id;

    public function userIdCheck($id = null)
    {
        count($id) ?: $id = $this->id;
        if (Gate::denies('UserIDCheck', $id)) {
            abort(403, 'Unauthorized action.');
        }
        return $this;
    }

    public function userIdCheckForSpecific($id, $productId)
    {
        if (Gate::forUser(User::find($id))->denies('UserIDCheckForSpecific', $productId)) {
            abort(403, 'Unauthorized action.');
        }

        return $this;
    }
}
