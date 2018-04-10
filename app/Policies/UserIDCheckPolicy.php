<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserIDCheckPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function UserIDCheck($user, $id)
    {
        return !! count($user->products()->get()->where('product_id', $id));
    }

    /**
     * @param $user
     * @param $productId
     * @return mixed
     */
    public function UserIDCheckForSpecific($user, $productId)
    {
        return $user->products->pluck('product_id')->contains($productId);
    }
}
