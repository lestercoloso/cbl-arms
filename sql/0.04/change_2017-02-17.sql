drop table `customer_information`;
CREATE TABLE `customer_information` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`customer_code` int(10) DEFAULT NULL,
	`customer_type` int(10) DEFAULT NULL,
	`customer_name` varchar(225) DEFAULT NULL,
	`company_anniversary` date DEFAULT NULL,
	`tel_no` varchar(225) DEFAULT NULL,
	`fax_no` varchar(225) DEFAULT NULL,
	`industry_type` int(20) DEFAULT NULL,
	`address` varchar(775) DEFAULT NULL,
	`tin_no` varchar(50) DEFAULT NULL,
	`city` varchar(225) DEFAULT NULL,
	`assistant_executive_1` bigint(20) DEFAULT NULL,
	`assistant_executive_2` bigint(20) DEFAULT NULL,
	`area_1` varchar(225) DEFAULT NULL,
	`area_2` varchar(225) DEFAULT NULL,
	`area_3` varchar(225) DEFAULT NULL,
	`area_4` varchar(225) DEFAULT NULL,
	`area_5` varchar(225) DEFAULT NULL,
	`region` varchar(225) DEFAULT NULL,
	`tax_type` bigint(20) DEFAULT NULL,    
	`payment_terms` varchar(225) DEFAULT NULL,
	`preferred_supplier` bigint(20) DEFAULT NULL,    
	`pricelist_ds` bigint(20) DEFAULT NULL,    
	`pricelist_da` bigint(20) DEFAULT NULL,    
	`pricelist_dt` bigint(20) DEFAULT NULL,    
	`pricelist_is` bigint(20) DEFAULT NULL,    
	`pricelist_ia` bigint(20) DEFAULT NULL,    
	`pricelist_it` bigint(20) DEFAULT NULL,    
	`follow_up_day` varchar(225) DEFAULT NULL,    
	`collection_day` varchar(225) DEFAULT NULL,    
	`billing_cycle` varchar(225) DEFAULT NULL,    
	`credit_limit` varchar(225) DEFAULT NULL,    
	`billing_format` bigint(20) DEFAULT NULL,        
    `status` tinyint(1) DEFAULT '1',
	`created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE KEY `customer_code` (`customer_code`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


ALTER TABLE `customer_information` 
ADD COLUMN `customer_status` TINYINT(2) NULL DEFAULT 1 AFTER `created_date`;

ALTER TABLE `customer_information` 
CHANGE COLUMN `industry_type` `industry_type` VARCHAR(225) NULL DEFAULT NULL ;
