<?php
class Controller
{
    protected $model;
    protected $view;
    function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
    }

    function loadModel($model)
    {
        $url = 'models/' . $model . 'model.php';

        if (file_exists($url)) {
            require_once $url;

            $modelName = ucfirst($model) . 'Model';
            $this->model = new $modelName();
        }
    }
    function requireModel($models){
        foreach ($models as $model) {
            $url = 'models/' . $model . 'model.php';
            if (file_exists($url)) {
                require_once $url;
            }
        }
    }

    function existPOST($params)
    {
        foreach ($params as $param) {
            if (!isset($_POST[$param])) {
                return false;
            }
        }
        return true;
    }

    function existGET($params)
    {
        foreach ($params as $param) {
            if (!isset($_GET[$param])) {
                return false;
            }
        }
        return true;
    }

    function getGet($name)
    {
        return $_GET[$name];
    }

    function getPost($name)
    {
        return $_POST[$name];
    }
    
    function redirect($url, $mensajes = [])
    {
        $data = [];
        $params = '';

        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);

        if ($params != '') {
            $params = '?' . $params;
        }
        header('location: ' . constant('URL')  . $url . $params);
    }
}
