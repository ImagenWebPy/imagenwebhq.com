<?php

class Controller {

    public $helper = '';
    public $idioma = '';
    public $url = '';
    public $page = '';

    function __construct() {
        //echo 'Main controller<br />';
        $this->view = new View();
        $this->helper = new Helper;
        $this->url = $this->helper->getUrl();
        $lng = 'es';
        if (!empty($this->helper->getUrl()[0])) {
            if ($this->helper->getUrl()[0] != 'index.php') {
                $lng = $this->helper->getUrl()[0];
            }
        }
        $this->idioma = $lng;
        $page = $this->helper->getPage();
        $page = implode(',', $page);
        $this->page = $page;
    }

    /**
     * 
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {

        $path = $modelPath . $name . '_model.php';

        if (file_exists($path)) {
            require $modelPath . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

}
