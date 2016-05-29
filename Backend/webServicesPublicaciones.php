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
require './class_imgUpldr.php';
require './Table.php';
$opcion = $_POST[OPCION];
switch ($opcion) {
    //agregar una publicación
    case 1:
        $titulo = $_POST[TITULO];
        $contenido = $_POST[CONTENIDO];
        $imagen = $_FILES[IMAGEN];
        $id = $_POST[ADMINISTRADORES_ID_ADMINISTRADORES];
        $subir = new imgUpldr;
        $url = $subir->init($imagen, 'image/publicaciones/');
        $t_Publicaciones = new Table(TABLA_PUB);
        $t_Publicaciones->conectar();
        $t_Publicaciones->select_database();
        $t_Publicaciones->set(TITULO, $titulo);
        $t_Publicaciones->set(CONTENIDO, $contenido);
        $t_Publicaciones->set(IMAGEN, $url);
        $t_Publicaciones->set(ADMINISTRADORES_ID_ADMINISTRADORES, $id);
        $resultado = $t_Publicaciones->insertar();
        $t_Publicaciones->close();
        header('Location: http://localhost/Centro_Idiomas/menu_Administrador.html');
        break;
    //Obtener las publicaciones
    case 2:
        $t_Publicaciones = new Table(TABLA_PUB);
        $t_Publicaciones->conectar();
        $t_Publicaciones->select_database();
        $query = 'select * from ' . $t_Publicaciones->nombre_Table() . ' LIMIT 4;';
        $resultado = $t_Publicaciones->query($query);
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_PUBLICACIONES => $row1[ID_PUBLICACIONES],
                TITULO => utf8_encode($row1[TITULO]),
                CONTENIDO => utf8_encode($row1[CONTENIDO]),
                IMAGEN => utf8_encode(URLHOST . $row1[IMAGEN])];
        }
        echo json_encode(array_values($json));
        $t_Publicaciones->close();
        break;
    //eliminar las publicaciones
    case 3:
        $t_Publicaciones = new Table(TABLA_PUB);
        $t_Publicaciones->conectar();
        $t_Publicaciones->select_database();
        $info = $_POST[ID_PUBLICACIONES];
        $info = preg_split("/[\s]+/", $info);
        $id = $info[0];
        $url = $info[1];
        $url = preg_split("[/]", $url);
        unlink('image/publicaciones/' . $url[count($url) - 1]);
        $where = ID_PUBLICACIONES . "='" . $id . "';";
        $t_Publicaciones->delete($where);
        break;
    //modificar las publicaciones
    case 4:
        $t_Publicaciones = new Table(TABLA_PUB);
        $t_Publicaciones->conectar();
        $t_Publicaciones->select_database();
        $imagen = $_FILES[IMAGEN];
        $id = $_POST[ID_PUBLICACIONES];
        $titulo = $_POST[TITULO];
        $contenido = $_POST[CONTENIDO];
        if ($_FILES[IMAGEN]["name"] != '') {
            $id = $_POST[ID_PUBLICACIONES];
            $resultado = $t_Publicaciones->query('select ' . IMAGEN . ' from ' . $t_Publicaciones->nombre_Table() . ' where ' . ID_PUBLICACIONES . " = '" . $id . "';");
            $url = mysqli_fetch_array($resultado);
            $url = preg_split("[/]", $url[IMAGEN]);
            unlink('image/publicaciones/' . $url[count($url) - 1]);
            $imagen = $_FILES[IMAGEN];
            $subir = new imgUpldr;
            $url = $subir->init($imagen, 'image/publicaciones/');
            $set = TITULO . "='" . $titulo . "', " . CONTENIDO . "='" . $contenido . "', " . IMAGEN . "='" .
                    $url . "'";
            $where = ID_PUBLICACIONES . "='" . $id . "';";
        } else {
            $set = TITULO . "='" . $titulo . "', " . CONTENIDO . "='" . $contenido . "' ";
            $where = ID_PUBLICACIONES . "='" . $id . "';";
        }
        $t_Publicaciones->update($set, $where);
        $t_Publicaciones->close();
        header('Location: http://localhost/Centro_Idiomas/menu_Administrador.html');
        break;
    case 5:
        $t_Publicacion = new Table(TABLA_PUB);
        $id = $_POST[ID_PUBLICACIONES];
        $t_Publicacion->conectar();
        $t_Publicacion->select_database();
        $row1 = mysqli_fetch_array($t_Publicacion->query('select * from ' .
                        $t_Publicacion->nombre_Table() . ' where ' . ID_PUBLICACIONES . " ='" . $id . "';"));
        $json = [ID_PUBLICACIONES => $row1[ID_PUBLICACIONES],
            TITULO => utf8_encode($row1[TITULO]),
            CONTENIDO => utf8_encode($row1[CONTENIDO]),
            IMAGEN => utf8_encode(URLHOST . $row1[IMAGEN])];
        echo json_encode($json);
        $t_Publicacion->close();
        break;
}
?>
