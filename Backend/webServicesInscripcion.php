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
        if ($resultado == "1") {
            ob_start();
            require './PDF.php';
            $pdf = new PDF();
            $pdf->AddPage();
            $pdf->SetMargins(15, 20, 10);
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(40, 10, "", 0, 1);
            $pdf->Cell(0, 10, utf8_decode("FECHA: $fecha"), 0, 1, 'R');
            $pdf->Cell(40, 10, utf8_decode("N° CONTROL: $n_Control"), 0, 1);
            $pdf->Cell(40, 10, utf8_decode("NOMBRE: $nombre" . " " . $apellidos_Array[0] . " " . $apellidos_Array[0]), 0, 1);
            $pdf->Cell(40, 10, utf8_decode("CARRERA: $carrera"), 0, 1);
            $t_Cursos = new Table(TABLA_CURSOS);
            $t_Cursos->conectar();
            $t_Cursos->select_database();
            $row = mysqli_fetch_array($t_Cursos->query('select * from ' .
                            $t_Cursos->nombre_Table() . ' where ' . ID_CURSOS . " ='" . $curso . "';"));
            $t_Cursos->close();
            $pdf->Cell(40, 10, utf8_decode("CURSO: " . utf8_encode($row[NOMBRE_CURSO])), 0, 1);
            $pdf->Cell(40, 10, utf8_decode("SEMESTRE: $semestre"), 0, 1);
            $pdf->Cell(40, 10, utf8_decode("HORARIO: " . utf8_encode($row[HORARIO])), 0, 1);
            $pdf->Cell(40, 10, "", 0, 1);
            $pdf->Cell(40, 10, "", 0, 1);
            $pdf->Cell(180, 10, utf8_decode("INSTRUCCIONES:"), 1, 1, 'C');
            $pdf->Cell(180, 10, utf8_decode("1. BAJAR E IMPRIMIR ESTE FORMATO POR CURSO."), 1, 1, 'C');
            $pdf->Cell(180, 10, utf8_decode("2. REALIZAR PAGO EN EL BANCO."), 1, 1, 'C');
            $pdf->Cell(180, 10, utf8_decode("3. SACAR 2 FOTOCOPIAS AL VOUCHER"), 1, 1, 'C');
            $pdf->Cell(180, 10, utf8_decode("4. ENTREGAR EL ORIGINAL EN RECURSOS FINANCIEROS Y SELLAR LAS 2 FOTOCOPIAS."), 1, 1, 'C');
            $pdf->Cell(180, 10, utf8_decode("5. ENTREGAR COPIA SELLADA AL COORDINADOR DE IDIOMAS"), 1, 1, 'C');
            $pdf->Cell("");
            $pdf->Output();
            ob_end_flush();
        } else {
            echo 'Error en la conexion de la Base de Datos';
        }
        break;
    //ver inscritos
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
                CURSOS_ID_CURSOS => utf8_encode(nombre_Curso($row1[CURSOS_ID_CURSOS]))];
        }
        echo json_encode(array_values($json));
        $t_Ins->close();
        break;
    case 3:
        $t_Ins = new Table(TABLA_INSCRIPCIONES);
        $t_Ins->conectar();
        $t_Ins->select_database();
        $id = $_POST[ID_INSCRIPCIONES];
        $where = ID_INSCRIPCIONES . "='" . $id . "';";
        $t_Ins->delete($where);
        $t_Ins->close();
        break;
    case 4:
        $t_Ins = new Table(TABLA_INSCRIPCIONES);
        $t_Ins->conectar();
        $t_Ins->select_database();
        $id = $_POST[ID_INSCRIPCIONES];
        $set = STATUS . "='1'";
        $where = ID_INSCRIPCIONES . "='" . $id . "';";
        $t_Ins->update($set, $where);
        $t_Ins->close();
}

function nombre_Curso($id) {
    $t_Cursos = new Table(TABLA_CURSOS);
    $t_Cursos->conectar();
    $t_Cursos->select_database();
    $query = 'select ' . NOMBRE_CURSO . ' from ' . $t_Cursos->nombre_Table() . ' where ' . ID_CURSOS . " = '" . $id . "';";
    $resultado = $t_Cursos->query($query);
    $row1 = mysqli_fetch_array($resultado);
    return $row1[NOMBRE_CURSO];
}

?>

