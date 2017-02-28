ALTER TABLE `bill_of_lading` 
ADD COLUMN `quantity` INT(10) NULL DEFAULT 0 AFTER `bill_no`;