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
                $this->model->scanTicket($scannedTicket);

            }
        }

        // Get all tickets from the model
        $tickets = $this->model->getTickets();

        // Send tickets to the view
        $this->view('overzichttickets/index', ['tickets' => $tickets]);
    }

    public function add($data = [], $params = []) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requiredFields = ['voorstelling', 'datum', 'barcode', 'status'];
            $missing = [];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missing[] = $field;
                }
            }
            if (!empty($missing)) {
                $voorstelling = $this->model->getVoorstellingen();
                $error = 'Vul alle verplichte velden in.';
                $formData = [
                    'voorstelling' => $_POST['voorstelling'] ?? '',
                    'datum' => $_POST['datum'] ?? '',
                    'barcode' => $_POST['barcode'] ?? '',
                    'status' => $_POST['status'] ?? ''
                ];
                $this->view('overzichttickets/add', [
                    'voorstelling' => $voorstelling,
                    'error' => $error,
                    'ticket' => (object)$formData
                ]);
                return;
            }
            $ticketData = [
                'voorstelling' => $_POST['voorstelling'],
                'datum' => $_POST['datum'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status']
            ];
            $this->model->addTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket toegevoegd!']);
        } else {
            $bezoekers = $this->model->getBezoekers();
            $voorstelling = $this->model->getVoorstellingen();
            $this->view('overzichttickets/add', ['voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
        }
    }

    public function update($data = [], $params = []) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requiredFields = ['voorstelling', 'datum', 'barcode', 'status'];
            $missing = [];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missing[] = $field;
                }
            }
            if (!empty($missing)) {
                $voorstelling = $this->model->getVoorstellingen();
                $error = 'Vul alle verplichte velden in.';
                $formData = [
                    'voorstelling' => $_POST['voorstelling'] ?? '',
                    'datum' => $_POST['datum'] ?? '',
                    'barcode' => $_POST['barcode'] ?? '',
                    'status' => $_POST['status'] ?? ''
                ];
                $this->view('overzichttickets/edit', [
                    'voorstelling' => $voorstelling,
                    'error' => $error,
                    'ticket' => (object)$formData
                ]);
                return;
            }
            $ticketData = [
                'voorstelling' => $_POST['voorstelling'],
                'datum' => $_POST['datum'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status']
            ];
            $this->model->updateTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket bijgewerkt!']);
        } else {
            // Optionally, fetch ticket data for editing
            $barcode = $_GET['barcode'] ?? null;
            $querydata = ['barcode' => $barcode];
            $voorstelling = $this->model->getVoorstellingen();
            $bezoekers = $this->model->getBezoekers();
            $ticket = $barcode ? $this->model->getTicket(['barcode' => $barcode]) : null;
            $this->view('overzichttickets/edit', ['ticket' => $ticket, 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
        }
    }

    public function delete($data = [], $params = []) {
        $ticketId = $_GET['id'] ?? null;
        if ($ticketId) {
            $this->model->deleteTicket($ticketId);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket verwijderd!']);
        } else {
            $this->redirect('overzichttickets/index', ['message' => 'Geen ticket ID opgegeven.']);
        }
    }
}