<?php

namespace App\Policies;

use App\Models\Tree;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TreePolicy
{
    
    /**
     * Determine whether the user can view the model.
     */
     public function view(User $user, Tree $tree): bool
     {
       return $user->id === $tree->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
     public function update(User $user, Tree $tree): bool
      {
       return $user->id === $tree->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
      public function delete(User $user, Tree $tree): bool
     {
       return $user->id === $tree->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tree $tree): bool
    {
        return false;
    }

}
