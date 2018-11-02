<?php

class Formularios_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function frmcontacto($datos) {
        $ip = $this->helper->getReal_ip();
        $nombre = $datos['nombre'];
        $email = $datos['email'];
        $asunto = $datos['asunto'];
        $mensaje = $datos['mensaje'];
        $this->db->insert('frm_contacto', array(
            'nombre' => utf8_decode($nombre),
            'email' => $email,
            'asunto' => utf8_decode($asunto),
            'mensaje' => utf8_decode($mensaje),
            'ip' => $ip,
            'fechaCreado' => date('Y-m-d H:i:s'),
        ));
        $data = array(
            'type' => 'success',
            'content' => '<div class="alert alert-success" role="alert">Gracias por ponerte en contacto con nosotros. En breve nos estaremos comunicando contigo...</div>'
        );
        return $data;
    }

    public function frmNewsletter($datos) {
        #verificamos que no existe todavia el email a registrar
        $email = $datos['email'];
        $sqlExiste = $this->db->select("select email from frm_newsletter where email = '$email'");
        if (empty($sqlExiste)) {
            #insertamos el email en la db
            $this->db->insert('frm_newsletter', array(
                'email' => $email,
                'fecha_suscripcion' => date('Y-m-d H:i:s')
            ));
            $data = array(
                'type' => 'success',
                'content' => '<div class="alert alert-success mensajesNewsletterSuccess" role="alert">'
                . '<p><i class="fa fa-check-circle" aria-hidden="true"></i> Gracias. Su email se ha registrado correctamente en nuestra base de datos. Pronto estará recibiendo nuestras novedades</p>'
                . '</div>'
            );
        } else {
            #retornamos mensaje de error
            $data = array(
                'type' => 'error',
                'content' => '<div class="alert alert-danger mensajesNewsletterError" role="alert">'
                . '<p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> El email que ha ingresado <strong>ya existe</strong> en nuestra base de datos...</p>'
                . '</div>'
            );
        }
        return $data;
    }

}
