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
        Schema::create('brand_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
           $table->text('short_description')->nullable();
           $table->longText('description')->nullable();
           $table->text('seo_key')->nullable();
           $table->text('seo_des')->nullable();

           $table->integer('brand_id')->unsigned();
           $table->string('locale')->index();
           $table->unique(['brand_id', 'locale']);
           $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('brand_translations');
    }
};
