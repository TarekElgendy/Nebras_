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
        Schema::create('major_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('default.png');
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
        Schema::dropIfExists('major_categories');
    }
};
