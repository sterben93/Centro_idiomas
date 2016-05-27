<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Me permite realizar operaciones de un administrador a partir de una opcion
 * obtenida mediante un metodo Post
 * @author rous
 */
ob_start();
ini_set('display_errors', 'Off');
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
error_reporting(E_ALL);
error_reporting(-1);
error_reporting(E_ALL | E_STRICT);
error_reporting(0);
ini_set('error_reporting', E_ALL);
require './Administrador.php';
require './Correo.php';

$opcion = $_POST['salida'];

switch ($opcion) {
    //Login del usuario
    case 1:
        $user = $_POST[ID_ADMINISTRADOR];
        $password = $_POST[CONTRASEÑA];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = mysqli_fetch_array($admin->login($user, $password));
        if ($resultado['login'] == 1) {
            header("Location: http://localhost/Centro_Idiomas/menu_Administrador.html#$user");
        } else {
            header('Location: http://localhost/Centro_Idiomas/login.html#erroLogin');
        }
        $admin->close();
        break;

    //Registro de un Usuario
    case 2:

        $letras = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Q", "W",
            "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F",
            "G", "H", "J", "K", "L", "Z", "X", "C", "V", "B", "N", "M"];
        $nombre = $_POST[NOMBRE];
        $apellidos = $_POST["Apellidos"];
        $contraseña = $_POST[CONTRASEÑA];
        $correo = $_POST[CORREO];

        $admin = new Administrador();
        $apellidos_Array = preg_split("/[\s]+/", $apellidos);
        $apellido_paterno = $apellidos_Array[0];
        $apellido_materno = $apellidos_Array[1];
        $usuario = "CI" . $nombre[0] . $apellido_paterno[0] . $apellido_materno[0] .
                $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)];

        $admin->conectar();
        $admin->select_database();

        $admin->set(ID_ADMINISTRADOR, $usuario);
        $admin->set(NOMBRE, $nombre);
        $admin->set(APELLIDO_MATERNO, $apellido_materno);
        $admin->set(APELLIDO_PATERNO, $apellido_paterno);
        $admin->set(CONTRASEÑA, $contraseña);
        $admin->set(CORREO, $correo);
        $admin->set(STATUS, 0);
        $resultado = $admin->insertar();

        $admin->close();
        if ($resultado == "1") {
            header('Location: http://localhost/Centro_Idiomas/login.html#registro');
        } else {
            header('Location: http://localhost/Centro_Idiomas/login.html#errorRegistro');
        }
        break;

    //Opcion para obtener el la contraseña de un usuario
    case 3:
        $email = $_POST[CORREO];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = mysqli_fetch_array($admin->obtener_Contraseña($email));
        $admin->close();
        $correo = new Correo();
        if ($correo->enviarEmail("Centro de Idiomas de ITver", $email, 'Recuperacion de contraseña', 'Su contraseña es: ' . $resultado['password'])) {
            header('Location: http://localhost/Centro_Idiomas/login.html#email');
        } else {
            header('Location: http://localhost/Centro_Idiomas/login.html#errorEmail');
        }
        break;

    //Cambia el status de un administrador
    case 4:

        $id_Admin = $_POST['idAdmin'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = $admin->cambiar_Status($id_Admin);
        $resultado = mysqli_fetch_array($admin->query("select ".CORREO." from ".$admin->nombre_Table()." where ".ID_ADMINISTRADOR."='".$id_Admin."';"));
        $email= $resultado[CORREO];
        $admin->close();
        $correo = new Correo();
        $correo->enviarEmail("Centro de Idiomas de ITver", $email, 'Usuario administrativo del Cetro de idiomas del Itver', 'Su usuario es: ' . $id_Admin);
        break;

    //obtengo el nombre del usuario
    case 5:
        $usuario = $_POST['user'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = mysqli_fetch_array($admin->nombreUsuario($usuario));
        echo $resultado["Nombre_Completo"];
        break;

    //obtengo los adminitradores con un estatus false
    case 6:

        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = $admin->status_Administrador();
        $json = array();
        while ($row1 = mysqli_fetch_array($resultado)) {
            $json[] = [ID_ADMINISTRADOR => utf8_encode($row1[ID_ADMINISTRADOR]),
                nombreCompleto => utf8_encode($row1[NOMBRE] . " " . $row1[APELLIDO_PATERNO] .
                        " " . $row1[APELLIDO_MATERNO]),
                CONTRASEÑA => utf8_encode($row1[utf8_decode(CONTRASEÑA)]),
                CORREO => utf8_encode($row1[CORREO])];
        }
        echo json_encode($json);
        $admin->close();
        break;

    //Elimina un administrador
    case 7:
        $id_Admin = $_POST['idAdmin'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $t_Publicaciones = new Table(TABLA_PUB);
        $t_Publicaciones->setMysqli($admin->getMysqli());
        $where = ADMINISTRADORES_ID_ADMINISTRADORES . "='" . $id_Admin . "';";
        $t_Publicaciones->delete($where);
        $where = ID_ADMINISTRADOR . " = '" . $id_Admin . "'";
        $admin->delete($where);
        $admin->close();
        break;
}
ob_flush();
?>
