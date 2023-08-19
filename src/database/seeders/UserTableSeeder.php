<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'test1',
            'email' => 'test1@example.com',
            'email_verified_at' => null,
            'password' => \Hash::make('test1test1'),
            'nickname' => 'TestUser1',
            'icon' => null,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'test2',
            'email' => 'test2@example.com',
            'email_verified_at' => null,
            'password' => \Hash::make('test2test2'),
            'nickname' => 'TestUser2',
            'icon' => null,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'test3',
            'email' => 'test3@example.com',
            'email_verified_at' => null,
            'password' => \Hash::make('test3test3'),
            'nickname' => 'TestUser3',
            'icon' => null,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'test4',
            'email' => 'test4@example.com',
            'email_verified_at' => null,
            'password' => \Hash::make('test4test4'),
            'nickname' => 'TestUser4',
            'icon' => null,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'test5',
            'email' => 'test5@example.com',
            'email_verified_at' => null,
            'password' => \Hash::make('test5test5'),
            'nickname' => 'TestUser5',
            'icon' => null,
            'remember_token' => null,
        ]);

    }
}
