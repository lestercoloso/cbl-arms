CREATE TABLE `inbound_list` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `client_id` int(225) DEFAULT NULL,
  `bill_of_lading` varchar(255) DEFAULT NULL,
  `delivery_receipt` varchar(255) DEFAULT NULL,
  `pallet_code` varchar(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `storage_type` varchar(255) DEFAULT NULL,
  `inventory_type` varchar(255) DEFAULT NULL,
  `ex_date` datetime DEFAULT NULL,
  `en_date` datetime DEFAULT NULL,
  `pu_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `customer_information` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(225) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


ALTER TABLE `inbound_list` 
ADD COLUMN `invoice_no` INT(45) NULL AFTER `delivery_receipt`;

ALTER TABLE `inbound_list` 
ADD COLUMN `location` varchar(255) NULL AFTER `delivery_receipt`;


ALTER TABLE `inbound_list` 
ADD COLUMN `code` INT(45) NULL AFTER `invoice_no`;

ALTER TABLE `inbound_list` 
ADD COLUMN `rack_level` INT(45) NULL AFTER `code`;


ALTER TABLE `inbound_list` 
CHANGE COLUMN `ex_date` `ex_date` DATE NULL DEFAULT NULL ,
CHANGE COLUMN `en_date` `en_date` DATE NULL DEFAULT NULL ,
CHANGE COLUMN `pu_date` `pu_date` DATE NULL DEFAULT NULL ;



