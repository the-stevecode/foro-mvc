<?php
final class LogoutController extends SessionController
{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->destroySession();
        $this->redirect('thread');
    }
}
