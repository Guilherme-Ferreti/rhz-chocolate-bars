<?php

use App\Models\CocoaBatch;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->enum('provider', CocoaBatch::PROVIDERS);
            $table->enum('origin', CocoaBatch::ORIGINS);
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
