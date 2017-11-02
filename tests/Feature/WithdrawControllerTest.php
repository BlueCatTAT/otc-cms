<?php

namespace Tests\Feature;

use OtcCms\Models\User;
use OtcCms\Models\WithdrawStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WithdrawControllerTest extends TestCase
{

    public function testAudit()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->post(route('withdraw_audit', [1]), [
                'status' => WithdrawStatus::WITHDRAW_SUCCESS,
            ]);
        $response->isSuccessful();
        $response->isRedirection();
    }
}
