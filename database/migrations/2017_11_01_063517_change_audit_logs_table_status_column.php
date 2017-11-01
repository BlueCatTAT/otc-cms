<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAuditLogsTableStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_audit_logs', function (Blueprint $table) {
            $table->renameColumn('previousStatus', 'previous_status');
            $table->renameColumn('postStatus', 'post_status');
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
            $table->renameColumn('previous_status', 'previousStatus');
            $table->renameColumn('post_status', 'postStatus');
        });
    }
}
