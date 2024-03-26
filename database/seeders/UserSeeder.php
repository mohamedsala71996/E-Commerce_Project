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
            // DB::table('admins')->truncate();
            $users = [
                [
                    'name' => 'Amgad Salah',
                    'email' => 'a@yahoo.com',
                    'password' => Hash::make('123456789'),
                ],
               
            ];
            DB::table('users')->insert($users);
        }
    }
    



    

