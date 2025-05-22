<?php

class overzichtadd extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ticketsModel');
    }

    public function index($data = [], $params = [])
    {
        if (!$this->loggedinAS('medewerker')) {
            return $this->redirect('homepages/index');
        }

        // Get all tickets from the model
        $tickets = $this->model->getAllTickets();

        // Send tickets to the view
        $this->view('overzichttickets/index', ['tickets' => $tickets]);
    }
}