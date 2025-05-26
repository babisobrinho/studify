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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->integer('position');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->enum('content_type', ['video', 'article', 'podcast', 'course', 'exercise']);
            $table->string('content_url');
            $table->boolean('external_resource')->default(true);
            $table->integer('estimated_time')->comment('Tempo estimado em minutos');
            $table->timestamps();
            
            $table->unique(['track_id', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
