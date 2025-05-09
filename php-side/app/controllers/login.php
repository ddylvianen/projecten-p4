<?php

class login extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    
    public function index($data = [], $params = [])
    {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            (session_status() == PHP_SESSION_NONE)?
            session_start() : session_reset();
            $this->login();
        }
        else{
            $this->view('login/index', $data);
        }
    }

    private function login(){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $user = $this->userModel->login($username, $password);

        if($user){
            $this->createUserSession($user);
        }
        else{
            $this->view('login/index', ['message' => 'Gebruikersnaam of wachtwoord is onjuist']);
        }
    }

    private function createUserSession($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $this->redirect('homepages/index', ['message' => 'Welkom ' . $_SESSION['username']]);
    }


}