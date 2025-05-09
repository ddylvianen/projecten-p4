<?php

class UpdateLes extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('lessenModel');
    }

    public function index($data = [], $params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->updateLes();
        } else {
            try {
                $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                $data = $this->model->getLesById($id);
                $this->view('overzichtadd/index', ['les' => $data]);
            } catch (Exception $e) {
                // Handle exception (e.g., log it, show an error message, etc.)
                $this->view('overzicht/index', ['message' => 'Deze les bestaat niet.']);
            }
        }
    }

    private function updateLes()
    {

        $datum = filter_input(INPUT_POST, 'datum', FILTER_SANITIZE_SPECIAL_CHARS);
        $tijd = filter_input(INPUT_POST, 'tijd', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$datum || !$tijd) {
            $this->redirect('overzicht/index', ['message' => 'Ongeldige datum of tijd.']);
            exit;
        }

        $datetime = strtotime("$datum $tijd");

        if ($datetime === false || $datetime < time()) {
            $this->redirect('overzicht/index', ['message' => 'De opgegeven datum en tijd zijn ongeldig of liggen in het verleden.']);
            exit;
        }
        
        $data = [
            'id' => $_POST['id'],
            'naam' => $_POST['naam'],
            'datum' => $_POST['datum'],
            'tijd' => $_POST['tijd'],
            'minAantalPersonen' => $_POST['minAantalPersonen'],
            'maxAantalPersonen' => $_POST['maxAantalPersonen'],
            'beschikbaarheid' => $_POST['beschikbaarheid'],
        ];

        $this->model->updateLes($data);
        $this->redirect('overzicht/index', ['message' => 'Les is succesvol bijgewerkt!']);
    }
}
