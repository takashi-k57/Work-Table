<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('holidays')->insert([
            'user_id' => 1,
            'id' => 1,
            'day' => '2020-08-20',
            'description' => '有休',
            'created_at' => '2020-08-20',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 2,
            'id' => 2,
            'day' => '2020-08-19',
            'description' => '有休',
            'created_at' => '2020-08-20',
        ]);
    }
}
