-- MySQL Script generated by MySQL Workbench
-- 10/13/15 19:44:50
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema BurritoBar
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema BurritoBar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `BurritoBar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `BurritoBar` ;

-- -----------------------------------------------------
-- Table `BurritoBar`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BurritoBar`.`User` (
  `userID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(16) NOT NULL COMMENT '',
  `guest` TINYINT(1) NULL COMMENT '',
  `creditProvider` VARCHAR(20) NOT NULL COMMENT '',
  `ccNum` INT NOT NULL COMMENT '',
  `firstName` VARCHAR(20) NOT NULL COMMENT '',
  `lastName` VARCHAR(20) NOT NULL COMMENT '',
  `loggedIn` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`userID`)  COMMENT '',
  UNIQUE INDEX `userID_UNIQUE` (`userID` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `ccNum_UNIQUE` (`ccNum` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BurritoBar`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BurritoBar`.`Orders` (
  `orderID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `customerID` INT UNSIGNED NOT NULL COMMENT '',
  `timeOrdered` DATETIME NOT NULL COMMENT '',
  `orderJSON` VARCHAR(200) NOT NULL COMMENT '',
  PRIMARY KEY (`orderID`)  COMMENT '',
  UNIQUE INDEX `orderID_UNIQUE` (`orderID` ASC)  COMMENT '',
  UNIQUE INDEX `customerID_UNIQUE` (`customerID` ASC)  COMMENT '',
  CONSTRAINT `fk_Orders_User`
    FOREIGN KEY (`customerID`)
    REFERENCES `BurritoBar`.`User` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BurritoBar`.`Items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BurritoBar`.`Items` (
  `itemName` VARCHAR(20) NOT NULL COMMENT '',
  `itemType` VARCHAR(20) NOT NULL COMMENT '',
  `itemPrice` INT UNSIGNED NOT NULL COMMENT '',
  `itemID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  PRIMARY KEY (`itemID`)  COMMENT '',
  UNIQUE INDEX `itemID_UNIQUE` (`itemID` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BurritoBar`.`Session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `BurritoBar`.`Session` (
  `sessionID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `sessionStart` DATETIME NOT NULL COMMENT '',
  `lastUse` DATETIME NOT NULL COMMENT '',
  `userID` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`sessionID`)  COMMENT '',
  UNIQUE INDEX `sessionID_UNIQUE` (`sessionID` ASC)  COMMENT '',
  UNIQUE INDEX `userID_UNIQUE` (`userID` ASC)  COMMENT '',
  CONSTRAINT `fk_Session_User1`
    FOREIGN KEY (`userID`)
    REFERENCES `BurritoBar`.`User` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
