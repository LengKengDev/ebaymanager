<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('buyer');
            $table->string('address')->nullable();
            $table->string('item')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('tracking')->nullable();
            $table->string('status')->default('order_new');
            $table->dateTime('paid_on_date')->nullable();
            $table->dateTime('last_update')->nullable();
            $table->double('price')->default(0);
            $table->text('note')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('number')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
