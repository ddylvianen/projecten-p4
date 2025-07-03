<?php
// Controller voor medewerker functionaliteit
require_once __DIR__ . '/../libraries/BaseController.php';

class Medewerker extends BaseController
{
    // Toon medewerker overzicht
    public function index($data = [], $params = [])
    {
        // Let op hier de volledige modelnaam met Model erbij
        $medewerkerModel = $this->model('MedewerkerModel');

        $data['medewerkers'] = $medewerkerModel->getAllMedewerkers();

        $this->view('medewerker/overzicht', $data);
    }
}

