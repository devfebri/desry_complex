<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'user',
                'username' => 'user',
                'role' => 'user',
                'password' => Hash::make('user'),
                'email' => 'user@user.com',
            ],
            [
                'name' => 'manager',
                'username' => 'manager',
                'role' => 'manager',
                'password' => Hash::make('manager'),
                'email' => 'manager@manager.com',
            ],
            [
                'name' => 'managersenior',
                'username' => 'managersenior',
                'role' => 'managersenior',
                'password' => Hash::make('managersenior'),
                'email' => 'managersenior@managersenior.com',
            ],
            [
                'name' => 'managerit',
                'username' => 'managerit',
                'role' => 'managerit',
                'password' => Hash::make('managerit'),
                'email' => 'managerseniorit@managerit.com',
            ],
            [
                'name' => 'managerseniorit',
                'username' => 'managerseniorit',
                'role' => 'managerseniorit',
                'password' => Hash::make('managerseniorit'),
                'email' => 'managerseniorit@managerseniorit.com',
            ],
            // Add more users here if needed
        ]);
    }
}
