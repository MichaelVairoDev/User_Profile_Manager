<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WorkExperience;
use App\Models\Skill;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear habilidades comunes
        $skills = [
            // Programación
            ['name' => 'PHP', 'category' => 'programming'],
            ['name' => 'JavaScript', 'category' => 'programming'],
            ['name' => 'Python', 'category' => 'programming'],
            ['name' => 'Java', 'category' => 'programming'],
            ['name' => 'C#', 'category' => 'programming'],

            // Frameworks
            ['name' => 'Laravel', 'category' => 'frameworks'],
            ['name' => 'Vue.js', 'category' => 'frameworks'],
            ['name' => 'React', 'category' => 'frameworks'],
            ['name' => 'Angular', 'category' => 'frameworks'],
            ['name' => 'Django', 'category' => 'frameworks'],

            // Bases de datos
            ['name' => 'MySQL', 'category' => 'databases'],
            ['name' => 'PostgreSQL', 'category' => 'databases'],
            ['name' => 'MongoDB', 'category' => 'databases'],
            ['name' => 'SQLite', 'category' => 'databases'],

            // Idiomas
            ['name' => 'Inglés', 'category' => 'languages'],
            ['name' => 'Español', 'category' => 'languages'],
            ['name' => 'Francés', 'category' => 'languages'],

            // Habilidades blandas
            ['name' => 'Trabajo en equipo', 'category' => 'soft_skills'],
            ['name' => 'Comunicación efectiva', 'category' => 'soft_skills'],
            ['name' => 'Liderazgo', 'category' => 'soft_skills'],
            ['name' => 'Resolución de problemas', 'category' => 'soft_skills'],

            // Herramientas
            ['name' => 'Git', 'category' => 'tools'],
            ['name' => 'Docker', 'category' => 'tools'],
            ['name' => 'VS Code', 'category' => 'tools'],
            ['name' => 'Jira', 'category' => 'tools'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Usuario de prueba
        $demoUser = User::factory()->create([
            'name' => 'Usuario Demo',
            'email' => 'demo@example.com',
            'password' => bcrypt('password123'),
            'bio' => 'Desarrollador web con pasión por las nuevas tecnologías y el aprendizaje continuo.',
            'location' => 'Madrid, España',
            'profession' => 'Desarrollador Web Full Stack',
            'birth_date' => '1990-01-15',
            'phone' => '+34 600 123 456',
        ]);

        // Asignar habilidades al usuario demo
        $demoSkills = [
            'PHP' => 5,
            'Laravel' => 5,
            'JavaScript' => 4,
            'Vue.js' => 4,
            'MySQL' => 4,
            'Git' => 4,
            'Inglés' => 4,
            'Trabajo en equipo' => 5,
            'Comunicación efectiva' => 4,
        ];

        foreach ($demoSkills as $skillName => $level) {
            $skill = Skill::where('name', $skillName)->first();
            if ($skill) {
                $demoUser->skills()->attach($skill->id, ['level' => $level]);
            }
        }

        // Experiencias laborales para el usuario demo
        WorkExperience::create([
            'user_id' => $demoUser->id,
            'company_name' => 'TechCorp Solutions',
            'position' => 'Desarrollador Web Senior',
            'description' => 'Desarrollo de aplicaciones web utilizando Laravel, Vue.js y otras tecnologías modernas. Liderazgo de equipo y mentoría de desarrolladores junior.',
            'start_date' => '2022-01-01',
            'current_job' => true,
            'location' => 'Madrid, España',
            'company_website' => 'https://techcorp-example.com',
        ]);

        WorkExperience::create([
            'user_id' => $demoUser->id,
            'company_name' => 'Digital Innovators',
            'position' => 'Desarrollador Web Full Stack',
            'description' => 'Desarrollo full stack de aplicaciones web empresariales, implementación de APIs RESTful y optimización de rendimiento.',
            'start_date' => '2019-03-01',
            'end_date' => '2021-12-31',
            'location' => 'Barcelona, España',
            'company_website' => 'https://digitalinnovators-example.com',
        ]);

        WorkExperience::create([
            'user_id' => $demoUser->id,
            'company_name' => 'StartupTech',
            'position' => 'Desarrollador Web Junior',
            'description' => 'Desarrollo frontend con HTML, CSS y JavaScript. Mantenimiento y mejora de aplicaciones existentes.',
            'start_date' => '2018-01-01',
            'end_date' => '2019-02-28',
            'location' => 'Valencia, España',
            'company_website' => 'https://startuptech-example.com',
        ]);

        // Crear usuarios adicionales con sus experiencias y habilidades
        User::factory(5)->create()->each(function ($user) {
            // Asignar experiencias laborales aleatorias
            WorkExperience::factory()->count(rand(1, 3))->create([
                'user_id' => $user->id,
            ]);

            // Asignar habilidades aleatorias
            $randomSkills = Skill::inRandomOrder()->take(rand(5, 10))->get();
            foreach ($randomSkills as $skill) {
                $user->skills()->attach($skill->id, ['level' => rand(1, 5)]);
            }
        });
    }
}
