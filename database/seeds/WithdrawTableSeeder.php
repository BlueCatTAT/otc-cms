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
        $statusList = array_values(\OtcCms\Models\WithdrawStatus::getStatusList());
        for ($i = 0; $i < 5000; $i++) {
            DB::table('withdraw')->insert([
                'uid' => mt_rand(1, 999999),
                'uname' => substr(uniqid(), 0, 10),
                'bitcoin_address' => '',
                'amount' => (mt_rand() / mt_getrandmax()) * 10,
                'status' => $statusList[mt_rand(0, 3)]->getStatusCode(),
            ]);
        }
    }
}
