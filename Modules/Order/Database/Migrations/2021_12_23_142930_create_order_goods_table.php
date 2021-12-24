<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('order_id')->unsigned()->nullable();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->string('name');
            $table->tinyInteger('quantity')->unsigned()->default(1);
            $table->decimal('total_amount', 10, 2)->unsigned()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('order_goods');
        Schema::table('order_goods', function (Blueprint $table){
            $table->dropForeign(['order_id']);
        });
    }
}
