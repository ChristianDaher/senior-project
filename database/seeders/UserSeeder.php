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
        } catch (\Exception $e) {
            dump('Failed to create default users: ' . $e->getMessage());
        }

        User::factory()->count(25)->create();
        User::factory()->count(5)->deleted()->create();
        User::factory()->count(5)->unverified()->create();
        User::factory()->count(5)->old()->create();
        User::factory()->count(5)->old()->deleted()->create();
    }
}
