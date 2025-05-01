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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('personal_number')->unique();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('station_id')->constrained();
            $table->enum('designation', ['Observer', 'Senior Observer']);
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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