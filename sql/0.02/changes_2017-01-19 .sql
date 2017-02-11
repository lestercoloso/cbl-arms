ALTER TABLE `rack_storage` 
ADD COLUMN `style` VARCHAR(255) NULL AFTER `status`;


ALTER TABLE `bay_storage` 
ADD COLUMN `style` VARCHAR(255) NULL AFTER `status`;
