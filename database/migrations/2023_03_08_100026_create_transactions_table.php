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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');


            $table->integer('receiver_id')->unsigned();
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');


            $table->double('balance')->default(0);//The current balance of the wallet.
            $table->double('fees')->default(0);//The fees associated with the transaction.

            $table->enum('currency', ['USD', 'BTC','EGP'])->default('EGP');//The type of currency that the wallet holds (e.g. USD, BTC, ETH).

            $table->enum('status', ['active', 'inactive','locked'])->default('active');//status of the wallet (e.g. active, inactive, locked).

            $table->enum('type', ['buy', 'sell','transfer'])->default('transfer');//The type of transaction (e.g. buy, sell, transfer).
            $table->text('Notes')->nullable();// Any notes or comments related to the transaction.


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
        Schema::dropIfExists('transactions');
    }
};
