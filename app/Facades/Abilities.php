<?php

namespace App\Facades;

use App\Interfaces\DataRepositoryInterface;
use Illuminate\Support\Facades\Facade;

class Abilities extends Facade
{
 
    public static function getFacadeAccessor()
    {
        return DataRepositoryInterface::class; 
    }
}