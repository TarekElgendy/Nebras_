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
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->double('balance')->default(0);//The current balance of the wallet.

            $table->enum('currency', ['USD', 'BTC','EGP'])->default('EGP');//The type of currency that the wallet holds (e.g. USD, BTC, ETH).

            $table->enum('status', ['active', 'inactive','locked'])->default('active');//status of the wallet (e.g. active, inactive, locked).



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
        Schema::dropIfExists('wallets');
    }
};
