<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\AuthorSponsor;
use App\Models\Resolution;
use App\Models\User;

class ResolutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resolution::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'res_date' => $this->faker->date(),
            'res_no' => $this->faker->word(),
            'series' => $this->faker->word(),
            'subject' => $this->faker->text(),
            'author_id' => AuthorSponsor::factory(),
            'committee_in_charge' => $this->faker->word(),
            'file' => $this->faker->word(),
            'createdby' => User::factory(),
            'updatedby' => User::factory(),
        ];
    }
}
