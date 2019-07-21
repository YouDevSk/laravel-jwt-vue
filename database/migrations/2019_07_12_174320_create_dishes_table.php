<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('price');
            $table->timestamps();
        });

        Schema::create('dish_ingredients', function(Blueprint $table) {
            $table->integer('dish_id');
            $table->integer('ingredients_id');
            $table->primary(['dish_id', 'ingredients_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
        Schema::dropIfExists('dish_ingredient');
    }
}
