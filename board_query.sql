-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gm1702848
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `gm1702848` ;

-- -----------------------------------------------------
-- Schema gm1702848
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gm1702848` DEFAULT CHARACTER SET utf8 ;
USE `gm1702848` ;

-- -----------------------------------------------------
-- Table `gm1702848`.`board`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gm1702848`.`board` ;

CREATE TABLE IF NOT EXISTS `gm1702848`.`board` (
  `board_id` INT NOT NULL AUTO_INCREMENT,
  `parent_id` INT NULL,
  `title` VARCHAR(45) NOT NULL,
  `content` VARCHAR(45) NOT NULL,
  `writer` VARCHAR(45) NOT NULL,
  `reg_date` TIMESTAMP NOT NULL DEFAULT NOW(),
  `password` VARCHAR(255) NOT NULL,
  `hit` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`board_id`),
  UNIQUE INDEX `board_id_UNIQUE` (`board_id` ASC),
  INDEX `self_refer_idx` (`parent_id` ASC),
  CONSTRAINT `self_refer`
    FOREIGN KEY (`parent_id`)
    REFERENCES `gm1702848`.`board` (`board_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gm1702848`.`reply`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `gm1702848`.`reply` ;

CREATE TABLE IF NOT EXISTS `gm1702848`.`reply` (
  `reply_id` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `reg_date` TIMESTAMP NOT NULL DEFAULT NOW(),
  `writer` VARCHAR(45) NOT NULL,
  `board_id` INT NOT NULL,
  PRIMARY KEY (`reply_id`),
  UNIQUE INDEX `board_id_UNIQUE` (`reply_id` ASC),
  INDEX `fk_reply_board_idx` (`board_id` ASC),
  CONSTRAINT `fk_reply_board`
    FOREIGN KEY (`board_id`)
    REFERENCES `gm1702848`.`board` (`board_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `gm1702848`.`board`
-- -----------------------------------------------------
START TRANSACTION;
USE `gm1702848`;
INSERT INTO `gm1702848`.`board` (`board_id`, `parent_id`, `title`, `content`, `writer`, `reg_date`, `password`, `hit`) VALUES (1, 1, 'parent', '0', '0', '0', '0', 0);

COMMIT;

