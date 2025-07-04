<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Medewerker Bewerken</title>
</head>
<body>
    <h2>Medewerker Bewerken</h2>
    <form method="POST" action="/medewerker/edit/<?= $medewerker->Nummer ?>">
        <input type="hidden" name="nummer" value="<?= $medewerker->Nummer ?>">

        <label for="soort">Soort:</label>
        <input type="text" id="soort" name="soort" value="<?= $medewerker->Medewerkersoort ?>" required><br><br>

        <label for="gebruikerId">Gebruiker ID:</label>
        <input type="number" id="gebruikerId" name="gebruikerId" value="<?= $medewerker->GebruikerId ?>" required><br><br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
