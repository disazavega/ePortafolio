SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `eportfolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `eportfolio` ;

-- -----------------------------------------------------
-- Table `eportfolio`.`form`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`form` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `url` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`field`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`field` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  `idForm` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_field_form1_idx` (`idForm` ASC) ,
  CONSTRAINT `fk_field_form1`
    FOREIGN KEY (`idForm` )
    REFERENCES `eportfolio`.`form` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`fieldInstance`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`fieldInstance` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `value` VARCHAR(45) NULL ,
  `date` TIMESTAMP NULL ,
  `idField` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_field_instance_field_idx` (`idField` ASC) ,
  CONSTRAINT `fk_field_instance_field`
    FOREIGN KEY (`idField` )
    REFERENCES `eportfolio`.`field` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`schema`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`schema` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `author` VARCHAR(45) NULL ,
  `createdAt` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`table`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`table` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `idSchema` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_table_schema1_idx` (`idSchema` ASC) ,
  CONSTRAINT `fk_table_schema1`
    FOREIGN KEY (`idSchema` )
    REFERENCES `eportfolio`.`schema` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`attribute`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`attribute` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idTable` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_attribute_table1_idx` (`idTable` ASC) ,
  CONSTRAINT `fk_attribute_table1`
    FOREIGN KEY (`idTable` )
    REFERENCES `eportfolio`.`table` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`concetpMaterialized`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`concetpMaterialized` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  `idForm` INT NOT NULL ,
  `idTable` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_concetpMaterialized_form1_idx` (`idForm` ASC) ,
  INDEX `fk_concetpMaterialized_table1_idx` (`idTable` ASC) ,
  CONSTRAINT `fk_concetpMaterialized_form1`
    FOREIGN KEY (`idForm` )
    REFERENCES `eportfolio`.`form` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_concetpMaterialized_table1`
    FOREIGN KEY (`idTable` )
    REFERENCES `eportfolio`.`table` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`alignment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`alignment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `idField` INT NOT NULL ,
  `idAttribute` INT NOT NULL ,
  `idConcept` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_alignment_field1_idx` (`idField` ASC) ,
  INDEX `fk_alignment_attribute1_idx` (`idAttribute` ASC) ,
  INDEX `fk_alignment_concetpMaterialized1_idx` (`idConcept` ASC) ,
  CONSTRAINT `fk_alignment_field1`
    FOREIGN KEY (`idField` )
    REFERENCES `eportfolio`.`field` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alignment_attribute1`
    FOREIGN KEY (`idAttribute` )
    REFERENCES `eportfolio`.`attribute` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alignment_concetpMaterialized1`
    FOREIGN KEY (`idConcept` )
    REFERENCES `eportfolio`.`concetpMaterialized` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`key`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`key` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idTable` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_key_table1_idx` (`idTable` ASC) ,
  CONSTRAINT `fk_key_table1`
    FOREIGN KEY (`idTable` )
    REFERENCES `eportfolio`.`table` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eportfolio`.`foreignKey`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eportfolio`.`foreignKey` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idTable` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_foreignKey_table1_idx` (`idTable` ASC) ,
  CONSTRAINT `fk_foreignKey_table1`
    FOREIGN KEY (`idTable` )
    REFERENCES `eportfolio`.`table` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `eportfolio` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
