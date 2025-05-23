<?php
/**
 * Dit is de database class die alle communicatie met de database verzorgt
 */

class Database
{
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;

    private $dbHandler;
    private $statement;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            // 💥 Toon de echte fout tijdelijk op het scherm
            die("Database verbinding mislukt: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function resultSet($data = null)
    {
        $this->statement->execute($data);
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function bind($parameter, $value, $type = PDO::PARAM_STR)
    {
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function beginTransaction()
    {
        return $this->dbHandler->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->dbHandler->commit();
    }

    public function rollback()
    {
        return $this->dbHandler->rollBack();
    }

    public function closeCursor()
    {
        return $this->statement->closeCursor();
    }

    public function execute($data = null)
    {
        return $this->statement->execute($data);
    }

    public function single()
    {
        $result = $this->statement->fetch(PDO::FETCH_OBJ);
        $this->statement->closeCursor();
        return $result;
    }

    public function outQuery($sql)
    {
        return $this->dbHandler->query($sql);
    }

    public function lastInsertId()
    {
        return $this->dbHandler->lastInsertId();
    }

    public function getConnection()
    {
        return $this->dbHandler;
    }
}
