<?php

namespace Database\Factories;

use App\Models\Supervisor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supervisor>
 */
class SupervisorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Supervisor::class;
    public function definition(): array
    {

        // $user = User::where('type', 1)->inRandomOrder()->first();
        $user = User::where('type', 1)->whereNotIn('id', Supervisor::pluck('userId')->toArray())->orderBy('id','asc')->first();

        return [
            'userId' => $user->id,
            'namaSupervisor' => $user->nama, 
            'fotoProfil' => $this->faker->image(public_path('/storage/images/'), 640, 480, "animals", false),
            'noTelp' => $this->faker->phoneNumber(),
        ];
       
        
    }
}