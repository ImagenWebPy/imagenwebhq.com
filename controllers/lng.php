<?php

class Lng extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function cambiarIdioma() {
        header('Content-type: application/json; charset=utf-8');
        $datos = array(
            'lng' => $this->helper->cleanInput($_POST['lng']),
            'url' => $this->helper->cleanInput($_POST['url']),
            'page' => $this->helper->cleanInput($_POST['page'])
        );
        $data = $this->model->cambiarIdioma($datos);
        echo json_encode($data);
    }

}
