<?php require_once APPROOT . '/views/includes/header.php'; ?>
    <link rel="stylesheet" href="../public/css/forms.css">
    </head>
    <body>
        <form action="/signup" method="post">
            <input type="text" name="voornaam" id="voornaam" placeholder="Voornaam">
            <input type="text" name="tussenvoegsel" id="tussenvoegsel" placeholder="Tussenvoegsel">
            <input type="text" name="achternaam" id="achternaam" placeholder="Achternaam">
            <input type="text" name="email" id="email" placeholder="Email">
            <input type="date" name="geboortedatum" id="geboortedatum" placeholder="Geboortedatum">

            <input type="text" name="gebruikersnaam" id="gebruikersnaam" placeholder="Gebruikersnaam">
            <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord">
            <input type="password" name="wachtwoord2" id="wachtwoord2" placeholder="Herhaal wachtwoord">
            <input type="submit" value="account maken">
        </form>
<?php require_once APPROOT . '/views/includes/under.php'; ?>