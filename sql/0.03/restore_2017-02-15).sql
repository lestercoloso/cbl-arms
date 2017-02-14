drop table home_module;

CREATE TABLE `home_module` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

INSERT INTO `home_module` (`name`, `link`, `img`, `status`, `sort_order`) VALUES ('Customer Information', 'customer_information', 'customer_info.png', '1', '1');
INSERT INTO `home_module` (`name`, `link`, `img`, `status`, `sort_order`) VALUES ('Booking', 'booking', 'booking.png', '1', '2');
INSERT INTO `home_module` (`name`, `link`, `img`, `status`, `sort_order`) VALUES ('Warehouse', 'warehouse', 'warehouse.png', '1', '3');
INSERT INTO `home_module` (`name`, `link`, `img`, `status`, `sort_order`) VALUES ('Bill of Lading', 'bill_of_lading', 'bill_of_lading.png', '1', '4');
INSERT INTO `home_module` (`name`, `img`, `status`, `sort_order`) VALUES ('Billing', 'billing.png', '1', '5');
INSERT INTO `home_module` (`name`, `img`, `status`, `sort_order`) VALUES ('Collection Call Out', 'collection_call_out.png', '1', '6');
INSERT INTO `home_module` (`name`, `img`, `status`, `sort_order`) VALUES ('Payment', 'payments.png', '1', '7');
INSERT INTO `home_module` (`name`, `img`, `status`, `sort_order`) VALUES ('Reports', 'reports.png', '1', '8');

