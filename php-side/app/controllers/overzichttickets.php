<?php

class overzichtadd extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('lessenModel');
    }

    public function index($data = [], $params = [])
    {
        ($this->loggedinAS('medewerker')) ? null : $this->redirect('homepages/index');
        
        
    }

}