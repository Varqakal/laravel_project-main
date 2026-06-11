<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@electroshop.com')],
            [
                'name'     => 'Administrateur',
                'email'    => env('ADMIN_EMAIL', 'admin@electroshop.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMe!')),
                'is_admin' => true,
            ]
        );
    }
}
