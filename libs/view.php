<?php
class View
{
    protected $d;
    
    public function render($viewName, $data = [])
    {
        // Comprobar si el archivo de vista existe
        $viewPath = "views/$viewName.php";
        if (file_exists($viewPath)) {
            // Cargar la vista y pasar los datos
            $this->d = $data;
            require $viewPath;
        } else {
            // Manejar el caso en que la vista no existe
            echo "La vista '$viewName' no se encuentra.";
        }
    }
}