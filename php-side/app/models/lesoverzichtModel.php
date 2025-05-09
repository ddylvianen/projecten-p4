<?php

class lesoverzichtModel{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }



    public function getLessen($week){

        // has to be ordered by date and group by date by also by week

        $sql = 'SELECT Id, Naam,Datum,TIME_FORMAT(Tijd, "%H:%i") AS Tijd,MinAantalPersonen,MaxAantalPersonen,Beschikbaarheid,Opmerking,DATE_FORMAT(Datum, "%W") AS dag, IsActief
                FROM Les
                WHERE WEEK(Datum, 3) = :week
                ORDER BY Datum,Tijd';

        $this->db->query($sql);
        $result = $this->db->resultSet($week);
        return $result;
        // $data = $this->group_data($result);
        // return $data;
    }

    // public function group_data($data){
    //     $grouped = [];
    //     foreach($data as $item){
    //         $dag = $item->dag;
    //         unset($item->dag);
    //         $grouped[$dag][] = $item;
    //     }

    //     return $grouped;
    // }
}