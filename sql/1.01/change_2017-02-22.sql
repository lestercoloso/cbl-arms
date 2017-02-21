ALTER TABLE `inbound_list` 
CHANGE COLUMN `type_of_shipment` `type_of_shipment` VARCHAR(255) NULL DEFAULT NULL ,
CHANGE COLUMN `quantity` `quantity` INT(10) NULL DEFAULT NULL ,
CHANGE COLUMN `storage_type` `storage_type` VARCHAR(255) NULL DEFAULT NULL,
CHANGE COLUMN `datecreated` `datecreated` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
CHANGE COLUMN `id` `id` BIGINT(20) NOT NULL AUTO_INCREMENT
;




INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('pullout_shipment', 'Transfer');
INSERT INTO `maintenance` (`particulars`, `description`) VALUES ('pullout_shipment', 'Release');


CREATE TABLE `outbound_list` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `inbound_id` bigint(20) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `pullout_type` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `datecreated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


