<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'subject_number' => 'TH',
            'name' => 'Toán học',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'VL',
            'name' => 'Vật lý',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'HH',
            'name' => 'Hóa học',
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'SH',
            'name' => 'Sinh học',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'NV',
            'name' => 'Ngữ văn',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'LS',
            'name' => 'Lịch sử',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'DL',
            'name' => 'Địa lý',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'NN',
            'name' => 'Ngoại ngữ',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'GDCD',
            'name' => 'GDCD',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'CN',
            'name' => 'Công nghệ',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'AN',
            'name' => 'Âm nhạc',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'MT',
            'name' => 'Mỹ thuật',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'TinH',
            'name' => 'Tin học',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);
        DB::table('subjects')->insert([
            'subject_number' => 'TheD',
            'name' => 'Thể dục',
            'lop_6' => 6,
            'lop_7' => 7,
            'lop_8' => 8,
            'lop_9' => 9
        ]);

    }
}
