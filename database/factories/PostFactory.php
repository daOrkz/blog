<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'content' => $this->faker->text(),
            //'preview_image' => $this->faker->image('public/storage/images/preview/', 640, 480),
//            'main_image' => $this->faker->image('public/storage/images/main/', 1920, 1080),
//            'preview_image' => $this->faker->imageUrl($width=300, $height=250),
//            'main_image' => $this->faker->imageUrl($width=1920, $height=1080),
            'preview_image' => $this->faker->previewImg('post/preview', 'images/preview'),
            'main_image' => $this->faker->mainImg('post/main', 'images/main'),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
        ];
    }
}
