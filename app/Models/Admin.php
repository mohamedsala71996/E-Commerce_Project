<?php

namespace App\Models;

use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;


class Admin extends User 
{
    use HasFactory, Notifiable, HasRoles, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'super_admin',
        'status',
    ];

    
}
