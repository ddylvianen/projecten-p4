<?php
// Controller voor de construction (onderhoud) pagina
class construction extends BaseController
{
    // Toon de onderhoudspagina
    public function index($data = [], $params = [])
    {
        $this->view('construction/index', $data);
    }
}