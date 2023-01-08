<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->double('total_price');
            $table->boolean('is_accepted')->comment('0= cancelled, 1= completed');
            $table->integer('respond_by')->nullable()->comment('record of accept/reject');
            $table->text('shipping_address');
            $table->integer('payment_gateway');
            $table->string('transaction_details')->nullable();
            $table->text('order_note')->nullable();
            $table->text('cancel_note')->nullable();
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
