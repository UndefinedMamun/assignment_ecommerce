<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_name',50);
            $table->integer('category_id');
            $table->integer('manufacturer_id');
            $table->float('product_old_price', 10,2)->nullable();
            $table->float('product_new_price', 10,2)->nullable();
            $table->integer('product_quantity')->nullable();
            $table->text('product_short_description')->nullable();
            $table->text('product_long_description')->nullable();
            $table->string('product_image',250)->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('publication_status');
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
        Schema::dropIfExists('tbl_product');
    }
}
