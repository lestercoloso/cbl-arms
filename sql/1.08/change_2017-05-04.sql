ALTER TABLE `inbound_shipment_list` 
ADD COLUMN `wh_status` VARCHAR(45) NULL AFTER `status`,
ADD COLUMN `wh_storage` VARCHAR(255) NULL AFTER `wh_status`,
ADD COLUMN `storage_type` VARCHAR(255) NULL AFTER `wh_storage`,
ADD COLUMN `pallet_position_code` VARCHAR(45) NULL AFTER `storage_type`;

ALTER TABLE `inbound_shipment` 
ADD COLUMN `shipped_to` VARCHAR(255) NULL AFTER `cbl_status`,
ADD COLUMN `entry_date` DATE NULL AFTER `shipped_to`;

