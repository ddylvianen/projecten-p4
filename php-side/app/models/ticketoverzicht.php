<?php

class TicketOverzicht
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Haal alle tickets op (optioneel filter op status/bezoeker)
    public function getTickets($status = null)
    {
        $sql = "SELECT t.*, v.Naam AS VoorstellingNaam, b.Relatienummer, p.Tarief
                FROM Ticket t
                JOIN Voorstelling v ON t.VoorstellingId = v.Id
                JOIN Bezoeker b ON t.BezoekerId = b.Id
                JOIN Prijs p ON t.PrijsId = p.Id";
        if ($status !== null) {
            $sql .= " WHERE t.Status = :status";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':status', $status);
        } else {
            $stmt = $this->pdo->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Scan ticket (status veranderen)
    public function scanTicket($ticketId, $nieuweStatus = 'gescand')
    {
        $sql = "UPDATE Ticket SET Status = :status, Datumgewijzigd = NOW() WHERE Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $nieuweStatus);
        $stmt->bindParam(':id', $ticketId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Verwijder ticket
    public function deleteTicket($ticketId)
    {
        $sql = "DELETE FROM Ticket WHERE Id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $ticketId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}