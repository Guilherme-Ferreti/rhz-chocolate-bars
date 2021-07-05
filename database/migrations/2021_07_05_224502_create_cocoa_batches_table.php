<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocoaBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocoa_batches', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->enum('provider', ['RZM Kakau', 'RZM Organic', 'RZM Foods Brazil']);
            $table->enum('origin', [ 'Organic', 'Preprocessed']);
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
        Schema::dropIfExists('cocoa_batches');
    }
}
