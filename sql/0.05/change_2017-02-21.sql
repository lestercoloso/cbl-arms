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
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Billing');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Shipping');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('address_type', 'Contact');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Land Trip');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Sea Freight');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('mode_of_shipping', 'Air Freight');


INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('booking_status', 'Cancelled Pick Up');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('booking_status', 'For Monitoring');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Accommodations');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Accounting');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Advertising ');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Information');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Music');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('industry_type', 'Construction');

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

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('storage_type', 'Ambiant Storage');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('storage_type', 'Cool Storage');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('subinventory_type', 'Sample 1');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('subinventory_type', 'Sample 2');

INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('type_of_shipment', 'Pickup');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('type_of_shipment', 'Delivery');