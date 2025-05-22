<?php
/**
 * De database verbindingsgegevens
 */
define('DB_HOST', 'db');
define('DB_NAME', 'TheaterDB');
define('DB_USER', 'root');
define('DB_PASS', 'root');


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