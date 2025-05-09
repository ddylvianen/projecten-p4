<?php

class construction extends BaseController
{

    public function index($data = [], $params = [])
    {
        $this->view('construction/index', $data);
    }
}