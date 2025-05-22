<?php
class Medewerker {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "
            SELECT m.Nummer, m.Medewerkersoort, g.Voornaam, g.Achternaam
            FROM Medewerker m
            INNER JOIN Gebruiker g ON m.GebruikerId = g.Id
            WHERE m.Isactief = 1
        ";
        $result = $this->conn->query($sql);

        $medewerkers = [];
        while ($row = $result->fetch_assoc()) {
            $medewerkers[] = $row;
        }
        return $medewerkers;
    }
}
