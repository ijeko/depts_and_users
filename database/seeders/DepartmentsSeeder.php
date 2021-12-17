<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Department::factory()
            ->count(15)
            ->create();

        $depts = Department::query()->get();

        foreach ($depts as $dept) {
            $i = rand(0,5);

            while ($i!=0) {
                $dept->users()->syncWithoutDetaching(rand(1,15));
                $i--;
            }
        }
    }
}
