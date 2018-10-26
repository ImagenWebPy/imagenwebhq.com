<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $lng = $this->idioma;
        $this->view->idioma = $lng;
        $this->view->page = $this->page;

        $this->view->menu = $this->helper->cargar_menu($lng);
        $this->view->slider = $this->helper->cargar_slider($lng);
        $this->view->conocenos = $this->helper->cargar_conocenos($lng);
        $this->view->frases = $this->helper->cargar_frases($lng);
        $this->view->trabajos_encabezado = $this->helper->cargar_trabajosEncabezados($lng);
        
        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

}
