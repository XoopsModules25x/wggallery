# SQL Dump for wggallery module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: localhost
# Generated on: Mon Mar 19, 2018 to 10:04:53
# Server version: 5.7.11
# PHP Version: 5.6.19

#
# Structure table for `wggallery_albums` 10
#

CREATE TABLE `wggallery_albums` (
  `alb_id`            INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alb_pid`           INT(8)          NOT NULL DEFAULT '0',
  `alb_iscat`         INT(1)          NOT NULL DEFAULT '0',
  `alb_name`          VARCHAR(200)    NOT NULL DEFAULT '',
  `alb_desc`          TEXT            NULL ,
  `alb_weight`        INT(8)          NOT NULL DEFAULT '0',
  `alb_imgcat`        INT(1)          NOT NULL DEFAULT '0',
  `alb_image`         VARCHAR(200)    NOT NULL DEFAULT '',
  `alb_imgid`         INT(8)          NOT NULL DEFAULT '0',
  `alb_state`         INT(1)          NOT NULL DEFAULT '0',
  `alb_wmid`          INT(8)          NOT NULL DEFAULT '0',
  `alb_date`          INT(8)          NOT NULL DEFAULT '0',
  `alb_submitter`     INT(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`alb_id`)
) ENGINE=InnoDB;

#
# Structure table for `wggallery_images` 18
#

CREATE TABLE `wggallery_images` (
  `img_id`          INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_title`       VARCHAR(200)    NOT NULL DEFAULT '',
  `img_desc`        TEXT            NULL ,
  `img_name`        VARCHAR(200)    NOT NULL DEFAULT '',
  `img_namelarge`   VARCHAR(200)    NOT NULL DEFAULT '',
  `img_nameorig`    VARCHAR(200)    NOT NULL DEFAULT '',
  `img_mimetype`    VARCHAR(50)     NOT NULL DEFAULT '',
  `img_size`        INT(8)          NOT NULL DEFAULT '0',
  `img_resx`        INT(8)          NOT NULL DEFAULT '0',
  `img_resy`        INT(8)          NOT NULL DEFAULT '0',
  `img_downloads`   INT(8)          NOT NULL DEFAULT '0',
  `img_ratinglikes` INT(8)          NOT NULL DEFAULT '0',
  `img_votes`       INT(8)          NOT NULL DEFAULT '0',
  `img_weight`      INT(8)          NOT NULL DEFAULT '0',
  `img_albid`       INT(8)          NOT NULL DEFAULT '0',
  `img_state`       INT(8)          NOT NULL DEFAULT '0',
  `img_exif`        TEXT            NULL ,
  `img_date`        INT(8)          NOT NULL DEFAULT '0',
  `img_submitter`   INT(8)          NOT NULL DEFAULT '0',
  `img_ip`          VARCHAR(50)     NOT NULL DEFAULT '',
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB;

#
# Structure table for `wggallery_gallerytypes` 7
#

CREATE TABLE `wggallery_gallerytypes` (
  `gt_id`       int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gt_primary`  int(1)          NOT NULL DEFAULT '0',
  `gt_name`     varchar(100)    NOT NULL DEFAULT '',
  `gt_credits`  varchar(100)    NOT NULL DEFAULT '',
  `gt_template` varchar(100)    NOT NULL DEFAULT '',
  `gt_options`  text            NULL,
  `gt_date`     int(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`gt_id`),
  UNIQUE KEY  (`gt_template`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure table for `wggallery_albumtypes` 7
#

CREATE TABLE `wggallery_albumtypes` (
  `at_id`       INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `at_primary`  INT(1)          NOT NULL DEFAULT '0',
  `at_name`     VARCHAR(100)    NOT NULL DEFAULT '',
  `at_credits`  VARCHAR(100)    NOT NULL DEFAULT '',
  `at_template` VARCHAR(100)    NOT NULL DEFAULT '',
  `at_options`  TEXT            NULL,
  `at_date`     INT(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`at_id`),
  UNIQUE KEY  (`at_template`)
) ENGINE=InnoDB;

#
# Structure table for `wggallery_watermarks` 13
#

CREATE TABLE `wggallery_watermarks` (
  `wm_id`        INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wm_name`      VARCHAR(100)    NOT NULL DEFAULT '',
  `wm_type`      INT(8)          NOT NULL DEFAULT '0',
  `wm_position`  INT(8)          NOT NULL DEFAULT '0',
  `wm_marginlr`  INT(8)          NOT NULL DEFAULT '0',
  `wm_margintb`  INT(8)          NOT NULL DEFAULT '0',
  `wm_image`     VARCHAR(255)    NOT NULL DEFAULT '',
  `wm_text`      VARCHAR(100)    NOT NULL DEFAULT '',
  `wm_font`      VARCHAR(255)    NOT NULL DEFAULT '',
  `wm_fontsize`  INT(8)          NOT NULL DEFAULT '0',
  `wm_color`     VARCHAR(100)    NOT NULL DEFAULT '',
  `wm_usage`     INT(1)          NOT NULL DEFAULT '0',
  `wm_target`    INT(1)          NOT NULL DEFAULT '0',
  `wm_date`      INT(8)          NOT NULL DEFAULT '0',
  `wm_submitter` INT(8)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`wm_id`)
) ENGINE=InnoDB;

