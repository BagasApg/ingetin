<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\Todo;
use App\Models\User;
use App\Models\Todolist;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $todos = [
            [
                'list_id' => 1,
                'status' => 1,
                'name' => 'First Todo',
                'description' => 'a first todo ever',
                'deadline' => Carbon::now()
            ],
            [
                'list_id' => 1,
                'status' => 1,
                'name' => 'clean room',
                'description' => 'tidious apart',
                'deadline' => Carbon::yesterday()
            ],
            [
                'list_id' => 1,
                'status' => 0,
                'name' => 'meeting',
                'description' => 'for dear money',
                'deadline' => Carbon::tomorrow()
            ],
            [
                'list_id' => 2,
                'status' => 0,
                'name' => 'other list',
                'description' => 'for dear moneys',
                'deadline' => Carbon::tomorrow()
            ]
        ];

        $todolists = [
            [
                'user_id' => 1,
                'name' => 'My Quests'
            ],
            [
                'user_id' => 1,
                'name' => 'My Quest'
            ],
            [
                'user_id' => 2,
                'name' => 'My Activities'
            ],
        ];

        $users = [
            [
                'username' => 'bagasap',
                'password' => 'asdasdasd'
            ],
            [
                'username' => 'faizagit',
                'password' => 'asdasdasd'
            ]
        ];

        foreach ($users as $user) {
            User::create([
                'username' => $user['username'],
                'password' => $user['password']
            ]);
        }

        foreach ($todolists as $list) {
            Todolist::create([
                'user_id' => $list['user_id'],
                'name' => $list['name']
            ]);
        }
        foreach ($todos as $todo) {
            Todo::create([
                'list_id' => $todo['list_id'],
                'status' => $todo['status'],
                'name' => $todo['name'],
                'description' => $todo['description'],
                'deadline' => $todo['deadline']
            ]);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
