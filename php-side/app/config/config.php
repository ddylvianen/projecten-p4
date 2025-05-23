<?php
/**
 * Database verbindingsgegevens
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'TheaterDB'); // Jouw database naam
define('DB_USER', 'root');      // Database gebruiker
define('DB_PASS', '');


/**
 * URL van je project (virtual host of localhost)
 */
define('URLROOT', 'http://localhost'); // Voeg http(s) toe voor volledigheid

/**
 * Absolute pad naar de 'app' directory
 * __DIR__ is de map waarin dit bestand (config.php) staat,
 * dus met '../' ga je een map omhoog en dan naar 'app'.
 * Pas dit aan als je config.php ergens anders staat.
 */
define('APPROOT', realpath(__DIR__ . '/..'));



/**
 * Start de sessie als die nog niet gestart is
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
