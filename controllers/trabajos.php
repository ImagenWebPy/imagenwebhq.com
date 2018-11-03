<?php

class Trabajos extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function item() {
        $url = $this->url;

        $lng = $url[0];
        $id = $url[3];

        $this->view->idioma = $lng;
        $this->view->page = $this->page;

        $this->view->helper = $this->helper;
        $this->view->menu = $this->helper->cargar_menu($lng, 0);

        $this->view->datos_trabajo = $this->model->datos_trabajo($id, $lng);
        
        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('trabajos/index');
        $this->view->render('footer');
    }

}
