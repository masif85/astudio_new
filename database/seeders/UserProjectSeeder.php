<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $user = User::latest()->first();
        $project = Project::latest()->first();

        UserProject::create([
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);
    }
}
