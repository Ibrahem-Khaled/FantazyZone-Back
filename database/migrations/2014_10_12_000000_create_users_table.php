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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fn_id')->unique();
            $table->string('name')->nullable();
            $table->bigInteger('points')->nullable();
            $table->bigInteger('team_id')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('team_leader')->default(0);
            $table->boolean('leagues_leader')->default(0);
            $table->boolean('captin')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
