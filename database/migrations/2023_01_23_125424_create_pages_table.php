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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->nullable();

            $table->string('image')->default('default.png');
            $table->string('image2')->default('default.png');
            $table->string('icon')->nullable();

            $table->text('link')->nullable();
            $table->text('video')->nullable();

            $table->string('createdBy')->nullable();
            $table->string('editeBy')->nullable();


            $table->integer('rank')->nullable()->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('mainPage', ['active', 'inactive'])->default('inactive');
            $table->enum('deleteItem', ['yes', 'no'])->default('no'); //if yes   prenvent user to delete what you create

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
        Schema::dropIfExists('pages');
    }
};
