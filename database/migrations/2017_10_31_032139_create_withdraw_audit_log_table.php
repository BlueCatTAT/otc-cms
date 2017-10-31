<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawAuditLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_audit_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('withdraw_id', false, true);
            $table->integer('cms_uid', false, true);
            $table->string('cms_uname', 255);
            $table->tinyInteger('previousStatus');
            $table->tinyInteger('postStatus');
            $table->timestamp('create_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')->default(
                DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_audit_logs');
    }
}
