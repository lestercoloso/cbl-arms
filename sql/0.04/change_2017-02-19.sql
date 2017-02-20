
CREATE TABLE `customer_contact` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`customer_id` bigint(20) DEFAULT NULL,
	`birth_date` date DEFAULT NULL,
	`contact_no` varchar(255) DEFAULT NULL,
	`department` varchar(255) DEFAULT NULL,
	`designation` varchar(255) DEFAULT NULL,
	`email` varchar(255) DEFAULT NULL,
	`first_name` varchar(255) DEFAULT NULL,
	`last_name` varchar(255) DEFAULT NULL,
	`middle_initial` varchar(255) DEFAULT NULL,
	`mobile_no` varchar(255) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '1',
	`created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `customer_address` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`customer_id` bigint(20) DEFAULT NULL,
	`address` varchar(255) DEFAULT NULL,
	`address_type` varchar(255) DEFAULT NULL,
	`city` varchar(255) DEFAULT NULL,
	`area` varchar(255) DEFAULT NULL,
	`region` varchar(255) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '1',
	`created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

ALTER TABLE `booking` 
CHANGE COLUMN `mode_of_shipping` `mode_of_shipping` VARCHAR(225) NULL DEFAULT NULL ;

ALTER TABLE `booking` 
CHANGE COLUMN `vehicle_type` `vehicle_type` VARCHAR(225) NULL DEFAULT NULL ;

ALTER TABLE `booking` 
CHANGE COLUMN `booking_status` `booking_status` VARCHAR(255) NULL DEFAULT NULL ;



ALTER TABLE `booking` 
CHANGE COLUMN `department_id` `contact_id` INT(20) NULL DEFAULT NULL ;

ALTER TABLE `customer_information` 
CHANGE COLUMN `industry_type` `industry_type` VARCHAR(225) NULL DEFAULT NULL ;


ALTER TABLE `booking` 
ADD COLUMN `contact` VARCHAR(2000) NULL AFTER `created_date`;

ALTER TABLE `inbound_list` 
CHANGE COLUMN `id` `id` BIGINT(20) NOT NULL ,
CHANGE COLUMN `client_id` `client_id` BIGINT(20) NULL DEFAULT NULL ,
CHANGE COLUMN `pallet_code` `pallet_code` INT(10) NULL DEFAULT NULL ;



ALTER TABLE `bill_of_lading` 
ADD COLUMN `shipper_information` VARCHAR(2000) NULL AFTER `status`,
ADD COLUMN `package_content` VARCHAR(2000) NULL AFTER `shipper_information`,
ADD COLUMN `charges` VARCHAR(45) NULL AFTER `package_content`,
ADD COLUMN `additional_charges` VARCHAR(2000) NULL AFTER `charges`,
ADD COLUMN `recipient_information` VARCHAR(2000) NULL AFTER `additional_charges`,
ADD COLUMN `others` VARCHAR(2000) NULL AFTER `recipient_information`,
ADD COLUMN `created_date` DATETIME DEFAULT CURRENT_TIMESTAMP AFTER `others`;


ALTER TABLE `bill_of_lading` 
ADD COLUMN `recipient` VARCHAR(255) NULL AFTER `created_date`,
ADD COLUMN `shipper` VARCHAR(255) NULL AFTER `recipient`;




