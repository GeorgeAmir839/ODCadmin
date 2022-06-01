<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Course::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'level' => $this->faker->text,
        ];
    }
}
