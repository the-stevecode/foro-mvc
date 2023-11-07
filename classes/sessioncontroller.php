<?php
require_once 'session.php';
class SessionController extends Controller
{
    protected $session;
    protected $user = null;

    public function __construct()
    {
        parent::__construct();

        $this->requireModel(['user']);
        $this->session = new Session();

        $this->init();
    }

    public function init()
    {
        if ($this->session->existSession()) {
            $userId = $this->session->get();
            $this->user = new UserModel();
            $this->user->getById($userId);
        }
    }
}
