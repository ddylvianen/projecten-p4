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
}