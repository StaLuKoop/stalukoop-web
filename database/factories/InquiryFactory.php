<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  protected $model = Inquiry::class;

  public function definition(): array
  {
    return [
      'first_name' => $this->faker->firstName,
      'last_name'  => $this->faker->lastName,
      'email'      => $this->faker->unique()->safeEmail,
      'phone'      => $this->faker->phoneNumber,
      'inquiry'    => $this->faker->sentence(3),
      'message'    => $this->faker->paragraph,
    ];
  }
}
