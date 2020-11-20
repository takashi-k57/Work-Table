<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        DB::table('users')->insert([
            'name' => "本田圭佑",
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "常勤",
        ]);

        DB::table('users')->insert([
            'name' => "香川真司",
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "常勤",
        ]);

        DB::table('users')->insert([
            'name' => "柴崎岳",
            'email' => 'user3@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "常勤",
        ]);

        DB::table('users')->insert([
            'name' => "南野拓実",
            'email' => 'user4@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "常勤",
        ]);

        DB::table('users')->insert([
            'name' => "鎌田大地",
            'email' => 'user5@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "常勤",
        ]);

        DB::table('users')->insert([
            'name' => "乾貴士",
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "非常勤",
        ]);

        DB::table('users')->insert([
            'name' => "岡崎慎司",
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "非常勤",
        ]);

        DB::table('users')->insert([
            'name' => "原口元気",
            'email' => 'admin3@gmail.com',
            'password' => Hash::make('password'),
            'worksystem' => "非常勤",
        ]);

    }
}
