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
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->double('dateFrom')->default(0);
            $table->double('dateTo')->default(0);

            $table->double('priceUnit')->nullable();
            $table->double('priceDeposit')->nullable();
            $table->double('priceTotal')->nullable();

            $table->double('priceSample')->nullable(); //sample
            $table->enum('provideSample', ['yes', 'no'])->nullable();




            $table->text('manufacturingMethod')->nullable();
            $table->enum('madeSameSample', ['yes', 'no'])->nullable();
            $table->string('file')->nullable();
            $table->string('file2')->nullable();
            $table->string('file3')->nullable();

            $table->text('notes')->nullable();
            $table->text('adminNotes')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('inactive');




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
        Schema::dropIfExists('offers');
    }
};
