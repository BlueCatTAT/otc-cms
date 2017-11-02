<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuditLogsTableAddSuccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_audit_logs', function (Blueprint $table) {
            $table->tinyInteger('is_successful')
                ->comment('操作是否执行成功')
                ->unsigned();
            $table->char('request_id', '32')
                ->comment('向otc_server发送请求的ID，用于到日志中查错');
            $table->tinyInteger('target_status')
                ->comment('操作时想要到达的状态')
                ->unsigned();
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
            $table->dropColumn('is_successful');
            $table->dropColumn('request_id');
            $table->dropColumn('target_status');
        });
    }
}
