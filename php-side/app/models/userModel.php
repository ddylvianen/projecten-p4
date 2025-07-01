<?php
class userModel
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct()
    {
        $this->db = new Database;
    }

    // Handles user login by verifying username and password
    public function login($username, $password)
    {
        $user = $this->getUser($username);
        if ($user && password_verify($password, $user->Wachtwoord)) {
            $result = new stdClass();
            $result->id = $user->Id;
            $result->username = $user->Gebruikersnaam;
            $result->role = $this->getUserRole($user->Id);
            return $result;
        } else {
            return null; // Return null if login fails
        }
    }

    // Retrieves user data from the database by username
    private function getUser($username)
    {
        $this->db->query('SELECT * FROM Gebruiker WHERE Gebruikersnaam = :username LIMIT 1');
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->single();
    }

    // Retrieves the user's role from the Rol table
    private function getUserRole($gebruikerId)
    {
        $this->db->query('SELECT Naam FROM Rol WHERE GebruikerId = :gebruikerid AND Isactief = 1 LIMIT 1');
        $this->db->bind(':gebruikerid', $gebruikerId);
        $this->db->execute();
        $role = $this->db->single();
        return $role ? $role->Naam : null;
    }

    // Handles user signup by inserting data into Gebruiker and Rol
    public function signup($data)
    {
        try {
            $this->db->beginTransaction(); // Start a database transaction

            // Insert a new user into Gebruiker
            $gebruikerId = $this->insertGebruiker($data);
            if (!$gebruikerId) {
                throw new Exception('Gebruiker kon niet worden aangemaakt.');
            }

            // Assign a role to the newly created user
            $rolId = $this->insertRol($gebruikerId);
            if (!$rolId) {
                throw new Exception('Rol kon niet worden toegekend.');
            }

            $this->db->endTransaction(); // Commit the transaction
            return true;

        } catch (Exception $e) {
            echo $e; // Output the exception message for debugging
            $this->db->rollBack(); // Roll back the transaction on failure
            $this->db->endTransaction();
            return false;
        }
    }

    // Inserts a new user into the Gebruiker table
    private function insertGebruiker($data)
    {
        $this->db->query('INSERT INTO Gebruiker (Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, Wachtwoord, IsIngelogd, Ingelogd, Uitgelogd, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES (:voornaam, :tussenvoegsel, :achternaam, :gebruikersnaam, :wachtwoord, 0, NULL, NULL, 1, NULL, NOW(), NOW())');
        $this->db->execute([
            ':voornaam' => $data['voornaam'],
            ':tussenvoegsel' => $data['tussenvoegsel'],
            ':achternaam' => $data['achternaam'],
            ':gebruikersnaam' => $data['gebruikersnaam'],
            ':wachtwoord' => password_hash($data['wachtwoord'], PASSWORD_DEFAULT)
        ]);
        return $this->db->lastInsertId();
    }

    // Assigns a default role to a user in the Rol table
    private function insertRol($gebruikerId)
    {
        $this->db->query('INSERT INTO Rol (GebruikerId, Naam, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES (:gebruikerid, :rol, 1, NULL, NOW(), NOW())');
        $this->db->execute([
            ':gebruikerid' => $gebruikerId,
            ':rol' => 'Bezoeker' // Default role
        ]);
        return $this->db->lastInsertId();
    }
}