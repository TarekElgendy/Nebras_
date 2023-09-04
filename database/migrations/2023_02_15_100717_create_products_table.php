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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');


            $table->string('type')->nullable();


            $table->string('image')->default('default.png');
            $table->string('image2')->default('default.png');
            $table->string('icon')->nullable();

            $table->double('price')->unsigned();
            $table->double('old_price')->nullable();

            $table->enum('exclusive', ['active', 'inactive'])->default('inactive');
            $table->enum('feature', ['active', 'inactive'])->default('inactive');
            $table->enum('offers', ['active', 'inactive'])->default('inactive');

            $table->integer('min_stock')->nullable()->default(1);
            $table->integer('stock')->nullable()->default(1);

            $table->enum('stock_availability', ['active', 'inactive'])->default('active');
            $table->enum('warranty',['active', 'inactive'])->default('active');
            $table->text('warrantyInfo')->nullable();
            $table->enum('Refundable',['active', 'inactive'])->default('active');
            $table->enum('taxesIncluded',['active', 'inactive'])->default('active');

            $table->enum('availableColors',['oneColor', 'multiple'])->default('multiple');
            $table->text('listAvailableColors')->nullable();

            $table->enum('poweredBy',['electricity' , 'water' , 'air' ,'battery' ,'manual' ,'naturalGas'])->default('electricity');


            $table->text('manufacturerCountry')->nullable();



            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();


            $table->text('link')->nullable();
            $table->text('video')->nullable();

            $table->string('createdBy')->nullable();
            $table->string('editeBy')->nullable();


            $table->integer('rank')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('mainPage', ['active', 'inactive'])->default('inactive');
            $table->enum('deleteItem', ['active', 'inactive'])->default('inactive'); //if active   prenvent user to delete what you create

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
        Schema::dropIfExists('products');
    }
};
