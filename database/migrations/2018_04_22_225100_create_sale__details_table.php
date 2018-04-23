<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale__details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('product_name');
            $table->decimal('price', 8, 2);
            $table->decimal('quantity', 8, 2);
            $table->decimal('sub_amount', 8, 2);
            $table->timestamps();

            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('set null');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale__details');
    }
}
