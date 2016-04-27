<?php

require './Data_Base.php';

use Data_Base;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase con los metodos necesarios para manipular una tabla en la base de datos
 *
 * @author rous
 */
class Table extends Data_Base {

    private $nombre;
    protected $campos;
    protected $valores;

    /**
     * Inicializa el nombre de la tabla utilizada
     * @param string $nombre
     */
    public function __construct($nombre) {
        parent::__construct();
        $this->nombre = $nombre;
        $this->campos = array();
        $this->valores = array();
    }

    /**
     * Datos a insertar en la base de datos
     * @param string $campo
     * @param string $valor
     */
    public function set($campo, $valor) {
        $this->campos[] = $campo;
        $this->valores[] = $valor;
    }

    /**
     * Retorna un lista de los Campos de la tabla
     * @return type
     */
    public function getCampos() {
        return $this->campos;
    }

    /**
     * Retorna los valores de fila o los valores a agregar a un tabla
     * * @return array
     */
    public function getValores() {
        return $this->valores;
    }

    /**
     * Proporciona de la tabla empleada
     * @return string
     */
    public function nombre_Table() {
        return $this->nombre;
    }

    /**
     * Inserta un registro a la tabla correspodiente
     */
    public function insertar() {
        $query = "insert into " . $this->nombre_Table() . "(";
        $campos = $this->getCampos();
        for ($index1 = 0; $index1 < count($campos); $index1++) {
            if ($index1 == count($campos) - 1) {
                $query.=$campos[$index1];
                break;
            }
            $query.=$campos[$index1] . ", ";
        }

        $query.=") values('";
        $valores = $this->getValores();

        for ($index2 = 0; $index2 < count($valores); $index2++) {
            if ($index2 == count($valores) - 1) {
                $query.=$valores[$index2];
                break;
            }
            $query.=$valores[$index2] . "', '";
        }

        $query.= "');";
        return mysql_query(utf8_decode($query))or die(mysql_error());
    }

    /**
     * Borra un registro de una tabla
     * @param string $where
     */
    public function delete($where) {
        $delete = "delete " . $this->nombre_Table() . ".*" .
                " from " . $this->nombre_Table() .
                " where " . $where . ";";
        echo $delete;
        mysql_query(utf8_decode($delete))or die(mysql_error());
    }

    /**
     * Permite realizar una consulta a la base de datos
     * @param string $query
     * @return array
     */
    public function query($query) {
        $resultados = mysql_query($query)or die(mysql_error());
        return $resultados;
    }


    public function update() {

    }

}
