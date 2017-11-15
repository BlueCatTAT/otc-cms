<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeDailyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_daily', function(Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('crypto_type')->default(1)->unsigned();
            $table->date('date');
            $table->decimal('commission', 12, 8)
                ->comment('How much we charge for the service');
            $table->decimal('total', 20, 8)
                ->comment('How much coins transfered');
            $table->integer('ratio')->unsigned();
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
        Schema::dropIfExists('commission_daily');
    }
}
