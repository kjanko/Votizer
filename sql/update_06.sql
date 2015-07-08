CREATE TABLE `top_blackilist_profanity` (
	`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`word` VARCHAR(50) NOT NULL DEFAULT '0',
	`replacement` VARCHAR(50) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
)
COLLATE='utf32_general_ci'
ENGINE=InnoDB
;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='top100';
SHOW TABLE STATUS FROM `top100`;
SHOW FUNCTION STATUS WHERE `Db`='top100';
SHOW PROCEDURE STATUS WHERE `Db`='top100';
SHOW TRIGGERS FROM `top100`;
SELECT *, EVENT_SCHEMA AS `Db`, EVENT_NAME AS `Name` FROM information_schema.`EVENTS` WHERE `EVENT_SCHEMA`='top100';
SHOW CREATE TABLE `top100`.`top_blackilist_profanity`;
/* Entering session "localhost" */
SHOW CREATE TABLE `top100`.`top_blackilist_profanity`;