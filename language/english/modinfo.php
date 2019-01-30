<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
define('_MI_WGGALLERY_NAME', 'wgGallery');
define('_MI_WGGALLERY_DESC', 'This module is a picture gallery for XOOPS');
// ---------------- Admin Menu ----------------
define('_MI_WGGALLERY_ADMENU1', 'Dashboard');
define('_MI_WGGALLERY_ADMENU2', 'Albums');
define('_MI_WGGALLERY_ADMENU3', 'Images');
define('_MI_WGGALLERY_ADMENU4', 'Gallery types');
define('_MI_WGGALLERY_ADMENU5', 'Album types');
define('_MI_WGGALLERY_ADMENU7', 'Permissions');
define('_MI_WGGALLERY_ADMENU8', 'Maintenance');
define('_MI_WGGALLERY_ADMENU9', 'Watermarks');
define('_MI_WGGALLERY_ADMENU10', 'Import');
define('_MI_WGGALLERY_FEEDBACK', 'Feedback');
define('_MI_WGGALLERY_ABOUT', 'About');
// ---------------- Admin Nav ----------------
define('_MI_WGGALLERY_ADMIN_PAGER', 'List items admin pages');
define('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'Define the number of list items in the admin area');
// User
define('_MI_WGGALLERY_USER_PAGER', 'List items user pages');
define('_MI_WGGALLERY_USER_PAGER_DESC', 'Define the number of list items in the user area');
// Submenu
define('_MI_WGGALLERY_SMNAME1', 'Index page');
define('_MI_WGGALLERY_SMNAME2', 'Albums management');
define('_MI_WGGALLERY_SMNAME3', 'Create new album');
define('_MI_WGGALLERY_SMNAME4', 'Upload images');
// Blocks
define('_MI_WGGALLERY_ALBUMS_BLOCK', 'Albums block');
define('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Show a block with albums (sorting can be selected)');
define('_MI_WGGALLERY_IMAGES_BLOCK', 'Images block');
define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Show a block with images (sorting can be selected)');
// Config
define('_MI_WGGALLERY_EDITOR', 'Editor');
define('_MI_WGGALLERY_EDITOR_DESC', 'Select the Editor Desc to use');
define('_MI_WGGALLERY_KEYWORDS', 'Keywords');
define('_MI_WGGALLERY_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_WGGALLERY_MAXSIZE', 'Max size');
define('_MI_WGGALLERY_MAXSIZE_DESC', 'Set the max file size for uploads files');
define('_MI_WGGALLERY_FILEEXT', 'Allowed file extension');
define('_MI_WGGALLERY_FILEEXT_DESC', 'Set the file extension which are allowed for upload');
define('_MI_WGGALLERY_MAXWIDTH', 'Maximum width upload');
define('_MI_WGGALLERY_MAXWIDTH_DESC', 'Set the max width which is allowed for uploading images (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT', 'Maximum height upload');
define('_MI_WGGALLERY_MAXHEIGHT_DESC', 'Set the max height which is allowed for uploading images (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_LARGE', 'Maximum width large image');
define('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC', 'Set the max width to which uploaded images should be scaled (in pixel)<br>0 means, that large images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Maximum height large image');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC', 'Set the max height to which uploaded images should be scaled (in pixel)<br>0 means, that large images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Maximum width medium image');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC', 'Set the max width to which uploaded images will be scaled for medium image (in pixel)<br>If large/original image is smaller then image will be not enlarge (large image will be copied as medium)');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Maximum height medium image');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC', 'Set the max height to which uploaded images should be scaled for medium image (in pixel)<br>If large/original image is smaller then image will be not enlarge (large image will be copied as medium)');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Maximum width thumbs');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'Set the max width to which uploaded images will be scaled for thumbs (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Maximum height thumbs');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'Set the max height to which uploaded images should be scaled for thumbs (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE', 'Maximum width album images');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC', 'Set the max width to which uploaded images will be scaled for album images (in pixel)<br>If you use an image of the album itself this option has no effect');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE', 'Maximum height album images');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC', 'Set the max height to which uploaded images should be scaled for album images (in pixel)<br>If you use an image of the album itself this option has no effect');
define('_MI_WGGALLERY_GALLERY_TARGET', 'Target for gallery');
define('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Please select where a gallery should be opened');
define('_MI_WGGALLERY_GALLERY_TARGET_SELF', 'Same window/tab');
define('_MI_WGGALLERY_GALLERY_TARGET_BLANK', 'New window/tab');
define('_MI_WGGALLERY_ADDJQUERY', 'Add jquery library');
define('_MI_WGGALLERY_ADDJQUERY_DESC', 'If you use already jquery (e.g. in your theme) then set to NO');
define('_MI_WGGALLERY_PANEL_TYPE', 'Panel Type');
define('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGGALLERY_SHOWBCRUMBS', 'Show breadcrumb navigation');
define('_MI_WGGALLERY_SHOWBCRUMBS_DESC', "Breadcrumb navigation displays the current page's context within the site structure.");
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME', 'Show module name');
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC', 'Show the module name in breadcrumb navigation');
define('_MI_WGGALLERY_SHOWCOPYRIGHT', 'Show copyright');
define('_MI_WGGALLERY_SHOWCOPYRIGHT_DESC', 'You can remove the copyright from the gallery, but a backlinks to www.wedega.com is expected, anywhere on your site');
define('_MI_WGGALLERY_STOREEXIF', 'Save meta data (exif)');
define('_MI_WGGALLERY_STOREEXIF_DESC', 'Define whether you want to save the meta data (exif) of the images');
// Notifications
define('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Global notify');
define('_MI_WGGALLERY_ALBUMS_NOTIFY', 'Albums notify');
define('_MI_WGGALLERY_IMAGES_NOTIFY', 'Images notify');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY', 'Global album new notify');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_CAPTION', 'Global album new notify caption');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_DESC', 'Global album new notify desc');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_SUBJECT', 'Global album new notify subject');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY', 'Global album modify notify');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_CAPTION', 'Global album modify notify caption');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_DESC', 'Global album modify notify desc');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_SUBJECT', 'Global album modify notify subject');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY', 'Global album approve notify');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_CAPTION', 'Global album approve notify caption');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_DESC', 'Global album approve notify desc');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_SUBJECT', 'Global album approve notify subject');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY', 'Global album delete notify');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_CAPTION', 'Global album delete notify caption');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_DESC', 'Global album delete notify desc');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_SUBJECT', 'Global album delete notify subject');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY', 'Global image new notify');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_CAPTION', 'Global image new notify caption');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_DESC', 'Global image new notify desc');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_SUBJECT', 'Global image new notify subject');
define('_MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY', 'Global image approve notify');
define('_MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_CAPTION', 'Global image approve notify caption');
define('_MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_DESC', 'Global image approve notify desc');
define('_MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_SUBJECT', 'Global image approve notify subject');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY', 'Global image delete notify');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_CAPTION', 'Global image delete notify caption');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_DESC', 'Global image delete notify desc');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_SUBJECT', 'Global image delete notify subject');
// ---------------- End ----------------
