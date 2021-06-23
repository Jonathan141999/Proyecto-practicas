<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Category::truncate();
        $faker = \Faker\Factory::create();
        // Crear categorias ficticios en la tabla
        Category::create([
            'name' =>$faker->randomElement(['Informática','Quimica','Mecánica','Redes y Telecomunicaciones','Matematicas','Física']),
        ]);
    }
}
