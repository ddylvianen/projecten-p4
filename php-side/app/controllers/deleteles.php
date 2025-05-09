<?php

class Deleteles extends BaseController
{
    private $lessenModel;

    public function __construct()
    {
        $this->lessenModel = $this->model('LessenModel');
    }

    public function index($data = [], $params = [])
    {
        try {
            //delete the lesson and redirect to the overview page
            $this->deleteLes();
            $this->redirect('overzicht/index', ['message' => 'Les is succesvol geannuleerd!']);
        } catch (Exception $e) {
            // Handle exception (e.g., log it, show an error message, etc.)
            $this->redirect('overzicht/index', ['message' => 'Er is een fout opgetreden bij het verwijderen van de les.']);
        }
    }

    private function deleteLes()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
       
        if (!$this->lessenModel->getLesById($id)) {
            // Redirect with a specific error message if the lesson does not exist
            $this->redirect('overzicht/index', ['message' => 'De les bestaat niet.']);
            return;
        }

        $this->lessenModel->deleteLes($id);

        // echte delete
        // $this->lessenModel->Lesdelete($id);
    }
}