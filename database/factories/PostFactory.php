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
            'content' => $this->faker->paragraphs(5, true),
            'preview_image' => $this->faker->previewImg('post/preview', 'images/preview'),
            'main_image' => $this->faker->mainImg('post/main', 'images/main'),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
        ];
    }
}
