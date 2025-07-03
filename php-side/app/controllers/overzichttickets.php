<?php

// Controller voor het beheren van tickets (overzicht, toevoegen, bewerken, verwijderen)
class overzichttickets extends BaseController
{
    // Model voor ticketdata
    private $model;

    // Constructor: laad het ticketmodel
    public function __construct()
    {
        $this->model = $this->model('ticketModel');
    }

    // Toon het overzicht van tickets en verwerk eventueel een gescande ticket
    public function index($data = [], $params = [])
    {
        // Verwerk gescande ticket indien aanwezig
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['scanned_ticket'])) {
            $scannedTicket = trim($_POST['scanned_ticket']);
            if (!empty($scannedTicket)) {
                // Sla de gescande ticket op via het model
                $status = $this->model->scanTicket($scannedTicket);
            }
        }

        // Haal alle tickets op
        $tickets = $this->model->getTickets();
        $this->view('overzichttickets/index', ['tickets' => $tickets, 'message' => $status ?? null]);
    }

    // Voeg een nieuw ticket toe
    public function add($data = [], $params = []) {
        $bezoekers = $this->model->getBezoekers();
        $voorstelling = $this->model->getVoorstellingen();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF-bescherming
            if (session_status() === PHP_SESSION_NONE) session_start();
            if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                $this->view('overzichttickets/add', ['message' => 'Ongeldige sessie. Probeer het opnieuw.', 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
                return;
            }
            // Controleer verplichte velden
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
            // Voeg prijs toe en haal prijsId op
            $prijsId = $this->model->addPrijs($_POST['prijs']);
            $ticketData = [
                'voorstelling' => $_POST['voorstelling'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status'],
                'bezoeker' => $_POST['bezoeker'],
                'prijsId' => $prijsId
            ];
            // Voeg ticket toe via model
            $this->model->addTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket toegevoegd!']);
        } else {
            // Toon formulier
            $this->view('overzichttickets/add', ['voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
        }
    }

    // Bewerk een bestaand ticket
    public function update($data = [], $params = []) {
        $bezoekers = $this->model->getBezoekers();
        $voorstelling = $this->model->getVoorstellingen();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF-bescherming
            if (session_status() === PHP_SESSION_NONE) session_start();
            if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
                $this->view('overzichttickets/edit', ['message' => 'Ongeldige sessie. Probeer het opnieuw.', 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
                return;
            }
            // Controleer verplichte velden
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
            // Zet ticketdata klaar
            $ticketData = [
                'id' => $_POST['id'],
                'voorstelling' => $_POST['voorstelling'],
                'barcode' => $_POST['barcode'],
                'status' => $_POST['status'],
                'bezoeker' => $_POST['bezoeker'],
                'prijs' => $_POST['prijs'],
                'prijsId' => $_POST['prijsId']
            ];
            // Update ticket via model
            $this->model->updateTicket($ticketData);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket bijgewerkt!']);
        } else {
            // Haal ticketdata op voor bewerken
            $barcode = $_GET['barcode'] ?? null;
            $querydata = ['barcode' => $barcode];
            $ticket = $barcode ? $this->model->getTicket(['barcode' => $barcode]) : null;
            
            $this->view('overzichttickets/edit', ['ticket' => $ticket, 'voorstelling' => $voorstelling, 'bezoekers' => $bezoekers]);
        }
    }

    // Verwijder een ticket
    public function delete($data = [], $params = []) {
        $ticketId = $_GET['id'] ?? null;
        if ($ticketId) {
            // Verwijder ticket via model
            $this->model->deleteTicket($ticketId);
            $this->redirect('overzichttickets/index', ['message' => 'Ticket verwijderd!']);
        } else {
            // Geen ID opgegeven
            $this->redirect('overzichttickets/index', ['message' => 'Geen ticket ID opgegeven.']);
        }
    }
}