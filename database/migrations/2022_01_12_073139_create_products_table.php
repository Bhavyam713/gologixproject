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
            $table->id();
            $table->String('name');
            $table->String('description');
            // $table->BLOB('image');
         $table->unsignedBigInteger('category_id')->unsigned();
              $table->foreign('category_id')->references('id')-> on('categories')->onDelete('cascade');
          /*   $table->unsignedBigInteger('inventatory_id');
            $table->foreign('inventatory_id')
                   ->references('id')-> on('product_inventatories')
                   ->onDelete('cascade');
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')
                   ->references('id')-> on('product_discounts')
                   ->onDelete('cascade');*/
              // $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');


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
        Schema::dropIfExists('products', function (Blueprint $table)
        {
             $table->dropForeign('products_category_id_foreign');
            // $table->dropForeign('products_discount_id_foreign');
            // $table->dropForeign('products_inventatory_id_foreign');
        });
    }
}
