
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- make
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `make`;

CREATE TABLE `make`
(
    `id` INTEGER NOT NULL,
    `BrandName` VARCHAR(45),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- vehicle
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle`;

CREATE TABLE `vehicle`
(
    `id` INTEGER NOT NULL,
    `Name` VARCHAR(45),
    `Color` VARCHAR(45),
    `Make_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_Vehicle_Make_idx` (`Make_id`),
    CONSTRAINT `fk_Vehicle_Make`
        FOREIGN KEY (`Make_id`)
        REFERENCES `make` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
