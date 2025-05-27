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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 200)->unique();
            $table->integer('min_experience')->unsigned();
            $table->integer('max_experience')->unsigned()->nullable();
            $table->string('badge_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Adicionar coluna de level_id na tabela users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('level_id')->after('profile_pic')
                ->nullable()->constrained()->onDelete('set null');
            $table->integer('experience')->after('level_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropColumn(['level_id', 'experience']);
        });
        
        Schema::dropIfExists('levels');
    }
};
