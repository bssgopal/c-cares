29/07/2017
ALTER TABLE `user` ADD `role` INT(4) NOT NULL DEFAULT '3' AFTER `company_id`;
UPDATE `cropcares`.`user` SET `role` = '1' WHERE `user`.`id` = 1;



CREATE TABLE IF NOT EXISTS `gstins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_name` varchar(225) NOT NULL,
  `location` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(225) NOT NULL COMMENT 'superadmin = creates shops and profiles,Admin = creates profiles to his shop;User = normal user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


	 
ALTER TABLE `user` ADD `first_name` VARCHAR(150) NOT NULL AFTER `id`, ADD `middle_name` VARCHAR(150) NOT NULL AFTER `first_name`, ADD `last_name` VARCHAR(150) NOT NULL AFTER `middle_name`, ADD `phone` VARCHAR(50) NOT NULL AFTER `last_name`, ADD `address` VARCHAR(225) NOT NULL AFTER `phone`, ADD `date_of_birth` DATE NOT NULL AFTER `address`;

RENAME TABLE `cropcares`.`trades` TO `cropcares`.`gstins`;

ALTER TABLE `gstins` ADD `gst_no` VARCHAR(250) NOT NULL AFTER `trade_name`, ADD `fl_no` VARCHAR(250) NOT NULL AFTER `gst_no`, ADD `si_no` VARCHAR(250) NOT NULL AFTER `fl_no`, ADD `pi_no` VARCHAR(250) NOT NULL AFTER `si_no`;


ALTER TABLE `gstins` CHANGE `fl_no` `fertilizer_license` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `gstins` CHANGE `si_no` `seed_license` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `gstins` CHANGE `pi_no` `pesticide_license` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gstin_id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `rtgs_cash` varchar(250) NOT NULL,
  `rtgs_number` varchar(250) NOT NULL,
  `amount` float(8,2) NOT NULL,
  `payment_date` date NOT NULL,
  `created` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `sale_retail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_date` datetime NOT NULL,
  `phone` varchar(25) NOT NULL,
  `farmer_name` varchar(250) NOT NULL,
  `village` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sale_retail_bill` (
  `id` int(11) NOT NULL,
  `sale_retail_id` int(11) NOT NULL,
  `variety` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(8,2) NOT NULL,
  `total_price` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `sale_retail` ADD `gstin_id` INT(11) NOT NULL AFTER `id`;
ALTER TABLE `sale_retail` ADD `created` TIMESTAMP NOT NULL AFTER `village`;

ALTER TABLE `purchase` ADD `module` VARCHAR(225) NOT NULL AFTER `company_name`;
ALTER TABLE `payments` ADD `module` VARCHAR(225) NOT NULL AFTER `company_name`
ALTER TABLE `sale_retail` ADD `module` VARCHAR(225) NOT NULL AFTER `gstin_id`
ALTER TABLE `whole_sale` ADD `module` VARCHAR(225) NOT NULL AFTER `gstin_id`

ALTER TABLE `whole_sale` ADD `gst` VARCHAR(250) NOT NULL AFTER `vehicle_no`;

ALTER TABLE `whole_sale` CHANGE `gst` `customer_gst_no` VARCHAR(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'customer gst no';
ALTER TABLE `whole_sale` CHANGE `cgst` `cgst` FLOAT(8,2) NOT NULL;
ALTER TABLE `whole_sale` CHANGE `sgst` `sgst` FLOAT(8,2) NOT NULL;

27/08/2017
ALTER TABLE `payments` CHANGE `created` `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `purchase` CHANGE `created` `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;


ALTER TABLE `purchase` ADD `sgst` FLOAT(8,2) NOT NULL AFTER `quantity`, ADD `cgst` FLOAT(8,2) NOT NULL AFTER `sgst`;
ALTER TABLE `user` ADD `gstin_id` INT(12) NOT NULL AFTER `id`;
ALTER TABLE `sale_retail` ADD `bill_no` VARCHAR(125) NOT NULL AFTER `module`;
ALTER TABLE `sale_retail` ADD `farmer_aadhar_no` VARCHAR(250) NOT NULL AFTER `farmer_name`;

Pesticides_sale_retails
Pesticides_whole_sale
___________________________________DONE_______________________________________________

ALTER TABLE `purchase` ADD `invoice_date` DATETIME NOT NULL AFTER `invoice`;
___________________________________DONE_______________________________________________
CREATE TABLE IF NOT EXISTS `purchase_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gstind_id` int(11) NOT NULL,
  `module` varchar(225) NOT NULL,
  `remaining` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


ALTER TABLE `whole_sale` ADD `bill_no` INT(11) NOT NULL AFTER `module`;

ALTER TABLE `gstins` ADD `fertilizer_cgst` DECIMAL(10,2) NOT NULL AFTER `location`, ADD `fertilizer_sgst` DECIMAL(10,2) NOT NULL AFTER `fertilizer_cgst`, ADD `seeds_cgst` DECIMAL(10,2) NOT NULL AFTER `fertilizer_sgst`, ADD `seeds_sgst` DECIMAL(10,2) NOT NULL AFTER `seeds_cgst`, ADD `pesticides_cgst` DECIMAL(10,2) NOT NULL AFTER `seeds_sgst`, ADD `pesticides_sgst` DECIMAL(10,2) NOT NULL AFTER `pesticides_cgst`, ADD `cement_cgst` DECIMAL(10,2) NOT NULL AFTER `pesticides_sgst`, ADD `cement_sgst` DECIMAL(10,2) NOT NULL AFTER `cement_cgst`;

ALTER TABLE `gstins` CHANGE `fertilizer_cgst` `fertilizers_cgst` DECIMAL(10,2) NOT NULL;
ALTER TABLE `gstins` CHANGE `fertilizer_sgst` `fertilizers_sgst` DECIMAL(10,2) NOT NULL;
ALTER TABLE `gstins` CHANGE `cement_cgst` `cements_cgst` DECIMAL(10,2) NOT NULL;
ALTER TABLE `gstins` ADD `bank_details` VARCHAR(225) NOT NULL AFTER `cement_sgst`;


16/12/2017
/*ALTER TABLE `sale_retail` ADD `batch_no` INT(11) NULL DEFAULT '0' AFTER `bill_date`;
ALTER TABLE `whole_sale` ADD `batch_no` INT(11) NOT NULL DEFAULT '0' AFTER `bill_date`;
*/
ALTER TABLE `purchase` ADD `batch_no` INT(11) NOT NULL DEFAULT '0' AFTER `invoice_date`;
ALTER TABLE `pesticides_sale_retail_bill` ADD `hsn_code` INT(11) NOT NULL AFTER `packing`;
ALTER TABLE `pesticides_whole_sale_bill` ADD `hsn_code` INT(11) NOT NULL AFTER `packing`


ALTER TABLE `sale_retail_bill` ADD `batch_no` INT(11) NOT NULL DEFAULT '0' AFTER `variety`;

ALTER TABLE `sale_retail` ADD `payment_type` TINYINT(4) NOT NULL DEFAULT '1' AFTER `gstin_id`;

ALTER TABLE `whole_sale` ADD `payment_type` TINYINT(4) NOT NULL DEFAULT '1' AFTER `module`;

ALTER TABLE `sale_retail` CHANGE `payment_type` `payment_type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '1=>rtgs,2=>cash';
ALTER TABLE `whole_sale` CHANGE `payment_type` `payment_type` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '1=>rtgs,2=>cash';
ALTER TABLE `purchase` ADD `before_stock` TINYINT(4) NOT NULL DEFAULT '0' AFTER `gstin_id`;