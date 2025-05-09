<?php

class AdminModel
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = new Database;
    }

    // Retrieves reservation data and organizes it by month
    public function getdata()
    {
        $sql = 'CALL `SLreservering`()'; // Call stored procedure to fetch reservation data

        $this->db->query($sql);
        $result = $this->db->resultSet(); // Fetch all results

        // Initialize an array to store data for each month
        $monthData = array_fill(0, 12, 0);

        // Process the results and map them to the corresponding month
        foreach ($result as $lesson) {
            $index = (int) $lesson->maand; // Convert the month to an integer
            if ($index >= 0 && $index < 12) {
                $monthData[$index] = (int) $lesson->aantal; // Store the count for the month
            }
        }

        return $monthData; // Return the organized data
    }
}