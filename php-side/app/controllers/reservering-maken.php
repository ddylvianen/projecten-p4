<?php

class Reservering_maken extends BaseController
{
    private $database;
    private $data;

    public function __construct()
    {
        $this->database = new Database();

        $this->data = [
            'voornaam' => $_POST['voornaam'],
            'tussenvoegsel' => $_POST['tussenvoegsel'],
            'achternaam' => $_POST['achternaam'],
            'email' => $_POST['email'],
            'telefoonnummer' => $_POST['telefoonnummer'],
            'datum' => $_POST['datum'],
            'tijd' => $_POST['tijd'],
            'aantal_personen' => $_POST['aantal_personen']
        ];

    }

    public function index($data = [], $params = [])
    {
        // if (!($this->loggedinAS('lid'))) {
        //     $this->redirect('/');
        // }
        
        $this->database->query('INSERT INTO reserveringen (voornaam, tussenvoegsel, achternaam, email, telefoonnummer, datum, tijd, aantal_personen) VALUES (:voornaam, :tussenvoegsel, :achternaam, :email, :telefoonnummer, :datum, :tijd, :aantal_personen)');
        $this->database->execute($this->data);
        http_response_code(200);
    }
}