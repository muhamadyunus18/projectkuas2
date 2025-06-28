<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($password),
                'is_admin' => true,
                'role' => 'admin'
            ]);
            $this->info('Admin user updated successfully!');
        } else {
            $user = User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
                'role' => 'admin'
            ]);
            $this->info('Admin user created successfully!');
        }

        $this->info('Email: ' . $email);
    }
}
