<?php

#conexion a la BD
require 'libs/Database.php';

class Helper {

    private $idioma = '';

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $lng = 'en';
        if (!empty($this->getUrl()[0])) {
            if ($this->getUrl()[0] != 'index.php') {
                $lng = $this->getUrl()[0];
            }
        }
        $this->idioma = $lng;
    }

    /**
     * Funcion para limpiar un string
     * @param strig $String a quitar caracteres especiales y espacios
     * @return string formateado
     */
    public function cleanUrl($String) {
        $String = str_replace(array('á', 'à', 'â', 'ã', 'ª', 'ä'), "a", $String);
        $String = str_replace(array('Á', 'À', 'Â', 'Ã', 'Ä'), "A", $String);
        $String = str_replace(array('Í', 'Ì', 'Î', 'Ï'), "I", $String);
        $String = str_replace(array('í', 'ì', 'î', 'ï'), "i", $String);
        $String = str_replace(array('é', 'è', 'ê', 'ë'), "e", $String);
        $String = str_replace(array('É', 'È', 'Ê', 'Ë'), "E", $String);
        $String = str_replace(array('ó', 'ò', 'ô', 'õ', 'ö', 'º'), "o", $String);
        $String = str_replace(array('Ó', 'Ò', 'Ô', 'Õ', 'Ö'), "O", $String);
        $String = str_replace(array('ú', 'ù', 'û', 'ü'), "u", $String);
        $String = str_replace(array('Ú', 'Ù', 'Û', 'Ü'), "U", $String);
        $String = str_replace(array('?', '[', '^', '´', '`', '¨', '~', ']', '¿', '!', '¡'), "", $String);
        $String = str_replace("ç", "c", $String);
        $String = str_replace("Ç", "C", $String);
        $String = str_replace("ñ", "n", $String);
        $String = str_replace("Ñ", "N", $String);
        $String = str_replace("Ý", "Y", $String);
        $String = str_replace("ý", "y", $String);
        $String = str_replace("(", "_", $String);
        $String = str_replace(")", "_", $String);

        $String = str_replace("'", "", $String);
        //$String = str_replace(".", "_", $String);
        $String = str_replace("#", "_", $String);
        $String = str_replace(" ", "_", $String);
        $String = str_replace("/", "_", $String);

        $String = str_replace("&aacute;", "a", $String);
        $String = str_replace("&Aacute;", "A", $String);
        $String = str_replace("&eacute;", "e", $String);
        $String = str_replace("&Eacute;", "E", $String);
        $String = str_replace("&iacute;", "i", $String);
        $String = str_replace("&Iacute;", "I", $String);
        $String = str_replace("&oacute;", "o", $String);
        $String = str_replace("&Oacute;", "O", $String);
        $String = str_replace("&uacute;", "u", $String);
        $String = str_replace("&Uacute;", "U", $String);
        return $String;
    }

    /**
     * Funcion para limpiar un input antes de enviarlo por post
     * @param type $data
     * @return type
     */
    public function cleanInput($data) {
        $data = trim($data);
        $data = str_replace("'", "\'", $data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        return $data;
    }

    /**
     * Funcion para mostrar mensajes de alerta
     * @param string $type (success - info - warning - error)
     * @param string $message (mensaje a mostrar)
     * @return string
     */
    public function messageAlert($type, $message) {
        $alert = "";
        switch ($type) {
            case 'success':
                $alert .= '<div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'info':
                $alert .= '<div class="alert alert-info" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'warning':
                $alert .= '<div class="alert alert-warning" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
            case 'error':
                $alert .= '<div class="alert alert-danger" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            ' . $message . '
                        </div>';
                break;
        }
        return $alert;
    }

    /**
     * 
     * @return string url anterior del sitio
     */
    public function getUrlAnterior() {
        $url = (!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
        return $url;
    }

    /**
     * Funcion que retorna la url actual en forma de array
     * @return array url
     */
    public function getUrl() {
        $url = '';
        if (!empty($_GET['url'])) {
            $url = $_GET['url'];
            $url = explode('/', $url);
        }
        return $url;
    }

    /**
     * Funcion que lista las opciones del campo enum de una tabla
     * @param string $table
     * @param string $field
     * @return array con las opciones del campo enum
     */
    public function getEnumOptions($table, $field) {
        $finalResult = array();
        if (strlen(trim($table)) < 1)
            return false;
        $query = $this->db->select("show columns from $table");
        foreach ($query as $row) {
            if ($field != $row["Field"])
                continue;
//check if enum type 
            if (preg_match('/enum.(.*)./', $row['Type'], $match)) {
                $opts = explode(',', $match[1]);
                foreach ($opts as $item)
                    $finalResult[] = substr($item, 1, strlen($item) - 2);
            } else
                return false;
        }
        return $finalResult;
    }

    /**
     * Funcion para obtener las paginas donde nos encontramos
     * @return array
     */
    public function getPage() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $pagina = (explode('/', $url));
        return $pagina;
    }

    /**
     * Devuelve la ip del visitante
     * @return string IP
     */
    public function getReal_ip() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * 
     * @param int $per_page
     * @param int $page
     * @param string $table (tabla a obtener el maximo de registros)
     * @param string $section (ruta del mvc a paginar)
     * @return string
     */
    public function mostrarPaginador($per_page, $page, $table, $section, $lng, $condicion = NULL) {
        if (!empty($condicion)) {
            $query = $this->db->select("SELECT COUNT(*) as totalCount $condicion");
        } else {
            $query = $this->db->select("SELECT COUNT(*) as totalCount FROM $table where estado = 1");
        }
        $total = $query[0]['totalCount'];
        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;
        $setLastpage = ceil($total / $per_page);
        $lpm1 = $setLastpage - 1;

        $paging = "";
        if ($setLastpage > 1) {
            $paging .= "<ul class='pagination'>";
            $paging .= "<li class='active'>Página $page de $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {
                    if ($counter == $page)
                        $paging .= "<li class='active'><a href='#'>$counter</a></li>";
                    else
                        $paging .= '<li><a href="' . URL . $lng . '/' . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $paging .= '<li class="active"><a href="#">' . $counter . '</a></li>';
                        else
                            $paging .= '<li><a  href="' . URL . $lng . '/' . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                    $paging .= "<li class='dot'>...</li>";
                    $paging .= '<li><a  href="' . URL . $lng . '/' . $section . '/' . $lpm1 . '" data-size="small" data-color="secondary" data-border>' . $lpm1 . '</a></li>';
                    $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>' . $setLastpage . '</a></li>';
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/1' . '" data-size="small" data-color="secondary" data-border>1</a></li>';
                    $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/2' . '" data-size="small" data-color="secondary" data-border>2</a></li>';
                    $paging .= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $paging .= "<li class='active'><a href='#'>$counter</a></li>"
                            ;
                        else
                            $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                    $paging .= "<li class='dot'>..</li>";
                    $paging .= '<li><a  href="' . URL . $lng . '/' . $section . '/' . $lpm1 . '" data-size="small" data-color="secondary" data-border>' . $lpm1 . '</a></li>';
                    $paging .= '<li><a  href="' . URL . $lng . '/' . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>' . $setLastpage . '</a></li>';
                }
                else {
                    $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/1' . '" data-size="small" data-color="secondary" data-border>1</a></li>';
                    $paging .= '<li><a  href ="' . URL . $lng . '/' . $section . '/2' . '" data-size="small" data-color="secondary" data-border>2</a></li>';
                    $paging .= "<li class = 'dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $paging .= "<li class='active'><a href='#'>$counter</a></li>"
                            ;
                        else
                            $paging .= '<li><a  href="' . URL . $lng . '/' . $section . '/' . $counter . '" data-size="small" data-color="secondary" data-border>' . $counter . '</a></li>';
                    }
                }
            }

            if ($page < $counter - 1) {
                $paging .= '<li><a href="' . URL . $lng . '/' . $section . '/' . $next . '" data-size="small" data-color="secondary" data-border >Siguiente</a></li>';
                $paging .= '<li><a href="' . URL . $lng . '/' . $section . '/' . $setLastpage . '" data-size="small" data-color="secondary" data-border>Ultima</a></li>';
            } else {
                $paging .= "<li class='active'><a href='#'>Siguiente</a></li>";
                $paging .= "<li class='active'><a href='#'>Ultima</a></li>";
            }

            $paging .= "</ul>";
        }

        return $paging;
    }

    function redimensionar($file, $nameFile, $ancho, $alto, $serverdir) {
        # se obtene la dimension y tipo de imagen 
        $datos = getimagesize($file);

        $ancho_orig = $datos[0]; # Anchura de la imagen original 
        $alto_orig = $datos[1];    # Altura de la imagen original 
        $tipo = $datos[2];

        if ($tipo == 1) { # GIF 
            if (function_exists("imagecreatefromgif"))
                $img = imagecreatefromgif($file);
            else
                return false;
        }
        else if ($tipo == 2) { # JPG 
            if (function_exists("imagecreatefromjpeg"))
                $img = imagecreatefromjpeg($file);
            else
                return false;
        }
        else if ($tipo == 3) { # PNG 
            if (function_exists("imagecreatefrompng"))
                $img = imagecreatefrompng($file);
            else
                return false;
        }

        # Se calculan las nuevas dimensiones de la imagen 
        if ($ancho_orig > $alto_orig) {
            $ancho_dest = $ancho;
            $alto_dest = ($ancho_dest / $ancho_orig) * $alto_orig;
        } else {
            $alto_dest = $alto;
            $ancho_dest = ($alto_dest / $alto_orig) * $ancho_orig;
        }

        // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        $img2 = @imagecreatetruecolor($ancho_dest, $alto_dest) or $img2 = imagecreate($ancho_dest, $alto_dest);

        // Redimensionar 
        // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        @imagecopyresampled($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig) or imagecopyresized($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig);

        // Crear fichero nuevo, según extensión. 
        if ($tipo == 1) // GIF 
            if (function_exists("imagegif"))
                imagegif($img2, $serverdir . $nameFile, 60);
            else
                return false;

        if ($tipo == 2) // JPG 
            if (function_exists("imagejpeg"))
                imagejpeg($img2, $serverdir . $nameFile, 60);
            else
                return false;

        if ($tipo == 3)  // PNG 
            if (function_exists("imagepng"))
                imagepng($img2, $serverdir . $nameFile, 6);
            else
                return false;

        return true;
    }

    /**
     * Funcion que envia un correo a travez de la funcion mail de PHP.
     * @param string $para
     * @param string $asunto
     * @param string $mensaje
     * @param string $cc
     */
    public function sendMail($para, $asunto, $mensaje, $cc = NULL) {
        $page = $this->getHost();
        #Libreria para enviar mails
        require 'util/mailer/vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->CharSet = "UTF-8";
        if (($page == 'localhost') || ($page == '192.168.1.89')) {
            $mail->isSMTP();
        }
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'servidor@cadiem.com.py';
        $mail->Password = 'servi4926*';
        $mail->SetFrom('servidor@cadiem.com.py', 'Servidor - CADIEM Casa de Bolsa S.A.');
        $mail->AddAddress($para, $para);
        //$mail->SMTPDebug = 2;
        if ($cc == 1) {
            $mail->AddCC($cc_para, $cc_para);
            $mail->addReplyTo($cc_para, $cc_para);
        }
        $mail->IsHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->AltBody = $mensaje;

        if (!$mail->send()) {

            $estadomail = $mail->ErrorInfo;
        } else {

            $estadomail = 'OK';
        }
    }

    public function sendMailPhp($para, $asunto, $mensaje, $cc = NULL) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: CADIEM Fondos <atc@cadiemfondos.com.py>' . "\r\n";
        if (!empty($cc))
            $headers .= 'Bcc:' . $emailAsesor . "\r\n";
        $headers .= 'Reply-To: atc@cadiemfondos.com.py' . "\r\n";
        mail($para, $asunto, $mensaje, $headers);
    }

    /**
     * Ver http://php.net/manual/es/function.date.php para mas información sobre los formatos de fecha.
     * @param string $format
     * @param type $month (Nombre abreviado o completo del mes en ingles de acuerdo al formato elegido)
     * @return string
     */
    public function TranslateDate($format, $month, $language = 'es') {
        $mes = '';
        switch ($format) {
            case 'F':
                switch ($month) {
                    case 'January':
                        $mes = 'Enero';
                        break;
                    case 'February':
                        $mes = 'Febrero';
                        break;
                    case 'March':
                        $mes = 'Marzo';
                        break;
                    case 'April':
                        $mes = 'Abril';
                        break;
                    case 'May':
                        $mes = 'Mayo';
                        break;
                    case 'June':
                        $mes = 'Junio';
                        break;
                    case 'July':
                        $mes = 'Julio';
                        break;
                    case 'August':
                        $mes = 'Agosto';
                        break;
                    case 'September':
                        $mes = 'Septiembre';
                        break;
                    case 'October':
                        $mes = 'Octubre';
                        break;
                    case 'November':
                        $mes = 'Noviembre';
                        break;
                    case 'December':
                        $mes = 'Diciembre';
                        break;
                }
                break;
            case 'M':
                switch ($language) {
                    case 'es':
                        switch ($month) {
                            case 'Jan':
                                $mes = 'Ene';
                                break;
                            case 'Feb':
                                $mes = 'Feb';
                                break;
                            case 'Mar':
                                $mes = 'Mar';
                                break;
                            case 'Apr':
                                $mes = 'Abr';
                                break;
                            case 'May':
                                $mes = 'May';
                                break;
                            case 'Jun':
                                $mes = 'Jun';
                                break;
                            case 'Jul':
                                $mes = 'Jul';
                                break;
                            case 'Aug':
                                $mes = 'Ago';
                                break;
                            case 'Sept':
                                $mes = 'Set';
                                break;
                            case 'Sep':
                                $mes = 'Set';
                                break;
                            case 'Oct':
                                $mes = 'Oct';
                                break;
                            case 'Nov':
                                $mes = 'Nov';
                                break;
                            case 'Dec':
                                $mes = 'Dic';
                                break;
                        }
                        break;
                    case 'en':
                        switch ($month) {
                            case 'Ene':
                                $mes = 'Jan';
                                break;
                            case 'Feb':
                                $mes = 'Feb';
                                break;
                            case 'Mar':
                                $mes = 'Mar';
                                break;
                            case 'Abr':
                                $mes = 'Apr';
                                break;
                            case 'May':
                                $mes = 'May';
                                break;
                            case 'Jun':
                                $mes = 'Jun';
                                break;
                            case 'Jul':
                                $mes = 'Jul';
                                break;
                            case 'Ago':
                                $mes = 'Aug';
                                break;
                            case 'Set':
                                $mes = 'Sept';
                                break;
                            case 'Set':
                                $mes = 'Sep';
                                break;
                            case 'Oct':
                                $mes = 'Oct';
                                break;
                            case 'Nov':
                                $mes = 'Nov';
                                break;
                            case 'Dic':
                                $mes = 'Dec';
                                break;
                        }
                        break;
                }
                break;
        }
        return $mes;
    }

    /**
     * Funcion que retorna un string aleatorio
     * @param string $type ('numerico','alfanumerico','especial')
     * @param int $length
     * @return string
     */
    public function generateRandomString($type, $length = 10) {
        switch ($type) {
            case 'numerico':
                $characters = '0123456789';
                break;
            case 'alfanumerico':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'especial':
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-{}[],.;¿?!¡';
                break;
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Encrypt and decrypt
     * 
     * @author Nazmul Ahsan <n.mukto@gmail.com>
     * @link http://nazmulahsan.me/simple-two-way-function-encrypt-decrypt-string/
     *
     * @param string $string string to be encrypted/decrypted
     * @param string $action what to do with this? e for encrypt, d for decrypt
     */
    function encrypt($string, $action = 'e') {
        $secret_key = '!@123456789ABCDEFGHIJKLMNOPRSTWYZ[¿]{?}<->';
        $secret_iv = '12345678910AABBCCDDEEFFGG';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if (!empty($string)) {
            if ($action == 'e') {
                $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
            } else if ($action == 'd') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        } else {
            $output = '';
        }
        return $output;
    }

    public function simple_php_captcha($config = array()) {
        // Check for GD library
        if (!function_exists('gd_info')) {
            throw new Exception('Required GD library is missing');
        }

        $bg_path = URL . 'public/captcha/backgrounds/';
        $font_path = URL . 'public/captcha/fonts/';
        // Default values
        $captcha_config = array(
            'code' => '',
            'min_length' => 5,
            'max_length' => 5,
            'backgrounds' => array(
                $bg_path . '45-degree-fabric.png',
                $bg_path . 'cloth-alike.png',
                $bg_path . 'grey-sandbag.png',
                $bg_path . 'kinda-jean.png',
                $bg_path . 'polyester-lite.png',
                $bg_path . 'stitched-wool.png',
                $bg_path . 'white-carbon.png',
                $bg_path . 'white-wave.png'
            ),
            'fonts' => array(
                $font_path . 'times_new_yorker.ttf'
            ),
            'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
            'min_font_size' => 28,
            'max_font_size' => 28,
            'color' => '#666',
            'angle_min' => 0,
            'angle_max' => 10,
            'shadow' => true,
            'shadow_color' => '#fff',
            'shadow_offset_x' => -1,
            'shadow_offset_y' => 1
        );

        // Overwrite defaults with custom config values
        if (is_array($config)) {
            foreach ($config as $key => $value)
                $captcha_config[$key] = $value;
        }

        // Restrict certain values
        if ($captcha_config['min_length'] < 1)
            $captcha_config['min_length'] = 1;
        if ($captcha_config['angle_min'] < 0)
            $captcha_config['angle_min'] = 0;
        if ($captcha_config['angle_max'] > 10)
            $captcha_config['angle_max'] = 10;
        if ($captcha_config['angle_max'] < $captcha_config['angle_min'])
            $captcha_config['angle_max'] = $captcha_config['angle_min'];
        if ($captcha_config['min_font_size'] < 10)
            $captcha_config['min_font_size'] = 10;
        if ($captcha_config['max_font_size'] < $captcha_config['min_font_size'])
            $captcha_config['max_font_size'] = $captcha_config['min_font_size'];

        // Generate CAPTCHA code if not set by user
        if (empty($captcha_config['code'])) {
            $captcha_config['code'] = '';
            $length = mt_rand($captcha_config['min_length'], $captcha_config['max_length']);
            while (strlen($captcha_config['code']) < $length) {
                $captcha_config['code'] .= substr($captcha_config['characters'], mt_rand() % (strlen($captcha_config['characters'])), 1);
            }
        }

        // Generate HTML for image src
        if (strpos($_SERVER['SCRIPT_FILENAME'], $_SERVER['DOCUMENT_ROOT'])) {
            $image_src = substr(__FILE__, strlen(realpath($_SERVER['DOCUMENT_ROOT']))) . '?_CAPTCHA&amp;t=' . urlencode(microtime());
            $image_src = '/' . ltrim(preg_replace('/\\\\/', '/', $image_src), '/');
        } else {
            $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);
            $image_src = substr(__FILE__, strlen(realpath($_SERVER['WEB_ROOT']))) . '?_CAPTCHA&amp;t=' . urlencode(microtime());
            $image_src = '/' . ltrim(preg_replace('/\\\\/', '/', $image_src), '/');
        }

        $_SESSION['_CAPTCHA']['config'] = serialize($captcha_config);

        return array(
            'code' => $captcha_config['code'],
            'image_src' => $image_src
        );
    }

    private function hex2rgb($hex_str, $return_string = false, $separator = ',') {
        $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str); // Gets a proper hex string
        $rgb_array = array();
        if (strlen($hex_str) == 6) {
            $color_val = hexdec($hex_str);
            $rgb_array['r'] = 0xFF & ($color_val >> 0x10);
            $rgb_array['g'] = 0xFF & ($color_val >> 0x8);
            $rgb_array['b'] = 0xFF & $color_val;
        } elseif (strlen($hex_str) == 3) {
            $rgb_array['r'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
            $rgb_array['g'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
            $rgb_array['b'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
        } else {
            return false;
        }
        return $return_string ? implode($separator, $rgb_array) : $rgb_array;
    }

    /**
     * Funcion que obtiene el host desde donde se este ejecutando el script
     * @return string
     */
    public function getHost() {
        $host = $_SERVER['HTTP_HOST'];
        return $host;
    }

    /*     * ***************************
     * FUNCIONES DEL INERENTES AL SITIO
     * ****************************** */

    public function urlInicio($lng) {
        $url = URL . 'en/';
        if ($lng === 'es') {
            $url = URL . 'es/';
        }
        return $url;
    }

    public function Breadcrumbs($url) {
        $controlador = $url[1];
        $sqlMenuInicio = $this->db->select("select " . $this->idioma . "_texto from menu where controlador = '/'");
        if ($controlador != 'pagina') {
            $sqlControlador = $this->db->select("select controlador, metodo, " . $this->idioma . "_texto from menu where controlador = '$controlador'");
            $seccion = utf8_encode($sqlControlador[0][$this->idioma . '_texto']);
        } else {
            $idPagina = $url[3];
            $sqlControlador = $this->db->select("select m.controlador, m.metodo, m." . $this->idioma . "_texto from menu m
                                                LEFT JOIN pagina p on p.id_menu = m.id where p.id = '$idPagina'");
            $seccion = utf8_encode($sqlControlador[0][$this->idioma . '_texto']);
        }
        $data = '<div id="Breadcrumbs">
                    <div class="container">
                        <div class="column one">
                            <ul class="breadcrumbs">
                                <li class="home"><i class="fa fa-home"></i><a href="' . $this->urlInicio($this->idioma) . '">' . utf8_encode($sqlMenuInicio[0][$this->idioma . '_texto']) . '</a><span><i class="fa fa-angle-right"></i></span></li>
                                <li><a href="#">' . $seccion . '</a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
        return $data;
    }

    public function cargarMenu($idioma) {
        $lng = $idioma;
        $sql = $this->db->select("SELECT id, id_padre, " . $lng . "_texto, controlador, metodo, funcion from menu where estado = 1 ORDER BY orden ASC");
        $menu = '<ul id="megaUber" class="megaMenu">';

        $sqlProductos = $this->db->select("SELECT
                                                                id,
                                                                " . $lng . "_nombre as nombre
                                                        FROM
                                                                productos
                                                        WHERE
                                                                estado = 1
                                                        ORDER BY
                                                                orden ASC;");
        #para el menu de certificaciones
        $sqlCertificaciones = $this->db->select("SELECT
                                                        id,
                                                        " . $lng . "_menu as menu
                                                FROM
                                                        certificaciones
                                                WHERE
                                                        estado = 1
                                                ORDER BY
                                                        orden ASC");
        #para el menu de logistica
        $sqlLogistica = $this->db->select("SELECT
                                                        id,
                                                        " . $lng . "_menu as menu
                                                FROM
                                                        logistica
                                                WHERE
                                                        estado = 1
                                                ORDER BY
                                                        orden ASC");
        foreach ($sql as $item) {
            $controlador = str_replace('/', '', $item['controlador']);
            $url = '#';
            if (($controlador != 'products') && ($controlador != 'certifications') && ($controlador != 'logistics')) {
                $metodo = '';
                if ($item['metodo'] != 'index') {
                    $metodo = $item['metodo'] . '/';
                }
                if ($controlador != 'pagina') {
                    $url = $this->urlInicio($lng) . $controlador . '/' . $metodo;
                } else {
                    $sqlPagina = $this->db->select("SELECT id FROM `pagina` where id_menu = " . $item['id']);
                    $url = $this->urlInicio($lng) . 'pagina/contenido/' . $sqlPagina[0]['id'] . '/' . $this->cleanUrl($item[$lng . '_texto']);
                }
            }
            $classSubMenu = '';
            switch ($item['controlador']) {
                case 'products':
                    $classSubMenu = 'current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children mega-with-sub ss-nav-menu-item-0 ss-nav-menu-item-depth-0 ss-nav-menu-reg um-flyout-align-center';
                    break;
                case 'certifications':
                    $classSubMenu = 'current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children mega-with-sub ss-nav-menu-item-0 ss-nav-menu-item-depth-0 ss-nav-menu-reg um-flyout-align-center';
                    break;
                case 'logistics':
                    $classSubMenu = 'current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children mega-with-sub ss-nav-menu-item-0 ss-nav-menu-item-depth-0 ss-nav-menu-reg um-flyout-align-center';
                    break;
            }
            $menu .= '  <li class="menu-item ' . $classSubMenu . '"><a href="' . $url . '"><span class="wpmega-link-title">' . utf8_encode($item[$lng . '_texto']) . '</span></a>';
            switch ($item['controlador']) {
                case 'products':
                    $menu .= '<ul class="sub-menu sub-menu-1">';
                    foreach ($sqlProductos as $producto) {
                        $menu .= '<li class="menu-item ss-nav-menu-item-depth-1"><a href="' . $this->urlInicio($lng) . 'products/product/' . $producto['id'] . '/' . $this->cleanUrl(utf8_encode($producto['nombre'])) . '"><span class="wpmega-link-title"> ' . utf8_encode($producto['nombre']) . '</span></a></li>';
                    }
                    $menu .= '</ul>';
                    break;
                case 'certifications':
                    $menu .= '<ul class="sub-menu sub-menu-1">';
                    foreach ($sqlCertificaciones as $certificacion) {
                        $menu .= '<li class="menu-item ss-nav-menu-item-depth-1"><a href="' . $this->urlInicio($lng) . 'certifications/certification/' . $certificacion['id'] . '/' . $this->cleanUrl(utf8_encode($certificacion['menu'])) . '"><span class="wpmega-link-title"> ' . utf8_encode($certificacion['menu']) . '</span></a></li>';
                    }
                    $menu .= '</ul>';
                    break;
                case 'logistics':
                    $menu .= '<ul class="sub-menu sub-menu-1">';
                    foreach ($sqlLogistica as $logistica) {
                        $menu .= '<li class="menu-item ss-nav-menu-item-depth-1"><a href="' . $this->urlInicio($lng) . 'logistics/logistic/' . $logistica['id'] . '/' . $this->cleanUrl(utf8_encode($logistica['menu'])) . '"><span class="wpmega-link-title"> ' . utf8_encode($logistica['menu']) . '</span></a></li>';
                    }
                    $menu .= '</ul>';
                    break;
            }
            $menu .= '</li>';
        }
        $menu .= '   </ul>';
        return $menu;
    }

    public function cargarRedesSociales() {
        $sql = $this->db->select("SELECT descripcion, fontawesome, url FROM `redes` where estado = 1 ORDER BY orden ASC");
        $div = '<div class="social">
                    <ul>';
        foreach ($sql as $item) {
            $div .= '   <li class="' . strtolower(utf8_encode($item['descripcion'])) . '"><a target="_blank" href="' . $item['url'] . '" title="' . utf8_encode($item['descripcion']) . '"><i class="' . $item['fontawesome'] . ' redes-icon" aria-hidden="true"></i></a></li>';
        }
        $div .= '   </ul>
                </div>';
        return $div;
    }

    public function cargarCertificacionesPie($lng) {
        $sql = $this->db->select("SELECT
                                        id,
                                        " . $lng . "_menu as menu,
                                        img_certificacion
                                FROM
                                        certificaciones
                                WHERE
                                        estado = 1
                                ORDER BY
                                        orden ASC");
        $li = '<ul>';
        foreach ($sql as $item) {
            $li .= '<li>
                        <div class="slide-wrapper">
                            <a href="' . $this->urlInicio($lng) . 'certifications/certification/' . $item['id'] . '/' . $this->cleanUrl(utf8_encode($item['menu'])) . '" title="' . utf8_encode($item['menu']) . '"><img width="200" height="65" src="' . URL . 'public/images/certificaciones/' . utf8_encode($item['img_certificacion']) . '" class="scale-with-grid wp-post-image img-footer-certification" alt="' . utf8_encode($item['menu']) . '"/></a>
                        </div>
                    </li>';
        }
        $li .= '</ul>';
        return $li;
    }

    public function getMetaTags($lng, $controlador) {
        $data = array();
        if (!empty($controlador[1])) {
            $controller = $controlador[1];
        } else {
            $controller = '/';
        }
        $sql = $this->db->select("SELECT mt." . $lng . "_descripcion as description,
                                        mt." . $lng . "_keywords as keywords,
                                        mt." . $lng . "_title as title
                                FROM menu m
                                LEFT JOIN meta_tags mt on mt.id_menu = m.id
                                where m.controlador = '" . $controller . "'");
        $data = array(
            'description' => utf8_encode($sql[0]['description']),
            'keywords' => utf8_encode($sql[0]['keywords']),
            'title' => utf8_encode($sql[0]['title'])
        );
        return $data;
    }

    public function footer_content($lng) {
        $textoMenuNosotros = $this->db->select("select " . $lng . "_texto as texto from menu where id = 2");
        $aboutus = $this->db->select("SELECT " . $lng . "_contenido as contenido FROM nosotros where id = 1;");
        $textoFooter = $this->db->select("SELECT " . $lng . "_footer as texto from blog_header where id = 1");
        $ultimasEntradas = $this->db->select("SELECT
                                                    id,
                                                    " . $lng . "_titulo as titulo
                                            FROM
                                                    blog
                                            WHERE
                                                    estado = 1
                                            ORDER BY
                                                    fecha_blog DESC
                                            LIMIT 3");
        $data = array(
            'titulo_nosotros' => utf8_encode($textoMenuNosotros[0]['texto']),
            'nosotros' => substr(strip_tags(utf8_encode($aboutus[0]['contenido'])), 0, 300),
            'titulo_blog' => utf8_encode($textoFooter[0]['texto']),
            'entradas' => $ultimasEntradas
        );
        return $data;
    }

    public function getDirecciones() {
        $sql = $this->db->select("SELECT
                                        direccion,
                                        ciudad,
                                        pais,
                                        telefono,
                                        email,
                                        latitud,
                                        longitud,
                                        zoom,
                                        mappin
                                FROM
                                        datos_contacto
                                WHERE
                                        id = 1");
        return $sql[0];
    }

    public function cargarSlider($lng) {
        $sql = $this->db->select("SELECT
                                        imagen,
                                        " . $lng . "_texto1 as texto1,
                                        " . $lng . "_texto2 as texto2,
                                        " . $lng . "_boton as boton,
                                        data_x_1,
                                        data_x_2,
                                        data_y_1,
                                        data_y_2,
                                        data_speed_1,
                                        data_speed_2,
                                        data_start_1,
                                        data_start_2,
                                        boton_x,
                                        boton_y,
                                        boton_speed,
                                        boton_start,
                                        " . $lng . "_url as url
                                FROM
                                        slider
                                WHERE
                                        estado = 1
                                ORDER BY
                                        orden ASC");
        return $sql;
    }

    public function cargarSeccion1($lng) {
        $sql = $this->db->select("SELECT
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_contenido as contenido,
                                        estado
                                FROM
                                        index_seccion1
                                WHERE
                                        id = 1
                                AND estado = 1");
        return (!empty($sql)) ? $sql[0] : NULL;
    }

    public function cargarSeccion2($lng) {
        $sql = $this->db->select("SELECT
                                        imagen,
                                        " . $lng . "_contenido as contenido,
                                        " . $lng . "_boton as boton,
                                        " . $lng . "_url as url
                                FROM
                                        index_seccion2
                                WHERE
                                        id = 1
                                AND estado = 1");
        return (!empty($sql)) ? $sql[0] : NULL;
    }

    public function cargarSeccion3($lng) {
        $sql = $this->db->select("SELECT
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_contenido as contenido,
                                        imagen
                                FROM
                                        index_seccion3
                                WHERE
                                        id = 1
                                AND estado = 1");
        return (!empty($sql)) ? $sql[0] : NULL;
    }

    public function cargarSeccion4($lng) {
        $sql = $this->db->select("SELECT
                                        " . $lng . "_titulo as titulo,
                                        " . $lng . "_contenido as contenido,
                                        id_video_youtube as video
                                FROM
                                        index_seccion4
                                WHERE
                                        id = 1
                                AND estado = 1");
        return (!empty($sql)) ? $sql[0] : NULL;
    }

    public function cargarSeccion5($lng) {
        $sql = $this->db->select("SELECT
                                        " . $lng . "_titulo as titulo,
                                        imagen
                                FROM
                                        index_seccion5
                                WHERE
                                        id = 1
                                AND estado = 1");
        return (!empty($sql)) ? $sql[0] : NULL;
    }

    public function cargarSeccion5_items($lng) {
        $sql = $this->db->select("SELECT
                                        " . $lng . "_item as item
                                FROM
                                        index_seccion5_items
                                WHERE
                                        estado = 1 ORDER BY orden ASC");
        return (!empty($sql)) ? $sql : NULL;
    }

    public function armaUrl($id, $tabla, $campo, $lng) {
        $sql = $this->db->select("select $campo from $tabla where id = $id");
        $tituloBlog = $this->cleanUrl(utf8_encode($sql[0][$campo]));
        $url = URL . $lng . "/blog/post/$id/" . $tituloBlog;
        return $url;
    }

    public function getActivePageAdmin($page) {
        $dashboard = $inicio = $aboutus = $products = $blog = $quality = $certificactions = $logistics = $neopure = $listado = $busqueda = $contacto = $menu = $pagina = $redes = $logo = $direccion = $metatags = $usuarios = '';
        switch ($page) {
            case'inicio':
                $inicio = 'class ="active"';
                break;
            case'aboutus':
                $aboutus = 'class ="active"';
                break;
            case'products':
                $products = 'class ="active"';
                break;
            case'certifications':
                $certificactions = 'class ="active"';
                break;
            case'logistics':
                $logistics = 'class ="active"';
                break;
            case'quality':
                $quality = 'class ="active"';
                break;
            case'neopure':
                $neopure = 'class ="active"';
                break;
            case'blog':
                $blog = 'class ="active"';
                $listado = 'class ="active"';
                break;
            case'busquedas':
                $blog = 'class ="active"';
                $busqueda = 'class ="active"';
                break;
            case'contacto':
                $contacto = 'class ="active"';
                break;
            case'menu':
                $menu = 'class ="active"';
                break;
            case'pagina':
                $pagina = 'class ="active"';
                break;
            case'redes':
                $redes = 'class ="active"';
                break;
            case'logo':
                $logo = 'class ="active"';
                break;
            case'direccion':
                $direccion = 'class ="active"';
                break;
            case'metatags':
                $metatags = 'class ="active"';
                break;
            case'usuarios':
                $usuarios = 'class ="active"';
                break;
            default :
                $dashboard = 'class ="active"';
                break;
        }
        $data = array(
            'type' => 'success',
            'paginas' => array(
                'dashboard' => $dashboard,
                'inicio' => $inicio,
                'aboutus' => $aboutus,
                'products' => $products,
                'certificactions' => $certificactions,
                'logistics' => $logistics,
                'quality' => $quality,
                'neopure' => $neopure,
                'blog' => array(
                    'blog' => $blog,
                    'listado' => $listado,
                    'busqueda' => $busqueda
                ),
                'contacto' => $contacto,
                'menu' => $menu,
                'pagina' => $pagina,
                'redes' => $redes,
                'logo' => $logo,
                'direccion' => $direccion,
                'metatags' => $metatags,
                'usuarios' => $usuarios,
            )
        );
        return $data;
    }

    public function retornarIdioma() {
        return $this->idioma;
    }

    public function getLogos() {
        $sql = $this->db->select("select logo from logo where id = 1");
        return $sql[0]['logo'];
    }

}
