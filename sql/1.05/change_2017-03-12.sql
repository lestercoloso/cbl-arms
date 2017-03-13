ALTER TABLE `booking` 
ADD COLUMN `vehicle` VARCHAR(2000) NULL AFTER `contact`;


CREATE TABLE `inventory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `booking_id` bigint(20) NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `product_code` varchar(225) DEFAULT NULL,
  `bar_code` int(20) DEFAULT NULL,
  `casebar_code` int(20) DEFAULT NULL,
  `item_type` varchar(225) DEFAULT NULL,
  `storage_type` varchar(225) DEFAULT NULL,
  `unit_of_measurement` varchar(225) DEFAULT NULL,
  `packaging` int(20) DEFAULT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `unit_cost` float DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `floor_level` int(20) DEFAULT NULL,
  `ceiling_level` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

ALTER TABLE `bill_of_lading` 
ADD COLUMN `amount` FLOAT NOT NULL DEFAULT 0.00 AFTER `shipper`;



