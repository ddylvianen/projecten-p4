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

    public function add($data = [], $params = []) {
        $bezoekers = $this->model->getBezoekers();
        $voorstelling = $this->model->getVoorstellingen();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requiredFields = ['voorstelling', 'barcode', 'status', 'bezoeker', 'prijs'];
            $missing = [];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missing[] = $field;
                }
            }
            if (!empty($missing)) {
                $error = 'Vul alle verplichte velden in.';
                $formData = [
                    'voorstelling' => $_POST['voorstelling'] ?? '',
                    'barcode' => $_POST['barcode'] ?? '',
                    'status' => $_POST['status'] ?? '',
                    'bezoeker' => $_POST['bezoeker'] ?? '',
                    'prijs' => $_POST['prijs'] ?? ''
                ];
                $this->view('overzichttickets/add', ['message' => $error, 'ticket' => (object)$formData, 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
                return;
            }
            // Eerst prijs toevoegen en prijsId ophalen
            $prijsId = $this->model->addPrijs($_POST['prijs']);
            $ticketData = [
                'voorstelling' => $_POST['voorstelling'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status'],
                'bezoeker' => $_POST['bezoeker'],
                'prijsId' => $prijsId
            ];
            $this->model->addTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket toegevoegd!']);
        } else {
            $this->view('overzichttickets/add', ['voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
        }
    }

    public function update($data = [], $params = []) {
        $bezoekers = $this->model->getBezoekers();
        $voorstelling = $this->model->getVoorstellingen();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requiredFields = ['voorstelling', 'barcode', 'status', 'bezoeker', 'prijs'];
            $missing = [];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $missing[] = $field;
                }
            }
            if (!empty($missing)) {
                $error = 'Vul alle verplichte velden in.';
                $formData = [
                    'voorstelling' => $_POST['voorstelling'] ?? '',
                    'barcode' => $_POST['barcode'] ?? '',
                    'status' => $_POST['status'] ?? '',
                    'bezoeker' => $_POST['bezoeker'] ?? '',
                    'prijs' => $_POST['prijs'] ?? ''
                ];
                $this->view('overzichttickets/edit', ['message' => $error, 'ticket' => (object)$formData, 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
                return;
            }
            $ticketData = [
                'id' => $_POST['id'],
                'voorstelling' => $_POST['voorstelling'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status'],
                'bezoeker' => $_POST['bezoeker'],
                'prijs' => $_POST['prijs'],
                'prijsId' => $_POST['prijsId']
            ];
            $this->model->updateTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket bijgewerkt!']);
        } else {
            // Optionally, fetch ticket data for editing
            $barcode = $_GET['barcode'] ?? null;
            $querydata = ['barcode' => $barcode];
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