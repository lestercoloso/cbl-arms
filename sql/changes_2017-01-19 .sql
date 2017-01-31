ALTER TABLE `cblarms`.`rack_storage` 
ADD COLUMN `style` VARCHAR(255) NULL AFTER `status`;


ALTER TABLE `cblarms`.`bay_storage` 
ADD COLUMN `style` VARCHAR(255) NULL AFTER `status`;
