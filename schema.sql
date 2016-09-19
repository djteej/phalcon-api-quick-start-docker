CREATE DATABASE IF NOT EXISTS `development`;

CREATE TABLE IF NOT EXISTS `development`.`app` (
  `id`      CHAR(13) NOT NULL DEFAULT '',
  `name`    VARCHAR(255)      DEFAULT NULL,
  `key`     CHAR(64)          DEFAULT NULL,
  `secret`  CHAR(64)          DEFAULT NULL,
  `created` INT(10) UNSIGNED  DEFAULT NULL,
  `updated` INT(10) UNSIGNED  DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
);
