<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Robert',
            'email' => 'robert@test.com',
            'password'=>'kether1330',
        ]);

        Category::create(['name'=>'Medical']);
        Category::create(['name'=>'Tuition']);
        Category::create(['name'=>'Other']);
    }
}
