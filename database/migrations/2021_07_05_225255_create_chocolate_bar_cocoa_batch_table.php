<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChocolateBarCocoaBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chocolate_bar_cocoa_batch', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chocolate_bar_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cocoa_batch_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('grams');
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
        Schema::dropIfExists('chocolate_bar_cocoa_batch');
    }
}
