<?php

class logout extends BaseController
{
    public function index($data = [], $params = [])
    {
        $_SESSION = [];
        $this->redirect('homepages/index', ['message' => 'U bent uitgelogd!']);
    }
}