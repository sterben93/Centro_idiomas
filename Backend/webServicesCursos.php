<?php

ini_set('display_errors', 'Off');
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL);
error_reporting(-1);
error_reporting(E_ALL | E_STRICT);
error_reporting(0);
ini_set('error_reporting', E_ALL);
require './Table.php';
$salida = $_POST['salida'];
switch ($salida) {
    //Agrego un curso
    case 1:
        $nombre = $_POST[NOMBRE_CURSO];
        $nivel = $_POST[NIVEL];
        $horario = $_POST[HORARIO];
        $salon = $_POST[SALON];
        $fec_ini_ins = $_POST[FEC_INI_INSC];
        $fec_fin_ins = $_POST[FEC_FIN_INSC];
        $fec_ini_cur = $_POST[FEC_INI_CUR];
        $fec_fin_cur = $_POST[FEC_FIN_CUR];
        $capacidad = $_POST[CAPACIDAD];
        $info = preg_split("/[\s]+/", $_POST[IDIOMAS_ID_IDIOMAS]);
        $id_Idioma = $info[0];
        $id_Maestro = $_POST[MAESTRO_ID_MAESTRO];
        $t_Cursos = new Table(TABLA_CURSOS);
        $t_Cursos->conectar();
        $t_Cursos->select_database();
        $t_Cursos->set(NOMBRE_CURSO, $nombre);
        $t_Cursos->set(NIVEL, $nivel);
        $t_Cursos->set(HORARIO, $horario);
        $t_Cursos->set(SALON, $salon);
        $t_Cursos->set(FEC_INI_INSC, $fec_ini_ins);
        $t_Cursos->set(FEC_FIN_INSC, $fec_fin_ins);
        $t_Cursos->set(FEC_INI_CUR, $fec_ini_cur);
        $t_Cursos->set(FEC_FIN_CUR, $fec_fin_cur);
        $t_Cursos->set(CAPACIDAD, $capacidad);
        $t_Cursos->set(INSCRITOS, 0);
        $t_Cursos->set(PENDIENTES, 0);
        $t_Cursos->set(MAESTRO_ID_MAESTRO, $id_Maestro);
        $t_Cursos->set(IDIOMAS_ID_IDIOMAS, $id_Idioma);
        $t_Cursos->insertar();
        $t_Cursos->close();
        header('Location: http://localhost/Centro_Idiomas/cursos.html');
        break;
    //Ver todos los cursos
    case 2:
        $t_Cursos = new Table(TABLA_CURSOS);
        $t_Cursos->conectar();
        $t_Cursos->select_database();
        $query = 'select * from ' . $t_Cursos->nombre_Table() . ';';
        $resultado = $t_Cursos->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_CURSOS => $row1[ID_CURSOS],
                NOMBRE_CURSO => utf8_encode($row1[NOMBRE_CURSO]),
                NIVEL => utf8_encode($row1[NIVEL]),
                HORARIO => utf8_encode($row1[HORARIO]),
                SALON => utf8_encode($row1[SALON]),
                FEC_INI_INSC => utf8_encode($row1[FEC_INI_INSC]),
                FEC_FIN_INSC => utf8_encode($row1[FEC_FIN_INSC]),
                FEC_INI_CUR => utf8_encode($row1[FEC_INI_CUR]),
                FEC_FIN_CUR => utf8_encode($row1[FEC_FIN_CUR]),
                CAPACIDAD => utf8_encode($row1[CAPACIDAD]),
                INSCRITOS => utf8_encode($row1[INSCRITOS]),
                PENDIENTES => utf8_encode($row1[PENDIENTES]),
                MAESTRO_ID_MAESTRO => utf8_encode($row1[MAESTRO_ID_MAESTRO]),
                IDIOMAS_ID_IDIOMAS => utf8_encode($row1[IDIOMAS_ID_IDIOMAS]),
            ];
        }
        echo json_encode(array_values($json));
        $t_Cursos->close();
        break;
    //ver cursos por idiomas
    case 3:
        $id = $_POST[ID_IDIOMAS];
        $t_Cursos = new Table(TABLA_CURSOS);
        $t_Cursos->conectar();
        $t_Cursos->select_database();
        $query = 'select * from ' . $t_Cursos->nombre_Table() . ' where ' . IDIOMAS_ID_IDIOMAS . " = '" . $id . "';";
        $resultado = $t_Cursos->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_CURSOS => $row1[ID_CURSOS],
                NOMBRE_CURSO => utf8_encode($row1[NOMBRE_CURSO]),
                NIVEL => utf8_encode($row1[NIVEL]),
                HORARIO => utf8_encode($row1[HORARIO]),
                SALON => utf8_encode($row1[SALON]),
                FEC_INI_INSC => utf8_encode($row1[FEC_INI_INSC]),
                FEC_FIN_INSC => utf8_encode($row1[FEC_FIN_INSC]),
                FEC_INI_CUR => utf8_encode($row1[FEC_INI_CUR]),
                FEC_FIN_CUR => utf8_encode($row1[FEC_FIN_CUR]),
                CAPACIDAD => utf8_encode($row1[CAPACIDAD]),
                INSCRITOS => utf8_encode($row1[INSCRITOS]),
                PENDIENTES => utf8_encode($row1[PENDIENTES]),
                MAESTRO_ID_MAESTRO => utf8_encode($row1[MAESTRO_ID_MAESTRO]),
                IDIOMAS_ID_IDIOMAS => utf8_encode($row1[IDIOMAS_ID_IDIOMAS]),
            ];
        }
        echo json_encode(array_values($json));
        $t_Cursos->close();
        break;
    //eliminar curso
    case 4:
        $t_Cursos = new Table(TABLA_CURSOS);
        $t_Cursos->conectar();
        $t_Cursos->select_database();
        $id = $_POST[ID_CURSOS];
        $where = ID_CURSOS . "='" . $id . "';";
        $t_Cursos->delete($where);
        $t_Cursos->close();
        break;
}








//echo $_POST[NOMBRE_CURSO] . "<br/>";
//echo $_POST[NIVEL] . "<br/>";
//echo $_POST[HORARIO] . "<br/>";
//echo $_POST[SALON] . "<br/>";
//echo $_POST[FEC_INI_INSC] . "<br/>";
//echo $_POST[FEC_FIN_INSC] . "<br/>";
//echo $_POST[FEC_INI_CUR] . "<br/>";
//echo $_POST[FEC_FIN_CUR] . "<br/>";
//echo $_POST[CAPACIDAD] . "<br/>";
////echo $_POST[INSCRITOS]."\n";
////echo $_POST[PENDIENTES]."\n";
//echo $_POST[MAESTRO_ID_MAESTRO] . "<br/>";
//echo $_POST[IDIOMAS_ID_IDIOMAS] . "<br/>";
