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
        Schema::create('game_texts', function (Blueprint $table) {
            $table->id()->startingValue(0);
            $table->unsignedBigInteger('categoriesId');
            $table->foreign(    'categoriesId')->references('id')->on('categories');
            $table->unsignedBigInteger('difficultiesId');
            $table->foreign('difficultiesId')->references('id')->on('difficulties');
            $table->string('gameText');
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
        Schema::dropIfExists('game_texts');
    }
};
