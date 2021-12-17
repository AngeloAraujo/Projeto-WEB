-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema devweb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema devweb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `devweb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `devweb` ;

-- -----------------------------------------------------
-- Table `devweb`.`modelo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`modelo` (
  `id_modelo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  `modelo` VARCHAR(45) NULL DEFAULT NULL,
  `consumo` FLOAT NULL DEFAULT NULL,
  `tanque` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_modelo`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`veiculo` (
  `id_veiculo` INT NOT NULL AUTO_INCREMENT,
  `id_modelo` INT NOT NULL,
  `placa` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_veiculo`, `id_modelo`),
  INDEX `id_modelo_idx` (`id_modelo` ASC),
  CONSTRAINT `id_modelo`
    FOREIGN KEY (`id_modelo`)
    REFERENCES `devweb`.`modelo` (`id_modelo`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`abastecimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`abastecimento` (
  `id_abastecimento` INT NOT NULL AUTO_INCREMENT,
  `preco` DOUBLE NULL DEFAULT NULL,
  `litros` FLOAT NULL DEFAULT NULL,
  `id_veiculo` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id_abastecimento`),
  INDEX `id_veiculo_idx` (`id_veiculo` ASC),
  CONSTRAINT `id_veiculo`
    FOREIGN KEY (`id_veiculo`)
    REFERENCES `devweb`.`veiculo` (`id_veiculo`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`motorista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`motorista` (
  `id_motorista` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_motorista`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`endereco` (
  `rua` VARCHAR(45) NULL DEFAULT NULL,
  `numero` INT NULL DEFAULT NULL,
  `bairro` VARCHAR(45) NULL DEFAULT NULL,
  `cidade` VARCHAR(45) NULL DEFAULT NULL,
  `id_motorista` INT NOT NULL,
  INDEX `id_motorista_idx` (`id_motorista` ASC),
  PRIMARY KEY (`id_motorista`),
  CONSTRAINT `id_motorista`
    FOREIGN KEY (`id_motorista`)
    REFERENCES `devweb`.`motorista` (`id_motorista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`rota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`rota` (
  `id_rota` INT NOT NULL AUTO_INCREMENT,
  `km` INT NULL DEFAULT NULL,
  `origem` VARCHAR(45) NULL DEFAULT NULL,
  `destino` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_rota`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `devweb`.`viagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `devweb`.`viagem` (
  `id_viagem` INT NOT NULL AUTO_INCREMENT,
  `id_veiculo` INT NOT NULL,
  `id_motorista` INT NOT NULL,
  `id_rota` INT NOT NULL,
  PRIMARY KEY (`id_viagem`, `id_motorista`, `id_rota`, `id_veiculo`),
  INDEX `id_veiculo_idx` (`id_veiculo` ASC),
  INDEX `id_motorista_idx` (`id_motorista` ASC),
  INDEX `id_rota_idx` (`id_rota` ASC),
  CONSTRAINT `id_motorista1`
    FOREIGN KEY (`id_motorista`)
    REFERENCES `devweb`.`motorista` (`id_motorista`),
  CONSTRAINT `id_rota`
    FOREIGN KEY (`id_rota`)
    REFERENCES `devweb`.`rota` (`id_rota`),
  CONSTRAINT `id_veiculo1`
    FOREIGN KEY (`id_veiculo`)
    REFERENCES `devweb`.`veiculo` (`id_veiculo`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
