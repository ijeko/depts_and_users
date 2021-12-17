<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!User::query()->whereEmail('admin@test.loc')->first()) {
            User::query()->create([
                'name' => 'admin',
                'email' => 'admin@test.loc',
                'password' => bcrypt('password')
            ]);
        }

        User::factory()
            ->count(15)
            ->create();
    }
}
