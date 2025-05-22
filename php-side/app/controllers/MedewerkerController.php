<?php
require_once __DIR__ . '/../libraries/Database.php';
require_once __DIR__ . '/../models/Medewerker.php';

class MedewerkerController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $medewerkerModel = new Medewerker($db);
        $medewerkers = $medewerkerModel->getAll();

        // Zet de variabele beschikbaar vóór het includen
        include __DIR__ . '/../views/medewerker_overzicht.php';
    }
}