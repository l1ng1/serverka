<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(4),
            'desc' => $this->faker->paragraph(3),
            'preview_image' => 'preview.jpg',
        ];
    }
}