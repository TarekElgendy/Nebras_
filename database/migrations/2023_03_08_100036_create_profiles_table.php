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
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->string('whatsapp')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable();

            $table->date('birthDate')->nullable();



            $table->enum('verification', ['active', 'inactive'])->nullable(); //yes or no
            $table->longText('compBio')->nullable();
            $table->text('compInfo1')->nullable();
            $table->text('compInfo2')->nullable();
            $table->string('compLegalName')->nullable();

            $table->string('compName')->nullable();
            $table->string('compPhone')->nullable();
            $table->string('compemail')->nullable();
            $table->string('compWebsite')->nullable();
            $table->string('compAddress')->nullable();
            $table->string('compLogo')->default('default.png');
            $table->string('compCommercialRecord')->nullable();
            $table->string('compTaxNumber')->nullable();

            $table->string('compTaxValueNumber')->nullable();
            $table->string('compIndustryRegistry')->nullable();

            $table->string('compJobTitle')->nullable();

            $table->string('compBankAccount')->nullable();
            $table->string('compBankSwift')->nullable();
            $table->string('compBankCity')->nullable();
            $table->string('compBankStockholder')->nullable();
            $table->string('compShippingAddress')->nullable();
            $table->string('image')->default('default.png');
            $table->string('logo')->default('default.png');
            $table->enum('status', ['active', 'inactive'])->default('active');

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
        Schema::dropIfExists('profiles');
    }
};
