<?php
$serverName = $_SERVER['SERVER_NAME'];
$folder = 'foro/';
define('URL', 'http://'.$serverName .'/' . $folder);
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dbforo');
define('DB_CHARSET', 'utf8');

/*
1   La función getenv('DB_NAME') se utiliza para obtener el valor de una variable de entorno llamada DB_NAME. 
    Las variables de entorno son valores externos que se almacenan en el sistema operativo o en un servidor y
    que pueden ser accesibles desde tu aplicación PHP. En este caso, DB_NAME representaría el nombre de la base de
    datos que se encuentra en el servidor de la base de datos MySQL.

    Para configurar getenv('DB_NAME'), debes asegurarte de que la variable de entorno DB_NAME esté definida 
    y tenga el valor correcto en el entorno en el que se ejecuta tu aplicación. Esto se suele hacer
    a nivel del servidor o en un archivo de configuración externo, no en el código fuente de tu aplicación,
    para que los valores de configuración, como las contraseñas de la base de datos, no se almacenen en el código fuente.

    Aquí tienes un ejemplo de cómo podrías configurar la variable de entorno DB_NAME en un entorno de
    servidor Linux utilizando un archivo de configuración externo:

        Crea un archivo de configuración, por ejemplo, config.ini, que contenga la configuración de tu aplicación, incluyendo la configuración de la base de datos:
            ini
            Copy code
            [database]
            DB_HOST = localhost
            DB_USER = tu_usuario_db
            DB_PASS = tu_contraseña_db
            DB_NAME = nombre_de_la_base_de_datos

        Configura el entorno para que la aplicación pueda acceder a esta configuración. Puedes hacerlo exportando las variables de entorno desde la terminal
        o utilizando un archivo de configuración .env. Aquí te muestro un ejemplo de exportación de variables de entorno:
            bash
            Copy code
            export DB_HOST=localhost
            export DB_USER=tu_usuario_db
            export DB_PASS=tu_contraseña_db
            export DB_NAME=nombre_de_la_base_de_datos

        Cuando tu aplicación se ejecute, utilizará las variables de entorno definidas en el entorno en el que se está ejecutando para obtener la configuración
        de la base de datos mediante getenv('DB_NAME'), getenv('DB_USER'), etc.

        Este enfoque permite separar la configuración de la aplicación de su código fuente, lo que es una práctica más segura y flexible, especialmente para
        valores sensibles como contraseñas de base de datos. Además, si deseas cambiar la configuración en el futuro, solo necesitas modificar el archivo de
        configuración o las variables de entorno sin tener que modificar el código fuente de la aplicación.
*/
?>