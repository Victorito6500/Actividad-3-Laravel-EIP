<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Libro;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $libros = [
          [
            'titulo'           => 'El Señor de los Anillos. El Retorno del Rey',
            'autor'            => 'J.R.R. Tolkien',
            'descripcion'      => 'En la adormecida e idílica Comarca, un joven hobbit recibe un encargo: custodiar el Anillo Único y emprender el viaje para su destrucción en la Grieta del Destino. Acompañado por magos, hombres, elfos y enanos, atravesará la Tierra Media y se internará en las sombras de Mordor, perseguido siempre por las huestes de Sauron, el Señor Oscuro, dispuesto a recuperar su creación para establecer el dominio definitivo del Mal.',
            'anio_publicacion' => '1954',
            'genero'           => 'Novela de Fantasía Heróica',
            'disponible'       => 1
          ],
          [
            'titulo'           => 'Fahrenheit 451',
            'autor'            => 'Ray Bradbury',
            'descripcion'      => 'Fahrenheit 451: la temperatura a la que el papel se enciende y arde.\nGuy Montag es un bombero y el trabajo de un bombero es quemar libros, que están prohibidos porque son causa de discordia y sufrimiento. El Sabueso Mecánico del Departamento de Incendios, armado con una letal inyección hipodérmica, escoltado por helicópteros, está preparado para rastrear a los disidentes que aún conservan y leen libros.\nComo 1984, de George Orwell, como Un mundo feliz, de Aldous Huxley, Fahrenheit 451 describe una civilización occidental esclavizada por los medios, los tranquilizantes y el conformismo.\nLa visión de Bradbury es asombrosamente profética: pantallas de televisión que ocupan paredes y exhiben folletines interactivos; avenidas donde los coches corren a 150 kilómetros por hora persiguiendo a peatones; una población que no escucha otra cosa que una insípida corriente de música y noticias trasnmitidas por unos diminutos auriculares insertados en las orejas.\n"Fahrenheit 451 es el más convincente de todos los infiernos conformistas".',
            'anio_publicacion' => '1953',
            'genero'           => 'Novela de Ficción Distópica',
            'disponible'       => 1
          ],
          [
            'titulo'           => 'Orgullo y prejuicio',
            'autor'            => 'Jane Austen',
            'descripcion'      => 'La novela Orgullo y Prejuicio es una crítica de la sociedad inglesa de comienzos del S.XIX. Jane, Elizabeth, Mary, Kitty y Lidia son cinco hermanas que viven con sus padres en las afueras de Londres y que deben contraer matrimonio para que, de acuerdo a las reglas de la época, la herencia paterna continúe en el seno familiar. A dicha tarea se encomienda con ahínco su madre, quien se siente esperanzada cuando entran en escena Mr. Binglye, un joven soltero y rico, y Mr. Darcy.',
            'anio_publicacion' => '1813',
            'genero'           => 'Novela Romántica',
            'disponible'       => 1
          ]
        ];

        // Seeder libros
        foreach ($libros as  $libro) {
          Libro::create([
              'titulo'           => $libro['titulo'],
              'autor'            => $libro['autor'],
              'descripcion'      => $libro['descripcion'],
              'anio_publicacion' => $libro['anio_publicacion'],
              'genero'           => $libro['genero'],
              'disponible'       => $libro['disponible']
          ]);
        }

        // Admin user
        User::create ([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('admin123')
        ]);

    }
}
