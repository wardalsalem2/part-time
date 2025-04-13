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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade'); 
            $table->foreignId('job_offer_id')->constrained('job_offers')->onDelete('cascade'); 
            $table->string('status')->default('pending'); // (pending, accepted, rejected)
            $table->text('cover_letter')->nullable();
            $table->string('resume')->nullable(); 
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
