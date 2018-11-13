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
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
 
include_once 'common.php'; 
 
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
define('_MI_WGGALLERY_ABOUT', 'About');
// ---------------- Admin Nav ----------------
define('_MI_WGGALLERY_ADMIN_PAGER', 'Admin pager');
define('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'Admin per page list');
// User
define('_MI_WGGALLERY_USER_PAGER', 'User pager');
define('_MI_WGGALLERY_USER_PAGER_DESC', 'User per page list');
// Submenu
define('_MI_WGGALLERY_SMNAME1', 'Index page');
define('_MI_WGGALLERY_SMNAME2', 'Albums management');
define('_MI_WGGALLERY_SMNAME3', 'Create new album');
define('_MI_WGGALLERY_SMNAME4', 'Upload images');
// Blocks
define('_MI_WGGALLERY_ALBUMS_BLOCK', 'Albums block');
define('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Show a block with albums (sorted by weight and date)');
// define('_MI_WGGALLERY_ALBUMS_BLOCK_LAST', 'Last albums block');
// define('_MI_WGGALLERY_ALBUMS_BLOCK_LAST_DESC', 'Show a block with last albums');
// define('_MI_WGGALLERY_IMAGES_BLOCK', 'Images block');
// define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Images block description');
define('_MI_WGGALLERY_IMAGES_BLOCK', 'Images block');
define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Show a block with albums (sorted by weight and date)');
// define('_MI_WGGALLERY_IMAGES_BLOCK_LAST', 'Images block last');
// define('_MI_WGGALLERY_IMAGES_BLOCK_LAST_DESC', 'Images block last description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_NEW', 'Images block new');
// define('_MI_WGGALLERY_IMAGES_BLOCK_NEW_DESC', 'Images block new description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_HITS', 'Images block hits');
// define('_MI_WGGALLERY_IMAGES_BLOCK_HITS_DESC', 'Images block hits description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_TOP', 'Images block top');
// define('_MI_WGGALLERY_IMAGES_BLOCK_TOP_DESC', 'Images block top description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_RANDOM', 'Images block random');
// define('_MI_WGGALLERY_IMAGES_BLOCK_RANDOM_DESC', 'Images block random description');
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
define('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC', 'Set the max width to which uploaded images should be scaled (in pixel)<br />0 means, that large images keeps the original size. <br />If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Maximum height large image');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC', 'Set the max height to which uploaded images should be scaled (in pixel)<br />0 means, that large images keeps the original size. <br />If an image is smaller than maximum value then the image will be not enlarge, it will be save in original size.');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Maximum width medium image');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC', 'Set the max width to which uploaded images will be scaled for medium image (in pixel)<br />If large/original image is smaller then image will be not enlarge (large image will be copied as medium)');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Maximum height medium image');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC', 'Set the max height to which uploaded images should be scaled for medium image (in pixel)<br />If large/original image is smaller then image will be not enlarge (large image will be copied as medium)');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Maximum width thumbs');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'Set the max width to which uploaded images will be scaled for thumbs (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Maximum height thumbs');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'Set the max height to which uploaded images should be scaled for thumbs (in pixel)');
// define('_MI_WGGALLERY_ALBUM_SHOWSUBMITTER', 'Show submitter album');
// define('_MI_WGGALLERY_ALBUM_SHOWSUBMITTER_DESC', 'Show submitter of album on index page');
define('_MI_WGGALLERY_IMAGE_SHOWSUBMITTER', 'Show submitter image');
define('_MI_WGGALLERY_IMAGE_SHOWSUBMITTER_DESC', 'Show submitter of the images');
// define('_MI_WGGALLERY_INDEX_ALBUM_STYLE', 'Style album index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_STYLE_DESC', 'Please select a style for your album index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA', 'Number columns albums index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA_DESC', 'Please select the number of albums per row on index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC', 'Number columns categories index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC_DESC', 'Please select the number of categories per row on index page');
define('_MI_WGGALLERY_STYLE_INDEX_IMAGE', 'Style image index page');
define('_MI_WGGALLERY_STYLE_INDEX_IMAGE_DESC', 'Please select a style for your image index page');
// define('_MI_WGGALLERY_GALLERY_TYPE', 'Gallery type');
// define('_MI_WGGALLERY_GALLERY_TYPE_DESC', 'Please select a gallery type for displaying your images');
define('_MI_WGGALLERY_ALLOW_DOWNLOAD', 'Allow downloads');
define('_MI_WGGALLERY_ALLOW_DOWNLOAD_DESC', 'Please select for which images download should be available');
define('_MI_WGGALLERY_GALLERY_TARGET', 'Target for gallery');
define('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Please select where a gallery should be opened');
define('_MI_WGGALLERY_GALLERY_TARGET_SELF', 'Same window/tab');
define('_MI_WGGALLERY_GALLERY_TARGET_BLANK', 'New window/tab');
define('_MI_WGGALLERY_ADDJQUERY', 'Add jquery library');
define('_MI_WGGALLERY_ADDJQUERY_DESC', 'If you use already jquery (e.g. in your theme) then set to NO');
// define('_MI_WGGALLERY_NUMB_COL', 'Number Columns');
// define('_MI_WGGALLERY_NUMB_COL_DESC', 'Number Columns to View.');
// define('_MI_WGGALLERY_DIVIDEBY', 'Divide By');
// define('_MI_WGGALLERY_DIVIDEBY_DESC', 'Divide by columns number.');
// define('_MI_WGGALLERY_TABLE_TYPE', 'Table Type');
// define('_MI_WGGALLERY_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table.');
define('_MI_WGGALLERY_PANEL_TYPE', 'Panel Type');
define('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGGALLERY_SHOW_MODULETITLE', 'Show module title');
define('_MI_WGGALLERY_SHOW_MODULETITLE_DESC', 'Show module title in breadcrumbs');
define('_MI_WGGALLERY_MAINTAINEDBY', 'Maintained By');
define('_MI_WGGALLERY_MAINTAINEDBY_DESC', 'Allow url of support site or community');
// Notifications
define('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Global notify');
define('_MI_WGGALLERY_GLOBAL_NOTIFY_DESC', 'Global notify desc');
define('_MI_WGGALLERY_CATEGORY_NOTIFY', 'Category notify');
define('_MI_WGGALLERY_CATEGORY_NOTIFY_DESC', 'Category notify desc');
define('_MI_WGGALLERY_IMAGE_NOTIFY', 'Image notify');
define('_MI_WGGALLERY_IMAGE_NOTIFY_DESC', 'Image notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY', 'Global newcategory notify');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', 'Global newcategory notify caption');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_DESC', 'Global newcategory notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', 'Global newcategory notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY', 'Global imagemodify notify');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_CAPTION', 'Global image modify notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_DESC', 'Global imagemodify notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_SUBJECT', 'Global image modify notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY', 'Global image broken notify');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_CAPTION', 'Global imagebroken notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_DESC', 'Global imagebroken notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_SUBJECT', 'Global imagebroken notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY', 'Global image submit notify');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_CAPTION', 'Global image submit notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_DESC', 'Global imagesubmit notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_SUBJECT', 'Global imagesubmit notify subject');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY', 'Global newimage notify');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_CAPTION', 'Global newimage notify caption');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_DESC', 'Global newimage notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_SUBJECT', 'Global newimage notify subject');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY', 'Category imagesubmit notify');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_CAPTION', 'Category image submit notify caption');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_DESC', 'Category image submit notify desc');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_SUBJECT', 'Category image submit notify subject');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY', 'Category newimage notify');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_CAPTION', 'Category newimage notify caption');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_DESC', 'Category newimage notify desc');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_SUBJECT', 'Category newimage notify subject');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY', 'Image approve notify');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_CAPTION', 'Image approve notify caption');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_DESC', 'Image approve notify desc');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_SUBJECT', 'Image approve notify subject');
// Permissions Groups
// define('_MI_WGGALLERY_GROUPS', 'Groups access');
// define('_MI_WGGALLERY_GROUPS_DESC', 'Select general access permission for groups.');
// define('_MI_WGGALLERY_ADMIN_GROUPS', 'Admin Group Permissions');
// define('_MI_WGGALLERY_ADMIN_GROUPS_DESC', 'Which groups have access to tools and permissions page');
// ---------------- End ----------------