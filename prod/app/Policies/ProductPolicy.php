<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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

    public function add(User $user)
    {
        return $user->canDo('ADD_PROD');
    }

    public function edit(User $user)
    {
        return $user->canDo('UPDATE_PROD');
    }

    public function editarticle(User $user)
    {
        return $user->canDo('UPDATE_ARTICLE');
    }


    public function destroy(User $user, Product $product)
    {
        return ($user->canDo('DELETE_PROD'));
    }
}
