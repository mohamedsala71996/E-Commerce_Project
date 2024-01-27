<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{

   public function authenticate($request) 
    {
        $username=$request->input(config('fortify.username'));
        $password=$request->password;
       $user= Admin::where('username',$username)
        ->orwhere('email',$username)
        ->orwhere('phone_number',$username)
        ->first();
        if ($user && Hash::check( $password,  $user->password) ) {
            return $user;
        }else { 
            return false;
        }

    }

}
