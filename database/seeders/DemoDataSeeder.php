<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $managers = [
            ['name' => 'Manager One', 'email' => 'manager1@example.com'],
            ['name' => 'Manager Two', 'email' => 'manager2@example.com'],
        ];

        $engineers = [
            ['name' => 'Engineer One', 'email' => 'engineer1@example.com'],
            ['name' => 'Engineer Two', 'email' => 'engineer2@example.com'],
            ['name' => 'Engineer Three', 'email' => 'engineer3@example.com'],
            ['name' => 'Engineer Four', 'email' => 'engineer4@example.com'],
        ];

        $managerUsers = [];
        foreach ($managers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'manager',
                ]
            );
            $user->syncRoles(['manager']);
            $managerUsers[] = $user;
        }

        $engineerUsers = [];
        foreach ($engineers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'role' => 'engineer',
                ]
            );
            $user->syncRoles(['engineer']);
            $engineerUsers[] = $user;
        }

        $projects = [
            [
                'name' => 'Stechoq Tracker',
                'manager_id' => $managerUsers[0]->id,
                'status' => 'in_progress',
                'start_date' => now(),
                'end_date' => now()->addDays(14),
            ],
            [
                'name' => 'Bug Bash',
                'manager_id' => $managerUsers[1]->id,
                'status' => 'not_started',
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(21),
            ],
        ];

        $projectModels = [];
        foreach ($projects as $projectData) {
            $projectModels[] = Project::firstOrCreate(
                ['name' => $projectData['name']],
                $projectData
            );
        }

        $issueTypes = ['bug', 'improvement'];
        $issueStatuses = ['open', 'in_progress', 'done'];

        foreach ($projectModels as $projectIndex => $project) {
            for ($i = 1; $i <= 8; $i++) {
                $assignee = $engineerUsers[($projectIndex * 8 + $i - 1) % count($engineerUsers)];
                Issue::firstOrCreate(
                    ['title' => "Issue {$i} for {$project->name}", 'project_id' => $project->id],
                    [
                        'assignee_id' => $assignee->id,
                        'description' => 'Seeded issue for demo data.',
                        'type' => $issueTypes[$i % count($issueTypes)],
                        'status' => $issueStatuses[$i % count($issueStatuses)],
                        'priority' => (($i - 1) % 5) + 1,
                        'working_hour' => rand(1, 10),
                    ]
                );
            }
        }
    }
}
