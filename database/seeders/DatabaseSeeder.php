<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Voert het database seeden uit voor de applicatie.
     */
    public function run(): void
    {
        // Maak rollen aan
        $rollen = ['secretaris', 'penningmeester'];

        foreach ($rollen as $rol) {
            Role::create(['name' => $rol]);
        }

        // Maak gebruikers aan en wijs rollen toe
        $gebruikers = [
            [
                'name' => 'Secretaris',
                'email' => 'secretaris@ledenadministratie.test',
                'password' => Hash::make('secretaris'),
                'rol' => 'secretaris',
            ],
            [
                'name' => 'Penningmeester',
                'email' => 'penningmeester@ledenadministratie.test',
                'password' => Hash::make('penningmeester'),
                'rol' => 'penningmeester',
            ],
        ];

        foreach ($gebruikers as $gebruikersData) {
            $gebruiker = User::factory()->create([
                'name' => $gebruikersData['name'],
                'email' => $gebruikersData['email'],
                'password' => $gebruikersData['password'],
            ]);

            $rol = Role::where('name', $gebruikersData['rol'])->first();
            $gebruiker->roles()->attach($rol);
        }

        // Voeg records toe aan de `soort_leden` tabel
        DB::table('soort_leden')->insert([
            ['naam' => 'Jeugd', 'omschrijving' => 'jonger dan 8 jaar'],
            ['naam' => 'Aspirant', 'omschrijving' => 'van 8 t/m 12 jaar'],
            ['naam' => 'Junior', 'omschrijving' => 'van 13 t/m 17 jaar'],
            ['naam' => 'Senior', 'omschrijving' => 'van 18 t/m 50 jaar'],
            ['naam' => 'Oudere', 'omschrijving' => 'van 51 jaar']
        ]);

        DB::table('global_settings')->insert([
            ['standaard_contributie' => 100, 'jeugd_korting' => 50, 'aspirant_korting' => 40, 'junior_korting' => 25,'senior_korting' => 0,'oudere_korting' => 45 ],
        ]);
    }
}
