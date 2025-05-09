<?php

class overzichtadd extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('lessenModel');
    }

    public function index($data = [], $params = [])
    {
        ($this->loggedinAS('medewerker')) ? null : $this->redirect('homepages/index');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $data = [
                    'naam' => $_POST['naam'],
                    'datum' => $_POST['datum'],
                    'tijd' => $_POST['tijd'],
                    'minAantalPersonen' => $_POST['minAantalPersonen'],
                    'maxAantalPersonen' => $_POST['maxAantalPersonen'],
                    'beschikbaarheid' => $_POST['beschikbaarheid'],
                    'DatumAangemaakt' => date('Y-m-d H:i:s'),
                    'DatumGewijzigd' => date('Y-m-d H:i:s')
                ];
                $this->model->addLes($data);
                $this->redirect('overzicht/index', ['message' => 'Les is toegevoegd!']);
            } catch (\Throwable $th) {
                $this->redirect('overzichtadd/index', ['message' => 'Er is iets fout gegaan!, probeer het nog eens']);
            }
        }
        else{
            $this->view('overzichtadd/index');
        }
    }

}