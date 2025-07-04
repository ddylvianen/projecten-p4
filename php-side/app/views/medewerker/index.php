<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Medewerker index</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2, .add-btn { text-align: center; }
        .add-btn a { text-decoration: none; background: #4CAF50; color: white; padding: 8px 12px; border-radius: 4px; }
    </style>
</head>
<body>

    <h2>Medewerker Overzicht</h2>
    <div class="add-btn">
        <a href="/medewerker/add.php" class="btn btn-success">Nieuwe medewerker</a>
    </div>
    <table>
        <tr>
            <th>Nummer</th>
            <th>Naam</th>
            <th>Soort</th>
            <th>Acties</th>
        </tr>
        <?php if (!empty($medewerkers)): ?>
            <?php foreach ($medewerkers as $medewerker): ?>
                <tr>
                    <td><?= htmlspecialchars($medewerker->Nummer) ?></td>
                    <td><?= htmlspecialchars($medewerker->Voornaam . ' ' . $medewerker->Achternaam) ?></td>
                    <td><?= htmlspecialchars($medewerker->Medewerkersoort) ?></td>
                    <td>
                        <a href="/medewerker/edit/<?= htmlspecialchars($medewerker->Nummer) ?>" class="btn btn-primary">Edit</a>
                        <a href="/medewerker/delete/<?= htmlspecialchars($medewerker->Nummer) ?>" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je deze medewerker wilt verwijderen?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align:center;">Geen medewerkers gevonden.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
