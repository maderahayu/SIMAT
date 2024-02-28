<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tugas;
use App\Models\kelompok;
use App\Models\Supervisor;
use Illuminate\Support\Carbon;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluasi>
 */
class EvaluasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $tugas = Tugas::inRandomOrder->first()->tugasId
        $status = ['Baru', 'Revisi', 'Selesai'];

        $tugas = Tugas::inRandomOrder()->first();
        $kelompok = Kelompok::where('kelompokId', '=', $tugas->kelompokId)->first();
        $supervisor = Supervisor::where('supervisorId', '=', $tugas->supervisorId)->first();

        return [
            'tugasId' => $tugas->tugasId,
            'kelompokId' => $kelompok->kelompokId,
            'supervisorId' => $supervisor->supervisorId,
            'penilaian' => $this->faker->numberBetween(50, 100),
            'komentar' => $this->faker->sentence(8),
            // 'status'  => $this->faker->randomElement($status),
            'tglEvaluasi' => $this->faker->dateTimeBetween('- 2 week', '+3 months'),
        ];
    }
}
