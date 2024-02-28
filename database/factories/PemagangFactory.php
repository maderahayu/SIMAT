<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\kelompok;
use App\Models\Pemagang;
use App\Models\Supervisor;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PemagangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pemagang::class;
    public function definition(): array
    {
        
        // $users = DB::table('users')->where('type', '=', false)->get();
        $mulai = $this->faker->dateTimeBetween('- 1 months', '+3 months');
        $selesai = $this->faker->dateTimeBetween(
            $mulai->format('d/m/Y').' +30 days',
            $mulai->format('d/m/Y').' +3 months'
        );
        $kampus = ["Universitas Indonesia", "Telkom University", "Institut Teknologi Telkom Surabaya",
                 "Universitas Pelita Harapan", "Universitas Gajah Mada", "Universitas Veteran Jawa Timur",
                 "Universitas Negeri Surbaya", "Insitut Teknologi Sepuluh November"];

        $user = User::where('type', 0)->whereNotIn('id', Pemagang::pluck('userId')->toArray())->orderBy('id','asc')->first();
        $supervisorId = Supervisor::inRandomOrder()->value('supervisorId');
        $kelompok = kelompok::inRandomOrder()->value('kelompokId');


        return [
            'userId' => $user->id,
            'namaPemagang' => $user->nama,
            'fotoProfil' => $this->faker->image(public_path('/storage/images/'), 640, 480, "person", false),
            'namaUniversitas' => $this->faker->randomElement($kampus),
            'tglMulai' => $mulai,
            'tglSelesai' => $selesai,
            'noTelp' => $this->faker->phoneNumber(),
            'supervisorId' => $supervisorId,
            'kelompokId'=> $kelompok
        ];
        
    }
}