<?php

class Homepages extends BaseController
{

    public function index($data = [], $params = [])
    {
        $this->view('homepages/index', $data);
    }
    
}