<?php
class App
{
    private $controllerName = 'ThreadController';
    private $controller = 'ThreadController';
    private $method = 'index';
    protected $params = [];

    function __construct()
    {
        $url = $this->parseUrl();

        //var_dump($url);
        /**
         * controlador [0]
         * metodo [1]
         * parametro [2]
         */

        //verificar si se proporciona un controlador en la url
        if (isset($url[0])) {
            $this->controllerName = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        $controllerFile = 'controllers/' . strtolower($this->controllerName) . '.php';
        //verificar si existe el archivo del controlador
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
        } else {
            echo '¡Ups! al parecer No existe el recurso que estás buscando';
            exit();
        }

        //instancia el controlador
        $this->controller = new $this->controllerName;

        //verificar si se proporciona un metodo en la url
        if (isset($url[1])) {
            $requestedMethod = $url[1];
        
            // Verificar si el método existe en el controlador
            if (method_exists($this->controller, $requestedMethod)) {
                $this->method = $requestedMethod;
            } else {
                // El método no existe, manejar la situación
                echo '¡Ups! al parecer No existe el recurso que estás buscando';
                exit();
            }
        
            unset($url[1]);
        }

        // Los valores restantes en la URL se consideran como parámetros
        $this->params = $url ? array_values($url) : [];

        // Llama al método del controlador con el modelo y los parámetros
        $this->controller->{$this->method}($this->params);
    }
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', rtrim($_GET['url'], '/'));
        }
    }
}
