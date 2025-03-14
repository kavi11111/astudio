<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Timesheet;
use App\Models\User;
use App\Models\Project;

class TimesheetSeeder extends Seeder
{
    
    public function run(): void
    {
        $user = User::first();
        $project = Project::first();

        Timesheet::create([
            'task_name' => 'Branding',
            'date' => now(),
            'hours' => 5,
            'user_id' => $user->id,
            'project_id' => $project->id,
        ]);
    }
}
