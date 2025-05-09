<?php

class Homepages extends BaseController
{

    public function index($data = [], $params = [])
    {
        // echo ($this->loggedinAS('gastgebruiker')) ?  'geen gast!!' : 'gastgastt!!';
        ($this->loggedinAS('admin')) ? $this->redirect('admin/index') : 
        $this->view('homepages/index', $data);

    }

    
}