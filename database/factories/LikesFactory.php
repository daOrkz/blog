<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostUserLike;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LikesFactory extends Factory
{
    protected $model = PostUserLike::class;

    public function definition()
    {
        return [
            'post_id' => Post::query()->inRandomOrder()->value('id'),
            'user_id' => mt_rand(1,2),
        ];
    }
}
