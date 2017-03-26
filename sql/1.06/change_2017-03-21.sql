ALTER TABLE `bay_storage` 
ADD COLUMN `block` VARCHAR(45) NOT NULL DEFAULT 'A' AFTER `style`;

ALTER TABLE `rack_storage` 
ADD COLUMN `block` VARCHAR(45) NOT NULL DEFAULT 'A' AFTER `style`;
ALTER TABLE `rack_storage` 
ADD COLUMN `no_rack_section` INT(5) NULL DEFAULT 1 AFTER `block`;

ALTER TABLE `rack_storage` 
ADD COLUMN `no_pallet_position` INT(5) NOT NULL DEFAULT 1 AFTER `no_rack_section`;


ALTER TABLE `inbound_list` 
ADD COLUMN `customer_name` VARCHAR(255) NOT NULL AFTER `client_id`;


INSERT INTO `modules` (`appgroup`, `module`, `sub_module`, `status`, `sort_order`) VALUES ('MAINTENANCE', 'Item Master File', '0', '1', '0');

ALTER TABLE `rack_storage` 
ADD COLUMN `storage_type` VARCHAR(45) NOT NULL AFTER `no_pallet_position`;


CREATE TABLE `item_master_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_id` int(10) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
  `bar_code` varchar(20) DEFAULT NULL,
  `case_bar_code` varchar(20) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `packaging` tinyint(1) DEFAULT '1',
  `storage_type` varchar(255) DEFAULT NULL,
  `length` float(50) DEFAULT 0,
  `width` float(50) DEFAULT 0,
  `height` float(50) DEFAULT 0,
  `unit_cost` float(50) DEFAULT 0,
  `unit_price` float(50) DEFAULT 0,
  `floor_level` int(20) DEFAULT 0,
  `ceiling_level` int(20) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
