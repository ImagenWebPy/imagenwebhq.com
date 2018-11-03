<?php

class Trabajos_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function datos_trabajo($id, $lng) {
        $sqlTrabajos = $this->db->select("SELECT
                                                web,
                                                url,
                                                " . $lng . "_descripcion as descripcion,
                                                imagen_header
                                        FROM
                                                `trabajos`
                                        WHERE
                                                id = $id;");
        $imagenes = array();
        $sqlImagenes = $this->db->select("SELECT imagen FROM `trabajos_img` WHERE id_trabajos = $id ORDER BY orden ASC;");
        foreach ($sqlImagenes as $item) {
            array_push($imagenes, $item['imagen']);
        }
        $data = array(
            'web' => utf8_encode($sqlTrabajos[0]['web']),
            'url' => utf8_encode($sqlTrabajos[0]['url']),
            'descripcion' => utf8_encode($sqlTrabajos[0]['descripcion']),
            'imagen_header' => utf8_encode($sqlTrabajos[0]['imagen_header']),
            'imagenes' => $imagenes,
        );
        return $data;
    }

}
