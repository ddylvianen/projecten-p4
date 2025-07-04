<?php

class MedewerkerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllMedewerkers()
    {
        $this->db->query("
            SELECT m.Nummer, m.Medewerkersoort, m.GebruikerId,
                   g.Voornaam, g.Achternaam
            FROM Medewerker m
            JOIN Gebruiker g ON m.GebruikerId = g.Id
            WHERE m.IsActief = 1
        ");

        return $this->db->resultSet();
    }

    public function getMedewerkerByNummer($nummer)
    {
        $this->db->query("
            SELECT m.Nummer, m.Medewerkersoort, m.GebruikerId,
                   g.Voornaam, g.Achternaam
            FROM Medewerker m
            JOIN Gebruiker g ON m.GebruikerId = g.Id
            WHERE m.Nummer = :nummer
        ");
        $this->db->bind(':nummer', $nummer);
        return $this->db->single();
    }

    public function addMedewerker($data)
    {
        $this->db->query("
            INSERT INTO Medewerker (Medewerkersoort, GebruikerId, IsActief)
            VALUES (:soort, :gebruikerId, 1)
        ");
        $this->db->bind(':soort', $data['soort']);
        $this->db->bind(':gebruikerId', $data['gebruikerId']);
        return $this->db->execute();
    }

    public function updateMedewerker($data)
    {
        $this->db->query("
            UPDATE Medewerker
            SET Medewerkersoort = :soort, GebruikerId = :gebruikerId
            WHERE Nummer = :nummer
        ");
        $this->db->bind(':soort', $data['soort']);
        $this->db->bind(':gebruikerId', $data['gebruikerId']);
        $this->db->bind(':nummer', $data['nummer']);
        return $this->db->execute();
    }

    public function deactivateMedewerker($nummer)
    {
        $this->db->query("
            UPDATE Medewerker
            SET IsActief = 0
            WHERE Nummer = :nummer
        ");
        $this->db->bind(':nummer', $nummer);
        return $this->db->execute();
    }
}
