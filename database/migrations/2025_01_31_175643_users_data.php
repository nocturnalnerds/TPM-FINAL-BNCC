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
        Schema::create('users_data', function (Blueprint $table) {
            $table->id('user_data_id');
            $table->unsignedBigInteger('userId');
            $table->string('whatsapp_number');
            $table->string('line_id');
            $table->string('github_gitlab_id');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('cv_path');
            $table->string('flazz_or_id_card_path');
            $table->timestamps();
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_data');
    }
};