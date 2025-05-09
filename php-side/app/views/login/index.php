<?php require_once APPROOT . '/views/includes/header.php'; ?>
    <link rel="stylesheet" href="../public/css/forms.css">
</head>
<body>
    <div class="container">
        <form action="/login" method="post">
            <h1>Login</h1>
            <input type="text" name="username" id="username" placeholder="Gebruikersnaam">
            <input type="password" name="password" id="password" placeholder="Wachtwoord">
            <button type="submit" class="btn">inloggen</button>
        </form>
    </div>

<?php require_once APPROOT . '/views/includes/under.php'; ?>

