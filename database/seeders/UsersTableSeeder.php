<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author ')->first();

        User::truncate();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $sosal = User::create([
            'name' => 'Sosal',
            'email' => 'sosal@sosal.com',
            'password' => bcrypt('password'),
        ]);

        $admin->roles()->attach($adminRole);
        $sosal->roles()->attach($authorRole);
    }
}