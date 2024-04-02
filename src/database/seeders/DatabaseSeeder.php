<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@trail-race.com',
            'role' => UserRoleEnum::APPLICANT,
            'password' => bcrypt('123456'),
        ]);

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@trail-race.com',
            'role' => UserRoleEnum::ADMIN,
            'password' => bcrypt('123456'),
        ]);

        $this->call(
            RaceSeeder::class,
        );
    }
}
