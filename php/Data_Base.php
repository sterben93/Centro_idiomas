<?php

require './Recursos.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Esta api es para facilitar al programador las funciones esenciales de un base
 * de datos como es la conexion, consultas, etc.
 * @author rous
 */
class Data_Base {

    private $user;
    private $host;
    private $password;
    private $database;
    private $conexion;

    /**
     * Funcion para inicializar las variables de la clase Data_Base
     */
    public function __construct() {
        $this->user = USER;
        $this->host = HOST;
        $this->database = USE_DATABASE;
        $this->password = PASSWORD;
    }

    /**
     * Permite la coneccion a la base de datos
     */
    public function conectar() {
        $this->conexion = mysql_connect($this->host, $this->user, $this->password)
                or die(mysql_error());
    }

    /**
     * Permite seleccionar la base de datos
     */
    public function select_database() {
        mysql_select_db($this->database, $this->conexion)
                or die("No se encontro la Base de Datos");
    }

    /**
      Funcion para cerrar la conexion de la Base de datos
     */
    public function close() {
        mysql_close()or die("No se pudo cerrar la conexion");
    }
}
