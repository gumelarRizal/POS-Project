<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = ModelsUser::create([
            'name' => 'Fajri',
            'email' => 'fajri123@gmail.com',
            'username' => 'fajri',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');
        $user = ModelsUser::create([
            'name' => 'Cupay',
            'email' => 'cupay123@gmail.com',
            'username' => 'cupay',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('user');
    }
}
