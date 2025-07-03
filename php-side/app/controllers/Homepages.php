<?php
// Controller voor de homepagina
class Homepages extends BaseController
{
    // Toon de homepagina
    public function index($data = [], $params = [])
    {
        $this->view('homepages/index', $data);
    }
    
}