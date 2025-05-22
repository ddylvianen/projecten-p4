<?php

class overzichttickets extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ticketModel');
    }

    public function index($data = [], $params = [])
    {
        // Check if a scanned ticket is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scanned_ticket'])) {
            $scannedTicket = trim($_POST['scanned_ticket']);
            if (!empty($scannedTicket)) {
                // Save the scanned ticket using the model
                $status = $this->model->scanTicket($scannedTicket);
            }
        }

        // Get all tickets from the model
        $tickets = $this->model->getTickets();
        $this->view('overzichttickets/index', ['tickets' => $tickets, 'message' => $status ?? null]);
    }
}