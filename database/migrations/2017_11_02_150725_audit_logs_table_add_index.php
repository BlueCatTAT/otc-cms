<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuditLogsTableAddIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_audit_logs', function (Blueprint $table) {
            $table->index('withdraw_id', 'withdraw_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdraw_audit_logs', function (Blueprint $table) {
            $table->dropIndex('withdraw_id');
        });
    }
}
