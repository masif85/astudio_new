<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $attribute = Attribute::latest()->first();
        $project = Project::latest()->first();

        AttributeValue::create([
            'attribute_id' => $attribute->id,
            'project_id' => $project->id,
            'value' => 'Test Value'
        ]);
    }
}
