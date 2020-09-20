<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'day' => '2020-09-01',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 2,
            'day' => '2020-09-02',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 3,
            'day' => '2020-09-03',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 4,
            'day' => '2020-09-04',
            'description' => '有給',
        ]);

        // $dayIterator = new App\dayIterator;
        // foreach($dayIterator as $dayobj) {
        //     if($dayobj->is_holiday) {
        //         DB::table('holidays')->insert([
        //             'day' =>  $dayobj->day->format('Y-m-d'),
        //             'description' => '公休',
        //         ]);
        //     }
        // }
    }
}
