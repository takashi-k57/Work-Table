<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('holidays')->insert([
            'user_id' => 1,
            'day' => '2020-10-02',
            'description' => '公',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 1,
            'day' => '2020-10-03',
            'description' => '有',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 1,
            'day' => '2020-10-09',
            'description' => '半公',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 1,
            'day' => '2020-10-15',
            'description' => '半公',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 2,
            'day' => '2020-10-07',
            'description' => '公',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 2,
            'day' => '2020-10-13',
            'description' => '半有',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 3,
            'day' => '2020-10-10',
            'description' => '公',
        ]);

        DB::table('holidays')->insert([
            'user_id' => 3,
            'day' => '2020-10-23',
            'description' => '代',
        ]);
    }
}
