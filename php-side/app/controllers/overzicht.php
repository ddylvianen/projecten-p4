<?php

class overzicht extends BaseController{

    private $model;
    private $week;
    private $data;

    public function __construct()
    {
        $this->model = $this->model('lesoverzichtModel');
        $this->week = date('W');
    }
    public function index($data = [], $params = [])
    {
        ($this->loggedinAS('medewerker') || $this->loggedinAS('admin')) 
        ? null : $this->redirect('homepages/index');

        $weekNumber = (isset($_GET['week'])) ? $_GET['week'] : date('W');


        $this->data = array_merge($this->data ?? [], $data);
        $this->data = array_merge([
            'lessen' => $this->model->getLessen(['week' => $weekNumber]),
            'week' => $this->getweek($weekNumber),
            'weekNumber' => $weekNumber,
        ], $this->data);
        
        $this->view('overzicht/index', $this->data);
    }

}