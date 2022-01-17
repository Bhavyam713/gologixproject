<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseraddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useraddresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();

             // $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id')
                   ->references('id')-> on('users')
                   ->onDelete('cascade');
            $table->String('address_line1');
            $table->String('address_line2');
            $table->String('city');
            $table->String('landmark');
            $table->String('postal_code');
            $table->String('country');
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
        Schema::dropIfExists('useraddresses', function (Blueprint $table){
            $table->dropForeign('useraddresses_user_id_foreign');
        });
    }
}
