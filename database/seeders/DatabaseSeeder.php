<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Project;
use App\Models\TimeSheet;
use App\Models\User;
use App\Models\UserProject;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            UserProjectSeeder::class,
            TimeSheetSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class
        ]);


        Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations']);

        $parameters = [
            '--personal' => true,
            '--name' => 'Central Panel Personal Access Client',
        ];


        Artisan::call('passport:client', $parameters);
    }
}
