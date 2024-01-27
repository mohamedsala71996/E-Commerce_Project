<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // DB::table('admins')->truncate();
            $admins = [
                [
                    'name' => 'Mohamed Salah',
                    'email' => 'mohamed_sala712@yahoo.com',
                    'username' => 'mohamedsala712',
                    'password' => Hash::make('123456789'),
                    'phone_number' =>'01066943748',
                    'super_admin'=>false,

                ],
               
            ];
            DB::table('admins')->insert($admins);
        }
    }
    



    

