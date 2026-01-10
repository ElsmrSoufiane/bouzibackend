<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin DeutschMohammed',
            'email' => 'admin@deutschmohammed.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('✅ Utilisateur admin créé !');
        $this->command->info('📧 Email: admin@deutschmohammed.com');
        $this->command->info('🔑 Mot de passe: admin123');
    }
}