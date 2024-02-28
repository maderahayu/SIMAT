<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Logbook;
use App\Models\Tugas;
use App\Models\Evaluasi;
use App\Models\Pemagang;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logbook>
 */
class LogbookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pemagang = Pemagang::pluck('pemagangId')->toArray();
        $pemagangId = $this->faker->randomElement($pemagang);

        // Retrieve a random Evaluation ID to associate the logbook entry with an Evaluation
        $tugas = Tugas::pluck('tugasId')->toArray();
        $tugasId = $this->faker->randomElement($tugas);
        $tgl = $this->faker->dateTimeBetween('- 2 weeks', '+1 months');


        return [
            'tugasId' => $tugasId,
            'pemagangId' => $pemagangId,
            'tglLogbook' => $tgl,
            'deskripsi' => $this->faker->sentence(8)
        ];
    }
}
