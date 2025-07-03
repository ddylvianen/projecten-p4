<?php

class BaseController
{
    /**
     * Hier maken we een nieuw model object aan en geven deze 
     * terug aan de controller
     */
    public function model($model)
    {
        require_once APPROOT . '/models/' . $model . '.php';
        return new $model();
    }

    /**
     * De view method laadt het view-bestand en geeft informatie
     * mee aan de view met het $data-array
     */
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php'))
        {
            require_once('../app/views/' . $view . '.php');
        } else {
            echo 'View bestaat niet';
        }
    }

    // public function redirectTo($page, $data = [])
    // {
    //         // $pageload = ($page == '/homepages/index') ? '' : $page;
    //         // $pageload = str_replace('/index', '', $pageload);
    //         // $this->view($page, $data);
    //     header("Location: " . URLROOT . '/' . ltrim($page, '/'). '?reload=true');
    //     exit;
    // }

    public function redirect($page, $data = [])
    {
        // Zet een echte HTTP redirect met header
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($data['message'])) {
            $_SESSION['flash_message'] = $data['message'];
        }
        $location = URLROOT . '/' . ltrim($page, '/');
        header('Location: ' . $location);
        exit();
    }

    public function sendmail($to, $subject, $message)
    {
        mail($to, $subject, $message);
    }
    
    
    public function senddata($data)
    {
        echo json_encode($data);
    }

    public function loggedinAS($role)
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] == $role) {
            return true;
        } else {
            return false;
        }
    }

    public function getweek($weekNumber){

        $begindatestr = date('Y') . 'W' . str_pad($weekNumber, 2, '0', STR_PAD_LEFT);
        $enddatestr = date('Y') . 'W' . str_pad($weekNumber, 2, '0', STR_PAD_LEFT) . '7';

        $month = date('F', strtotime($enddatestr));

        $week_start = date('d', strtotime($begindatestr));
        $week_end = date('d', strtotime($enddatestr));

        return "{$week_start} - {$week_end} {$month}";
    }

}