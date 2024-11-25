<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostUserLike;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserAdminSeeder::class,
            UserReaderSeeder::class,
        ]);

//         \App\Models\User::factory(10)->create();
        User::factory(5)
            ->has(Post::factory()->count(10), 'userPostLiked')
            ->create();
        Category::factory(5)->create();
        Tag::factory(5)->create();
//        Post::factory(5)->create();
        Comment::factory(50)->create();
        PostUserLike::factory(10)->create();

    }
}
