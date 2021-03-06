<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderIdToOrderAuditLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_audit_logs', function (Blueprint $table) {
            $table->integer('order_id')
                ->after('id')
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
        Schema::table('order_audit_logs', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }
}
