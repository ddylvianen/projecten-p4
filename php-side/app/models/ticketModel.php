<?php

class ticketModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Haal alle tickets op (optioneel filter op status)
    // Haal alle tickets op, optioneel filteren op status (standaard: 'bezet')
    public function getTickets($status = 'bezet')
    {
        // SQL-query om tickets op te halen met bijbehorende voorstelling, bezoeker en prijsinformatie
        $sql = "SELECT t.*, v.Naam AS VoorstellingNaam, b.Relatienummer, p.Tarief
                FROM Ticket t
                JOIN Voorstelling v ON t.VoorstellingId = v.Id
                JOIN Bezoeker b ON t.BezoekerId = b.Id
                JOIN Prijs p ON t.PrijsId = p.Id";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    // Scan ticket (status veranderen)
    public function scanTicket($barcode, $nieuweStatus = 'bezet')
    {
        // Check current status
        try {
            $sql = "SELECT Status FROM Ticket WHERE Barcode = :barcode";
            $this->db->query($sql);
            $this->db->bind(':barcode', $barcode);
            $ticket = $this->db->single();
            if (!$ticket) {
            return "Ticket niet gevonden.";
            }

            if (strcmp($ticket->Status, 'bezet') === 0) {
            return "Ticket all aangemeld als aanwezig.";
            }

            // Update status
            $sql = "UPDATE Ticket SET Status = :status, Datumgewijzigd = NOW() WHERE Barcode = :barcode";
            $this->db->query($sql);
            $this->db->bind(':status', $nieuweStatus);
            $this->db->bind(':barcode', $barcode);
            $this->db->execute();

            return "ticket is aangemeld!";
        } catch (Exception $e) {
            return "Er is een fout opgetreden";
        }
    }

    // Verwijder ticket
    public function deleteTicket($ticketId)
    {
        $sql = "DELETE FROM Ticket WHERE Id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $ticketId, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function addPrijs($prijs)
    {
        $sql = "INSERT INTO Prijs (Tarief) VALUES (:tarief)";
        $this->db->query($sql);
        $this->db->bind(':tarief', $prijs);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function addTicket($ticket)
    {
        $q = 'SELECT Datum, Tijd FROM Ticket WHERE Id = :id';
        $this->db->query($q);
        $this->db->bind(':id', $ticket['voorstelling']);
        $this->db->execute();
        $result = $this->db->single();
        $date = $result->Datum;
        $time = $result->Tijd;


        $sql = "INSERT INTO Ticket (VoorstellingId, Datum, Barcode, Status, Datumgewijzigd, BezoekerId, PrijsId, Tijd) VALUES (:voorstellingId, :datum, :barcode, :status, NOW(), :bezoekerId, :prijsId, :tijd)";
        $this->db->query($sql); 
        $this->db->bind(':voorstellingId', $ticket['voorstelling']);
        $this->db->bind(':datum', $date);
        $this->db->bind(':barcode', $ticket['barcode']);    
        $this->db->bind(':status', $ticket['status']);
        $this->db->bind(':bezoekerId', $ticket['bezoeker']);    
        $this->db->bind(':prijsId', $ticket['prijsId']);
        $this->db->bind(':tijd', $time);
        return $this->db->execute();
    }

    public function updateTicket($ticket)
    {
        // 1. Haal de nieuwe datum en tijd op van de voorstelling
        $sqlVoorstelling = "SELECT Datum, Tijd FROM Voorstelling WHERE Id = :voorstellingId";
        $this->db->query($sqlVoorstelling);
        $this->db->bind(':voorstellingId', $ticket['voorstelling']);
        $voorstelling = $this->db->single();
        $date = $voorstelling->Datum;
        $time = $voorstelling->Tijd;

        $sql = "UPDATE Prijs SET Tarief = :prijs WHERE Id = :prijsId";
        $this->db->query($sql);
        $this->db->bind(':prijs', $ticket['prijs']);
        $this->db->bind(':prijsId', $ticket['prijsId']);
        $this->db->execute();

        // 3. Update het ticket met alle relevante velden
        $sql = "UPDATE Ticket SET VoorstellingId = :voorstellingId, Datum = :datum, Tijd = :tijd, Status = :status, Datumgewijzigd = NOW(), BezoekerId = :bezoekerId, Barcode = :barcode WHERE Id = :id";
        $this->db->query($sql);
        $this->db->bind(':voorstellingId', $ticket['voorstelling']);
        $this->db->bind(':datum', $date);
        $this->db->bind(':tijd', $time);
        $this->db->bind(':status', $ticket['status']);
        $this->db->bind(':barcode', $ticket['barcode']);
        $this->db->bind(':bezoekerId', $ticket['bezoeker']);

        $this->db->bind(':id', $ticket['id']);
        return $this->db->execute();
    }

    public function getTicket($ticket)
    {
        $sql = "SELECT t.*, v.Naam AS VoorstellingNaam, b.Relatienummer, p.Tarief
                FROM Ticket t
                JOIN Voorstelling v ON t.VoorstellingId = v.Id
                JOIN Bezoeker b ON t.BezoekerId = b.Id
                JOIN Prijs p ON t.PrijsId = p.Id
                WHERE Barcode = :barcode";
        $this->db->query($sql);
        $this->db->bind(':barcode', $ticket['barcode']);
        $this->db->execute();
        return $this->db->single();
    }

    public function getVoorstellingen()
    {
        $sql = "SELECT Id, Naam FROM Voorstelling WHERE IsActief = 1";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getBezoekers()
    {
        $sql = "SELECT Bezoeker.Id, CONCAT(Gebruiker.Voornaam, ' ', Gebruiker.Achternaam) AS Naam
                FROM Bezoeker
                JOIN Gebruiker ON Bezoeker.GebruikerId = Gebruiker.Id";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getMedewerkerIdByVoorstellingId($voorstellingId)
    {
        $sql = "SELECT MedewerkerId FROM Voorstelling WHERE Id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $voorstellingId);
        $this->db->execute();
        $result = $this->db->single();
        return $result ? $result->MedewerkerId : null;
    }

}