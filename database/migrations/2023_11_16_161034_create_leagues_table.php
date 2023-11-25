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
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('points')->nullable();
            $table->bigInteger('user_id');
            $table->boolean('is_capten')->default(0);
            $table->boolean('is_spare')->default(0);
            $table->string('type')->nullable();
            $table->string('max_team_number')->default(12);
            $table->string('max_player_number')->default(6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leagues');
    }
};
