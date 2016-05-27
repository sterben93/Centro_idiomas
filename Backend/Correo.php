<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Correo
 *
 * @author rous
 */

require './vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

class Correo {

    //put your code here

    public function __construct() {
        $this->email = new PHPMailer();
        $this->inicializa();
    }

    public function inicializa() {
        $this->email->SMTPDebug = 2;
        $this->email->isSMTP();
        $this->email->Host = "smtp.gmail.com";
        $this->email->Port = 587;
        $this->email->SMTPSecure = "ssl";
        $this->email->Port = 465;
        $this->email->SMTPAuth = true;
        $this->email->Username = "rous.archer@gmail.com"; /* cambiar esto, si pones tu cuenta de google te dira que bloqueo esta aplicacion, tienes que activar el uso de aplicaciones no seguras para que esto jale */
        $this->email->Password = "zjkjrcnefcdmefol";   //https://www.google.com/settings/security/lesssecureapp
        $this->email->SMTPSecure = "tls";
        $this->email->Port = 587;
    }
    public function enviarEmail($fromName, $destinatario, $sujeto ,$cuerpo){
        $this->email->From = "rous.archer@gmail.com";
        $this->email->FromName = $fromName;
        $this->email->addAddress($destinatario, "Recepient Name");
        $this->email->isHTML(false);
        $this->email->Subject = utf8_decode($sujeto);
        $this->email->Body = utf8_decode($cuerpo);
        $this->email->AltBody = $cuerpo;
        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }
}
