ALTER TABLE `item_master_file` 
CHANGE COLUMN `bar_code` `bar_code` VARCHAR(20) NULL DEFAULT NULL ,
CHANGE COLUMN `case_bar_code` `case_bar_code` VARCHAR(20) NULL DEFAULT NULL ,
ADD COLUMN `non_sku` TINYINT(1) NULL AFTER `item_id`,
ADD COLUMN `carton_per_pallet` INT(10) NULL AFTER `unit_cost`,
ADD COLUMN `cbm` DOUBLE NULL AFTER `unit_cost`,
ADD COLUMN `share_pallet_group` INT(10) NULL AFTER `unit_cost`;

ALTER TABLE `storage` 
ADD COLUMN `locations` int(5) NULL AFTER `block`;


ALTER TABLE `pallet_position` 
CHANGE COLUMN `pallet_position` `rack_location` VARCHAR(5) NULL DEFAULT NULL ,
CHANGE COLUMN `wing` `type` VARCHAR(255) NULL DEFAULT NULL ,
ADD COLUMN `bin_location` VARCHAR(45) NULL AFTER `rack_location`;



CREATE TABLE `inbound_shipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `inbound_no` int(10) DEFAULT NULL,
  `estimated_arrival` datetime DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `booked_by` varchar(355) DEFAULT NULL,
  `booked_by_id` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `cbl_status` tinyint(1) DEFAULT '1',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
  
  
CREATE TABLE `inbound_shipment_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `inbound_id` int(10) DEFAULT NULL,
  `pieces` int(10) DEFAULT NULL,
  `box` int(10) DEFAULT NULL,
  `carton` int(10) DEFAULT NULL,
  `stock_no` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cbm` varchar(255) DEFAULT NULL,
  `total_cbm` varchar(255) DEFAULT NULL,
  `batch_code` varchar(255) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
  
  CREATE TABLE `outbound_shipment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `outbound_no` int(10) DEFAULT NULL,
  `estimated_arrival` datetime DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `booked_by` varchar(355) DEFAULT NULL,
  `booked_by_id` int(10) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `cbl_status` tinyint(1) DEFAULT '1',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
  
  
CREATE TABLE `outbound_shipment_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `outbound_id` int(10) DEFAULT NULL,
  `pieces` int(10) DEFAULT NULL,
  `box` int(10) DEFAULT NULL,
  `carton` int(10) DEFAULT NULL,
  `stock_no` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cbm` varchar(255) DEFAULT NULL,
  `total_cbm` varchar(255) DEFAULT NULL,
  `batch_code` varchar(255) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


ALTER TABLE `item_master_file` 
CHANGE COLUMN `share_pallet_group` `share_pallet_group` VARCHAR(255) NULL DEFAULT NULL,
CHANGE COLUMN `uom_qty_1` `uom_qty_1` VARCHAR(255) NULL DEFAULT NULL,
CHANGE COLUMN `uom_qty_2` `uom_qty_2` VARCHAR(255) NULL DEFAULT NULL,
CHANGE COLUMN `uom_qty_3` `uom_qty_3` VARCHAR(255) NULL DEFAULT NULL;
