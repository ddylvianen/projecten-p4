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

    public function addTicket($ticket)
    {
        $sql = "INSERT INTO Ticket (VoorstellingId, Datum, Barcode, Status, Datumgewijzigd) VALUES (:voorstellingId, :datum, :barcode, :status, NOW())";
        $this->db->query($sql);
        $this->db->bind(':voorstellingId', $ticket['voorstelling']);
        $this->db->bind(':datum', $ticket['datum']);
        $this->db->bind(':barcode', $ticket['barcode']);
        $this->db->bind(':status', $ticket['status']);
        return $this->db->execute();
    }

    public function updateTicket($ticket)
    {
        $sql = "UPDATE Ticket SET VoorstellingId = :voorstellingId, Datum = :datum, Status = :status, Datumgewijzigd = NOW() WHERE Barcode = :barcode";
        $this->db->query($sql);
        $this->db->bind(':voorstellingId', $ticket['voorstelling']);
        $this->db->bind(':datum', $ticket['datum']);
        $this->db->bind(':status', $ticket['status']);
        $this->db->bind(':barcode', $ticket['barcode']);
        $this->db->bind(':medewerkerId', $this->getMedewerkerIdByVoorstellingId($ticket['voorstelling']));
        return $this->db->execute();
    }

    public function getTicket($ticket)
    {
        $sql = "SELECT * FROM Ticket WHERE Barcode = :barcode";
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
        return $result ? $result['MedewerkerId'] : null;
    }

}