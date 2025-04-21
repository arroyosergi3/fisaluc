<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         DB::table('treatments')->insert([
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Presoterapia', 'price' => '30','pic' => 'img_treat/presoterapia.png'],
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Terapia manual', 'price' => '35','pic' => 'img_treat/terapiaManual.png'],
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Radiofrecuencia (diatermia)', 'price' => '30','pic' => 'img_treat/radiofrecuencia.png'],
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Readaptación deportiva', 'price' => '30','pic' => 'img_treat/readaptacionDeportiva.png'],
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Ejercicio terapéutico', 'price' => '30','pic' => 'img_treat/ejercicioTerapeutico.png'],
            ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'description' => 'Asistencia a domicilio', 'price' => '30','pic' => 'img_treat/asistenciaDomicilio.png'],
             ]);

             DB::table('users')->insert([
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00','name'=> 'Miriam','surname'=> 'López Jiménez','email'=> 'miriam@gmail.com','password'=> '$2y$12$K263xFVK4hLk7UPXnfjKX.TUnlgxE2ethRntlJwpBAvWRdVpQ6cSG','phone'=> '123456789', 'birthday'=> '1998-12-16','role'=> 'physio' ],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00','name'=> 'Alejandro','surname'=> 'Algo Algo','email'=> 'alejandro@gmail.com','password'=> '$2y$12$K263xFVK4hLk7UPXnfjKX.TUnlgxE2ethRntlJwpBAvWRdVpQ6cSG','phone'=> '123456789', 'birthday'=> '1998-12-16','role'=> 'physio' ],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00','name'=> 'Pepe','surname'=> 'Sanchez Garcia','email'=> 'pepe@gmail.com','password'=> '$2y$12$K263xFVK4hLk7UPXnfjKX.TUnlgxE2ethRntlJwpBAvWRdVpQ6cSG','phone'=> '123456789', 'birthday'=> '1998-12-16','role'=> 'basic' ],
            ]);

            DB::table('specialists')->insert([
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '1', 'physio' => '2'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '2', 'physio' => '2'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '3', 'physio' => '2'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '1', 'physio' => '1'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '2', 'physio' => '1'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '3', 'physio' => '1'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '4', 'physio' => '1'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '5', 'physio' => '1'],
                ['created_at' => '2025-03-25 00:00:00', 'updated_at' => '2025-03-25 00:00:00', 'treatment' => '6', 'physio' => '1'],
                  ]);

    }
}
