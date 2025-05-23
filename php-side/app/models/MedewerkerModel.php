<?php
require_once APPROOT . '/libraries/Database.php';


class MedewerkerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Haal alle actieve medewerkers op
    public function getAllMedewerkers()
    {
        $sql = "SELECT m.Nummer, m.Medewerkersoort, g.Voornaam, g.Achternaam
                FROM Medewerker m
                INNER JOIN Gebruiker g ON m.GebruikerId = g.Id
                WHERE m.Isactief = 1";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    // Voeg een medewerker toe
    public function addMedewerker($data)
    {
        $sql = "INSERT INTO Medewerker (Medewerkersoort, GebruikerId, Isactief)
                VALUES (:soort, :gebruikerId, 1)";
        $this->db->query($sql);
        $this->db->bind(':soort', $data['soort']);
        $this->db->bind(':gebruikerId', $data['gebruikerId']);
        return $this->db->execute();
    }

    // Verwijder (deactiveer) een medewerker
    public function deactivateMedewerker($nummer)
    {
        $sql = "UPDATE Medewerker SET Isactief = 0 WHERE Nummer = :nummer";
        $this->db->query($sql);
        $this->db->bind(':nummer', $nummer, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
