<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create User A
        User::create([
            'id' => 3,
            'name' => 'User A',
            'email' => 'userA@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create User B
        User::create([
            'id' => 4,
            'name' => 'User B',
            'email' => 'userB@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
