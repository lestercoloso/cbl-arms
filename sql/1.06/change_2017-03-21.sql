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
