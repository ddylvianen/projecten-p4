<?php
require_once __DIR__ . '/../libraries/BaseController.php';

class Medewerker extends BaseController
{
    public function index($data = [], $params = [])
    {
        $model = $this->model('MedewerkerModel');
        $data['medewerkers'] = $model->getAllMedewerkers();

        $this->view('medewerker/index', $data);
    }

    public function add()
    {
        $this->view('medewerker/add');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'soort' => $_POST['soort'] ?? '',
                'gebruikerId' => $_POST['gebruikerId'] ?? 0
            ];

            $model = $this->model('MedewerkerModel');
            $model->addMedewerker($data);

            header('Location: /medewerker/index');
            exit;
        } else {
            header('Location: /medewerker/add');
            exit;
        }
    }

    public function edit($params = [])
    {
        $model = $this->model('MedewerkerModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nummer' => $_POST['nummer'] ?? 0,
                'soort' => $_POST['soort'] ?? '',
                'gebruikerId' => $_POST['gebruikerId'] ?? 0
            ];
            $model->updateMedewerker($data);

            header('Location: /medewerker/index');
            exit;
        } else {
            if (!empty($params[0])) {
                $nummer = intval($params[0]);
                $data['medewerker'] = $model->getMedewerkerByNummer($nummer);
                if ($data['medewerker']) {
                    $this->view('medewerker/edit', $data);
                } else {
                    header('Location: /medewerker/index');
                    exit;
                }
            } else {
                header('Location: /medewerker/index');
                exit;
            }
        }
    }

    public function delete($params = [])
    {
        if (!empty($params[0])) {
            $nummer = intval($params[0]);
            $model = $this->model('MedewerkerModel');
            $model->deactivateMedewerker($nummer);
        }

        header('Location: /medewerker/index');
        exit;
    }
}
