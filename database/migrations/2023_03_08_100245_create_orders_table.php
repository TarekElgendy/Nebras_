<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->text('note')->nullable();
            $table->date('orderDate')->nullable();
            $table->date('shippedDate')->nullable();
            $table->double('total')->nullable();
            $table->string('code')->nullable();// promo code
            $table->double('discount')->nullable();
            $table->string('status')->nullable()->default('pending');

            $table->integer('user_address_id')->unsigned()->nullable();
            $table->foreign('user_address_id')->references('id')->on('user_addresses')->onDelete('cascade');


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
};
