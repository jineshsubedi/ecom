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
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_cost', 15, 2)->default(0.0);
            $table->integer('phone');
            $table->string('address');
            $table->integer('payment_mode');
            $table->enum('status', ['order_pending', 'order_place', 'order_cancel', 'order_success', 'order_complete']);
            $table->date('order_date')->nullable();
            $table->date('delivery_date')->nullable();
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
