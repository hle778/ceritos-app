## Juego del Tres en raya

##### CÓMO JUGAR A LAS TRES EN RAYA

Cada jugador elige las X o las O, y en su turno debe poner una, intentando conseguir 3 seguidas en una línea vertical, horizontal o diagonal. Una vez se llenan todos los espacios se termina la partida, finalizando en tablas si ninguno consigue enlazar tres de sus fichas seguidas.

### Requerimientos

Construido con Laravel Framework 8.54.0

- Version del servidor: Apache >= 2.4.38
- PHP >= 7.3.3
- Mysql Ver 15.1 Distrib 10.1.38-MariaDB

### Instalación

- Clone el repositorio<br>
`https://github.com/hle778/ceritos-app.git` 
- Cambiar a la carpeta del repositorio<br>
`cd ceritos-app`
- Instalar todas las dependencias<br>
`composer install`
- Instalar dependencias de **NPM**<br>
`npm install`<br>
`npm run dev`
- Copie el archivo env de ejemplo **.env.example** y realice los cambios de configuración necesarios en el archivo **.env**<br>
`cp .env.example .env`
- Genere una nueva clave de aplicación<br>
`php artisan key: generate`
- Cree una base de datos vacía para la aplicación con el nombre `ceritos-app`, usando el cliente **Mysql** instalado.
- Configure las credenciales de su base de datos en su archivo **.env**
- Ejecute las migraciones de la base de datos (establezca la conexión de la base de datos en **.env** antes de migrar)<br>
`php artisan migrate`
- Inicie el servidor de desarrollo local<br>
`php artisan serve`
- Ahora puede acceder al servidor en:<br>
`http://localhost:8000` 

### Autor

Hector Alejandro Lam Echavarria<br>
<hecticodj@gmail.com>
