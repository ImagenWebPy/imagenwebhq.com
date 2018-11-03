<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $lng = $this->idioma;
        $this->view->idioma = $lng;
        $this->view->page = $this->page;

        $this->view->helper = $this->helper;
        $this->view->menu = $this->helper->cargar_menu($lng);
        
        $this->view->slider = $this->helper->cargar_slider($lng);
        $this->view->destacados = $this->helper->cargar_destacados($lng);
        $this->view->conocenos = $this->helper->cargar_conocenos($lng);
        $this->view->frases = $this->helper->cargar_frases($lng);
        $this->view->trabajos_encabezado = $this->helper->cargar_trabajosEncabezados($lng);
        $this->view->trabajos = $this->helper->cargar_trabajos($lng);
        $this->view->loquehacemos_encabezado = $this->helper->cargar_loquehacemosEncabezados($lng);
        $this->view->loquehacemos = $this->helper->cargar_loquehacemos($lng);
        $this->view->elproceso_encabezado = $this->helper->cargar_elprocesoEncabezados($lng);
        $this->view->elproceso = $this->helper->cargar_elproceso($lng);
        $this->view->parallax = $this->helper->parallax($lng);
        $this->view->blog_encabezado = $this->helper->cargar_blogEncabezado($lng);
        $this->view->blog = $this->helper->cargar_blog($lng);
        $this->view->newsletter = $this->helper->cargar_newsletter($lng);
        $this->view->contacto = $this->helper->cargar_contacto($lng);
        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

}
