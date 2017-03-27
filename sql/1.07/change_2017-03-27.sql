ALTER TABLE `item_master_file` 
ADD COLUMN `uom_1` VARCHAR(255) NOT NULL AFTER `uom`;

ALTER TABLE `item_master_file` 
ADD COLUMN `uom_2` VARCHAR(255) NOT NULL AFTER `uom_1`;

ALTER TABLE `item_master_file` 
ADD COLUMN `uom_3` VARCHAR(255) NOT NULL AFTER `uom_2`;

ALTER TABLE `item_master_file` 
ADD COLUMN `uom_qty_1` int(10) NOT NULL AFTER `uom_3`;

ALTER TABLE `item_master_file` 
ADD COLUMN `uom_qty_2` int(10) NOT NULL AFTER `uom_qty_1`;

ALTER TABLE `item_master_file` 
ADD COLUMN `uom_qty_3` int(10) NOT NULL AFTER `uom_qty_2`;


ALTER TABLE `inbound_list` 
ADD COLUMN `irr` VARCHAR(3000) NOT NULL AFTER `status`;



CREATE TABLE `irr_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `inbound_id` bigint(20) NOT NULL,
  `pcid` bigint(20) DEFAULT NULL,
  `item_no` bigint(20) DEFAULT NULL,
  `batch_code` bigint(20) DEFAULT NULL,
  `material_desc` varchar(10) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `cbm` varchar(255) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
