<?php

namespace Database\Factories;

use App\Models\kelompok;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kelompokl;
use App\Models\Supervisor;
use App\Models\Lampiran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tugas>
 */
class TugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['Progress', 'Revisi', 'Selesai'];
        $mulai = $this->faker->dateTimeBetween('- 1 week', '+1 months');
        $selesai = $this->faker->dateTimeBetween(
            $mulai->format('d/m/Y').' +7 days',
            $mulai->format('d/m/Y').' +3 months'
        );

        $kelompok = Kelompok::inRandomOrder()->first();
        $lampiran = Lampiran::inRandomOrder()->first();
        $supervisor = Supervisor::where('supervisorId', '=', $kelompok->supervisorId)->first();

        return [
            'judul'=> $this->faker->sentence(),
            'deskripsi'=> $this->faker->paragraph(),
            'tglMulai' => $mulai,
            'tglSelesai' => $selesai,
            'status' =>$this->faker->randomElement($status),
            'kelompokId' => $kelompok->kelompokId,
            'supervisorId' => $supervisor->supervisorId
        ];
    }
}
