<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'test1@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
