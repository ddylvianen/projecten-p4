<?php

class ticketModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Haal alle tickets op (optioneel filter op status)
    public function getTickets($status = 'bezet')
    {
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
        $sql = "UPDATE Ticket SET Status = :status, Datumgewijzigd = NOW() WHERE Barcode = :barcode";
        $this->db->query($sql);
        $this->db->bind(':status', $nieuweStatus);
        $this->db->bind(':barcode', $barcode);
        return $this->db->execute();
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