<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
       'username' => 'seed',
       'email' => 'seed@admin.com',
       'password' => bcrypt('123456'),
       'name' => 'Admin',
       'role' => 'admin'
      ]);
        
    }
}
