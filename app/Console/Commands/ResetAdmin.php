<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dau:reset-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset admin user to default';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::query()->whereEmail('admin@test.loc')->first();

        if ($admin) {
            $admin->delete();

            User::query()->create([
                'name' => 'admin',
                'email' => 'admin@test.loc',
                'password' => bcrypt('password')
            ]);

            return 'Ok';
        }

        return 'User not found';
    }
}
