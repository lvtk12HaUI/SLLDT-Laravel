<?php

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'username' => 'admin',
            'password' => 'anhday99',
            'role' => -1,
        ]);
    }
}
