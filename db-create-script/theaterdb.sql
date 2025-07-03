DROP DATABASE IF EXISTS TheaterDB;
CREATE DATABASE IF NOT EXISTS TheaterDB;
USE TheaterDB;

-- 1. Gebruiker
CREATE TABLE Gebruiker (
    Id INT NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(10),
    Achternaam VARCHAR(50) NOT NULL,
    Gebruikersnaam VARCHAR(100) NOT NULL,
    Wachtwoord VARCHAR(255) NOT NULL,
    IsIngelogd BIT NOT NULL,
    Ingelogd DATETIME(6),
    Uitgelogd DATETIME(6),
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- 2. Rol
CREATE TABLE Rol (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Naam VARCHAR(100) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 3. Contact
CREATE TABLE Contact (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Mobiel VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 4. Medewerker
CREATE TABLE Medewerker (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Medewerkersoort VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 5. Bezoeker
CREATE TABLE Bezoeker (
    Id INT NOT NULL AUTO_INCREMENT,
    GebruikerId INT NOT NULL,
    Relatienummer MEDIUMINT NOT NULL UNIQUE,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (GebruikerId) REFERENCES Gebruiker(Id)
) ENGINE=InnoDB;

-- 6. Prijs
CREATE TABLE Prijs (
    Id INT NOT NULL AUTO_INCREMENT,
    Tarief DECIMAL(5,2) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- 7. Voorstelling
CREATE TABLE Voorstelling (
    Id INT NOT NULL AUTO_INCREMENT,
    MedewerkerId INT NOT NULL,
    Naam VARCHAR(100) NOT NULL,
    Beschrijving TEXT,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    MaxAantalTickets INT NOT NULL,
    Beschikbaarheid VARCHAR(50) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (MedewerkerId) REFERENCES Medewerker(Id)
) ENGINE=InnoDB;

-- 8. Ticket
CREATE TABLE Ticket (
    Id INT NOT NULL AUTO_INCREMENT,
    BezoekerId INT NOT NULL,
    VoorstellingId INT NOT NULL,
    PrijsId INT NOT NULL,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Barcode VARCHAR(20) NOT NULL UNIQUE,
    Datum DATE NOT NULL,
    Tijd TIME NOT NULL,
    Status VARCHAR(20) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (BezoekerId) REFERENCES Bezoeker(Id),
    FOREIGN KEY (VoorstellingId) REFERENCES Voorstelling(Id),
    FOREIGN KEY (PrijsId) REFERENCES Prijs(Id)
) ENGINE=InnoDB;

-- 9. Melding
CREATE TABLE Melding (
    Id INT NOT NULL AUTO_INCREMENT,
    BezoekerId INT,
    MedewerkerId INT,
    Nummer MEDIUMINT NOT NULL UNIQUE,
    Type VARCHAR(20) NOT NULL,
    Bericht VARCHAR(250) NOT NULL,
    Isactief BIT NOT NULL DEFAULT 1,
    Opmerking VARCHAR(250),
    Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (BezoekerId) REFERENCES Bezoeker(Id),
    FOREIGN KEY (MedewerkerId) REFERENCES Medewerker(Id)
) ENGINE=InnoDB;


-- 1. Gebruiker
INSERT INTO Gebruiker (Voornaam, Tussenvoegsel, Achternaam, Gebruikersnaam, Wachtwoord, IsIngelogd, Ingelogd, Uitgelogd, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
('Emma', NULL, 'Jansen', 'emma.jansen', 'wachtwoord123', 0, NULL, NULL, 1, NULL, NOW(), NOW()),
('Tom', 'van', 'Dijk', 'tom.dijk', 'veiligwachtwoord', 0, NULL, NULL, 1, NULL, NOW(), NOW()),
('Lars', NULL, 'de Vries', 'lars.vries', '123veilig', 0, NULL, NULL, 1, NULL, NOW(), NOW());

-- 2. Rol
INSERT INTO Rol (GebruikerId, Naam, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'Bezoeker', 1, NULL, NOW(), NOW()),
(2, 'Medewerker', 1, NULL, NOW(), NOW()),
(3, 'Medewerker', 1, NULL, NOW(), NOW());

-- 3. Contact
INSERT INTO Contact (GebruikerId, Email, Mobiel, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'emma.jansen@mail.com', '0612345678', 1, NULL, NOW(), NOW()),
(2, 'tom.dijk@mail.com', '0623456789', 1, NULL, NOW(), NOW()),
(3, 'lars.vries@mail.com', '0634567890', 1, NULL, NOW(), NOW());

-- 4. Medewerker
INSERT INTO Medewerker (GebruikerId, Nummer, Medewerkersoort, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(2, 1001, 'Technicus', 1, NULL, NOW(), NOW()),
(3, 1002, 'Kaartverkoop', 1, NULL, NOW(), NOW());

-- 5. Bezoeker
INSERT INTO Bezoeker (GebruikerId, Relatienummer, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 2001, 1, NULL, NOW(), NOW());

-- 6. Prijs
INSERT INTO Prijs (Tarief, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(12.50, 1, 'Normaal tarief', NOW(), NOW()),
(8.00, 1, 'Studententarief', NOW(), NOW());

-- 7. Voorstelling
INSERT INTO Voorstelling (MedewerkerId, Naam, Beschrijving, Datum, Tijd, MaxAantalTickets, Beschikbaarheid, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 'Hamlet', 'Een klassiek toneelstuk van Shakespeare', '2025-06-15', '20:00:00', 100, 'Beschikbaar', 1, NULL, NOW(), NOW()),
(2, 'De Kleine Prins', 'Een voorstelling voor kinderen', '2025-06-20', '15:00:00', 50, 'Beschikbaar', 1, NULL, NOW(), NOW());

-- 8. Ticket
INSERT INTO Ticket (BezoekerId, VoorstellingId, PrijsId, Nummer, Barcode, Datum, Tijd, Status, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, 1, 1, 3001, 'ABC123DEF456', '2025-06-15', '20:00:00', 'Geboekt', 1, NULL, NOW(), NOW()),
(1, 2, 2, 3002, 'XYZ789GHI123', '2025-06-20', '15:00:00', 'Geboekt', 1, NULL, NOW(), NOW());

-- 9. Melding
INSERT INTO Melding (BezoekerId, MedewerkerId, Nummer, Type, Bericht, Isactief, Opmerking, Datumaangemaakt, Datumgewijzigd) VALUES
(1, NULL, 4001, 'Vraag', 'Tot hoe laat duurt de voorstelling Hamlet?', 1, NULL, NOW(), NOW()),
(NULL, 2, 4002, 'Technisch', 'Geluid valt uit tijdens scène 3.', 1, NULL, NOW(), NOW());

-- UPDATE SCRIPT voor bestaande tabellen
-- Voeg default waarde toe aan Isactief, Datumaangemaakt en Datumgewijzigd

ALTER TABLE Gebruiker 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Rol 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Contact 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Medewerker 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Bezoeker 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Prijs 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Voorstelling 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Ticket 
    MODIFY COLUMN Nummer MEDIUMINT NOT NULL UNIQUE DEFAULT AUTO_INCREMENT,
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);

ALTER TABLE Melding 
    MODIFY COLUMN Isactief BIT NOT NULL DEFAULT 1,
    MODIFY COLUMN Datumaangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY COLUMN Datumgewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6);
-- EINDE UPDATE SCRIPT

