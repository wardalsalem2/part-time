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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('job_title')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable(); 
            $table->integer('available_hours')->nullable(); 
            $table->text('skills')->nullable(); 
            $table->text('experience')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('country')->nullable(); 
            $table->string('cv_path')->nullable(); 
            $table->string('image_path')->nullable(); 
            $table->boolean('is_active')->default(true); 
            $table->string('phone')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
