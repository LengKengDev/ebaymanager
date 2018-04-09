<?php

use Illuminate\Support\Facades\DB;
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
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('account_id')->unsigned()->nullable();
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
            $table->foreign('account_id')
                ->references('id')->on('accounts')
                ->onDelete(DB::raw('set null'));
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete(DB::raw('set null'));
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
