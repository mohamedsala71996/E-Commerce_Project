<?php

namespace Database\Seeders;

use App\Facades\Abilities;
use App\Models\Admin;
use App\Models\Role;
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
        $data = [
            'admin' => [
                'name' => 'Mohamed Salah',
                'email' => 'mohamed_sala712@yahoo.com',
                'username' => 'mohamedsala712',
                'password' => Hash::make('123456789'),
                'phone_number' => '01066943748',
                'super_admin' => false,

            ],
            'role' => [
                'name' => 'administrator',
            ],

        ];

        $admin = Admin::create($data['admin']);
        $role = Role::create($data['role']);
        foreach (Abilities::abilities() as $key => $value) {
            $role->roleAbility()->create([
                'ability' => $key,
                'type' => 'allow',
            ]);
        }
        $admin->roles()->attach($role->id);
    }
}
