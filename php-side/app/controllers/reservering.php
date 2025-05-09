<?php


class reservering extends BaseController
{

    private $model;
    private $week;
    private $data;

    public function __construct()
    {
        $this->model = $this->model('reserveringModel');
        $this->week = date('W');
    }
    public function index($data = [], $params = [])
    {
        // if (!($this->loggedinAS('lid'))) {
        //     $this->redirect('/');
        // }
        
        $weekNumber = (isset($_GET['week'])) ? $_GET['week'] : date('W');

        $this->data = [
            'lessen' => $this->model->getReserveringen(['week' => $weekNumber]),
            'week' => $this->getweek($weekNumber),
            'weekNumber' => $weekNumber,
            'error' => ($this->week > $weekNumber) ? 'Deze lessen zijn al geweest!' : ''
        ];
        $this->view('reservering/index', $this->data);
        $this->view('reservering/index', $this->data);
    }

}