<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Criar a tabela categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Adicionar a coluna category_id à tabela tracks
        Schema::table('tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        // Inserir as categorias predefinidas
        $categories = [
            ['name' => 'Desenvolvimento Web', 'slug' => 'desenvolvimento-web', 'description' => 'Cursos relacionados ao desenvolvimento de sites e aplicações web'],
            ['name' => 'Front-End', 'slug' => 'front-end', 'description' => 'Cursos focados em tecnologias de interface e experiência do usuário'],
            ['name' => 'Back-End', 'slug' => 'back-end', 'description' => 'Cursos focados em desenvolvimento de servidores e APIs'],
            ['name' => 'Inteligência Artificial', 'slug' => 'inteligencia-artificial', 'description' => 'Cursos sobre IA, machine learning e deep learning'],
            ['name' => 'Mobile', 'slug' => 'mobile', 'description' => 'Cursos de desenvolvimento de aplicativos móveis'],
            ['name' => 'DevOps', 'slug' => 'devops', 'description' => 'Cursos sobre integração entre desenvolvimento e operações'],
            ['name' => 'Segurança', 'slug' => 'seguranca', 'description' => 'Cursos sobre segurança da informação e cibersegurança'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'description' => 'Cursos sobre ciência de dados e análise de dados'],
            ['name' => 'UX/UI Design', 'slug' => 'ux-ui-design', 'description' => 'Cursos sobre design de interfaces e experiência do usuário'],
            ['name' => 'Cloud Computing', 'slug' => 'cloud-computing', 'description' => 'Cursos sobre computação em nuvem e serviços cloud'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remover a chave estrangeira e a coluna category_id da tabela tracks
        Schema::table('tracks', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        // Remover a tabela categories
        Schema::dropIfExists('categories');
    }
};
