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
        Schema::create('GameTexts', function (Blueprint $table) {
            $table->id()->startingValue(0);
            $table->text('textName');
            $table->unsignedBigInteger('categoriesId');
            $table->foreign(    'categoriesId')->references('id')->on('Categories');
            $table->unsignedBigInteger('difficultiesId');
            $table->foreign('difficultiesId')->references('id')->on('Difficulties');
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
        Schema::dropIfExists('GameTexts');
    }
};
