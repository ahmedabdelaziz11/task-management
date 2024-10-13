<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
                'role' => UserRole::EMPLOYEE->value,
                'manager_id' => $manager->id,
            ]);
        });

        User::create([
            'first_name' => 'ahmed',
            'last_name'  => 'abdelaziz',
            'email'      => 'ahmeddev101@gmail.com',
            'phone'      => '01004661072',
            'password'   => Hash::make('password'),
            'salary'     =>  10000,
        ]);
    }
}
