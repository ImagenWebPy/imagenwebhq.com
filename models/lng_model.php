<?php

class Lng_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function cambiarIdioma($datos) {
        $lng = $datos['lng'];
        $url = $datos['url'];
        $page = $datos['page'];
        $page = explode(',', $page);
        $cant = count($page);
        $enlace = '';
        switch ($cant) {
            case 2:
                $enlace = $url . $lng . '/' . $page[1];
                break;
            case 3:
                $enlace = $url . $lng . '/' . $page[1] . '/' . $page[2];
                break;
            case 5:
                $enlace = $url . $lng . '/' . $page[1] . '/' . $page[2] . '/' . $page[3] . '/' . $page[4];
                break;
            default:
                $enlace = $url . $lng;
                break;
        }
        $data = array(
            'type' => 'success',
            'url' => $enlace
        );
        return $data;
    }

}
