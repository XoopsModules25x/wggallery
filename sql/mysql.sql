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
  `alb_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alb_pid` INT(8) NOT NULL DEFAULT '0',
  `alb_iscat` INT(1) NOT NULL DEFAULT '0',
  `alb_name` VARCHAR(200) NOT NULL DEFAULT '',
  `alb_desc` TEXT NOT NULL ,
  `alb_weight` INT(8) NOT NULL DEFAULT '0',
  `alb_image` VARCHAR(200) NOT NULL DEFAULT '',
  `alb_imgid` INT(8) NOT NULL DEFAULT '0',
  `alb_state` INT(1) NOT NULL DEFAULT '0',
  `alb_allowdownload` INT(1) NOT NULL DEFAULT '0',
  `alb_date` INT(8) NOT NULL DEFAULT '0',
  `alb_submitter` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`alb_id`)
) ENGINE=InnoDB;

#
# Structure table for `wggallery_images` 18
#

CREATE TABLE `wggallery_images` (
  `img_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_title` VARCHAR(200) NOT NULL DEFAULT '',
  `img_desc` TEXT NOT NULL ,
  `img_name` VARCHAR(200) NOT NULL DEFAULT '',
  `img_origname` VARCHAR(200) NOT NULL DEFAULT '',
  `img_mimetype` VARCHAR(50) NOT NULL DEFAULT '',
  `img_size` INT(8) NOT NULL DEFAULT '0',
  `img_resx` INT(8) NOT NULL DEFAULT '0',
  `img_resy` INT(8) NOT NULL DEFAULT '0',
  `img_downloads` INT(8) NOT NULL DEFAULT '0',
  `img_ratinglikes` INT(8) NOT NULL DEFAULT '0',
  `img_votes` INT(8) NOT NULL DEFAULT '0',
  `img_weight` INT(8) NOT NULL DEFAULT '0',
  `img_albid` INT(8) NOT NULL DEFAULT '0',
  `img_state` INT(8) NOT NULL DEFAULT '0',
  `img_date` INT(8) NOT NULL DEFAULT '0',
  `img_submitter` INT(8) NOT NULL DEFAULT '0',
  `img_ip` TEXT NOT NULL ,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB;

#
# Structure table for `wggallery_gallerytypes` 7
#

CREATE TABLE `wggallery_gallerytypes` (
  `gt_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gt_primary` int(1) NOT NULL DEFAULT '0',
  `gt_name` varchar(100) NOT NULL DEFAULT '',
  `gt_credits` varchar(100) NOT NULL DEFAULT '',
  `gt_template` varchar(100) NOT NULL DEFAULT '',
  `gt_options` text,
  `gt_date` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gt_id`),
  UNIQUE KEY (`gt_template`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `wggallery_gallerytypes` (`gt_id`, `gt_primary`, `gt_name`, `gt_credits`, `gt_template`, `gt_options`, `gt_date`) VALUES
(1, 1, 'none', '', 'none', 'a:0:{}', 0),
(2, 0, 'Lightbox2', 'https://lokeshdhakar.com', 'lightbox2', 'a:9:{i:0;a:3:{s:4:"name";s:6:"source";s:5:"value";s:5:"large";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_SOURCE";}i:1;a:3:{s:4:"name";s:14:"source_preview";s:5:"value";s:6:"medium";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW";}i:2;a:3:{s:4:"name";s:9:"showTitle";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_SHOWTITLE";}i:3;a:3:{s:4:"name";s:9:"showDescr";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_SHOWDESCR";}i:4;a:3:{s:4:"name";s:14:"slideshowSpeed";s:5:"value";s:4:"1000";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED";}i:5;a:3:{s:4:"name";s:14:"showAlbumlabel";s:5:"value";s:4:"true";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_SHOWLABEL";}i:6;a:3:{s:4:"name";s:5:"speed";s:5:"value";s:3:"600";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_SPEEDOPEN";}i:7;a:3:{s:4:"name";s:10:"indexImage";s:5:"value";s:11:"fixedHeight";s:7:"caption";s:32:"_AM_WGGALLERY_OPTION_GT_INDEXIMG";}i:8;a:3:{s:4:"name";s:16:"indexImageheight";s:5:"value";s:3:"600";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT";}}', 0),
(3, 0, 'Justified Gallery with Colorbox', 'http://miromannino.com/', 'justifiedgallery', 'a:16:{i:0;a:3:{s:4:"name";s:6:"source";s:5:"value";s:5:"large";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_SOURCE";}i:1;a:3:{s:4:"name";s:14:"source_preview";s:5:"value";s:6:"medium";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW";}i:2;a:3:{s:4:"name";s:9:"showTitle";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_SHOWTITLE";}i:3;a:3:{s:4:"name";s:9:"rowHeight";s:5:"value";s:3:"150";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_ROWHEIGHT";}i:4;a:3:{s:4:"name";s:7:"lastRow";s:5:"value";s:9:"nojustify";s:7:"caption";s:36:"_AM_WGGALLERY_OPTION_GT_LASTROW_DESC";}i:5;a:3:{s:4:"name";s:7:"margins";s:5:"value";s:1:"1";s:7:"caption";s:31:"_AM_WGGALLERY_OPTION_GT_MARGINS";}i:6;a:3:{s:4:"name";s:6:"border";s:5:"value";s:1:"1";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_BORDER";}i:7;a:3:{s:4:"name";s:9:"randomize";s:5:"value";s:5:"false";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_RANDOMIZE";}i:8;a:3:{s:4:"name";s:9:"slideshow";s:5:"value";s:4:"true";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_SLIDESHOW";}i:9;a:3:{s:4:"name";s:13:"colorboxstyle";s:5:"value";s:6:"style1";s:7:"caption";s:37:"_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE";}i:10;a:3:{s:4:"name";s:10:"transition";s:5:"value";s:7:"elastic";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_GT_TRANSEFFECT";}i:11;a:3:{s:4:"name";s:14:"slideshowSpeed";s:5:"value";s:4:"3000";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED";}i:12;a:3:{s:4:"name";s:13:"slideshowAuto";s:5:"value";s:5:"false";s:7:"caption";s:32:"_AM_WGGALLERY_OPTION_GT_AUTOPLAY";}i:13;a:3:{s:4:"name";s:5:"speed";s:5:"value";s:3:"500";s:7:"caption";s:33:"_AM_WGGALLERY_OPTION_GT_SPEEDOPEN";}i:14;a:3:{s:4:"name";s:4:"open";s:5:"value";s:4:"true";s:7:"caption";s:32:"_AM_WGGALLERY_OPTION_GT_AUTOOPEN";}i:15;a:3:{s:4:"name";s:7:"opacity";s:5:"value";s:3:"0.8";s:7:"caption";s:29:"_AM_WGGALLERY_OPTION_OPACITIY";}}', 0),
(4, 0, 'Blueimp Gallery', 'Sebastian Tschan, https://blueimp.net', 'blueimpgallery', 'a:8:{i:0;a:3:{s:4:"name";s:6:"source";s:5:"value";s:5:"large";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_SOURCE";}i:1;a:3:{s:4:"name";s:14:"source_preview";s:5:"value";s:6:"medium";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW";}i:2;a:3:{s:4:"name";s:13:"slideshowtype";s:5:"value";s:8:"lightbox";s:7:"caption";s:37:"_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE";}i:3;a:3:{s:4:"name";s:14:"slideshowSpeed";s:5:"value";s:4:"3000";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED";}i:4;a:3:{s:4:"name";s:18:"transitionDuration";s:5:"value";s:3:"500";s:7:"caption";s:37:"_AM_WGGALLERY_OPTION_GT_TRANSDURATION";}i:5;a:3:{s:4:"name";s:13:"slideshowAuto";s:5:"value";s:5:"false";s:7:"caption";s:32:"_AM_WGGALLERY_OPTION_GT_AUTOPLAY";}i:6;a:3:{s:4:"name";s:14:"showThumbnails";s:5:"value";s:5:"false";s:7:"caption";s:34:"_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS";}i:7;a:3:{s:4:"name";s:9:"showTitle";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_SHOWTITLE";}}', 0),
(5, 0, 'ViewerJs', 'http://chenfengyuan.com', 'viewerjs', 'a:11:{i:0;a:3:{s:4:"name";s:6:"source";s:5:"value";s:5:"large";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_SOURCE";}i:1;a:3:{s:4:"name";s:14:"source_preview";s:5:"value";s:6:"medium";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW";}i:2;a:3:{s:4:"name";s:12:"button_close";s:5:"value";s:4:"true";s:7:"caption";s:36:"_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE";}i:3;a:3:{s:4:"name";s:6:"navbar";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_NAVBAR";}i:4;a:3:{s:4:"name";s:14:"viewerjs_title";s:5:"value";s:4:"true";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_SHOWTITLE";}i:5;a:3:{s:4:"name";s:7:"toolbar";s:5:"value";s:4:"true";s:7:"caption";s:31:"_AM_WGGALLERY_OPTION_GT_TOOLBAR";}i:6;a:3:{s:4:"name";s:8:"zoomable";s:5:"value";s:4:"true";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM";}i:7;a:3:{s:4:"name";s:8:"download";s:5:"value";s:4:"true";s:7:"caption";s:39:"_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD";}i:8;a:3:{s:4:"name";s:10:"fullscreen";s:5:"value";s:4:"true";s:7:"caption";s:34:"_AM_WGGALLERY_OPTION_GT_FULLSCREEN";}i:9;a:3:{s:4:"name";s:4:"loop";s:5:"value";s:1:"1";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS";}i:10;a:3:{s:4:"name";s:14:"slideshowSpeed";s:5:"value";s:4:"3000";s:7:"caption";s:38:"_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED";}}', 0),
(6, 0, 'Jssor', 'https://www.jssor.com', 'jssor', 'a:6:{i:0;a:3:{s:4:"name";s:6:"source";s:5:"value";s:5:"large";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_SOURCE";}i:1;a:3:{s:4:"name";s:12:"jssor_arrows";s:5:"value";s:9:"arrow-051";s:7:"caption";s:30:"_AM_WGGALLERY_OPTION_GT_ARROWS";}i:2;a:3:{s:4:"name";s:13:"jssor_bullets";s:5:"value";s:10:"bullet-031";s:7:"caption";s:31:"_AM_WGGALLERY_OPTION_GT_BULLETS";}i:3;a:3:{s:4:"name";s:16:"jssor_thumbnails";s:5:"value";s:13:"thumbnail-031";s:7:"caption";s:34:"_AM_WGGALLERY_OPTION_GT_THUMBNAILS";}i:4;a:3:{s:4:"name";s:14:"jssor_loadings";s:5:"value";s:16:"loading-003-oval";s:7:"caption";s:32:"_AM_WGGALLERY_OPTION_GT_LOADINGS";}i:5;a:3:{s:4:"name";s:14:"jssor_autoplay";s:5:"value";s:1:"1";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS";}}', 0);
#
# Structure table for `wggallery_albumtypes` 7
#

CREATE TABLE `wggallery_albumtypes` (
  `at_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `at_primary` INT(1) NOT NULL DEFAULT '0',
  `at_name` VARCHAR(100) NOT NULL DEFAULT '',
  `at_credits` VARCHAR(100) NOT NULL DEFAULT '',
  `at_template` VARCHAR(100) NOT NULL DEFAULT '',
  `at_options` TEXT,
  `at_date` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`at_id`),
  UNIQUE KEY (`at_template`)
) ENGINE=InnoDB;


