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

    private $user;
    protected function setUp()
    {
        parent::setUp();
        $this->user = User::find(1);
    }

    public function testAudit()
    {
        $response = $this->actingAs($this->user)
            ->post(route('withdraw_audit_confirm', [1]), [
                'status' => WithdrawStatus::WITHDRAW_CONFIRM,
            ]);
        $response->isSuccessful();
        $response->isRedirection();
    }

    public function testAuditDeny()
    {
        $response = $this->actingAs($this->user)
            ->post(route('withdraw_audit_deny', [1]), [
                'comment' => 'Denied',
            ]);
        $response->isSuccessful();
        $response->isRedirection();
    }
}
