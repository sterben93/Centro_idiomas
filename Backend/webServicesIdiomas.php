<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'Off');
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL);
error_reporting(-1);
error_reporting(E_ALL | E_STRICT);
error_reporting(0);
ini_set('error_reporting', E_ALL);
require './Table.php';
require './class_imgUpldr.php';
$opcion = $_POST['salida'];
switch ($opcion) {
    //agregar idioma
    case 1:
        $idioma = $_POST[IDIOMAS];
        $id = 'CI' . strtoupper(substr($idioma, 0, 3));
        $niveles = $_POST[NIVELES];
        $objetivo = $_POST[OBJETIVO];
        $perfil_Ing = $_POST[PERFIL_INGRESO];
        $perfil_Egr = $_POST[PERFIL_EGRESO];
        $imagen = $_FILES[IMAGEN];
        $subir = new imgUpldr;
        $url = $subir->init($imagen, 'image/idiomas/');
        $t_Idiomas = new Table(TABLA_IDIOMAS);
        $t_Idiomas->conectar();
        $t_Idiomas->select_database();
        $t_Idiomas->set(ID_IDIOMAS, $id);
        $t_Idiomas->set(IDIOMAS, $idioma);
        $t_Idiomas->set(NIVELES, $niveles);
        $t_Idiomas->set(OBJETIVO, $objetivo);
        $t_Idiomas->set(PERFIL_INGRESO, $perfil_Ing);
        $t_Idiomas->set(PERFIL_EGRESO, $perfil_Egr);
        $t_Idiomas->set(IMAGEN, $url);
        $resultado = $t_Idiomas->insertar();
        $t_Idiomas->close();
        if ($resultado == "1") {
            header('Location: http://localhost/Centro_Idiomas/idiomas.html');
        } else {
            header('Location: http://localhost/Centro_Idiomas/idiomas.html');
        }
        break;
    //Modificar Idioma
    case 2:
        $t_Idiomas = new Table(TABLA_IDIOMAS);
        $t_Idiomas->conectar();
        $t_Idiomas->select_database();
        $id = $_POST[ID_IDIOMAS];
        $idioma = $_POST[IDIOMAS];
        $niveles = $_POST[NIVELES];
        $objetivo = $_POST[OBJETIVO];
        $perfil_Ing = $_POST[PERFIL_INGRESO];
        $perfil_Egr = $_POST[PERFIL_EGRESO];
        if ($_FILES[IMAGEN]["name"] != '') {
            $id = $_POST[ID_IDIOMAS];
            $resultado = $t_Idiomas->query('select ' . IMAGEN . ' from ' . $t_Idiomas->nombre_Table() . ' where ' . ID_IDIOMAS . " = '" . $id . "';");
            $url = mysqli_fetch_array($resultado);
            $url = preg_split("[/]", $url[IMAGEN]);
            unlink('image/idiomas/' . $url[count($url) - 1]);
            $imagen = $_FILES[IMAGEN];
            $subir = new imgUpldr;
            $url = $subir->init($imagen, 'image/idiomas/');
            $set = IDIOMAS . "='" . $idioma . "', " . NIVELES . "=" . $niveles . ", " . OBJETIVO . "='" .
                    $objetivo . "', " . PERFIL_INGRESO . "='" . $perfil_Ing . "', " . PERFIL_EGRESO . "='" .
                    $perfil_Egr . "', " . IMAGEN . "='" . $url . "'";
            $where = ID_IDIOMAS . "='" . $id . "';";
        } else {
            $set = IDIOMAS . "='" . $idioma . "', " . NIVELES . "=" . $niveles . ", " . OBJETIVO . "='" .
                    $objetivo . "', " . PERFIL_INGRESO . "='" . $perfil_Ing . "', " . PERFIL_EGRESO . "='" .
                    $perfil_Egr . "'";
            $where = ID_IDIOMAS . "='" . $id . "';";
        }

        $where = ID_IDIOMAS . "='" . $id . "';";
        $t_Idiomas->update($set, $where);
        $t_Idiomas->close();
        header('Location: http://localhost/Centro_Idiomas/idiomas.html?01');
        break;

    //Eliminar idioma
    case 3:
        $t_Idiomas = new Table(TABLA_IDIOMAS);
        $t_Idiomas->conectar();
        $t_Idiomas->select_database();
        $info = $_POST[ID_IDIOMAS];
        $info = preg_split("/[\s]+/", $info);
        $id = $info[0];
        $url = $info[1];
        $url = preg_split("[/]", $url);
        unlink('image/idiomas/' . $url[count($url) - 1]);
        $where = ID_IDIOMAS . "='" . $id . "';";
        $t_Idiomas->delete($where);
        break;

    //Ver Idiomas
    case 4:
        $t_Idiomas = new Table(TABLA_IDIOMAS);
        $t_Idiomas->conectar();
        $t_Idiomas->select_database();
        $query = 'select * from ' . $t_Idiomas->nombre_Table() . ';';
        $resultado = $t_Idiomas->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_IDIOMAS => $row1[ID_IDIOMAS],
                IDIOMAS => utf8_encode($row1[IDIOMAS]),
                NIVELES => utf8_encode($row1[NIVELES]),
                OBJETIVO => utf8_encode($row1[OBJETIVO]),
                PERFIL_INGRESO => utf8_encode($row1[PERFIL_INGRESO]),
                PERFIL_EGRESO => utf8_encode($row1[PERFIL_EGRESO]),
                IMAGEN => utf8_encode($row1[IMAGEN])];
        }
        echo json_encode(array_values($json));
        $t_Idiomas->close();
        break;
    //Obtener un idioma
    case 5:
        $t_Idiomas = new Table(TABLA_IDIOMAS);
        $id = $_POST[ID_IDIOMAS];
        $t_Idiomas->conectar();
        $t_Idiomas->select_database();
        $row1 = mysqli_fetch_array($t_Idiomas->query('select * from ' .
                        $t_Idiomas->nombre_Table() . ' where ' . ID_IDIOMAS . " ='" . $id . "';"));
        $json = [ID_IDIOMAS => $row1[ID_IDIOMAS],
            IDIOMAS => utf8_encode($row1[IDIOMAS]),
            NIVELES => utf8_encode($row1[NIVELES]),
            OBJETIVO => utf8_encode($row1[OBJETIVO]),
            PERFIL_INGRESO => utf8_encode($row1[PERFIL_INGRESO]),
            PERFIL_EGRESO => utf8_encode($row1[PERFIL_EGRESO]),
            IMAGEN => utf8_encode($row1[IMAGEN])];
        echo json_encode($json);
        $t_Idiomas->close();
        break;
}
?>



