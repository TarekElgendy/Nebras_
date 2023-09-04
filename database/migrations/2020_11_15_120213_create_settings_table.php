<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('logo')->default('default.png');
            $table->string('icon')->default('default.png');
            $table->string('footer_logo')->default('default.png');

            $table->string('num1')->nullable();
            $table->string('num2')->nullable();
            $table->string('num3')->nullable();

            $table->string('working-hours')->nullable();

            $table->string('email')->nullable();
            $table->longText('link')->nullable();
            $table->longText('map')->nullable();
            $table->longText('seo_google_analatic')->nullable();
            $table->longText('facebook_messanger')->nullable();

            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('tiktok')->nullable();
            $table->text('youtube')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('snapchat')->nullable();
            $table->text('pinterest')->nullable();

            $table->string('createdBy')->nullable();
            $table->string('editeBy')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
