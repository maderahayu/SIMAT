<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tugas;
use App\Models\Supervisor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lampiran>
 */
class LampiranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tugas = Tugas::inRandomOrder()->value('kelompokId');
        $supervisorId = Supervisor::inRandomOrder()->value('supervisorId');

        return [
            'tugasId' => $tugas,
            'userId' => $supervisorId,
            'namaFile' => $this->faker->image(public_path('/storage/file/'), 640, 480, "file lampiran", false)
        ];
    
    }
}
