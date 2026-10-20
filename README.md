# DESCARGA REPOSITORIO




![1792506803008](image/README/1792506803008.png)

---



# 2 CREACIÓN Proyecto Laravel 13: Listado de alumnos de 2.º DAW

Vamos a desarrollar una aplicación sencilla con Laravel 13, PHP y MySQL que muestre un listado de 11 alumnos de Desarrollo de Aplicaciones Web del IES Francisco de los Ríos.

El objetivo es que el alumnado comprenda el funcionamiento básico de Laravel siguiendo el patrón MVC (Modelo–Vista–Controlador), utilizando migraciones, seeders, rutas y plantillas Blade.

## 1. Resultado final del proyecto

La aplicación mostrará una página con el nombre del centro, el ciclo formativo y una tabla con los alumnos almacenados en MySQL.

## IES FRANCISCO DE LOS RÍOS

2.º Desarrollo de Aplicaciones Web

Curso 2026/2027

Listado de alumnos

11 alumnos

| ID | Nombre    | Apellidos       |
| -- | --------- | --------------- |
| 1  | Alejandro | García López  |
| 2  | Lucía    | Fernández Ruiz |
| 3  | Daniel    | Martín Pérez  |
| 4  | María    | Sánchez Torres |
| 5  | Pablo     | Romero Díaz    |
| 6  | Carmen    | Moreno Castro   |
| 7  | Javier    | Navarro Molina  |
| 8  | Elena     | Jiménez Ortiz  |
| 9  | Adrián   | Ramos Vega      |
| 10 | Paula     | Herrera León   |
| 11 | Sergio    | Muñoz Gil      |

Ejemplo con nombres ficticios, generados mediante un seeder.

## 2. Estructura del proyecto

Utilizaremos estos componentes:

| Componente        | Función                      |
| ----------------- | ----------------------------- |
| MySQL             | Almacenar los alumnos         |
| Migración        | Crear la tabla `alumnos`    |
| Modelo `Alumno` | Representar los registros     |
| Seeder            | Insertar 11 alumnos ficticios |
| Controlador       | Consultar los alumnos         |
| Ruta              | Acceder al listado            |
| Vista Blade       | Mostrar la tabla HTML         |

El flujo será:

Navegador

GET /alumnos

Ruta → AlumnoController

Modelo Alumno → MySQL

SELECT \* FROM alumnos

Vista alumnos/index.blade.php

Tabla HTML con los 11 alumnos

## 3. Crear el proyecto Laravel

Necesitamos PHP compatible con Laravel 13, Composer, MySQL y las extensiones PHP necesarias, especialmente `pdo_mysql`.

Desde una terminal:

```
composer create-project laravel/laravel listado-daw "^13.0"
cd listado-daw
```

Generamos la clave de aplicación, si todavía no existe:

```
php artisan key:generate
```

## 4. Configurar MySQL

Primero creamos una base de datos desde phpMyAdmin o el cliente MySQL:

```
CREATE DATABASE daw_laravel
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Editamos el archivo `.env` del proyecto:

```
APP_NAME="IES Francisco de los Ríos"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=daw_laravel
DB_USERNAME=root
DB_PASSWORD=
```

El usuario y la contraseña deben adaptarse a la instalación local de MySQL.

## 5. Crear el modelo y la migración

Ejecutamos:

```
php artisan make:model Alumno -m
```

Se generan dos archivos principales:

- `app/Models/Alumno.php`
- `database/migrations/xxxx_xx_xx_xxxxxx_create_alumnos_table.php`

### Migración

Editamos la migración generada:

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 150);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
```

La migración crea una tabla con `id`, `nombre`, `apellidos`, `created_at` y `updated_at`.

### Modelo Alumno

Archivo `app/Models/Alumno.php`:

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'nombre',
        'apellidos',
    ];
}
```

Este modelo permitirá consultar la tabla `alumnos` mediante Eloquent ORM.

## 6. Crear el seeder con los 11 alumnos

Ejecutamos:

```
php artisan make:seeder AlumnoSeeder
```

Editamos `database/seeders/AlumnoSeeder.php`:

```
<?php

namespace Database\Seeders;

