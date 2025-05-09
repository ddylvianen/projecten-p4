<?php

class Signup extends BaseController
{
    private $userModel;

    // Constructor to initialize the user model
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    
    // Handles the signup page request
    public function index($data = [], $params = [])
    {
        ($_SERVER['REQUEST_METHOD'] == 'POST') ? 
        $this->signup() // If the request is POST, handle signup
        : $this->view('signup/index'); // Otherwise, load the signup view
    }

    // Handles the signup process
    private function signup()
    {
        // Collect data from the POST request
        $data = [
            'voornaam' => $_POST['voornaam'],
            'tussenvoegsel' => $_POST['tussenvoegsel'] ?? null,
            'achternaam' => $_POST['achternaam'],
            'email' => $_POST['email'],
            'geboortedatum' => $_POST['geboortedatum'],
            'gebruikersnaam' => $_POST['gebruikersnaam'],
            'wachtwoord' => $_POST['wachtwoord'],
            'wachtwoord2' => $_POST['wachtwoord2']
        ];

        // Call the signup method in the user model
        ($this->userModel->signup($data)) ? 
        $this->view('login/index') // Redirect to success page if signup is successful
        : $this->view('signup/index', ['error' => 'Signup failed']); // Reload signup page with error
    }
}