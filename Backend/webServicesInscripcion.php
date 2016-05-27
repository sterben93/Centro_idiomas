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
require './fpdf181/fpdf.php';
$opcion = $_POST['salida'];
switch ($opcion) {
    //agregar inscrito
    case 1:
        $time = time();
        $fecha = date("Y-m-d", $time);
        $status = 0;
        $n_Control = $_POST[N_CONTROL];
        $nombre = $_POST[NOMBRE];

        $apellidos_Array = preg_split("/[\s]+/", $_POST['Apellidos']);
        $carrera = $_POST[CARRERA];
        $semestre = $_POST[SEMESTRE];
        $curso = $_POST[CURSOS_ID_CURSOS];
        $t_Ins = new Table(TABLA_INSCRIPCIONES);
        $t_Ins->conectar();
        $t_Ins->select_database();
        $t_Ins->set(FEC_INSC, $fecha);
        $t_Ins->set(STATUS, $status);
        $t_Ins->set(N_CONTROL, $n_Control);
        $t_Ins->set(NOMBRE, $nombre);
        $t_Ins->set(APELLIDO_PATERNO, $apellidos_Array[0]);
        $t_Ins->set(APELLIDO_MATERNO, $apellidos_Array[1]);
        $t_Ins->set(CARRERA, $carrera);
        $t_Ins->set(SEMESTRE, $semestre);
        $t_Ins->set(CURSOS_ID_CURSOS, $curso);
        $resultado = $t_Ins->insertar();
        $t_Ins->close();

//        if ($resultado == "1") {
//            header('Location: http://localhost/Centro_Idiomas/index.html');
//        } else {
//            header('Location: http://localhost/Centro_Idiomas/index.html');
//        }
        break;
    case 2:
        $t_Ins = new Table(TABLA_INSCRIPCIONES);
        $t_Ins->conectar();
        $t_Ins->select_database();
        $query = 'select * from ' . $t_Ins->nombre_Table() . ';';
        $resultado = $t_Ins->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_INSCRIPCIONES => $row1[ID_INSCRIPCIONES],
                FEC_INSC => utf8_encode($row1[FEC_INSC]),
                STATUS => utf8_encode($row1[STATUS]),
                N_CONTROL => utf8_encode($row1[N_CONTROL]),
                NOMBRE => utf8_encode($row1[NOMBRE]),
                APELLIDO_PATERNO => utf8_encode($row1[APELLIDO_PATERNO]),
                APELLIDO_MATERNO => utf8_encode($row1[APELLIDO_MATERNO]),
                CARRERA => utf8_encode($row1[CARRERA]),
                SEMESTRE => utf8_encode($row1[SEMESTRE]),
                CURSOS_ID_CURSOS => utf8_encode($row1[CURSOS_ID_CURSOS])];
        }
        echo json_encode(array_values($json));
        $t_Ins->close();
        break;
}



$pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'¡Hola, Mundo!');
        $pdf->Output();
        echo "Hola";

