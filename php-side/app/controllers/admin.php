<?php


class Admin extends BaseController
{
    private $adminModel;
    public function __construct()
    {
        $this->adminModel = $this->model('AdminModel');
    }
    public function index($data = [], $params = [])
    {
        $this->checkadmin();
        $data['aantallessen'] = $this->adminModel->getData();
        $this->view('admin/index', $data);
    }

    private function checkadmin(){
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->redirect('home/index', ['message' => 'Je moet ingelogd zijn als admin om deze pagina te bekijken.']);
        }
    }

    public function getData()
    {
        $this->checkadmin();
        // Assuming you have a method in your model to fetch the data
        $data = $this->adminModel->getData();
        return $data;
    }
}