<?php

class Blog extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function listado() {
        /* CONTENIDO OBLIGATORIO PARA CADA VISTA */
        $url = $this->url;

        $lng = $url[0];

        $this->view->idioma = $lng;
        $this->view->page = $this->page;

        if (!empty($url[3])) {
            $pagina = $url[3];
        } else {
            $pagina = 1;
        }

        $this->view->helper = $this->helper;
        $this->view->menu = $this->helper->cargar_menu($lng, 0);
        $this->view->listado = $this->model->listado($lng, $pagina);

        $this->view->datos_encabezado = $this->model->datos_encabezado($lng);
        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('blog/listado');
        $this->view->render('footer');
    }

    public function post() {
        /* CONTENIDO OBLIGATORIO PARA CADA VISTA */
        $url = $this->url;

        $lng = $url[0];
        $id = $url[3];

        $this->view->idioma = $lng;
        $this->view->page = $this->page;

        $this->view->helper = $this->helper;
        $this->view->menu = $this->helper->cargar_menu($lng, 0);
        /* FIN CONTENIDO OBLIGATORIO PARA CADA VISTA */

        $id = $url[3];
        $this->view->post = $this->model->post($lng, $id);

        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('blog/post');
        $this->view->render('footer');
    }

    public function busqueda() {

        /* CONTENIDO OBLIGATORIO PARA CADA VISTA */
        $url = $this->url;
        $lng = $url[0];
        $metas = $this->helper->getMetaTags($lng, $url);
        $this->view->idioma = $lng;
        $this->view->page = $this->page;
        $this->view->logos = $this->helper->getLogos();
        $this->view->menu = $this->helper->cargarMenu($lng);
        $this->view->redes = $this->helper->cargarRedesSociales();
        $this->view->datos = $this->helper->obtenerDatos($lng);
        $this->view->datosContacto = $this->helper->getDatosContacto();
        $this->view->footerProductos = $this->helper->footerProductos($lng);
        $this->view->footerServicios = $this->helper->footerServicios($lng);
        $this->view->title = SITE_TITLE . $metas['title'];
        $this->view->description = $metas['description'];
        $this->view->keywords = $metas['keywords'];
        $this->view->template = $this->helper->getTemplate();
        $this->view->footerBackground = $this->helper->footerBackground();
        $this->view->helper = $this->helper;
        /* FIN CONTENIDO OBLIGATORIO PARA CADA VISTA */

        if (!empty($url[3])) {
            $pagina = $url[3];
        } else {
            $pagina = 1;
        }
        $datos = array(
            'lng' => $lng,
            'busqueda' => (!empty($_POST['busqueda'])) ? $this->helper->cleanInput($_POST['busqueda']) : NULL,
            'pagina' => $pagina
        );
        $this->view->header = $this->model->header($lng);
        $this->view->resultadosBusquedas = $this->model->resultadosBusquedas($datos);

        $this->view->render('header');
        $this->view->render('blog/busqueda');
        $this->view->render('footer');
    }

}
