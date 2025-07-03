<?php

// Model voor alle database-acties rondom tickets
class ticketModel
{
    // Database connectie
    private $db;

    // Constructor: maak database connectie
    public function __construct()
    {
        $this->db = new Database();
    }

    // Haal alle tickets op (optioneel filter op status)
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
        try {
            // Controleer huidige status
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

    // Verwijder ticket uit de database
    public function deleteTicket($ticketId)
    {
        try {
            $sql = "DELETE FROM Ticket WHERE Id = :id";
            $this->db->query($sql);
            $this->db->bind(':id', $ticketId, PDO::PARAM_INT);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log("[TicketModel:deleteTicket] " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, __DIR__ . '/../../../../logs/apache/error.log');
            return "Er is een fout opgetreden bij het verwijderen van het ticket. Probeer het later opnieuw.";
        }
    }

    // Voeg een nieuwe prijs toe en retourneer het ID
    public function addPrijs($prijs)
    {
        $sql = "INSERT INTO Prijs (Tarief) VALUES (:tarief)";
        $this->db->query($sql);
        $this->db->bind(':tarief', $prijs);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    // Voeg een nieuw ticket toe aan de database
    public function addTicket($ticket)
    {
        try {
            // Haal datum en tijd op van de voorstelling
            $q = 'SELECT Datum, Tijd FROM Ticket WHERE Id = :id';
            $this->db->query($q);
            $this->db->bind(':id', $ticket['voorstelling']);
            $this->db->execute();
            $result = $this->db->single();
            $date = $result->Datum;
            $time = $result->Tijd;
            // Voeg ticket toe
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
        } catch (Exception $e) {
            error_log("[TicketModel:addTicket] " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, __DIR__ . '/../../../../logs/apache/error.log');
            return "Er is een fout opgetreden bij het toevoegen van het ticket. Probeer het later opnieuw.";
        }
    }

    // Update een bestaand ticket
    public function updateTicket($ticket)
    {
        try {
            // Haal nieuwe datum en tijd op van de voorstelling
            $sqlVoorstelling = "SELECT Datum, Tijd FROM Voorstelling WHERE Id = :voorstellingId";
            $this->db->query($sqlVoorstelling);
            $this->db->bind(':voorstellingId', $ticket['voorstelling']);
            $voorstelling = $this->db->single();
            $date = $voorstelling->Datum;
            $time = $voorstelling->Tijd;
            // Update prijs
            $sql = "UPDATE Prijs SET Tarief = :prijs WHERE Id = :prijsId";
            $this->db->query($sql);
            $this->db->bind(':prijs', $ticket['prijs']);
            $this->db->bind(':prijsId', $ticket['prijsId']);
            $this->db->execute();
            // Update ticket
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
        } catch (Exception $e) {
            error_log("[TicketModel:updateTicket] " . $e->getMessage() . "\n" . $e->getTraceAsString(), 3, __DIR__ . '/../../../../logs/apache/error.log');
            return "Er is een fout opgetreden bij het bijwerken van het ticket. Probeer het later opnieuw.";
        }
    }

    // Haal een specifiek ticket op
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

    // Haal alle actieve voorstellingen op
    public function getVoorstellingen()
    {
        $sql = "SELECT Id, Naam FROM Voorstelling WHERE IsActief = 1";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    // Haal alle bezoekers op
    public function getBezoekers()
    {
        $sql = "SELECT Bezoeker.Id, CONCAT(Gebruiker.Voornaam, ' ', Gebruiker.Achternaam) AS Naam
                FROM Bezoeker
                JOIN Gebruiker ON Bezoeker.GebruikerId = Gebruiker.Id";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    // Haal medewerkerId op bij een voorstelling
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