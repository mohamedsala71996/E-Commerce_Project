<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            // DB::table('users')->truncate();
    

            $users = [
                [
                    'name' => 'Mohamed Salah',
                    'email' => 'mohamed_sala712@yahoo.com',
                    'password' => Hash::make('123456789'),
                    'type'=>'admin',
                ],
               
            ];
            DB::table('users')->insert($users);
        }
    }
    



    

