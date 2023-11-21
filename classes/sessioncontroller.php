<?php
class SessionController extends Controller
{
    private $sessionName = 'usuario';
    protected $user = null;

    public function __construct()
    {
        parent::__construct();

        session_start(); // Iniciar la sesión
        $this->requireModel(['user']);
        $this->init();
    }

    public function init()
    {
        if ($this->existSession()) {
            $userId = $this->getSession();
            $this->user = new UserModel();
            $this->user->getById($userId);
        }
    }

    public function existSession()
    {
        return isset($_SESSION[$this->sessionName]) ? true : false;
    }

    public function setSession($userId)
    {
        $_SESSION[$this->sessionName] = $userId; // Establecer un valor en la sesión
    }

    public function getSession()
    {
        return $_SESSION[$this->sessionName]; // Obtener un valor de la sesión
    }

    public function destroySession()
    {
        session_unset(); // Borrar todas las variables de la sesión
        session_destroy(); // Destruir la sesión
    }
}
