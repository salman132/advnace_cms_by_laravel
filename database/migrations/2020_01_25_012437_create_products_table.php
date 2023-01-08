<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name');
            $table->string('product_slug')->index();
            $table->integer('product_price');
            $table->text('product_description')->nullable();
            $table->integer('category_id');
            $table->boolean('stock')->default(0)->comment("1=Yes,0=No");
            $table->string('contentPic')->default('uploads/thumbnails/default.png');
            $table->text('gallery')->nullable();

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
        Schema::dropIfExists('prodcuts');
    }
}
