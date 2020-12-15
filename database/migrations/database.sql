-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema appfactory
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema appfactory
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `appfactory` DEFAULT CHARACTER SET utf8 ;
USE `appfactory` ;

-- -----------------------------------------------------
-- Table `appfactory`.`classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `year` INT NULL,
  `section` CHAR(1) NULL,
  `course` CHAR(3) NULL,
  `site` ENUM('colamonico', 'chiarulli') NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appfactory`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(128) NOT NULL,
  `last_name` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `class_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_classes_idx` (`class_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_classes`
    FOREIGN KEY (`class_id`)
    REFERENCES `appfactory`.`classes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appfactory`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appfactory`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `description` TEXT NULL,
  `allergens` TEXT NULL,
  `price` DECIMAL(6,2) NOT NULL,
  `num_items` INT NULL,
  `default_daily_stock` INT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_categories1_idx` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`category_id`)
    REFERENCES `appfactory`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appfactory`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `orderscol` VARCHAR(45) NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `appfactory`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appfactory`.`order_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appfactory`.`order_product` (
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quanity` INT NOT NULL DEFAULT 1,
  `price` DECIMAL(6,2) NOT NULL,
  PRIMARY KEY (`order_id`, `product_id`),
  INDEX `fk_orders_has_products_products1_idx` (`product_id` ASC) VISIBLE,
  INDEX `fk_orders_has_products_orders1_idx` (`order_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_has_products_orders1`
    FOREIGN KEY (`order_id`)
    REFERENCES `appfactory`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_has_products_products1`
    FOREIGN KEY (`product_id`)
    REFERENCES `appfactory`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
