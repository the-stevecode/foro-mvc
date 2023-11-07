<?php
final class Session
{
    private $sessionName = 'usuario';

    public function __construct()
    {
        session_start(); // Iniciar la sesión
    }
    public function existSession()
    {
        if (isset($_SESSION[$this->sessionName])) {
            return true; 
        }
        return false;
    }
    public function set($userId)
    {
        $_SESSION[$this->sessionName] = $userId; // Establecer un valor en la sesión
    }

    public function get()
    {
        if (isset($_SESSION[$this->sessionName])) {
            return $_SESSION[$this->sessionName]; // Obtener un valor de la sesión
        }
        return null;
    }

    public function destroy()
    {
        session_unset(); // Borrar todas las variables de la sesión
        session_destroy(); // Destruir la sesión
    }
}
