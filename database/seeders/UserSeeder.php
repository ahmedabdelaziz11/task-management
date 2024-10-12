<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $managers = User::factory()->count(5)->create(['role' => 'manager']);

        $managers->each(function ($manager) {
            User::factory()->count(10)->create([
                'role' => 'employee',
                'manager_id' => $manager->id,
            ]);
        });
    }
}
