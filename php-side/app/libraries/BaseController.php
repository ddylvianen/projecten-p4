<?php

class BaseController
{
    /**
     * Laad een model class
     * @param string $model Naam van het model (bijv. 'MedewerkerModel')
     * @return object Instantie van het model
     */
    public function model($model)
    {
        $modelPath = APPROOT . '/models/' . $model . '.php';

        if (file_exists($modelPath)) {
            require_once $modelPath;
            if (class_exists($model)) {
                return new $model();
            } else {
                die("Model class '$model' bestaat niet.");
            }
        } else {
            die("Model bestand '$modelPath' bestaat niet.");
        }
    }

    /**
     * Laad een view en geef data mee
     * @param string $view Pad naar de view relatief aan 'views' map (bijv. 'medewerker/index')
     * @param array $data Associatieve array met data voor de view
     */
    public function view($view, $data = [])
    {
        $viewPath = APPROOT . '/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            // Variabelen uit $data beschikbaar maken in de view
            extract($data);

            require_once $viewPath;
        } else {
            die("View '$view' bestaat niet.");
        }
    }

    /**
     * Redirect naar een andere pagina
     * @param string $url Relatieve URL (bijv. 'medewerker/index')
     */
    public function redirect($url)
    {
        // Zorg dat er geen output is voor header
        if (!headers_sent()) {
            header("Location: " . URLROOT . '/' . ltrim($url, '/'));
            exit;
        } else {
            echo "<script>window.location.href='" . URLROOT . '/' . ltrim($url, '/') . "';</script>";
            exit;
        }
    }

    /**
     * Stuur JSON data (handig voor API's)
     * @param mixed $data Data om te encoderen en te sturen
     */
    public function sendJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