use App\Models\Alumno;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $alumnos = [
            ['nombre' => 'Alejandro', 'apellidos' => 'García López'],
            ['nombre' => 'Lucía', 'apellidos' => 'Fernández Ruiz'],
            ['nombre' => 'Daniel', 'apellidos' => 'Martín Pérez'],
            ['nombre' => 'María', 'apellidos' => 'Sánchez Torres'],
            ['nombre' => 'Pablo', 'apellidos' => 'Romero Díaz'],
            ['nombre' => 'Carmen', 'apellidos' => 'Moreno Castro'],
            ['nombre' => 'Javier', 'apellidos' => 'Navarro Molina'],
            ['nombre' => 'Elena', 'apellidos' => 'Jiménez Ortiz'],
            ['nombre' => 'Adrián', 'apellidos' => 'Ramos Vega'],
            ['nombre' => 'Paula', 'apellidos' => 'Herrera León'],
            ['nombre' => 'Sergio', 'apellidos' => 'Muñoz Gil'],
        ];

        foreach ($alumnos as $alumno) {
            Alumno::create($alumno);
        }
    }
}
```

El método `create()` inserta cada alumno en MySQL utilizando el modelo Eloquent.

### Registrar el seeder

Editamos `database/seeders/DatabaseSeeder.php`:

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AlumnoSeeder::class);
    }
}
```

### Ejecutar migraciones y seeders

```
php artisan migrate
php artisan db:seed
```

![1792506572220](image/README/1792506572220.png)

Para comprobar los registros desde MySQL:

```
SELECT * FROM alumnos;
```

Deberían aparecer los 11 alumnos.


![1792506441684](image/README/1792506441684.png)

![1792506592013](image/README/1792506592013.png)


## 7. Crear el controlador

Ejecutamos:

```
php artisan make:controller AlumnoController
```

Editamos `app/Http/Controllers/AlumnoController.php`:

```
<?php

namespace App\Http\Controllers;

use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::orderBy('apellidos')->get();

        return view('alumnos.index', [
            'alumnos' => $alumnos
        ]);
    }
}
```

Explicación: `Alumno::orderBy('apellidos')->get()` consulta todos los alumnos de MySQL y los ordena alfabéticamente por apellidos. Después, `view()` envía los datos a la plantilla Blade.

## 8. Crear la ruta

Editamos `routes/web.php`:

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

Route::get('/', [AlumnoController::class, 'index']);

Route::get('/alumnos', [AlumnoController::class, 'index']);
```

De esta manera, el listado será accesible tanto desde `/` como desde `/alumnos`.

## 9. Crear la vista Blade

Creamos la carpeta `resources/views/alumnos` y dentro el archivo `index.blade.php`.

La vista utiliza HTML, CSS y las directivas `@foreach` y `{{ }}` de Blade. No necesita JavaScript ni compilar recursos con Vite.

```

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Alumnos de DAW</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
        }

        .contenedor {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #0001;
        }

        h1, h2 {
            text-align: center;
        }

        h1 {
            color: #17365d;
        }

        h2 {
            color: #475569;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th {
            background: #17365d;
            color: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="contenedor">

        <h1>IES FRANCISCO DE LOS RÍOS</h1>

        <h2>Listado de alumnos de 2.º DAW</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidos }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">
            Total de alumnos: {{ $alumnos->count() }}
        </p>

    </div>
</body>
</html>

```

## 10. Ejecutar el proyecto

Primero, si hemos modificado la configuración de la base de datos:

```
php artisan config:clear
```

Iniciamos el servidor:

```
php artisan serve
```

Abrimos en el navegador:

[http://127.0.0.1:8000/alumnos](http://127.0.0.1:8000/alumnos?utm_source=chatgpt.com)

&#x20;Copiar

Deberá aparecer el encabezado IES FRANCISCO DE LOS RÍOS, seguido de los 11 alumnos recuperados de MySQL.

Si necesitas reconstruir la base de datos desde cero durante las prácticas, puedes ejecutar:

```
php artisan migrate:fresh --seed
```

Atención: `migrate:fresh` elimina todas las tablas de la base de datos configurada. Debe utilizarse exclusivamente en una base de datos de pruebas.

## 11. Comprobación del aprendizaje

Para comprobar que el alumnado entiende el proyecto, propongo cuatro pequeñas modificaciones:

1. Añadir un campo `email` mediante una nueva migración y mostrarlo en la tabla.
2. Modificar el seeder para incluir un alumno adicional.
3. Ordenar el listado por nombre en lugar de apellidos.
4. Mostrar un mensaje cuando no existan alumnos, utilizando `@forelse` y `@empty` de Blade.

El ejercicio completo permite trabajar los fundamentos de rutas, controladores, modelos Eloquent, migraciones, seeders y vistas Blade, sin introducir todavía formularios, autenticación ni operaciones CRUD.
