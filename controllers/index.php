<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $lng = $this->idioma;
        $this->view->idioma = $lng;
        $this->view->page = $this->page;
        $this->view->title = SITE_TITLE;
        $this->view->description = '';
        $this->view->keywords = '';

        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }

}
