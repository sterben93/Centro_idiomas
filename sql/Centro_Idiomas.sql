-- MySQL Script generated by MySQL Workbench
-- jue 05 may 2016 10:19:55 CDT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Centro_Idiomas
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Centro_Idiomas` ;

-- -----------------------------------------------------
-- Schema Centro_Idiomas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Centro_Idiomas` DEFAULT CHARACTER SET utf8 ;
USE `Centro_Idiomas` ;

-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Administradores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Administradores` (
  `idAdministrador` VARCHAR(8) NOT NULL,
  `Nombre` VARCHAR(100) NOT NULL,
  `Apellido_Materno` VARCHAR(50) NOT NULL,
  `Apellido_Paterno` VARCHAR(50) NOT NULL,
  `Contraseña` VARCHAR(16) NOT NULL,
  `Correo` VARCHAR(200) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idAdministrador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Idiomas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Idiomas` (
  `idIdiomas` VARCHAR(5) NOT NULL,
  `Idiomas` VARCHAR(70) NOT NULL,
  `Niveles` DECIMAL(10,0) NOT NULL,
  `Objetivo` TEXT NOT NULL,
  `Perfil_Ingreso` TEXT NOT NULL,
  `Perfil_Egreso` TEXT NOT NULL,
  PRIMARY KEY (`idIdiomas`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Maestros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Maestros` (
  `idMaestros` VARCHAR(10) NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellido_Paterno` VARCHAR(45) NULL,
  `Apellido_Materno` VARCHAR(45) NULL,
  `Correo` VARCHAR(45) NULL,
  `Telefono` VARCHAR(45) NULL,
  PRIMARY KEY (`idMaestros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Cursos` (
  `idCursos` VARCHAR(5) NOT NULL,
  `Nivel` INT NOT NULL,
  `Horario` VARCHAR(45) NOT NULL,
  `salon` VARCHAR(5) NOT NULL,
  `Fec_Inicio_Insc` DATE NOT NULL,
  `Fec_Fin_Insc` DATE NOT NULL,
  `Fecha_Inicio_Curso` DATE NOT NULL,
  `Fecha_Fin_Curso` DATE NOT NULL,
  `Maestros_idMaestros` VARCHAR(10) NOT NULL,
  `Idiomas_idIdiomas` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`idCursos`, `Maestros_idMaestros`, `Idiomas_idIdiomas`),
  CONSTRAINT `fk_Cursos_Maestros1`
    FOREIGN KEY (`Maestros_idMaestros`)
    REFERENCES `Centro_Idiomas`.`Maestros` (`idMaestros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_Idiomas1`
    FOREIGN KEY (`Idiomas_idIdiomas`)
    REFERENCES `Centro_Idiomas`.`Idiomas` (`idIdiomas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Cursos_Maestros1_idx` ON `Centro_Idiomas`.`Cursos` (`Maestros_idMaestros` ASC);

CREATE INDEX `fk_Cursos_Idiomas1_idx` ON `Centro_Idiomas`.`Cursos` (`Idiomas_idIdiomas` ASC);


-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Inscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Inscripciones` (
  `idInscripciones` INT NOT NULL,
  `Fecha_Insc` DATE NULL,
  `Status` TINYINT(1) NULL,
  `N_Control` VARCHAR(45) NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellido_Paterno` VARCHAR(45) NULL,
  `Apellido_Materno` VARCHAR(45) NULL,
  `Carrera` VARCHAR(45) NULL,
  `Semestre` VARCHAR(45) NULL,
  `Cursos_idCursos` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`idInscripciones`, `Cursos_idCursos`),
  CONSTRAINT `fk_Inscripciones_Cursos1`
    FOREIGN KEY (`Cursos_idCursos`)
    REFERENCES `Centro_Idiomas`.`Cursos` (`idCursos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Inscripciones_Cursos1_idx` ON `Centro_Idiomas`.`Inscripciones` (`Cursos_idCursos` ASC);


-- -----------------------------------------------------
-- Table `Centro_Idiomas`.`Examen_Nivelacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Centro_Idiomas`.`Examen_Nivelacion` (
  `idExamen_Nivelacion` INT NOT NULL AUTO_INCREMENT,
  `N_Control` VARCHAR(45) NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellido_Paterno` VARCHAR(45) NULL,
  `Apellido_Materno` VARCHAR(45) NULL,
  `Carrera` VARCHAR(45) NULL,
  `Semestre` VARCHAR(45) NULL,
  PRIMARY KEY (`idExamen_Nivelacion`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Centro_Idiomas`.`Cursos`
-- -----------------------------------------------------
START TRANSACTION;
USE `Centro_Idiomas`;
INSERT INTO `Centro_Idiomas`.`Cursos` (`idCursos`, `Nivel`, `Horario`, `salon`, `Fec_Inicio_Insc`, `Fec_Fin_Insc`, `Fecha_Inicio_Curso`, `Fecha_Fin_Curso`, `Maestros_idMaestros`, `Idiomas_idIdiomas`) VALUES (DEFAULT, DEFAULT, '12:00', DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT);

COMMIT;

