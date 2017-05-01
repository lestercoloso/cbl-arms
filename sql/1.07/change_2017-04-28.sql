
CREATE TABLE `storage` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` int(225) DEFAULT NULL,
  `location` int(225) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `storage_type` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `levels` int(20) DEFAULT NULL,
  `sections` int(20) DEFAULT NULL,
  `wing` varchar(20) DEFAULT NULL,
  `style` varchar(2555) DEFAULT NULL,
  `block` varchar(45) NOT NULL DEFAULT 'A',
  `status` tinyint(1) DEFAULT '1',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `pallet_position` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `storage_id` int(20) DEFAULT NULL,
  `rack_section` int(20) DEFAULT NULL,
  `rack_level` int(20) DEFAULT NULL,
  `pallet_position` tinyint(1) DEFAULT NULL,
  `wing` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `pallet_position_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `storage_id` int(20) DEFAULT NULL,
  `rack_section` int(20) DEFAULT NULL,
  `rack_level` int(20) DEFAULT NULL,
  `pallet_position` tinyint(1) DEFAULT NULL,
  `wing` varchar(20) DEFAULT NULL,
  `location_code` varchar(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
