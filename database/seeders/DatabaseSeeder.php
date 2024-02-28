<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pemagang;
use App\Models\Supervisor;
use App\Models\Kelompok;
use App\Models\Tugas;
use App\Models\Evaluasi;
use App\Models\Lampiran;
use App\Models\Logbook;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        User::factory(10)->create();
        $supervisorUsers = User::where('type', 1)->get();
        foreach ($supervisorUsers as $user) {
            Supervisor::factory()->create();
        }
        
        Kelompok::factory(2)->create();
        
        $magangUsers = User::where('type', 0)->get();
        foreach ($magangUsers as $user) {
            Pemagang::factory()->create();
        }
        
        Tugas::factory(3)->create();
        Lampiran::factory(10)->create();
        Evaluasi::factory(3)->create();
        Logbook::factory(4)->create();
    }

}
