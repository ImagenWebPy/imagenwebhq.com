<?php

class Formularios extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function frmContacto() {
        header('Content-type: application/json; charset=utf-8');
        $datos = array(
            'nombre' => (!empty($_POST['nombre'])) ? $this->helper->cleanInput($_POST['nombre']) : NULL,
            'email' => (!empty($_POST['email'])) ? $this->helper->cleanInput($_POST['email']) : NULL,
            'asunto' => (!empty($_POST['asunto'])) ? $this->helper->cleanInput($_POST['asunto']) : NULL,
            'mensaje' => (!empty($_POST['mensaje'])) ? $this->helper->cleanInput($_POST['mensaje']) : NULL
        );
        $data = $this->model->frmcontacto($datos);
        echo json_encode($data);
    }

    public function frmNewsletter() {
        $datos = array(
            'email' => $this->helper->cleanInput($_POST['email_newsletter'])
        );
        header('Content-type: application/json; charset=utf-8');
        $data = $this->model->frmNewsletter($datos);
        echo json_encode($data);
    }

}
