<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('products_id')->constrained((new \App\Models\Products())->getTable());
            $table->foreignId('tag_id')->constrained((new \App\Models\Tag())->getTable());
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
        Schema::dropIfExists('products_tag');
    }
}
