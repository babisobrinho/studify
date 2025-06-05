<?php

namespace Database\Seeders;

use App\Enums\DifficultyEnum;
use App\Models\Badge;
use App\Models\Certificate;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Level;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Track;
use App\Models\User;
use App\Models\UserBadge;
use App\Models\UserStep;
use App\Models\UserTrack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria as roles do sistema
        $this->createRoles();

        // Cria níveis de usuário primeiro
        $levels = $this->createLevels();

        // Cria categorias
        $this->createCategories();

        // Cria o usuário admin com o primeiro nível
        $admin = $this->createAdminUser($levels->first());

        // Cria usuários normais
        $users = User::factory()
            ->count(5)
            ->create(['level_id' => $levels->random()->id])
            ->each(function ($user) {
                $user->assignRole('student');
            });

        // Cria badges
        $badges = Badge::factory()->count(5)->create();

        // Atribui badges a usuários garantindo unicidade
        foreach ($users as $user) {
            $badgesToAssign = $badges->random(rand(1, 3));
            
            foreach ($badgesToAssign as $badge) {
                UserBadge::firstOrCreate([
                    'user_id' => $user->id,
                    'badge_id' => $badge->id,
                ], [
                    'earned_at' => now()->subDays(rand(1, 365))
                ]);
            }
        }

        // Cria tags
        $tags = Tag::factory()->count(5)->create();

        // Cria tracks (alguns oficiais pelo admin)
        $possibleUsers = collect([$admin->id])->merge($users->pluck('id'));
        $categories = DB::table('categories')->pluck('id');
        $difficulties = DifficultyEnum::cases();
        $tracks = collect();
        for ($i = 0; $i < 10; $i++) {
            $tracks->push(
                Track::factory()->create([
                    'user_id' => $possibleUsers->random(),
                    'category_id' => $categories->random(),
                    'difficulty' => $difficulties[array_rand($difficulties)]->value,
                ])
            );
        }

        // Atribui tags aos tracks
        $tracks->each(function ($track) use ($tags) {
            $track->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')
            );
        });

        // Cria steps para os tracks
        $steps = collect();
        foreach ($tracks as $track) {
            $createdSteps = Step::factory()
                ->count(rand(5, 15))
                ->create(['track_id' => $track->id]);

            $steps = $steps->merge($createdSteps);
        }

        // Cria relações user_track
        $users->each(function ($user) use ($tracks) {
            $tracksToAssign = $tracks->random(rand(1, 3));
            
            foreach ($tracksToAssign as $track) {
                UserTrack::firstOrCreate([
                    'user_id' => $user->id,
                    'track_id' => $track->id,
                ], [
                    'progress' => rand(0, 100),
                    'last_accessed' => now()->subDays(rand(1, 30)),
                    'started_at' => now()->subDays(rand(31, 365)),
                    'completed_at' => rand(0, 100) === 100 ? now() : null,
                ]);
            }
        });

        // Cria relações user_step
        $existingPairs = [];
        while (count($existingPairs) < 20) {
            $userId = $users->random()->id;
            $stepId = $steps->random()->id;
            $key = "$userId-$stepId";

            if (!isset($existingPairs[$key])) {
                UserStep::create([
                    'user_id' => $userId,
                    'step_id' => $stepId,
                    'completed_at' => now()->subDays(rand(1, 60)),
                    'notes' => fake()->sentence(),
                ]);
                $existingPairs[$key] = true;
            }
        }

        // Cria certificados
        Certificate::factory()
            ->count(30)
            ->create([
                'user_id' => $users->random()->id,
                'track_id' => $tracks->random()->id,
            ]);

        // Cria comentários
        $comments = Comment::factory()
            ->count(5)
            ->create([
                'user_id' => $users->random()->id,
                'track_id' => $tracks->random()->id,
            ]);

        // Cria respostas aos comentários
        Comment::factory()
            ->count(5)
            ->reply()
            ->create([
                'user_id' => $users->random()->id,
                'track_id' => $tracks->random()->id,
                'parent_id' => $comments->random()->id,
            ]);

        // Cria likes
        $likesDone = [];
        while (count($likesDone) < 20) {
            $userId = $users->random()->id;
            $trackId = $tracks->random()->id;
            $key = "$userId-$trackId";

            if (!isset($likesDone[$key])) {
                Like::create([
                    'user_id' => $userId,
                    'track_id' => $trackId,
                    'created_at' => now()->subDays(rand(1, 60)),
                ]);
                $likesDone[$key] = true;
            }
        }

        // Cria ratings
        $userIds = $users->pluck('id');
        $trackIds = $tracks->pluck('id');

        // Create all combinations of user-track pairs (Cartesian product)
        $pairs = $userIds->crossJoin($trackIds);

        // Iterate over each pair and create the rating
        $pairs->each(function ($pair) {
            [$userId, $trackId] = $pair;

            Rating::create([
                'user_id' => $userId,
                'track_id' => $trackId,
                'rating' => 5,
                'review' => fake()->sentence(10),
                'created_at' => now()->subDays(rand(1, 60)),
            ]);
        });

        // Cria follows entre usuários
        $users = User::all();
        $follows = [];
        while (count($follows) < 5) {
            $follower = $users->random()->id;
            $followed = $users->random()->id;

            // Evita seguir a si mesmo e evita duplicatas
            if ($follower !== $followed) {
                $key = "$follower-$followed";

                if (!isset($follows[$key])) {
                    DB::table('follows')->insert([
                        'follower_id' => $follower,
                        'followed_id' => $followed,
                    ]);
                    $follows[$key] = true;
                }
            }
        }

        // Cria notificações
        Notification::factory()
            ->count(5)
            ->create([
                'user_id' => $users->random()->id,
            ]);

        // Cria reports
        Report::factory()
            ->count(5)
            ->create([
                'user_id' => $users->random()->id,
            ]);
    }

    /**
     * Cria as roles do sistema
     */
    protected function createRoles(): void
    {
        // Cria roles usando o modelo do Spatie
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'curator']);
        Role::create(['name' => 'moderator']);
        Role::create(['name' => 'student']);

        // Cria permissões básicas
        Permission::create(['name' => 'manage_tracks']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_content']);
    }

    /**
     * Cria os níveis de usuário
     */
    protected function createLevels()
    {
        $levelsData = [
            [
                'name' => 'Iniciante',
                'slug' => 'iniciante',
                'min_experience' => 0,
                'max_experience' => 100,
                'badge_image' => 'badges/beginner.png',
                'description' => 'Nível inicial para novos usuários',
            ],
            [
                'name' => 'Intermediário',
                'slug' => 'intermediario',
                'min_experience' => 101,
                'max_experience' => 300,
                'badge_image' => 'badges/intermediate.png',
                'description' => 'Nível para usuários com alguma experiência',
            ],
            [
                'name' => 'Avançado',
                'slug' => 'avancado',
                'min_experience' => 301,
                'max_experience' => 600,
                'badge_image' => 'badges/advanced.png',
                'description' => 'Nível para usuários experientes',
            ],
            [
                'name' => 'Expert',
                'slug' => 'expert',
                'min_experience' => 601,
                'max_experience' => 1000,
                'badge_image' => 'badges/expert.png',
                'description' => 'Nível para especialistas',
            ],
            [
                'name' => 'Mestre',
                'slug' => 'mestre',
                'min_experience' => 1001,
                'max_experience' => null,
                'badge_image' => 'badges/master.png',
                'description' => 'O nível mais alto possível',
            ],
        ];

        return collect($levelsData)->map(function ($level) {
            return Level::updateOrCreate(['name' => $level['name']], $level);
        });
    }

    /**
     * Cria o usuário admin
     */
    protected function createAdminUser(Level $level): User
    {
        $admin = User::create([
            'name' => 'Admin Studify',
            'username' => 'admin',
            'email' => 'admin@studify.com',
            'password' => Hash::make('12345678'),
            'level_id' => $level->id,
            'email_verified_at' => now(),
            'bio' => 'Administrador do sistema Studify',
            'profile_pic' => 'profile_pics/admin.jpg',
            'experience' => 0,
        ]);

        $admin->assignRole('admin');
        $admin->givePermissionTo(['manage_tracks', 'manage_users', 'manage_content']);

        return $admin;
    }

    protected function createCategories(): void
    {
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

        $timestamp = now();

        $prepared = array_map(function ($category) use ($timestamp) {
            return array_merge($category, [
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }, $categories);

        DB::table('categories')->insert($prepared);
    }
}
