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
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        $controller = explode('/', $page)[0];
        $controller = ($controller == 'homepages') ? 'homepages' : $controller;
        // header("Location: " . '/' . $controller)
        $method = explode('/', $page)[1];

        $params = explode('/', $page)[2] ?? null;
        $redirect = ($controller == 'homepages') ? '' : $controller;
        $data['redirect'] = "history.pushState({}, '', '$redirect');";
        require_once '../app/controllers/' . $controller . '.php';
        $controller = new $controller();

        if (method_exists($controller, $method)) {
            if ($params) {
                $controller->{$method}($data, $params);
            } else {
                $controller->{$method}($data);
            }

        } else {
            echo 'Method bestaat niet';
        }
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