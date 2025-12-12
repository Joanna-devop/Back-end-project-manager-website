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
            $table->id('pid');
            $table->string('title', 255);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('short_description');
            $table->enum('phase', ['design', 'development', 'testing', 'deployment', 'complete']);
            $table->foreignId('uid')->constrained('users', 'id')->onDelete('cascade');
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
