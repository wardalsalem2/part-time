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
        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); 
            $table->string('title');
            $table->text('description'); 
            $table->integer('work_hours');
            $table->decimal('salary', 10, 2)->nullable(); 
            $table->string('location')->nullable(); 
            $table->string('requirements')->nullable(); 
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true); 
            $table->string('category');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_offers');
    }
};
