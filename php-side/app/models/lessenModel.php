<?php
class lessenModel{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllLessen()
    {
        $this->db->query('SELECT * FROM Les ORDER BY Tijd ASC');
        return $this->db->resultSet();
    }


    public function getLesById($id)
    {
        $this->db->query('SELECT Id, Naam,Datum,TIME_FORMAT(Tijd, "%H:%i") AS Tijd,MinAantalPersonen,MaxAantalPersonen,Beschikbaarheid
                FROM Les
                WHERE Id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->single();
    }

    public function addLes($data)
    {
        
        $this->db->query('INSERT INTO Les (Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, DatumAangemaakt, DatumGewijzigd) VALUES(:naam, :datum, :tijd, :minAantalPersonen, :maxAantalPersonen, :beschikbaarheid, :DatumAangemaakt, :DatumGewijzigd)');
        $this->db->execute($data);
        return http_response_code(200);
    }

    public function updateLes($data)
    {
        $this->db->query('UPDATE Les SET Naam = :naam, Datum = :datum, Tijd = :tijd, MinAantalPersonen = :minAantalPersonen, MaxAantalPersonen = :maxAantalPersonen, Beschikbaarheid = :beschikbaarheid, DatumGewijzigd = NOW() WHERE Id = :id');
        $this->db->execute($data);

        return http_response_code(200);
    }

    public function deleteLes($id)
    {
        $this->db->query('UPDATE Les SET Beschikbaarheid = "uitgeschreven", IsActief = 0 WHERE Id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        return http_response_code(200);
    }

    public function Lesdelete($id)
    {
        $this->db->query('DELETE FROM Les WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();

        return http_response_code(200);
    }

}