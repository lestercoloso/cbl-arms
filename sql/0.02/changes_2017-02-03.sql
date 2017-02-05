
CREATE TABLE `bill_of_lading` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) DEFAULT NULL,
  `book_id` bigint(20) DEFAULT NULL,
  `bill_no` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

ALTER TABLE `inbound_list` 
ADD COLUMN `type_of_shipment` tinyint(1) NULL AFTER `code`;

ALTER TABLE `inbound_list` 
ADD COLUMN `storage` varchar(10) NULL AFTER `code`;

ALTER TABLE `cblarms`.`inbound_list` 
CHANGE COLUMN `storage_type` `storage_type` TINYINT(1) NULL DEFAULT NULL ;




