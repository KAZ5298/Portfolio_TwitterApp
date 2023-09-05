<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 4,
            'message' => 'Hello!',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 5,
            'message' => 'Hey!',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 4,
            'message' => 'How are you ?',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 5,
            'message' => 'I am fine thank you and you ?',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 4,
            'message' => 'I am fine too!',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        Message::create([
            'room_id' => 'room:4.5',
            'user_id' => 5,
            'message' => 'That is nice!',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
