CREATE TABLE `maintenance_table` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `particulars` varchar(255) DEFAULT NULL,
  `exp` tinyint(1) DEFAULT '0',
  `batch` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

ALTER TABLE `maintenance_table` 
ADD UNIQUE INDEX `index2` (`particulars` ASC);

ALTER TABLE `item_master_file` 
ADD COLUMN `replenish_level` INT(20) NULL AFTER `status`;

ALTER TABLE `item_master_file` 
CHANGE COLUMN `product_code` `stock_no` VARCHAR(20) NULL DEFAULT NULL ;


ALTER TABLE `item_master_file` 
ADD COLUMN `item_master_filecol` VARCHAR(45) NULL AFTER `replenish_level`,
ADD COLUMN `item_description` VARCHAR(45) NULL AFTER `item_master_filecol`;


ALTER TABLE `item_master_file` 
ADD COLUMN `weight` DOUBLE NULL DEFAULT 0 AFTER `height`;


CREATE TABLE `location_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(10) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `storage_type` varchar(225) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
