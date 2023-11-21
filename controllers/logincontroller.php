<?php
final class LoginController extends SessionController
{
    function __construct()
    {
        parent::__construct();
        $this->requireModel(['auth']);
    }

    public function index()
    {
        $this->view->render('login');
    }

    public function auth()
    {

        $username = trim($this->getPost('user'));
        $password = trim($this->getPost('pass'));

        if (empty($username) && empty($password)) {
            $this->redirect('login');
            return;
        }

        $auth = new AuthModel();
        $is = $auth->login($username, $password);
        if ($is) {
            $this->setSession($is);
            $this->redirect('thread');
        }else{
            $this->redirect('login');
        }
    }
}
