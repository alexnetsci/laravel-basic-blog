<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin', 
            'email' => 'admin@dev.com',
            'password' => Hash::make('airliner'),
        ]);

        User::insert([
            'name' => 'User 1', 
            'email' => 'user_1@dev.com',
            'password' => Hash::make('airliner'),
        ]);
    }
}
