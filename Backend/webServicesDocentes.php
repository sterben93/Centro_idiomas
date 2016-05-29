<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL);
error_reporting(-1);
error_reporting(E_ALL | E_STRICT);
error_reporting(0);
ini_set('error_reporting', E_ALL);
require './Table.php';
$opcion = $_POST['salida'];
switch ($opcion) {
    //agregar docente
    case 1:
        $letras = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Q", "W",
            "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F",
            "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M"];
        $nombre = $_POST[NOMBRE];
        $apellidos_Array = preg_split("/[\s]+/", $_POST['Apellidos']);
        $id = "CI" . $nombre[0] . $apellidos_Array[0][0] . $apellidos_Array[1][0] .
                $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)];
        $correo = $_POST[CORREO];
        $telefono = $_POST[TELEFONO];
        $t_Docente = new Table(TABLA_DOCENTES);
        $t_Docente->conectar();
        $t_Docente->select_database();
        $t_Docente->set(ID_DOCENTES, $id);
        $t_Docente->set(NOMBRE, $nombre);
        $t_Docente->set(APELLIDO_PATERNO, $apellidos_Array[0]);
        $t_Docente->set(APELLIDO_MATERNO, $apellidos_Array[1]);
        $t_Docente->set(CORREO, $correo);
        $t_Docente->set(TELEFONO, $telefono);
        $resultado = $t_Docente->insertar();
        $t_Docente->close();
        if ($resultado == "1") {
            header('Location: http://localhost/Centro_Idiomas/docentes.html#regDocente');
        } else {
            header('Location: http://localhost/Centro_Idiomas/docentes.html#error');
        }
        break;
    //Modificar Docente
    case 2:
        $t_Docente = new Table(TABLA_DOCENTES);
        $t_Docente->conectar();
        $t_Docente->select_database();
        $id = $_POST[ID_DOCENTES];
        $nombre= $_POST[NOMBRE];
        $apellidos_Array = preg_split("/[\s]+/", $_POST['Apellidos']);
        $correo = $_POST[CORREO];
        $telefono = $_POST[TELEFONO];
        $set = NOMBRE . "='" . $nombre . "', " . APELLIDO_PATERNO . "='" . $apellidos_Array[0] .
                "', " . APELLIDO_MATERNO . "='" .$apellidos_Array[1] .
                "', " . CORREO . "='" . $correo . "', " . TELEFONO . "='" .
                $telefono . "'";
        $where = ID_DOCENTES . "='" . $id . "';";
        $t_Docente->update($set, $where);
        $t_Docente->close();
        header('Location: http://localhost/Centro_Idiomas/docentes.html?update');
        break;

    //Eliminar Docente
    case 3:
        $t_Docente = new Table(TABLA_DOCENTES);
        $t_Docente->conectar();
        $t_Docente->select_database();
        $id = $_POST[ID_DOCENTES];
        $where = ID_DOCENTES . "='" . $id . "';";
        $t_Docente->delete($where);
        break;

    //Ver Docentes
    case 4:
        $t_Docente = new Table(TABLA_DOCENTES);
        $t_Docente->conectar();
        $t_Docente->select_database();
        $query = 'select * from ' . $t_Docente->nombre_Table() . ';';
        $resultado = $t_Docente->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_DOCENTES => $row1[ID_DOCENTES],
                NOMBRE => utf8_encode($row1[NOMBRE]),
                "Apellidos"=>utf8_encode($row1[APELLIDO_PATERNO] . " " . $row1[APELLIDO_MATERNO]),
                CORREO => utf8_encode($row1[CORREO]),
                TELEFONO => utf8_encode($row1[TELEFONO])];
        }
        echo json_encode(array_values($json));
        $t_Docente->close();
        break;
    //Obtener un docente
    case 4:
        break;
}
?>



