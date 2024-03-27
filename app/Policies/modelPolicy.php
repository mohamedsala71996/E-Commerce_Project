<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Contracts\HasAbilities;

class modelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function before($user,$abilities)
    {
        if($user->super_admin){
            return true;
        }
    }

    public function __call($name, $arguments)
    {
        $modelName=str_replace('Policy', '', class_basename($this));
        if ($name='viewAny') {
            $name = 'view';
        }
        $abiities=Str::plural(Str::lower($modelName)).'.'.$name;
        $user=$arguments[0];
        if(isset($arguments[1])){
            $model=$arguments[1];
           if ($model->store_id!= $user->store_id) {
            return false;
           }
        }
        // dd($abiities);
       return $user->hasAbility($abiities);

    }


}
