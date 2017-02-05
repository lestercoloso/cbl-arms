CREATE TABLE `version` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`description` varchar(225) DEFAULT NULL,
	`version` varchar(255) DEFAULT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;



CREATE TABLE `rack_storage` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` int(225) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`rack_length` int(225) DEFAULT NULL,
	`rack_width` int(225) DEFAULT NULL,
	`no_rack_level` int(225) DEFAULT NULL,
	`rack_level_height` int(225) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '1',
	PRIMARY KEY (`id`),
	UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


CREATE TABLE `bay_storage` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`code` int(225) DEFAULT NULL,
	`name` varchar(255) DEFAULT NULL,
	`bay_length` int(225) DEFAULT NULL,
	`bay_width` int(225) DEFAULT NULL,
	`status` tinyint(1) DEFAULT '1',
	PRIMARY KEY (`id`),
	UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;
