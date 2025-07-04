<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Medewerker</title>
</head>
<body>
    <h2>Nieuwe Medewerker Toevoegen</h2>
    <form method="POST" action="/medewerker/save">
        <label for="soort">Soort:</label>
        <input type="text" id="soort" name="soort" required><br><br>

        <label for="gebruikerId">Gebruiker ID:</label>
        <input type="number" id="gebruikerId" name="gebruikerId" required><br><br>

        <button type="submit">Opslaan</button>
    </form>
</body>
</html>
