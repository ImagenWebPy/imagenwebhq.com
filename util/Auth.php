<?php

/**
 * 
 */
class Auth {

    public static function handleLogin($url = NULL) {
        @session_start();
        $lng = 'en';
        if (!empty($_GET['URL'][0])) {
            if ($_GET['URL'][0] != 'index.php') {
                $lng = $_GET['URL'][0];
            }
        }
        $logged = (!empty($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : '');
        if (empty($logged)) {
            //session_destroy();
            if (!isset($_SESSION['urlAnterior'])) {
                Session::set('urlAnterior', array(
                    'url' => NULL
                ));
            }
            if (!empty($url)) {
                $_SESSION['urlAnterior']['url'] = $url;
            }
            header('location: ' . URL . $lng . '/login');
            exit();
        }
    }

    public function getUrl() {
        $url = '';
        if (!empty($_GET['url'])) {
            $url = $_GET['url'];
            $url = explode('/', $url);
        }
        return $url;
    }

}
