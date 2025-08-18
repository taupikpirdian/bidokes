<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            [
                'email' =>  'admin@mail.com',
            ],
            [
                'name'  => 'Admin',
                'password'  => bcrypt('p@ssword')
            ]
        );
        $user->assignRole('admin');
    }
}