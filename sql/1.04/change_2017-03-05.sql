ALTER TABLE `booking` 
ADD COLUMN `transaction_type` varchar(255) NULL DEFAULT 'Delivery' AFTER `department`;


ALTER TABLE `customer_information` 
CHANGE COLUMN `customer_type` `customer_type` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `assistant_executive_1` `assistant_executive_1` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `assistant_executive_2` `assistant_executive_2` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `area_3` `area_3` VARCHAR(225) NULL ,
CHANGE COLUMN `tax_type` `tax_type` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `preferred_supplier` `preferred_supplier` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_ds` `pricelist_ds` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_da` `pricelist_da` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_dt` `pricelist_dt` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_is` `pricelist_is` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_ia` `pricelist_ia` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `pricelist_it` `pricelist_it` VARCHAR(225) NULL DEFAULT NULL ,
CHANGE COLUMN `billing_format` `billing_format` VARCHAR(225) NULL DEFAULT NULL ;
