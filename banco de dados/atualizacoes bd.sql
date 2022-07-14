ALTER TABLE `paymentgateway` ADD `free_installments` VARCHAR(255) NULL DEFAULT NULL AFTER `encrypted_test_key`, 
ADD `max_installments` VARCHAR(255) NULL DEFAULT NULL AFTER `free_installments`, 
ADD `interest_rate` VARCHAR(255) NULL DEFAULT NULL AFTER `max_installments`, ADD `enable_card_cred` VARCHAR(255)
 NULL DEFAULT NULL AFTER `interest_rate`, ADD `enable_slip` VARCHAR(255) NULL DEFAULT NULL AFTER `enable_card_cred`;