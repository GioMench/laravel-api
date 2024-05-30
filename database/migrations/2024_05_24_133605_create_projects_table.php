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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name', 50)->require()->unique();
            $table->string('slug', 50)->nullable(); 
            $table->string('preview_image', 255)->nullable();
            $table->text('description')->nullable();
            $table->year('year_project')->nullable();
            $table->string('link_video',255)->nullable();
            $table->string('link_view', 255)->nullable();
            $table->string('link_git', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
