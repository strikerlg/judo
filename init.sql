-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema judo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema judo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `judo` DEFAULT CHARACTER SET latin1 ;
USE `judo` ;

-- -----------------------------------------------------
-- Table `judo`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `judo`.`events` (
  `evid` INT(11) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `organization` VARCHAR(45) NULL DEFAULT NULL,
  `date` DATETIME NOT NULL,
  `pic` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`evid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `judo`.`profiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `judo`.`profiles` (
  `pid` INT(11) NOT NULL,
  `pic` VARCHAR(45) NULL DEFAULT NULL,
  `weight` DECIMAL(32,0) NULL DEFAULT NULL,
  `height` DECIMAL(32,0) NULL DEFAULT NULL,
  `matches` INT(11) NULL DEFAULT NULL,
  `wins` VARCHAR(45) NULL DEFAULT NULL,
  `name` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NULL DEFAULT NULL,
  `birthdate` DATE NULL DEFAULT NULL,
  `gender` VARCHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`pid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `judo`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `judo`.`users` (
  `usrid` INT(11) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `dob` DATE NOT NULL,
  `account` BINARY(1) NOT NULL DEFAULT '0',
  `username` VARCHAR(45) NULL DEFAULT NULL,
  `salt` VARCHAR(45) NULL DEFAULT NULL,
  `hash` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`usrid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
