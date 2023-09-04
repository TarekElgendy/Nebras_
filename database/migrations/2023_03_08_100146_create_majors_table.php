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
        Schema::create('majors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('major_category_id')->unsigned();
            $table->foreign('major_category_id')->references('id')->on('major_categories')->onDelete('cascade');


            $table->string('type')->nullable();
            $table->string('image')->default('default.png');
            $table->integer('rank')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('mainPage', ['active', 'inactive'])->default('inactive');
            $table->enum('deleteItem', ['active', 'inactive'])->default('inactive'); //if yes   prenvent user to delete what you create

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
        Schema::dropIfExists('majors');
    }
};
