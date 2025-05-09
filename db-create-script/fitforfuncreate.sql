-- Date: 2021-01-01
-- Author: Dylan Vianen
-- Description: Fitforfun database

-- ** Startup **
DROP DATABASE IF EXISTS fitforfun;
CREATE DATABASE fitforfun;
USE fitforfun;

-- ** Table: Persoon **
CREATE TABLE Persoon (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10) NULL,
    Achternaam VARCHAR(50) NOT NULL,
    Geboortedatum DATE NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE = InnoDB;

INSERT INTO Persoon (Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    ('test1', 'test1', 'test1', '2021-01-01', 1, 'test1', '2021-01-01 12:00:00', '2021-01-01 12:00:00'),
    ('test2', 'test2', 'test2', '2021-02-01', 1, 'test2', '2021-02-01 12:00:00', '2021-02-01 12:00:00'),
    ('test3', 'test3', 'test3', '2021-03-01', 1, 'test3', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Gebruiker **
CREATE TABLE Gebruiker (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PersoonId INT UNSIGNED NOT NULL,
    Gebruikersnaam VARCHAR(50) NOT NULL,
    Wachtwoord VARCHAR(255) NOT NULL,
    IsIngelogd BIT NOT NULL DEFAULT 0,
    Ingelogd DATETIME NULL,
    Uitgelogd DATETIME NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (PersoonId) REFERENCES Persoon(Id)
) ENGINE = InnoDB;

INSERT INTO Gebruiker (PersoonId, Gebruikersnaam, Wachtwoord, IsIngelogd, Ingelogd, Uitgelogd, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    (1, 'test', 'test', 1, '2021-01-01 12:00:00', '2021-01-01 12:00:00', 1, 'test', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Rol **
CREATE TABLE Rol (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GebruikerId INT UNSIGNED NOT NULL,
    Naam VARCHAR(50) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE = InnoDB;

INSERT INTO Rol (GebruikerId, Naam, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    (1, 'lid', 1, 'test', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Medewerker **
CREATE TABLE Medewerker (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PersoonId INT UNSIGNED NOT NULL,
    Nummer MEDIUMINT NOT NULL,
    Medewerkersoort VARCHAR(20) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (PersoonId) REFERENCES Persoon(Id)
) ENGINE = InnoDB;

INSERT INTO Medewerker (PersoonId, Nummer, Medewerkersoort, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    (1, 1, 'test', 1, 'test', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Lid **
CREATE TABLE Lid (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PersoonId INT UNSIGNED NOT NULL,
    Relatienummer MEDIUMINT NOT NULL,
    Modiel VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (PersoonId) REFERENCES Persoon(Id)
) ENGINE = InnoDB;

INSERT INTO Lid (PersoonId, Relatienummer, Modiel, Email, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    (1, 1, 'test', 'test', 1, 'test', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Les **
CREATE TABLE Les (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50) NOT NULL,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    MinAantalPersonen TINYINT NOT NULL,
    MaxAantalPersonen TINYINT NOT NULL,
    Beschikbaarheid VARCHAR(50) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE = InnoDB;

INSERT INTO Les (Naam, Datum, Tijd, MinAantalPersonen, MaxAantalPersonen, Beschikbaarheid, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    ('cardiospinning', '2025-02-10', '10:00:00', 1, 10, 'beschikbaar', 1, 'opmerking1', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Table: Reservering **
CREATE TABLE Reservering (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    LidId INT UNSIGNED NOT NULL,
    LesId INT UNSIGNED NOT NULL,
    Nummer MEDIUMINT NOT NULL,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    Reserveringstatus VARCHAR(20) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1, -- Default value added
    Opmerking VARCHAR(250) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6) NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (LidId) REFERENCES Lid(Id),
    FOREIGN KEY (LesId) REFERENCES Les(Id)
) ENGINE = InnoDB;

INSERT INTO Reservering (LidId, LesId, Nummer, Datum, Tijd, Reserveringstatus, IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
VALUES
    (1, 1, 1, '2025-02-10', '10:00:00', 'test1', 1, 'test1', '2021-01-01 12:00:00', '2021-01-01 12:00:00');

-- ** Stored Procedures **
DELIMITER $$

CREATE DEFINER=`root`@`%` PROCEDURE `InsertGebruiker`(
    IN p_persoonid INT, 
    IN p_gebruikersnaam VARCHAR(255), 
    IN p_wachtwoord VARCHAR(255)
)
BEGIN
    INSERT INTO Gebruiker (PersoonId, Gebruikersnaam, Wachtwoord, DatumAangemaakt, DatumGewijzigd) 
    VALUES (p_persoonid, p_gebruikersnaam, p_wachtwoord, NOW(), NOW());

    -- Optionally, return the last inserted ID
    SELECT LAST_INSERT_ID() AS GebruikerID;
END$$

DELIMITER $$

CREATE DEFINER=`root`@`%` PROCEDURE `InsertPersoon`(
    IN p_voornaam VARCHAR(255), 
    IN p_tussenvoegsel VARCHAR(50), 
    IN p_achternaam VARCHAR(255), 
    IN p_geboortedatum DATE
)
BEGIN
    INSERT INTO Persoon (Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, DatumAangemaakt, DatumGewijzigd) 
    VALUES (p_voornaam, p_tussenvoegsel, p_achternaam, p_geboortedatum, NOW(), NOW());
    
    -- Optionally, return the last inserted ID
    SELECT LAST_INSERT_ID() AS PersoonID;
END$$

DELIMITER $$

CREATE DEFINER=`root`@`%` PROCEDURE `InsertRol`(
    IN p_gebruikerid INT, 
    IN p_rol VARCHAR(255)
)
BEGIN
    INSERT INTO Rol (GebruikerId, Naam, DatumAangemaakt, DatumGewijzigd) 
    VALUES (p_gebruikerid, p_rol, NOW(), NOW());

    -- Optionally, return the last inserted ID
    SELECT LAST_INSERT_ID() AS RolID;
END$$

DELIMITER $$

CREATE DEFINER=`root`@`%` PROCEDURE `SLuser`(IN `username` VARCHAR(50))
SELECT 
    Gb.id, 
    Gb.PersoonId, 
    Gb.Gebruikersnaam, 
    Gb.Wachtwoord, 
    Rol.naam AS rol 
FROM Gebruiker AS Gb
LEFT JOIN Rol ON Gb.id = Rol.GebruikerId
WHERE Gb.Gebruikersnaam = username$$

DELIMITER ;
