<?php
// Laad de config met juiste pad
require_once __DIR__ . '/../php-side/app/config/config.php';

// Laad de BaseController class
require_once APPROOT . '/libraries/BaseController.php';

// Laad de controller class
require_once APPROOT . '/controllers/Medewerker.php';

// Maak een instantie aan en roep de methode aan
$controller = new Medewerker();
$controller->index();
