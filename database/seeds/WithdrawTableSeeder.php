<?php

use Illuminate\Database\Seeder;

class WithdrawTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('withdraw')->insert([
                'uid' => mt_rand(1, 99),
                'uname' => substr(uniqid('user'), 0, 10),
                'bitcoin_address' => '',
                'amount' => (mt_rand() / mt_getrandmax()) * 10,
                'status' => 10,
            ]);
        }
    }
}
