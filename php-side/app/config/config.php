<?php
/**
 * De database verbindingsgegevens
 */
define('DB_HOST', 'db');
define('DB_NAME', 'fitforfun');
define('DB_USER', 'user');
define('DB_PASS', 'password');


/**
 * De naam van de virtualhost
 */
define('URLROOT', 'localhost');

/**
 * Het pad naar de folder app
 */
define('APPROOT', dirname(dirname(__FILE__)));

if (!isset($_SESSION)){
    session_start();
}