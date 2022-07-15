<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('user1')
        ];

        User::create($user);

        $user_2 = [
            'name' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('user2')
        ];

        User::create($user_2);
    }
}
