<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\Attribute;

class AttributeValueSeeder extends Seeder
{
    
    public function run(): void
    {
        $project = Project::first();
        $department = Attribute::where('name', 'department')->first();
        $startDate = Attribute::where('name', 'start_date')->first();
        $budget = Attribute::where('name', 'budget')->first();

        AttributeValue::create([
            'attribute_id' => $department->id,
            'entity_id' => $project->id,
            'value' => 'Marketing',
        ]);

        AttributeValue::create([
            'attribute_id' => $startDate->id,
            'entity_id' => $project->id,
            'value' => '2025-01-01',
        ]);

        AttributeValue::create([
            'attribute_id' => $budget->id,
            'entity_id' => $project->id,
            'value' => '100000',
        ]);
    }
}
