<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TimeSheet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::latest()->first();
        $project = Project::latest()->first();

        TimeSheet::create([
            'task_name' => 'Test Task',
            'due_date_time' =>  date('Y-m-d H:i:s', strtotime('+3 days')),
            'project_id' => $project->id,
            'user_id' => $user->id
        ]);
    }
}
