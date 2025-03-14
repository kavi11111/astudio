<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    
    public function run(): void
    {
        Project::create([
            'name' => 'Rolex',
            'status' => 'active',
        ]);
    
        Project::create([
            'name' => 'W Hotels',
            'status' => 'inactive',
        ]);
    }
}
