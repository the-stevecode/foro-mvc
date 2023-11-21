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
        return isset($_SESSION[$this->sessionName]) ? true : false;
    }
    public function set($userId)
    {
        $_SESSION[$this->sessionName] = $userId; // Establecer un valor en la sesión
    }

    public function get()
    {
        // Obtener un valor de la sesión
        return $this->existSession() ? $_SESSION[$this->sessionName] : null;
    }

    public function destroy()
    {
        session_unset(); // Borrar todas las variables de la sesión
        session_destroy(); // Destruir la sesión
    }
}
