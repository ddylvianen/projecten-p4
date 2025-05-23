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
