<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
         \App\Models\Admin::create([
             'name' => 'Fathy emad',
             'phone' => '1141661776',
             'email' => 'fatyemad@gmail.com',
             'national_id' => '29412012109216',
             'AdminRoleEnum' => 'admin',
             'GenderEnum' => 'male',
             'AdminStatusEnum' => 'active',
             'password' => Hash::make('P@ssw0rd'),
         ]);
    }
}
