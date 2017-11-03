<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_audit_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cms_uid')->unsigned();
            $table->string('cms_uname', '255');
            $table->char('request_id', 32)
                ->comment('向otc server发送请求的id');
            $table->tinyInteger('target_status')->unsigned()
                ->comment('操作时选择的状态');
            $table->tinyInteger('previous_status')->unsigned()
                ->comment('操作前的状态');
            $table->tinyInteger('post_status')->unsigned()
                ->comment('操作后实际的状态');
            $table->tinyInteger('is_successful');
            $table->string('comment', '1024');
            $table->timestamp('create_time')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('update_time')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_audit_logs');
    }
}
