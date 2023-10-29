<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Clone this repo

Para realizar la debida instalacion del repositorio. <br>
1.-primeramente clonamos el repo en nuestro equipo<br>
    1.1.1-si se desea clonar por medio de comando  desde git usamos el comando "Git clone "Url -repo" ".<br>
    1.2.1- si deseamos clonarlo por medio de una aplicacion usamos la interfaz grafica.<br>
    
2.- posterior mente entramos a la terminal y la direccion en donde clonamos el repositorio.<br>
    2.1- con ello usamos el comando "composer install"<br>
    2.2- si no se instalaron las dependencias utilizamos el comando "composer update" para que se installe el archivo autoload.<br>
    
3.-posteriormente levantar el servidor usando "php artisan server".<br>
    3.1Si aparece el error 500, en el proyecto copiar en otra carpeta el archivo .env.example, y en el proyecto cambiar el nombre de este archivo a ".env"<br>
    
4.-para teminar ejecutar el comando "php artisan key:generate" <br>

5.- Para la autentificacion de usuarios y roles se utilizaron las librerias:
- Laravel Jetstream
- spatie/laravel-permission (composer require spatie/laravel-permission)

6.- Una vez que inicies la app, el usuario administrador de prueba será:
Correo: admin@gmail.com Contraseña: 12345678


---------------USO DE LA SECCION DE BASE DE DATOS----------------------- //TODO SE DEBE INSTALAR EN BEAUTYSYS Y MASTER
1.-activar la creacion de carpetas y ejecuta primero el sp[creador_carpetas] esto para que los demas se pueden ejecutar--

EXEC sp_configure 'show advanced options', 1;
RECONFIGURE;
--en esta funcion se habilita el cmd de los comandos ES IMPORTANTE SI SE QUIERE CREAR LAS CARPETAS
EXEC sp_configure 'xp_cmdshell', 1;
RECONFIGURE;
EXEC sp_configure 'xp_cmdshell';

create procedure creador_carpetas
as 
begin
	Declare @cmd Nvarchar(100);
	declare @FilePath NVARCHAR(15) = 'C:\beautysys';
	declare @first_folder NVARCHAR(50);
	declare @resultado int = 0;


	set @cmd = 'if exist "'+ @FilePath +'" ( PRINT ''La carpeta existe'' ) else (mkdir "'+@FilePath+'")';

	exec xp_cmdshell @cmd;
end;

2.-ejecuta [backup_principal] y [backup_completo] esto para obtener el primer respaldo de la base de datos.
create procedure backup_principal
as
begin
	exec creador_carpetas;

	backup database [beautysys] to disk='C:\beautysys\beautysys_principal.bak'
	with noformat,
	init, name = 'Beautysys Respaldo completo'

end;
go

create procedure backup_completo 
as
begin
	exec creador_carpetas;

	backup database [beautysys] to disk='C:\beautysys\beautysys.bak'
	with noformat,
	init, name = 'Beautysys Respaldo completo'

end;
go

2.- copilar este sp en beautysys y master(por si acaso)//su funcion principal es obtener todos los restorage picipales y que se muestre
create procedure [dbo].[select_diff] 
as
begin
SELECT
    database_name AS NombreDeBaseDeDatos,
    backup_start_date AS FechaDeCreacion,
	position as files
FROM
(
    SELECT
        ROW_NUMBER() OVER (PARTITION BY database_name ORDER BY backup_start_date DESC) AS rn,
        database_name,
        backup_start_date,
        type,
		position
    FROM msdb.dbo.backupset
    WHERE type = 'I' -- Solo copias de seguridad diferenciales
) AS backups
WHERE backup_start_date >=
	(SELECT max(backup_start_date)
     FROM msdb.dbo.backupset
     WHERE position = 1);
end

para que funcionen las 3 funcionalidades de la base de datos se ocupa ingresar los siguentes sp
[backup_diff] //CREA LOS BACKUPS DIFERENCIALES
create procedure backup_diff
as
begin
	exec creador_carpetas;

	backup database [beautysys] to disk='C:\beautysys\beautysys.bak'
	with NOINIT,differential, NoFORMAT;

end;
go

[Restorage_principal] //ESTO FUNCIONA PARA LA RESTAURACION PRINCIPAL
create procedure [dbo].[Restorage_principal] 
as
begin
	ALTER DATABASE [beautysys] SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
	RESTORE DATABASE [beautysys] FROM  DISK = N'C:\beautysys\beautysys_principal.bak' WITH replace, FILE = 1,  NOUNLOAD
	ALTER DATABASE [beautysys] SET MULTI_USER;
end

[Restorage_diferencial] //para que esto funcione tiene que estar en uso correcto [select_diff] 
ALTER procedure [dbo].[Restorage_diferencial]
	@file int
as
begin

	ALTER DATABASE [beautysys] SET SINGLE_USER WITH ROLLBACK IMMEDIATE;
	restore database [beautysys] from disk='C:\beautysys\beautysys.bak'  with replace, file=1,norecovery,nounload
	restore database [beautysys] from disk='C:\beautysys\beautysys.bak'  with file=@file,nounload
	ALTER DATABASE [beautysys] SET MULTI_USER;
end

## Estructura del archivo .env

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:4LO9VHLJKGzQt7pdkqRN3nuwIMSbG7p00Ntb9ZEKfAE=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlsrv
DB_HOST=127.0.0.1
DB_PORT=1433
DB_DATABASE=Beautysys
DB_USERNAME=sa
DB_PASSWORD=(tu password)

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_DOMAIN='.beautysys.test'

SANCTUM_STATEFUL_DOMAINS="127.0.0.1,beautysys.test"

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
