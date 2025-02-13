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
        Schema::create('value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('study_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('study_id')->references('id')->on('studys');
            $table->integer('value_dt1');
            $table->integer('value_dt2');
            $table->integer('value_mss');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value');
    }
};
