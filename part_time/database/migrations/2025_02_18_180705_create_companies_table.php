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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // لكل مستخدم شركة واحدة فقط
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->string('industry')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable(); 
            $table->string('address')->nullable(); 
            $table->string('city')->nullable(); 
            $table->integer('num_employees')->nullable(); 
            $table->boolean('is_active')->default(false); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
