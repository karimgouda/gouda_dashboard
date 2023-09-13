<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class StartPorject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:fresh');
        $this->info('database was migrated');
        $name = $this->ask('Enter your name');
        $email = $this->ask('Enter your email');
        $password = $this->ask('Enter your password');
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        $this->info('Admin account was created');

        Artisan::call('db:seed');
        $this->info('data was seeded');

        return Command::SUCCESS;
    }
}
