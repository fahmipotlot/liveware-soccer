<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Club::create([
            'name' => 'Persibo',
            'city' => 'Bojonegoro',
        ]);

        \App\Models\Club::create([
            'name' => 'Persinga',
            'city' => 'Ngawi',
        ]);
    }
}
