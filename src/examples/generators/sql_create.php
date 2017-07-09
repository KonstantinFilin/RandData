<?php

require "../init.php";
/*
$sql = "CREATE TABLE `user` (
 `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 `sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `passhash` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `birth` date DEFAULT NULL,
 `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `role` enum('admin','manager','operator','leader','controller','omanager','master','operator_main','leader_main','marketer_main') COLLATE utf8mb4_unicode_ci NOT NULL,
 `auth_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
 `city_id` smallint(5) unsigned DEFAULT NULL,
 `callcenter_id` tinyint(3) unsigned DEFAULT NULL,
 `off_status_id` tinyint(3) unsigned DEFAULT NULL,
 `send_sms` tinyint(1) unsigned NOT NULL DEFAULT '1',
 `telegram_chat_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `location_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `work_city_id_cur` smallint(5) unsigned DEFAULT NULL,
 `work_city_id_next` smallint(5) unsigned DEFAULT NULL,
 `work_city_start_time` datetime DEFAULT NULL,
 `work_city_start_time2` datetime DEFAULT NULL,
 `position_id` tinyint(3) unsigned DEFAULT NULL,
 `level_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
 `hired_dt` date DEFAULT NULL,
 `fired_dt` date DEFAULT NULL,
 `fired_reason` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `operator_row` tinyint(3) unsigned DEFAULT NULL,
 `claim_bonus` smallint(5) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`),
 KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=4103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

$tableName = "user";
$generator = new \RandData\Generator(new \RandData\Fabric\Tuple\SqlCreateTable($sql), 20);
$formatter = new \RandData\Formatter\Sql($generator, $tableName);

echo $formatter->build() . PHP_EOL;

$sql2 = "CREATE TABLE `claim` (
 `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 `operator_id` smallint(5) unsigned DEFAULT NULL,
 `manager_id` smallint(5) unsigned DEFAULT NULL,
 `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `phone_cell` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `building` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `building_suffix` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `flat` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `amount` tinyint(3) unsigned DEFAULT NULL,
 `years_amount` tinyint(3) unsigned DEFAULT NULL,
 `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `t` time DEFAULT NULL,
 `sum` mediumint(8) unsigned DEFAULT NULL,
 `meeting_start` time DEFAULT NULL,
 `meeting_finish` time DEFAULT NULL,
 `city_id` smallint(5) unsigned DEFAULT NULL,
 `added` datetime NOT NULL,
 `added_dt` date DEFAULT NULL,
 `cancelled_status` enum('active','cancelled','returned','refused','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
 `mes_sended` datetime DEFAULT NULL,
 `mes_recieved` datetime DEFAULT NULL,
 `mes_res` text COLLATE utf8mb4_unicode_ci,
 `sum_first_payment` mediumint(8) unsigned DEFAULT NULL,
 `repair_dt` date DEFAULT NULL,
 `repair_dt2` date DEFAULT NULL,
 `repair_set_amount` tinyint(3) unsigned DEFAULT NULL,
 `repair_set_price` smallint(5) unsigned DEFAULT NULL,
 `sum_repair2` mediumint(8) unsigned DEFAULT NULL,
 `report_day` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `report_month` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `sum1_withwrawed` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `refuse_reason` text COLLATE utf8mb4_unicode_ci,
 `repair_add_dt` date DEFAULT NULL,
 `sum_fact` mediumint(8) unsigned DEFAULT NULL,
 `repair_set_amount_add` tinyint(3) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `added` (`added`),
 KEY `cancelled_status` (`cancelled_status`),
 KEY `city_id` (`city_id`),
 KEY `meeting_finish` (`meeting_finish`),
 KEY `added_dt` (`added_dt`),
 KEY `added_dt_2` (`added_dt`,`cancelled_status`),
 KEY `operator_id` (`operator_id`,`cancelled_status`,`added_dt`),
 KEY `operator_id_2` (`operator_id`,`cancelled_status`,`added_dt`,`meeting_finish`),
 KEY `added_dt_3` (`added_dt`,`city_id`,`cancelled_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
*/

$sql = "CREATE TABLE `user` (
 `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
 `login` varchar(100) NOT NULL,
 `role` enum('admin','student') NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `passhash` varchar(50) NOT NULL,
 `blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `activate_code` varchar(100) DEFAULT NULL,
 `activate_dt` date DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";

$tableName = "user";
$tuple = new \RandData\Fabric\Tuple\SqlCreateTuple($sql);
$generator = new \RandData\Generator($tuple, 20);
$formatter = new \RandData\Formatter\Sql($generator, $tableName);

echo $formatter->build() . PHP_EOL . PHP_EOL;
foreach ($tuple->getDataSets() as $fldName => $fldDef) {
    echo "'" . $fldName . "' => '" . $fldDef . "'," . PHP_EOL;
}
        
echo PHP_EOL;