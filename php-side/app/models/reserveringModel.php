<?php


Class reserveringModel{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getReserveringen($week){

        // has to be ordered by date and group by date by also by week

        $sql = 'SELECT Reservering.LesId, Reservering.Nummer, Reservering.Datum, Reservering.Tijd, Reservering.opmerking, WEEK(Reservering.Datum, 3) AS weeknummer, DATE_FORMAT(Reservering.Datum, "%W") AS dag, Les.Naam AS lesnaam
        FROM Reservering
        Left JOIN Les ON Reservering.LesId = Les.Id
        WHERE WEEK(Reservering.Datum, 3) = :week
        ORDER BY Reservering.Datum, Reservering.Tijd';

        $this->db->query($sql);
        $result = $this->db->resultSet($week);
        // return $result;
        $data = $this->group_data($result);
        return $data;
    }

    public function group_data($data){
        $grouped = [];
        foreach($data as $item){
            $dag = $item->dag;
            unset($item->dag);
            $grouped[$dag][] = $item;
        }

        return $grouped;
    }

    public function getReserveringById($id){
        $this->db->query('SELECT * FROM Reservering WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        $result = $this->db->single();
        return $result;
    }

    public function addReservering($data){
        $this->db->query('INSERT INTO Reservering (naam, email, telefoonnummer, datum, tijd, aantal_personen) VALUES(:naam, :email, :telefoonnummer, :datum, :tijd, :aantal_personen)');
        $this->db->execute($data);
        return http_response_code(200);
    }

    public function updateReservering($data){
        $this->db->query('UPDATE Reservering SET naam = :naam, email = :email, telefoonnummer = :telefoonnummer, datum = :datum, tijd = :tijd, aantal_personen = :aantal_personen WHERE id = :id');
        $this->db->execute($data);
        return http_response_code(200);
    }

    public function deleteReservering($id){
        $this->db->query('DELETE FROM Reservering WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        return http_response_code(200);
    }
}