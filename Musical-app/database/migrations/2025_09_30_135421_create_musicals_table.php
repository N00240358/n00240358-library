<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('musicals', function (Blueprint $table) {
            $table->id(); //makes id
            $table->string('title'); //makes title
            $table->string('image')->nullable(); //makes image
            $table->text('description')->nullable(); //makes description
            $table->integer('duration')->nullable(); //makes duration
            $table->string('director')->nullable(); //makes director
            $table->date('premiere_date')->nullable(); //makes premiere date
            $table->timestamps(); //makes created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicals');
    }
};
