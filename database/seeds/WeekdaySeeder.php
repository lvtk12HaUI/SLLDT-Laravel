<?php

use Illuminate\Database\Seeder;

class WeekdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=2;$i<=7;$i++){
            DB::table('weekdays')->insert([
                'day' => "Thứ ".$i
            ]);
        }
    }
}
