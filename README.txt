SERVICIO REST DE INFORMACIÓN DE PELÍCULAS

Requisitos

-PHP 7.4 o superior
-Composer para gestionar dependencias
-Servidor web compatible con PHP
-Docker

Intalación

1.Clona el repositorio o copia los archivos del proyecto en tu entorno local.

2.Intala las dependencias usando Composer:

composer install

3.Configura el archivo '.env':

-Crea un archivo '.env' en el directorio raíz del proyecto.
-Añade tu clave API de TMDB en el archivo '.env':

TMDB_API_KEY=tu_api_key_de_tmdb

Ejecución del servicio:

1.Construye la imagen Docker:

docker build -t tmdb-service

2.Ejecuta el contenedor:

docker run -p 8080:8080 tmdb-service

3.Accede al servicio a través de tu navegador:

http://localhost:8080/index.php?title=pelicula_a_buscar(ejemplo Titanic)


NOTAS

-Asegúrate de tener una API Key válida de TMDB y que esté correctamente configurada en el archivo '.env'.
-Si encuentras problemas al cargar el servicio, revisa los permisos de las carpetas y la configuración de tu servidor PHP.
