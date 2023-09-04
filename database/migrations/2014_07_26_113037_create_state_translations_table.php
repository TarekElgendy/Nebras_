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
        Schema::create('state_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('locale')->index();

            $table->integer('state_id')->unsigned();
            $table->unique(['state_id', 'locale']);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

             $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();


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
        Schema::dropIfExists('state_translations');
    }
};
