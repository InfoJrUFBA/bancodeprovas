-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bancodeprovas
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `bancodeprovas` ;

-- -----------------------------------------------------
-- Schema bancodeprovas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bancodeprovas` DEFAULT CHARACTER SET utf8 ;
USE `bancodeprovas` ;

-- -----------------------------------------------------
-- Table `bancodeprovas`.`areas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`areas` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`areas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bancodeprovas`.`components`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`components` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`components` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bancodeprovas`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`courses` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`courses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `type` TINYINT(1) NOT NULL,
  `areas_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_courses_areas1_idx` (`areas_id` ASC),
  CONSTRAINT `fk_courses_areas1`
    FOREIGN KEY (`areas_id`)
    REFERENCES `bancodeprovas`.`areas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bancodeprovas`.`courses_has_components`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`courses_has_components` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`courses_has_components` (
  `courses_id` INT(11) NOT NULL,
  `components_id` INT(11) NOT NULL,
  PRIMARY KEY (`courses_id`, `components_id`),
  INDEX `fk_courses_has_components_components1_idx` (`components_id` ASC),
  INDEX `fk_courses_has_components_courses1_idx` (`courses_id` ASC),
  CONSTRAINT `fk_courses_has_components_components1`
    FOREIGN KEY (`components_id`)
    REFERENCES `bancodeprovas`.`components` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_courses_has_components_courses1`
    FOREIGN KEY (`courses_id`)
    REFERENCES `bancodeprovas`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bancodeprovas`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`users` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NULL DEFAULT NULL,
  `score` INT(11) NOT NULL DEFAULT '0',
  `birthdate` DATE NOT NULL,
  `level` TINYINT(2) NOT NULL,
  `courses_id` INT(11) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `active` VARCHAR(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_courses_idx` (`courses_id` ASC),
  UNIQUE INDEX `token_UNIQUE` (`token` ASC),
  CONSTRAINT `fk_users_courses`
    FOREIGN KEY (`courses_id`)
    REFERENCES `bancodeprovas`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bancodeprovas`.`exams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `bancodeprovas`.`exams` ;

CREATE TABLE IF NOT EXISTS `bancodeprovas`.`exams` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `professor` VARCHAR(100) NOT NULL,
  `period` VARCHAR(15) NOT NULL,
  `created_at` DATE NOT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT '1',
  `components_id` INT(11) NOT NULL,
  `unit` TINYINT(1) NOT NULL,
  `users_id` INT(10) UNSIGNED NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exams_components1_idx` (`components_id` ASC),
  INDEX `fk_exams_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_exams_components1`
    FOREIGN KEY (`components_id`)
    REFERENCES `bancodeprovas`.`components` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exams_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `bancodeprovas`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
