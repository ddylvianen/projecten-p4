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
        $user = $this->getuser($username, $password);
        if ($user) {
            return $user; // Return user data if login is successful
        } else {
            return null; // Return null if login fails
        }
    }

    // Retrieves user data from the database and verifies the password
    private function getuser($username, $password)
    {
        $this->db->query('CALL SLuser(:username)'); // Call stored procedure to fetch user data
        $this->db->bind(':username', $username); // Bind the username parameter
        $this->db->execute();
        $userdb = $this->db->single(); // Fetch a single user record

        $hassedpassword = $userdb ? $userdb->Wachtwoord : null; // Get hashed password from the database
        if (password_verify($password, $hassedpassword)) { // Verify the provided password
            return [
                'id' => $userdb->id,
                'username' => $userdb->Gebruikersnaam,
                'role' => $userdb->rol
            ];
        } else {
            return false; // Return false if password verification fails
        }
    }

    // Handles user signup by inserting data into multiple tables
    public function signup($data)
    {
        try {
            $this->db->beginTransaction(); // Start a database transaction

            // Insert a new person and capture the ID
            $id = $this->Insertpersoon($data);

            // Insert a new user linked to the person ID
            $id = $this->InsertGebruiker($data, $id);

            // Assign a role to the newly created user
            $id = $this->InsertRol($id);

            $this->db->endTransaction(); // Commit the transaction
            return true;

        } catch (Exception $e) {
            echo $e; // Output the exception message for debugging
            $this->db->rollBack(); // Roll back the transaction on failure
            $this->db->endTransaction();
            return false;
        }
    }

    // Inserts a new person into the database
    private function Insertpersoon($data)
    {
        $this->db->query('CALL InsertPersoon(:voornaam, :tussenvoegsel, :achternaam, :geboortedatum)');
        $this->db->execute([
            ':voornaam' => $data['voornaam'],
            ':tussenvoegsel' => $data['tussenvoegsel'],
            ':achternaam' => $data['achternaam'],
            ':geboortedatum' => $data['geboortedatum']
        ]);
        $result = $this->db->single(); // Fetch the result of the stored procedure
        $this->db->closeCursor();
        return $result ? $result->PersoonID : null; // Return the inserted person ID
    }

    // Inserts a new user into the database linked to a person ID
    private function InsertGebruiker($data, $persoonId)
    {
        $this->db->query('CALL InsertGebruiker(:persoonid, :gebruikersnaam, :wachtwoord)');
        $this->db->execute([
            ':persoonid' => $persoonId, // Use the captured person ID
            ':gebruikersnaam' => $data['gebruikersnaam'],
            ':wachtwoord' => password_hash($data['wachtwoord'], PASSWORD_DEFAULT) // Hash the password
        ]);
        $result = $this->db->single(); // Fetch the result of the stored procedure
        $this->db->closeCursor();
        return $result ? $result->GebruikerID : null; // Return the inserted user ID
    }

    // Assigns a role to a user
    private function InsertRol($gebruikerId)
    {
        $this->db->query('CALL InsertRol(:gebruikerid, :rol)');
        $this->db->execute([
            ':gebruikerid' => $gebruikerId, // Use the captured user ID
            ':rol' => 'gastgebruiker' // Assign a default role
        ]);
        $result = $this->db->single(); // Fetch the result of the stored procedure
        $this->db->closeCursor();
        return $result ? $result->RolID : null; // Return the inserted role ID
    }
}