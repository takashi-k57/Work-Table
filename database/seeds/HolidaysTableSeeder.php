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
            'day' => '2020-10-01',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 1,
            'day' => '2020-10-02',
            'description' => '半給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 2,
            'day' => '2020-10-02',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 3,
            'day' => '2020-10-03',
            'description' => '有給',
        ]);
        DB::table('holidays')->insert([
            'user_id' => 4,
            'day' => '2020-10-04',
            'description' => '有給',
        ]);

        $dayIterator = new App\dayIterator('year');
        foreach($dayIterator as $dayobj) {
            if($dayobj->is_sunday) {
                DB::table('holidays')->insert([
                    'day' =>  $dayobj->day->format('Y-m-d'),
                    'description' => '公休',
                ]);
            }else if($dayobj->is_public_holiday) {
                DB::table('holidays')->insert([
                    'day' =>  $dayobj->day->format('Y-m-d'),
                    'description' => '祝日',
                ]);
            }
        }
    }
}
