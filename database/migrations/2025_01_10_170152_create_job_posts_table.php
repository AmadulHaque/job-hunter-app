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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('company_logo');
            $table->string('company_name');
            $table->string('salary_range');
            $table->string('location');
            $table->text('job_description');
            $table->enum('work_type', ['fulltime', 'parttime', 'remote', 'hourly']);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
