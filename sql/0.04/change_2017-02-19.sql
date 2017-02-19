
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

CREATE TABLE `maintenance` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`particulars` varchar(255) DEFAULT NULL,
	`description` varchar(255) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '1',
	`created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Home');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Business');
INSERT INTO `maintenance` (`particulars`, `description`, `status`) VALUES ('address_type', 'Billing', '1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Shipping');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Contact');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Land Trip');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Sea Freight');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Air Freight');


INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('booking_status', 'Cancelled Pick Up');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('booking_status', 'For Monitoring');

ALTER TABLE `booking` 
CHANGE COLUMN `department_id` `contact_id` INT(20) NULL DEFAULT NULL ;

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Accommodations');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Accounting');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Advertising ');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Information');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Music');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Construction');

ALTER TABLE `customer_information` 
CHANGE COLUMN `industry_type` `industry_type` VARCHAR(225) NULL DEFAULT NULL ;

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('services', 'Sample1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('services', 'Sample2');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('delivery_instruction', 'Sample1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('delivery_instruction', 'Sample2');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('commodity_class', 'Sample1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('commodity_class', 'Sample2');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('document_attached', 'Sample1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('document_attached', 'Sample2');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_payment', 'Sample1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_payment', 'Sample2');

ALTER TABLE `booking` 
ADD COLUMN `contact` VARCHAR(2000) NULL AFTER `created_date`;




