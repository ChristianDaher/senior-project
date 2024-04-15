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
                'username' => 'TheBestAdmin',
                'email' => 'test@admin.com',
                'is_admin' => true,
            ]);

            User::factory()->create([
                'name' => 'Test User',
                'username' => 'TheBestUser',
                'email' => 'test@user.com',
            ]);

            User::factory()->count(25)->create();
            
        } catch (\Exception $e) {
            dump('Failed to create users: ' . $e->getMessage());
        }
    }
}
