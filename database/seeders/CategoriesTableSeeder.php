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
        $cat=array('Administración de Empresas','Agroindustria', 'Computación', 'Economía','Electricidad','Electronica y Automatización','Física','Geología','Ingeniería Ambiental','Ingeniería Civil','Ingeniería de la Producción','Ingeniría Química','Matemática','Materiales','Mecánica','Petróleos','Software','Tecnologías de la Información','Telecomunicaciones','Tecnología Superior en Agua y Sanamiento','Tecnología Superior en Desarrollo de Software','Tecnología Superior en Electromecánica','Tecnología Superior en Redes y Telecomunicaciones' );
        for ($i = 0; $i < 23; $i++) {
            Category::create([
                'name' => $cat[$i],
            ]);
        }
    }
}
