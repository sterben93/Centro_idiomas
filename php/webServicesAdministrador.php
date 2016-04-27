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
require './Administrador.php';
$opcion = $_POST['salida'];

switch ($opcion) {
    //Login del usuario
    case 1:

        $user = $_POST['user'];
        $password = $_POST['password'];
        $admin = new Administrador();

        $admin->conectar();
        $admin->select_database();
        $resultado = mysql_fetch_array($admin->login($user, $password));
        if ($resultado['login'] == 1) {
            header('Location: ../menu_Administrador.html?user=' . $user);
        } else {
            header('Location: ../loginAdmin.html?login=0');
        }
        $admin->close();
        break;

    //Registro de un Usuario
    case 2:

        $letras = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Q", "W",
            "E", "R", "T", "Y", "U", "I", "O", "P", "A", "S", "D", "F",
            "G", "H", "J", "K", "L", "Ñ", "Z", "X", "C", "V", "B", "N", "M"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $contraseña = $_POST["contraseña"];
        $correo = $_POST["correo"];

        $admin = new Administrador();
        $apellidos_Array = split(" ", $apellidos);
        $apellido_paterno = $apellidos_Array[0];
        $apellido_materno = $apellidos_Array[1];
        $usuario = "CI" . $nombre[0] . $apellido_paterno[0] . $apellido_materno[0] .
                $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)] . $letras[rand(0, count($letras) - 1)];

        $admin->conectar();
        $admin->select_database();

        $admin->set($usuario);
        $admin->set($nombre);
        $admin->set($apellido_paterno);
        $admin->set($apellido_materno);
        $admin->set($contraseña);
        $admin->set($correo);
        $admin->set(false);
        $resultado = $admin->insertar();

        $admin->close();
        if ($resultado == "1") {
            header('Location: ../loginAdmin.html?registro=ok');
        } else {
            header('Location: ../loginAdmin.html?registro=no');
        }
        break;

    //Opcion para obtener el la contraseña de un usuario
    case 3:

        $correo = $_POST['correo'];

        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = mysql_fetch_array($admin->obtener_Contraseña($correo));
        $admin->close();
        //falta enviar el correo
        break;

    //Cambia el status de un administrador
    case 4:

        $id_Admin = $_POST['idAdmin'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = $admin->cambiar_Status($id_Admin);
        $admin->close();
        break;

    //obtengo el nombre del usuario
    case 5:

        $usuario = $_POST['user'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = mysql_fetch_array($admin->nombreUsuario($usuario));
        echo$resultado["Nombre_Completo"];
        break;

    //obtengo los adminitradores con un estatus false
    case 6:

        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $resultado = $admin->status_Administrador();
        $json = array();

        while ($row1 = mysql_fetch_array($resultado)) {
            $json[] = [ID_ADMINISTRADOR => $row1[ID_ADMINISTRADOR],
                nombreCompleto => $row1[NOMBRE] . " " . $row1[APELLIDO_PATERNO] .
                " " . $row1[APELLIDO_MATERNO],
                CONTRASEÑA => $row1[utf8_decode(CONTRASEÑA)],
                CORREO => $row1[CORREO]];
        }
        echo json_encode($json);
        $admin->close();
        break;

    //Elimina un administrador
    case 7:
        /**
         *     public function delete($where) {
          $delete = "delete " . $this->nombre_Table() . ".*" .
          " from " . $this->nombre_Table() .
          " where " . $where . ";";
          mysql_query(utf8_decode($delete))or die(mysql_error());
          }
         */
        $id_Admin = $_POST['idAdmin'];
        $admin = new Administrador();
        $admin->conectar();
        $admin->select_database();
        $where = ID_ADMINISTRADOR." = '".$id_Admin."'";
        $admin->delete($where);
        $admin->close();
        break;
}

?>

