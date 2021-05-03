<?php

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = DB::table('roles')->where('name', 'admin')->first()->id;
        $id = DB::table('users')->where('name', 'Admin')->first()->id;
        
        DB::table('role_user')->insert([
            'role_id' => $role,
            'user_id' => $id,
        ]);
    }
}
