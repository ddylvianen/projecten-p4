<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Medewerker Overzicht</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Medewerker Overzicht</h2>
    <table>
        <tr>
            <th>Nummer</th>
            <th>Naam</th>
            <th>Soort</th>
        </tr>
        <?php if (!empty($medewerkers)): ?>
            <?php foreach ($medewerkers as $medewerker): ?>
                <tr>
                    <td><?= htmlspecialchars($medewerker->Nummer) ?></td>
                    <td><?= htmlspecialchars($medewerker->Voornaam . ' ' . $medewerker->Achternaam) ?></td>
                    <td><?= htmlspecialchars($medewerker->Medewerkersoort) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" style="text-align:center;">Geen medewerkers gevonden.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
