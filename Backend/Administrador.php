<?php

require './Table.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author rous
 */


class Administrador extends Table {

    public function __construct() {
        parent::__construct(TABLA_ADMINISTRADORES);
    }

    /**
     * Metodo para obtener informacion de los administradores
     * @return Array
     */
    public function verAdministradores() {
        return $this->query(utf8_decode("select * from Administradores where status=0;"));
    }

    /**
     * Metodo para realizar confirmar los datos obtenidos por un logeo
     * @param string $user
     * @param string $password
     * @return Array
     */
    public function login($user, $password) {
        $login = "select count(*) as login " .
                "from Administradores " .
                "where idAdministrador='" . $user . "' and Contraseña='" . $password . "';";
        echo $login;
        return $this->query($login);
    }

    /**
     * Me permite obtener el nombre del Usuario que acaba de iniciar sesion
     * @param type $user
     * @return type
     */
    public function nombreUsuario($user) {
        $query = "select concat(concat(concat(concat(Nombre, ' '), Apellido_Paterno),' '),Apellido_Materno) As Nombre_Completo " .
                "from Administradores " .
                "where idAdministrador='" . $user . "';";
        return $this->query(utf8_decode($query));
    }

    /**
     * Metodo para obtener la contraseña de un usuario
     * @param string $correo
     * @return Array
     */
    public function obtener_Contraseña($correo) {
        $contrasena = "select Contraseña as password " .
                "from Administradores " .
                "where Correo ='" . $correo . "';";
        return $this->query($contrasena);
    }

    /**
     * Metodo para obtener los administradores de los usuario en un status false
     * @return Array
     */
    public function status_Administrador() {
        $admin_Status = "select *".
        " from ".TABLA_ADMINISTRADORES ." where Status = 0;";
        return $this->query($admin_Status);
    }

    public function cambiar_Status($id_Admin){
        $set=" Status = 1 ";
        $where= ID_ADMINISTRADOR."='".$id_Admin."';";
        $this->update($set, $where);

    }

}
