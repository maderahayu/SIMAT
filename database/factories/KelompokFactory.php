<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Supervisor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class KelompokFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supervisorId = Supervisor::inRandomOrder()->value('supervisorId');

        return [
            'namaKelompok'=> $this->faker->company(),
            'supervisorId'=> $supervisorId,
        ];
    }
}
