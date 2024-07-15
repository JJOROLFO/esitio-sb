<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AuthorSponsor;
use App\Models\Ordinance;
use App\Models\User;

class OrdinanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ordinance::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ord_date' => $this->faker->date(),
            'ord_no' => $this->faker->word(),
            'series' => $this->faker->word(),
            'subject' => $this->faker->text(),
            'author_id' => AuthorSponsor::factory(),
            'file' => $this->faker->word(),
            'createdby' => User::factory(),
            'updatedby' => User::factory(),
        ];
    }
}
