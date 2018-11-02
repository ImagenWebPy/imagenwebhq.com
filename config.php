<?php

/**
 * ARCHIVO DE CONFIGURACIONES
 * @author "Raul Ramirez" <raul.chuky@gmail.com>
 * @version 1 2018-07-06
 */
// Always provide a TRAILING SLASH (/) AFTER A PATH
//header('Content-type: text/plain; charset=utf-8');
$host = getHost();
switch ($host) {
    case 'localhost':
        define('URL', 'http://localhost/imagenwebhq.com/');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'iweb');
        define('DB_HOST', 'localhost');
        break;
    case '192.168.1.89':
        define('URL', 'http://192.168.1.89/imagenwebhq.com/');
        define('DB_USER', 'root');
        define('DB_PASS', 'cThoNTJ0cy9tVU5lQ3JnTDgrbXZxdz09');
        define('DB_NAME', 'iweb');
        define('DB_HOST', 'localhost');
        break;
}
define('LIBS', 'libs/');

define('DB_TYPE', 'mysql');


// This is for database passwords only
define('HASH_PASSWORD_KEY', '!@123456789ABCDEFGHIJKLMNOPRSTWYZ[¿]{?}<->::abcdefghijklmnopqrstwyxz;');

//Constantes varias
define('SITE_TITLE', 'Imagen Web - ');
define('CANT_REG', 12);

define('KEY_FILE_LOCATION', 'public/json/');

function getHost() {
    $host = $_SERVER['HTTP_HOST'];
    return $host;
}
