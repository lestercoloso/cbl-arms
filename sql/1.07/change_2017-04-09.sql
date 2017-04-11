ALTER TABLE `cblarms`.`user_account` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD UNIQUE INDEX `id_UNIQUE` (`id` ASC);


ALTER TABLE `user_profiles` 
DROP COLUMN `date_cretated`;

ALTER TABLE `user_profiles` 
DROP COLUMN `status`;

ALTER TABLE `user_account` 
CHANGE COLUMN `datecreated` `datecreated` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `user_profiles` 
DROP COLUMN `user_type`;
