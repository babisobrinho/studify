<?php

use App\Enums\DifficultyEnum;
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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->string('plan_color', 7)->default('primary');
            $table->boolean('is_official')->default(false);
            $table->boolean('is_public')->default(true);
            $table->enum('difficulty', DifficultyEnum::values())->default(DifficultyEnum::BEGINNER->value);
            $table->string('cover_image')->nullable();
            $table->integer('contributors_count')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
