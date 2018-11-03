<?php

class Blog_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function header($lng) {
        $sql = $this->db->select("SELECT
                                        imagen_header as imagen,
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_frase as frase
                                FROM
                                        `blog_header`
                                WHERE id = 1;");
        return $sql[0];
    }

    public function listado($lng, $pagina) {
        if (!empty($pagina)) {
            $page = $pagina;
        } else {
            $page = 1;
        }
        $setLimit = CANT_REG;
        $pageLimit = ($setLimit * $page) - $setLimit;
        $mas = 'Read More';
        if ($lng == 'es') {
            $sql = $this->db->select("SET lc_time_names = 'es_ES';");
            $mas = 'Leer Más';
        }
        $sql = $this->db->select("SELECT
                                        id,
                                        " . $lng . "_titulo as titulo,
                                        SUBSTR(" . $lng . "_contenido FROM 1 FOR 260) AS contenido,
                                        DATE_FORMAT(fecha_blog, '%d') AS fecha_dia,
                                        DATE_FORMAT(fecha_blog, '%M-%Y') AS fecha,
                                        imagen_thumb as thumb,
                                        imagen,
                                        youtube_id as video,
                                        " . $lng . "_tags as tags
                                FROM
                                        blog
                                WHERE
                                        estado = 1
                                ORDER BY
                                        fecha_blog DESC
                                 LIMIT $pageLimit, $setLimit;");
        $listado = array();
        $campo = $lng . '_titulo';
        foreach ($sql as $item) {
            $tags = explode(',', utf8_encode($item['tags']));
            $tag = '';
            foreach ($tags as $val) {
                $tag .= '<a href="#" rel="tag"><span>' . $val . '</span></a>,';
            }
            $tag = substr($tag, 0, -1);
            array_push($listado, array(
                'id' => $item['id'],
                'titulo' => utf8_encode($item['titulo']),
                'contenido' => strip_tags(utf8_encode($item['contenido'])) . '...',
                'tags' => $tag,
                'video' => utf8_encode($item['video']),
                'thumb' => utf8_encode($item['imagen']),
                'thumb' => utf8_encode($item['thumb']),
                'imagen' => utf8_encode($item['imagen']),
                'fecha_dia' => $item['fecha_dia'],
                'fecha' => $item['fecha'],
                'url' => $this->helper->armaUrl($item['id'], 'blog', $campo, $lng),
                'mas' => $mas
            ));
        }
        $data = array(
            'listado' => $listado,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $page, 'blog', 'blog/listado', $lng)
        );
        return $data;
    }

    public function post($lng, $id) {
        if ($lng == 'es') {
            $sql = $this->db->select("SET lc_time_names = 'es_ES';");
        }
        $sql = $this->db->select("SELECT
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_contenido as contenido,
                                        DATE_FORMAT(fecha_blog, '%d') AS fecha_dia,
                                        DATE_FORMAT(fecha_blog, '%M-%Y') AS fecha,
                                        imagen,
                                        youtube_id as video,
                                        " . $lng . "_tags as tags,
                                        imagen_header
                                FROM
                                        blog
                                WHERE
                                        id = $id");
        if (!empty($sql[0]['imagen_header'])) {
            $imagenHeader = utf8_encode($sql[0]['imagen_header']);
        } else {
            $cabecera = $this->dataHeader($lng);
            $imagenHeader = utf8_encode($cabecera['imagen_header']);
        }
        $data = array(
            'titulo' => utf8_encode($sql[0]['titulo']),
            'contenido' => utf8_encode($sql[0]['contenido']),
            'description' => substr(strip_tags(utf8_encode($sql[0]['contenido'])), 0, 300),
            'tags' => utf8_encode($sql[0]['tags']),
            'fecha_dia' => utf8_encode($sql[0]['fecha_dia']),
            'fecha' => utf8_encode($sql[0]['fecha']),
            'imagen' => utf8_encode($sql[0]['imagen']),
            'video' => utf8_encode($sql[0]['video']),
            'imagen_header' => $imagenHeader
        );
        return $data;
    }

    public function dataHeader($lng) {
        $sql = $this->db->select("SELECT imagen_header, " . $lng . "_header as titulo FROM blog_header;");
        return $sql[0];
    }

    public function resultadosBusquedas($datos) {
        if (!empty($datos['pagina'])) {
            $page = $datos['pagina'];
        } else {
            $page = 1;
        }
        $lng = $datos['lng'];
        $setLimit = CANT_REG;
        $pageLimit = ($setLimit * $page) - $setLimit;
        $busqueda = $datos['busqueda'];
        $mas = 'Read More';
        if ($lng == 'es') {
            $sql = $this->db->select("SET lc_time_names = 'es_ES';");
            $mas = 'Leer Más';
        }
        $sql = $this->db->select("select id,
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_contenido as contenido,
                                        " . $lng . "_tags as tags,
                                        imagen,
                                        youtube_id as video,
                                        imagen_header,
                                        DATE_FORMAT(fecha_blog, '%d') AS fecha_dia,
                                        DATE_FORMAT(fecha_blog, '%M-%Y') AS fecha
                                 from blog b 
                                 where 1 = 1
                                 AND (" . $lng . "_titulo like '%$busqueda%'
                                     OR " . $lng . "_contenido like '%$busqueda%')
                                 ORDER BY b.id desc 
                                 LIMIT $pageLimit, $setLimit");
        $condicion = "from blog b 
                    where 1 = 1
                    AND (" . $lng . "_titulo like '%$busqueda%'
                        OR " . $lng . "_contenido like '%$busqueda%')
                    ORDER BY b.id desc";
        $listado = array();
        $campo = $lng . '_titulo';
        foreach ($sql as $item) {
            $tags = explode(',', utf8_encode($item['tags']));
            $tag = '';
            foreach ($tags as $val) {
                $tag .= '<a href="#" rel="tag"><span>' . $val . '</span></a>,';
            }
            $tag = substr($tag, 0, -1);
            array_push($listado, array(
                'id' => $item['id'],
                'titulo' => utf8_encode($item['titulo']),
                'contenido' => utf8_encode($item['contenido']),
                'tags' => $tag,
                'video' => utf8_encode($item['video']),
                'imagen' => utf8_encode($item['imagen']),
                'fecha_dia' => utf8_encode($sql[0]['fecha_dia']),
                'fecha' => utf8_encode($sql[0]['fecha']),
                'url' => $this->helper->armaUrl($item['id'], 'blog', $campo, $lng),
                'mas' => $mas
            ));
        }
        #guardamos el dato buscado
        $ip = $this->helper->getReal_ip();
        $cantResultado = count($sql);
        $this->db->insert('blog_busquedas', array(
            'busqueda' => utf8_decode($busqueda),
            'ip' => $ip,
            'fecha' => date('Y-m-d H:i:s'),
            'cantidad' => $cantResultado
        ));
        $data = array(
            'listado' => $listado,
            'paginador' => $this->helper->mostrarPaginador($setLimit, $page, 'blog', 'blog/busqueda', $lng, $condicion)
        );
        return $data;
    }

}
