<?php
final class SignupController extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('signup');
    }

    public function newUser()
    {

        $username = trim($this->getPost('user'));
        $email = trim($this->getPost('email'));
        $password = trim($this->getPost('pass'));

        if (empty($username) && empty($email) && empty($password)) {
            $this->redirect('signup');
            return;
        }
        $user = new UserModel();

        if ($user->exist($username)) {
            $this->redirect('signup');
            return;
        }

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        if ($user->save()) {
            $this->redirect('login');
        } else {
            $this->redirect('signup');
        }
    }
}
