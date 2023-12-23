<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();
        Post::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $user = User::factory()->create([   
            'name' => 'User A',
            'email' => 'usera@example.com',
        ]);

        Post::factory(3)->create([
            'user_id'=>$user->id
        ]);


        $user = User::factory()->create([   
            'name' => 'User B',
            'email' => 'userb@example.com',
        ]);
        Post::factory(3)->create([
            'user_id'=>$user->id
        ]);

    }
}
