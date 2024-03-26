<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\Response;

class CategoryPolicy extends modelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny($user): bool
    // {
    //     return $user->hasAbility('categories.view');
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view( $user, Category $category): bool
    // {
    //     return $user->hasAbility('categories.view');

    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create( $user): bool
    // {
    //     return $user->hasAbility('categories.create');

    // }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update( $user, Category $category): bool
    // {
    //     return $user->hasAbility('categories.update');
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  */
    // public function delete($user, Category $category): bool
    // {
    //     return $user->hasAbility('categories.delete');
    // }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore( $user, Category $category): bool
    // {
    //     return $user->hasAbility('categories.restore');
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete( $user, Category $category): bool
    // {
    //     //
    // }
}