INSERT INTO `wggallery_albumtypes` (`at_id`, `at_primary`, `at_name`, `at_credits`, `at_template`, `at_options`, `at_date`) VALUES
(1, 0, 'default', '', 'default', 'a:3:{i:0;a:3:{s:4:"name";s:17:"number_cols_album";s:5:"value";s:1:"2";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB";}i:1;a:3:{s:4:"name";s:15:"number_cols_cat";s:5:"value";s:1:"2";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT";}i:2;a:3:{s:4:"name";s:19:"album_showsubmitter";s:5:"value";s:1:"1";s:7:"caption";s:37:"_AM_WGGALLERY_OPTION_AT_SHOWSUBMITTER";}}', 1527426908),
(2, 0, 'hovereffectideas', 'Codrops (http://tympanus.net/codrops)', 'hovereffectideas', 'a:3:{i:0;a:3:{s:4:"name";s:17:"number_cols_album";s:5:"value";s:1:"4";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB";}i:1;a:3:{s:4:"name";s:15:"number_cols_cat";s:5:"value";s:1:"2";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT";}i:2;a:3:{s:4:"name";s:11:"hovereffect";s:5:"value";s:4:"duke";s:7:"caption";s:29:"_AM_WGGALLERY_OPTION_AT_HOVER";}}', 1527429338),
(3, 1, 'simple', '', 'simple', 'a:4:{i:0;a:3:{s:4:"name";s:17:"number_cols_album";s:5:"value";s:1:"2";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB";}i:1;a:3:{s:4:"name";s:15:"number_cols_cat";s:5:"value";s:1:"3";s:7:"caption";s:35:"_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT";}i:2;a:3:{s:4:"name";s:9:"showTitle";s:5:"value";s:1:"1";s:7:"caption";s:29:"_AM_WGGALLERY_OPTION_AT_TITLE";}i:3;a:3:{s:4:"name";s:8:"showDesc";s:5:"value";s:1:"0";s:7:"caption";s:28:"_AM_WGGALLERY_OPTION_AT_DESC";}}', 1529597525);

--