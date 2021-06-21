<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();
        $faker = \Faker\Factory::create();
        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');
        User::create([
            'name' => 'Jonathan',
            'last_name'=>'alquinga',
            'phone'=>'0983868358',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'direction'=> 'Tumbaco',
            'role'=>'Estudiante',
        ]);
        // Generar algunos usuarios para nuestra aplicacion
        for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'last_name'=> $faker->lastName,
                'phone'=>$faker->phoneNumber,
                'email' => $faker->email,
                'password' => $password,
                'direction'=>$faker->sentence,
                'role'=>$faker->randomElement(['Estudiante','Empresa']),
            ]);

            $user->publications()->saveMany(
                $faker->randomElements(
                    array(
                        Publication::find(1),
                        Publication::find(2),
                        Publication::find(3)
                    ), $faker->numberBetween(1, 3), false
                )
            );
        }
    }
}
