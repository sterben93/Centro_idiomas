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
    private $mysqli;

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
        $this->mysqli = new mysqli($this->host, $this->user, $this->password);

        if ($this->mysqli->connect_error) {
            return die("Connection failed: " . $conn->connect_error);
        } else {
            return "Exito";
        }
    }

    /**
     * Permite seleccionar la base de datos
     */
    public function select_database() {
        mysqli_select_db($this->mysqli,  $this->database)or die("No se encontro la Base de Datos");
    }

    /**
      Funcion para cerrar la conexion de la Base de datos
     */
    public function close() {
        mysqli_close($this->mysqli)or die("No se pudo cerrar la conexion");
    }
    function getMysqli() {
        return $this->mysqli;
    }

    function setMysqli($conexion) {
        $this->mysqli=$conexion;
    }
}
