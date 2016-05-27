<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Este archivo PHP es para almacenar variables constantes relacionados con la base de datos de Centro de idiomas
 */
define('USER', "root");
define('HOST', "localhost");
define('PASSWORD', "archer93");
define('USE_DATABASE', "Centro_Idiomas");

/* Tabla del administrador */
define('TABLA_ADMINISTRADORES', "Administradores");
define('ID_ADMINISTRADOR', "idAdministrador");
define('NOMBRE', "Nombre");
define('APELLIDO_PATERNO', "Apellido_Paterno");
define('APELLIDO_MATERNO', "Apellido_Materno");
define('CONTRASEÑA', "Contraseña");
define('CORREO', "Correo");
define('STATUS', "Status");

/* Tabla de idiomas */
define('TABLA_IDIOMAS', "Idiomas");
define('ID_IDIOMAS', "idIdiomas");
define('IDIOMAS', "Idioma");
define('NIVELES', "Niveles");
define('OBJETIVO', "Objetivo");
define('PERFIL_INGRESO', "Perfil_Ingreso");
define('PERFIL_EGRESO', "Perfil_Egreso");
define('IMAGEN', "Imagen");

/* Tabla de Docentes */
define('TABLA_DOCENTES', "Docentes");
define('ID_DOCENTES', "idDocente");
define('TELEFONO', "Telefono");

/* Tabla Cursos */
define('TABLA_CURSOS', "Cursos");
define('ID_CURSOS', "idCursos");
define('NOMBRE_CURSO',"Nombre_del_Curso");
define('NIVEL', "Nivel");
define('HORARIO', "Horario");
define('SALON', "salon");
define('FEC_INI_INSC', "Fec_Inicio_Insc");
define('FEC_FIN_INSC', "Fec_Fin_Insc");
define('FEC_INI_CUR', "Fecha_Inicio_Curso");
define('FEC_FIN_CUR', "Fecha_Fin_Curso");
define('CAPACIDAD', "Capacidad");
define('INSCRITOS', "Inscritos");
define('PENDIENTES', "Pendientes");
define('MAESTRO_ID_MAESTRO', "Maestros_idMaestros");
define('IDIOMAS_ID_IDIOMAS', "Idiomas_idIdiomas");

/* Tabla de Inscripciones */
define('TABLA_INSCRIPCIONES', "Inscripciones");
define('ID_INSCRIPCIONES', "idInscripciones");
define('FEC_INSC', "Fecha_Insc");
define('N_CONTROL', "N_Control");
define('CARRERA', "Carrera");
define('SEMESTRE', "Semestre");
define('CURSOS_ID_CURSOS', "Cursos_idCursos");

/* tabla publicaciones*/
define('TABLA_PUB', "Publicaciones");
define('ID_PUBLICACIONES', "idPublicaciones");
define('TITULO', "Titulo");
define('CONTENIDO', "Contenido");
define('ADMINISTRADORES_ID_ADMINISTRADORES', "Administradores_idAdministrador");

define('OPCION', "opcion");
define('URLHOST', "http://localhost/Backend/");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "");
//define('', "")
