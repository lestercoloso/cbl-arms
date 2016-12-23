/*
Navicat MySQL Data Transfer

Source Server         : DEV ATP, DSRA, FRG
Source Server Version : 50552
Source Host           : 192.168.2.109:3306
Source Database       : cbl_wh

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2016-12-19 21:01:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for driver_profile
-- ----------------------------
DROP TABLE IF EXISTS `driver_profile`;
CREATE TABLE `driver_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(225) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `age` int(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of driver_profile
-- ----------------------------
INSERT INTO `driver_profile` VALUES ('1', '123', 'Mon Carlo', '1987-03-19', '29', 'taguig', 'Vehicle A', '1');
INSERT INTO `driver_profile` VALUES ('2', '0', '', '1970-01-01', '0', '', '', '1');
INSERT INTO `driver_profile` VALUES ('3', '222', 'Dwe', '2016-12-01', '0', 'ARM Solutions', 'Vehicle B', '1');

-- ----------------------------
-- Table structure for homepage
-- ----------------------------
DROP TABLE IF EXISTS `homepage`;
CREATE TABLE `homepage` (
  `sel_id` int(255) NOT NULL AUTO_INCREMENT,
  `sel_name` varchar(255) DEFAULT NULL,
  `sel_type` int(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `img_file` varchar(255) DEFAULT NULL,
  `wpage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of homepage
-- ----------------------------
INSERT INTO `homepage` VALUES ('1', 'Customer Information', '1', null, 'Customer_Info', 'customerInfo');
INSERT INTO `homepage` VALUES ('2', 'Booking', '1', null, 'Booking', 'booking');
INSERT INTO `homepage` VALUES ('3', 'Warehouse', '1', null, 'Warehouse', 'warehouse');
INSERT INTO `homepage` VALUES ('4', 'Bill of Lading', '1', null, 'Bill_of_Lading', 'blading');
INSERT INTO `homepage` VALUES ('5', 'Billing', '1', null, 'billing', 'billing');
INSERT INTO `homepage` VALUES ('6', 'Collection Call Out', '1', null, 'Collection_Call_Out', 'collection');
INSERT INTO `homepage` VALUES ('7', 'Payment', '1', null, 'Payment', 'payment');
INSERT INTO `homepage` VALUES ('8', 'Reports', '1', null, 'Reports', 'reports');

-- ----------------------------
-- Table structure for inbound
-- ----------------------------
DROP TABLE IF EXISTS `inbound`;
CREATE TABLE `inbound` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) DEFAULT NULL,
  `bill_of_blading` varchar(255) DEFAULT NULL,
  `delivery_receipt` varchar(255) DEFAULT NULL,
  `pallet_code` varchar(255) DEFAULT NULL,
  `quantity` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `storage_type` varchar(255) DEFAULT NULL,
  `inventory_type` varchar(255) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `entry_date` datetime DEFAULT NULL,
  `pick_date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inbound
-- ----------------------------
INSERT INTO `inbound` VALUES ('3', 'Customer A', '123456', '123456', '123456', '1', 'Description', 'Storage A', 'Inventory A', '2016-11-10 00:00:00', '2016-11-01 00:00:00', '2016-11-19 00:00:00', 'inbound', '2016-11-03 00:00:00');
INSERT INTO `inbound` VALUES ('4', 'Customer A', '1234567', '1234567', '1234567', '1234', 'Inbound Desc1', 'Storage A', 'Inventory A', '2016-11-10 00:00:00', '2016-11-01 00:00:00', '2016-11-19 00:00:00', 'inbound', '2016-11-03 00:00:00');
INSERT INTO `inbound` VALUES ('5', '', 'dsds', 'sds', '212', '1', 'fgfgdfgdf', 'Storage A', 'Inventory A', '1970-01-01 00:00:00', '1970-01-01 00:00:00', '2016-11-17 00:00:00', 'outbound', '2016-11-04 00:00:00');
INSERT INTO `inbound` VALUES ('6', 'Customer A', 'bmbm', 'mnbmb', 'nmbmnb', '0', 'mnmnb', 'Storage A', 'Inventory A', '2016-11-08 00:00:00', '2016-11-01 00:00:00', '2016-11-23 00:00:00', '1', '2016-11-10 00:00:00');

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appgroup` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `sub_module` int(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', 'USER ADMINISTRATION', 'Create User Account and Assign corresponding User Type', '0', '1', '1');
INSERT INTO `modules` VALUES ('2', 'USER ADMINISTRATION', 'Search for User Account', '0', '1', '2');
INSERT INTO `modules` VALUES ('3', 'USER ADMINISTRATION', 'View User Account Details', '0', '1', '3');
INSERT INTO `modules` VALUES ('4', 'USER ADMINISTRATION', 'View Own User Account Details', '0', '1', '4');
INSERT INTO `modules` VALUES ('5', 'USER ADMINISTRATION', 'Update User Account Details', '0', '1', '5');
INSERT INTO `modules` VALUES ('6', 'USER ADMINISTRATION', 'Update modules that the selected user account can access', '0', '1', '6');
INSERT INTO `modules` VALUES ('7', 'USER ADMINISTRATION', 'Update modules that selected user type can access', '0', '1', '7');
INSERT INTO `modules` VALUES ('8', 'USER ADMINISTRATION', 'Update Own User Account', '0', '1', '8');
INSERT INTO `modules` VALUES ('9', 'USER ADMINISTRATION', 'Deactivate a selected User Account', '0', '1', '9');
INSERT INTO `modules` VALUES ('10', 'MAINTENANCE', 'General Settings', '1', '1', '1');
INSERT INTO `modules` VALUES ('11', 'MAINTENANCE', 'Driver Information', '1', '1', '2');
INSERT INTO `modules` VALUES ('12', 'MAINTENANCE', 'Vehicle Information', '1', '1', '3');
INSERT INTO `modules` VALUES ('13', 'MAINTENANCE', 'Location Management', '1', '1', '4');
INSERT INTO `modules` VALUES ('14', 'CUSTOMER INFORMATION', 'Add Customer Information', '0', '1', '1');
INSERT INTO `modules` VALUES ('15', 'CUSTOMER INFORMATION', 'Add Dropdown Content', '0', '1', '2');
INSERT INTO `modules` VALUES ('16', 'CUSTOMER INFORMATION', 'Search Customer Information', '0', '1', '3');
INSERT INTO `modules` VALUES ('17', 'CUSTOMER INFORMATION', 'View Customer Information', '0', '1', '4');
INSERT INTO `modules` VALUES ('18', 'CUSTOMER INFORMATION', 'Update Customer Information', '0', '1', '5');
INSERT INTO `modules` VALUES ('19', 'CUSTOMER INFORMATION', 'Delete Dropdown Content', '0', '1', '6');
INSERT INTO `modules` VALUES ('20', 'BOOKING', 'Book Shipments', '0', '1', '1');
INSERT INTO `modules` VALUES ('21', 'BOOKING', 'Add Dropdown Contents', '0', '1', '2');
INSERT INTO `modules` VALUES ('22', 'BOOKING', 'Search Booking Request Form', '0', '1', '3');
INSERT INTO `modules` VALUES ('23', 'BOOKING', 'View Booking Details', '0', '1', '4');
INSERT INTO `modules` VALUES ('24', 'BOOKING', 'View Names who Created, Monitored and Approved Specific Shipment', '0', '1', '5');
INSERT INTO `modules` VALUES ('25', 'BOOKING', 'Update Booking Details', '0', '1', '6');
INSERT INTO `modules` VALUES ('26', 'BOOKING', 'Delete Booking Details', '0', '1', '7');
INSERT INTO `modules` VALUES ('27', 'BOOKING', 'Delete Dropdown Contents', '0', '1', '8');
INSERT INTO `modules` VALUES ('28', 'WAREHOUSE', 'Warehouse', '1', '1', '1');
INSERT INTO `modules` VALUES ('29', 'WAREHOUSE', 'Location Management', '1', '1', '2');
INSERT INTO `modules` VALUES ('30', 'WAREHOUSE', 'Inbound Shipment', '1', '1', '3');
INSERT INTO `modules` VALUES ('31', 'WAREHOUSE', 'Outbound Shipment', '1', '1', '4');
INSERT INTO `modules` VALUES ('32', 'BILL OF LADING', 'Add Bill of Lading', '0', '1', '1');
INSERT INTO `modules` VALUES ('33', 'BILL OF LADING', 'Add Dropdown and Checkbox Content', '0', '1', '2');
INSERT INTO `modules` VALUES ('34', 'BILL OF LADING', 'Generate Billing Report', '0', '1', '3');
INSERT INTO `modules` VALUES ('35', 'BILL OF LADING', 'Search Bill of Lading', '0', '1', '4');
INSERT INTO `modules` VALUES ('36', 'BILL OF LADING', 'View Bill of Lading', '0', '1', '5');
INSERT INTO `modules` VALUES ('37', 'BILL OF LADING', 'View Names who Created, Reviewed and Approved Specific Bill of Lading', '0', '1', '6');
INSERT INTO `modules` VALUES ('38', 'BILL OF LADING', 'Update Bill of Lading Details', '0', '1', '7');
INSERT INTO `modules` VALUES ('39', 'BILL OF LADING', 'Delete Dropdown and Checkbox Content', '0', '1', '8');
INSERT INTO `modules` VALUES ('40', 'BILL OF LADING', 'Download PDF FORMAT', '1', '0', '9');
INSERT INTO `modules` VALUES ('41', 'BILL OF LADING', 'Print in PDF Format', '0', '1', '10');
INSERT INTO `modules` VALUES ('42', 'BILLING', 'Add Billing Statement ', '0', '1', '1');
INSERT INTO `modules` VALUES ('43', 'BILLING', 'Search Billing Statement', '0', '1', '2');
INSERT INTO `modules` VALUES ('44', 'BILLING', 'View Billing Statement', '0', '1', '3');
INSERT INTO `modules` VALUES ('45', 'BILLING', 'Update Billing Statement Details', '0', '1', '4');
INSERT INTO `modules` VALUES ('46', 'BILLING', 'Void Generated Billing Statement', '0', '1', '5');
INSERT INTO `modules` VALUES ('47', 'BILLING', 'Download PDF FORMAT', '0', '1', '6');
INSERT INTO `modules` VALUES ('48', 'BILLING', 'Print in PDF Format', '0', '1', '7');
INSERT INTO `modules` VALUES ('49', 'COLLECTION CALL-OUT', 'Collection Call Out', '0', '1', '1');
INSERT INTO `modules` VALUES ('50', 'COLLECTION CALL-OUT', 'Search Billing Statement', '0', '1', '2');
INSERT INTO `modules` VALUES ('51', 'COLLECTION CALL-OUT', 'View Billing Statement and History Logs', '0', '1', '3');
INSERT INTO `modules` VALUES ('52', 'PAYMENT', 'Add Payment', '0', '1', '1');
INSERT INTO `modules` VALUES ('53', 'PAYMENT', 'Add Dropdown Content', '0', '1', '2');
INSERT INTO `modules` VALUES ('54', 'PAYMENT', 'Search Payment', '0', '1', '3');
INSERT INTO `modules` VALUES ('55', 'PAYMENT', 'View Payment Details', '0', '1', '4');
INSERT INTO `modules` VALUES ('56', 'PAYMENT', 'Update Payment Details', '0', '1', '5');
INSERT INTO `modules` VALUES ('57', 'PAYMENT', 'Delete Payment', '0', '1', '6');
INSERT INTO `modules` VALUES ('58', 'PAYMENT', 'Delete Dropdown Content', '0', '1', '7');
INSERT INTO `modules` VALUES ('59', 'REPORTS', 'Generate Reports', '0', '1', '1');
INSERT INTO `modules` VALUES ('60', 'REPORTS', 'Search Reports', '0', '1', '2');
INSERT INTO `modules` VALUES ('61', 'REPORTS', 'View Reports', '0', '1', '3');
INSERT INTO `modules` VALUES ('62', 'REPORTS', 'Download PDF FORMAT', '0', '1', '4');
INSERT INTO `modules` VALUES ('63', 'REPORTS', 'Print Reports in PDF Format', '0', '1', '5');
INSERT INTO `modules` VALUES ('66', 'REPORTS', 'Download EXCEL FORMAT', '0', '1', '0');
INSERT INTO `modules` VALUES ('64', 'BILL OF LADING', 'Download EXCEL FORMAT', '0', '1', '0');
INSERT INTO `modules` VALUES ('65', 'BILLING', 'Download EXCEL FORMAT', '0', '1', '0');

-- ----------------------------
-- Table structure for monitor_login
-- ----------------------------
DROP TABLE IF EXISTS `monitor_login`;
CREATE TABLE `monitor_login` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(21) NOT NULL,
  `first_login` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `previous_login` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of monitor_login
-- ----------------------------

-- ----------------------------
-- Table structure for select_menu
-- ----------------------------
DROP TABLE IF EXISTS `select_menu`;
CREATE TABLE `select_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `select_module` varchar(255) DEFAULT NULL,
  `select_name` varchar(255) DEFAULT NULL,
  `select_data` varchar(255) DEFAULT NULL,
  `select_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of select_menu
-- ----------------------------
INSERT INTO `select_menu` VALUES ('1', 'customer_info', 'customer_type', null, '');
INSERT INTO `select_menu` VALUES ('2', 'customer_info', 'industry_type', null, null);
INSERT INTO `select_menu` VALUES ('3', 'customer_info', 'ass_executive_1', null, null);
INSERT INTO `select_menu` VALUES ('4', 'customer_info', 'ass_executive_2', null, null);
INSERT INTO `select_menu` VALUES ('5', 'customer_info', 'tax_type', null, null);
INSERT INTO `select_menu` VALUES ('6', 'customer_info', 'preferred_supplier', null, null);
INSERT INTO `select_menu` VALUES ('7', 'customer_info', 'domestic_air', null, null);
INSERT INTO `select_menu` VALUES ('8', 'customer_info', 'domestic_sea', null, null);
INSERT INTO `select_menu` VALUES ('9', 'customer_info', 'domestic_trucking', null, null);
INSERT INTO `select_menu` VALUES ('10', 'customer_info', 'international', null, null);
INSERT INTO `select_menu` VALUES ('11', 'customer_info', 'international_sea', null, null);
INSERT INTO `select_menu` VALUES ('12', 'customer_info', 'bill_format', null, null);
INSERT INTO `select_menu` VALUES ('13', 'customer_info', 'international_air', null, null);
INSERT INTO `select_menu` VALUES ('14', 'booking', 'area', null, null);
INSERT INTO `select_menu` VALUES ('15', 'booking', 'contact_person', null, null);
INSERT INTO `select_menu` VALUES ('16', 'booking', 'mode_of_shipping', null, null);
INSERT INTO `select_menu` VALUES ('17', 'booking', 'vehicle_type', null, null);
INSERT INTO `select_menu` VALUES ('18', 'booking', 'status', null, null);
INSERT INTO `select_menu` VALUES ('19', 'Inbound_shipment', 'customer_name', null, null);
INSERT INTO `select_menu` VALUES ('20', 'Inbound_shipment', 'storage_type', null, null);
INSERT INTO `select_menu` VALUES ('21', 'Inbound_shipment', 'sub_inventory', null, null);

-- ----------------------------
-- Table structure for sub_modules
-- ----------------------------
DROP TABLE IF EXISTS `sub_modules`;
CREATE TABLE `sub_modules` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `appgroup` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sub_modules
-- ----------------------------
INSERT INTO `sub_modules` VALUES ('1', 'General Settings', ' Add Dropdown and Checkbox Content', '1', '1');
INSERT INTO `sub_modules` VALUES ('2', 'General Settings', 'Search specific Dropdown or Checkbox', '1', '2');
INSERT INTO `sub_modules` VALUES ('3', 'General Settings', 'View Dropdown and Checkbox Content', '1', '3');
INSERT INTO `sub_modules` VALUES ('4', 'General Settings', 'Delete Dropdown and Checkbox Content', '1', '4');
INSERT INTO `sub_modules` VALUES ('5', 'General Settings', 'Upload Price Matrix for Billing', '1', '5');
INSERT INTO `sub_modules` VALUES ('6', 'Driver Information', 'Add Driver Information', '1', '1');
INSERT INTO `sub_modules` VALUES ('7', 'Driver Information', 'Add Checkbox Content', '1', '2');
INSERT INTO `sub_modules` VALUES ('8', 'Driver Information', 'Search Driver Information', '1', '3');
INSERT INTO `sub_modules` VALUES ('9', 'Driver Information', ' View Driver Information', '1', '4');
INSERT INTO `sub_modules` VALUES ('10', 'Driver Information', 'Update Driver Information', '1', '5');
INSERT INTO `sub_modules` VALUES ('11', 'Driver Information', 'Delete Driver Information', '1', '6');
INSERT INTO `sub_modules` VALUES ('12', 'Driver Information', 'Delete Checkbox Content', '1', '7');
INSERT INTO `sub_modules` VALUES ('13', 'Vehicle Information', 'Add Vehicle Information', '1', '1');
INSERT INTO `sub_modules` VALUES ('14', 'Vehicle Information', ' Add Dropdown Content', '1', '2');
INSERT INTO `sub_modules` VALUES ('15', 'Vehicle Information', 'Search Vehicle using Vehicle Information', '1', '3');
INSERT INTO `sub_modules` VALUES ('16', 'Vehicle Information', 'View Vehicle Details', '1', '4');
INSERT INTO `sub_modules` VALUES ('17', 'Vehicle Information', 'Update Vehicle Information', '1', '5');
INSERT INTO `sub_modules` VALUES ('18', 'Vehicle Information', 'Delete Vehicle Information', '1', '6');
INSERT INTO `sub_modules` VALUES ('19', 'Vehicle Information', 'Delete Dropdown Content', '1', '7');
INSERT INTO `sub_modules` VALUES ('20', 'Location Management', 'Add Location', '1', '1');
INSERT INTO `sub_modules` VALUES ('21', 'Location Management', 'Add Dropdown Content', '1', '2');
INSERT INTO `sub_modules` VALUES ('22', 'Location Management', 'Search Location', '1', '3');
INSERT INTO `sub_modules` VALUES ('23', 'Location Management', ' View Location Details', '1', '4');
INSERT INTO `sub_modules` VALUES ('24', 'Location Management', 'Update Location Details', '1', '5');
INSERT INTO `sub_modules` VALUES ('25', 'Location Management', 'Remove Location', '1', '6');
INSERT INTO `sub_modules` VALUES ('26', 'Location Management', ' Delete Dropdown Content', '1', '7');
INSERT INTO `sub_modules` VALUES ('27', 'Warehouse', 'Add Racks, Shelves or Bay', '1', '1');
INSERT INTO `sub_modules` VALUES ('28', 'Warehouse', ' Search Shipment', '1', '2');
INSERT INTO `sub_modules` VALUES ('29', 'Warehouse', 'Warehouse Storage View or Shelves View', '1', '3');
INSERT INTO `sub_modules` VALUES ('30', 'Warehouse', ' Shipment Location', '1', '4');
INSERT INTO `sub_modules` VALUES ('31', 'Warehouse', 'Shipment Details', '1', '5');
INSERT INTO `sub_modules` VALUES ('32', 'Warehouse', 'Packing List for Pull Out', '1', '6');
INSERT INTO `sub_modules` VALUES ('33', 'Warehouse', 'Packing List for Pull Out', '1', '6');
INSERT INTO `sub_modules` VALUES ('34', 'Warehouse', 'Available Slots', '1', '7');
INSERT INTO `sub_modules` VALUES ('35', 'Warehouse', 'Move Rack or Bay', '1', '8');
INSERT INTO `sub_modules` VALUES ('36', 'Warehouse', ' Remove Rack, Shelves or Bay', '1', '9');
INSERT INTO `sub_modules` VALUES ('37', 'Location Management', 'View Different Locations and Shipments per Location', '1', '2');
INSERT INTO `sub_modules` VALUES ('38', 'Location Management', 'Search Location or Shipment', '1', '1');
INSERT INTO `sub_modules` VALUES ('39', 'Inbound Shipment', 'Place Shipment on Warehouse', '1', '1');
INSERT INTO `sub_modules` VALUES ('40', 'Inbound Shipment', 'Add Dropdown Content', '1', '2');
INSERT INTO `sub_modules` VALUES ('41', 'Inbound Shipment', ' Search Inbound Shipment', '1', '3');
INSERT INTO `sub_modules` VALUES ('42', 'Inbound Shipment', ' View Inbound Shipment', '1', '4');
INSERT INTO `sub_modules` VALUES ('43', 'Inbound Shipment', 'Update Shipment Details ', '1', '5');
INSERT INTO `sub_modules` VALUES ('44', 'Inbound Shipment', 'Pull Out Shipment', '1', '6');
INSERT INTO `sub_modules` VALUES ('45', 'Inbound Shipment', ' Delete Dropdown Content', '1', '7');
INSERT INTO `sub_modules` VALUES ('46', 'Outbound Shipment', 'View Outbound Shipment', '1', '1');
INSERT INTO `sub_modules` VALUES ('47', 'Outbound Shipment', 'Update Shipment Status', '1', '2');

-- ----------------------------
-- Table structure for user_account
-- ----------------------------
DROP TABLE IF EXISTS `user_account`;
CREATE TABLE `user_account` (
  `id` varchar(225) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_account
-- ----------------------------
INSERT INTO `user_account` VALUES ('582563f913cd7', 'einstain, d-sdasdasd ', 'alberto1', 'e10adc3949ba59abbe56e057f20f883e', 'System Administrator', '2016-11-11 02:23:53', '2016-12-19 21:00:32', '1');
INSERT INTO `user_account` VALUES ('58321d6b2d354', 'Rodriguez Manuson Rhaffael Jan Kalil', '123456789', '4297f44b13955235245b2497399d7a93', 'Supervisor', '2016-11-21 06:02:19', null, '1');
INSERT INTO `user_account` VALUES ('5832434aeb23b', '123639 123 123', '123', '4297f44b13955235245b2497399d7a93', 'System Administrator', '2016-11-21 08:43:54', null, '1');
INSERT INTO `user_account` VALUES ('583244140577d', '123123 123123 12322', '123', '4297f44b13955235245b2497399d7a93', 'System Administrator', '2016-11-21 08:47:16', null, '1');
INSERT INTO `user_account` VALUES ('5848137889cd5', 'Rito D Jon', 'ritojd', '827ccb0eea8a706c4c34a16891f84e7b', 'System Administrator', '2016-12-07 09:49:44', '2016-12-07 21:50:17', '1');

-- ----------------------------
-- Table structure for user_module
-- ----------------------------
DROP TABLE IF EXISTS `user_module`;
CREATE TABLE `user_module` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(225) DEFAULT NULL,
  `main_module` varchar(255) DEFAULT NULL,
  `submodule_1` varchar(255) DEFAULT NULL,
  `submodule_2` varchar(255) DEFAULT NULL,
  `submodule_3` varchar(255) DEFAULT NULL,
  `submodule_4` varchar(255) DEFAULT NULL,
  `submodule_5` varchar(255) DEFAULT NULL,
  `submodule_6` varchar(255) DEFAULT NULL,
  `submodule_7` varchar(255) DEFAULT NULL,
  `submodule_8` varchar(255) DEFAULT NULL,
  `submodule_9` varchar(255) DEFAULT NULL,
  `submodule_10` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_module
-- ----------------------------
INSERT INTO `user_module` VALUES ('1', '582563f913cd7', '1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1', '1,1,1,1,1,1,1', '1,1,1,1,1,1');
INSERT INTO `user_module` VALUES ('6', '58321d6b2d354', '1,1,1,1,1,1,0,1,1,1', '0,0,0,0,0,0,0,0,0', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1', '1,1,1,1,1,1,1', '1,1,0,0,0,0');
INSERT INTO `user_module` VALUES ('7', '5832434aeb23b', '1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1', '1,1,1,1,1,1,1', '1,1,1,1,1,1');
INSERT INTO `user_module` VALUES ('8', '583244140577d', '1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1', '1,1,1,1,1,1,1', '1,1,1,1,1,1');
INSERT INTO `user_module` VALUES ('9', '5848137889cd5', '1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1,1,1,1', '1,1,1,1,1,1,1,1', '1,1,1', '1,1,1,1,1,1,1', '1,1,1,1,1,1');

-- ----------------------------
-- Table structure for user_profiles
-- ----------------------------
DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key_value` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(225) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `mobile` varchar(225) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `date_cretated` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`key_value`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_profiles
-- ----------------------------
INSERT INTO `user_profiles` VALUES ('15', '582563f913cd7', 'd-sdasdasd', '', 'einstain', '+63123123124', 'hehe@gmail.com', 'System Administrator', 'samples', 'samples', '2016-11-11 02:23:53', '1');
INSERT INTO `user_profiles` VALUES ('40', '58321d6b2d354', 'Rhaffael Jan Kalil', 'Manuson', 'Rodriguez', '+639351957042', 'rhaffael.ar@gmail.com', 'Supervisor', 'SM Department', 'Web Developer', '2016-11-21 06:02:19', '1');
INSERT INTO `user_profiles` VALUES ('41', '5832434aeb23b', '123', '123', '123639', '+639999999999', 'nin@gmail.com', 'System Administrator', '123123', '123', '2016-11-21 08:43:54', '1');
INSERT INTO `user_profiles` VALUES ('42', '583244140577d', '12322', '123123', '123123', '+639999999999', 'sdfsd@gmail.com', 'System Administrator', '123', '123123', '2016-11-21 08:47:16', '1');
INSERT INTO `user_profiles` VALUES ('43', '5848137889cd5', 'Jon', 'D', 'Rito', '+639999980154', 'jdr@arms.ph', 'System Administrator', 'ARMS', 'Sitting', '2016-12-07 09:49:44', '1');

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_types` varchar(255) DEFAULT NULL,
  `sort_order` int(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES ('1', 'System Administrator', '1', '1', '0,0,0,1,1,1,1,1,1,1');
INSERT INTO `user_types` VALUES ('2', 'Manager', '2', '1', '1,0,1,1,1,1,1,1,1,1');
INSERT INTO `user_types` VALUES ('3', 'Supervisor', '3', '1', '0,0,0,1,1,1,1,1,1,1');
INSERT INTO `user_types` VALUES ('4', 'Regular User', '4', '1', '0,0,0,0,0,0,0,0,0,0');

-- ----------------------------
-- Table structure for Vehicle
-- ----------------------------
DROP TABLE IF EXISTS `Vehicle`;
CREATE TABLE `Vehicle` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `vehicle_no` varchar(225) DEFAULT NULL,
  `vehicle_desc` varchar(255) DEFAULT NULL,
  `plate_no` varchar(225) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of Vehicle
-- ----------------------------
INSERT INTO `Vehicle` VALUES ('1', '123', '123', '123', '1', 'Status A');
INSERT INTO `Vehicle` VALUES ('2', '321', '321', '321', '2', 'Status B');
