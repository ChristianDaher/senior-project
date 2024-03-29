<?php

namespace Database\Seeders;

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
        try {
            User::factory()->create([
                'name' => 'Test Admin',
                'email' => 'test@admin.com',
                'is_admin' => true,
            ]);

            User::factory()->create([
                'name' => 'Test User 1',
                'email' => 'test@user1.com',
            ]);

            User::factory()->create([
                'name' => 'Test User 2',
                'email' => 'test@user2.com',
            ]);

            User::factory()->create([
                'name' => 'Test User 3',
                'email' => 'test@user3.com',
            ]);
            
        } catch (\Exception $e) {
            dump('Failed to create users: ' . $e->getMessage());
        }
    }
}
