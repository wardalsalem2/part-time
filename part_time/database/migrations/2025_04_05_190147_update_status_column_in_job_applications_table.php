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
    Schema::table('job_applications', function (Blueprint $table) {
        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending')->change();
    });
}

public function down(): void
{
    Schema::table('job_applications', function (Blueprint $table) {
        $table->string('status')->default('pending')->change();
    });
}

};
