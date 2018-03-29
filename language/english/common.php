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
 * @version        $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */
 
// constants for state
define('_CO_WGGALLERY_STATE_OFFLINE', 'Offline');
define('_CO_WGGALLERY_STATE_ONLINE', 'Online');
define('_CO_WGGALLERY_STATE_APPROVAL', 'Waiting for approval');
// General
define('_CO_WGGALLERY_FORM_UPLOAD', 'Upload file');
define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Files in %s ');
define('_CO_WGGALLERY_FORM_ACTION', 'Action');
define('_CO_WGGALLERY_FORM_EDIT', 'Modification');
// Save/Delete
define('_CO_WGGALLERY_FORM_OK', 'Successfully saved');
define('_CO_WGGALLERY_FORM_DELETE_OK', 'Successfully deleted');
define('_CO_WGGALLERY_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>"); //default xoops confirm
define('_CO_WGGALLERY_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
define('_CO_WGGALLERY_FORM_DELETE', 'Delete'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_DELETE_SURE', 'Do you really want to delete?'); //wggallery xoops confirm
// There aren't
define('_CO_WGGALLERY_THEREARENT_ALBUMS', "There aren't albums");
define('_CO_WGGALLERY_THEREARENT_IMAGES', "There aren't images");
// Album buttons
define('_CO_WGGALLERY_ALBUM_ADD', 'Add Album');
define('_CO_WGGALLERY_ALBUM_EDIT', 'Edit Album'); 

// Elements of Album
define('_CO_WGGALLERY_ALBUM_ID', 'Id');
define('_CO_WGGALLERY_ALBUM_PID', 'Parent album');
define('_CO_WGGALLERY_ALBUM_NAME', 'Name');
define('_CO_WGGALLERY_ALBUM_DESC', 'Description');
define('_CO_WGGALLERY_ALBUM_WEIGHT', 'Weight');
define('_CO_WGGALLERY_ALBUM_IMAGE', 'Album image');
define('_CO_WGGALLERY_ALBUM_IMAGE_DESC', 'Option (2) will only be used if (1) is empty');
define('_CO_WGGALLERY_ALBUM_USE_EXIST', '(1) Use image of album as album image');
define('_CO_WGGALLERY_ALBUM_IMGID', 'Existing images in this album');
define('_CO_WGGALLERY_ALBUM_USE_UPLOADED', '(2) Use an uploaded image as album image');
define('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'Upload a new image');
define('_CO_WGGALLERY_ALBUM_STATE', 'State');
define('_CO_WGGALLERY_ALBUM_DATE', 'Date');
define('_CO_WGGALLERY_ALBUM_SUBMITTER', 'Submitter'); 
define('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Attention: All images linked to this album will also be deleted');

define('_AM_WGGALLERY_IMAGE_COUNT', 'Number of images');
define('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Show Album');
define('_CO_WGGALLERY_IMAGES_INDEX', 'Show Images Index'); 
define('_CO_WGGALLERY_IMAGES_UPLOAD', 'Upload Images'); 
// Image add/edit
define('_AM_WGGALLERY_IMAGE_ADD', 'Add Image');
define('_AM_WGGALLERY_IMAGE_EDIT', 'Edit Image');
// Elements of Image
define('_AM_WGGALLERY_IMAGE_ID', 'Id');
define('_AM_WGGALLERY_IMAGE_TITLE', 'Title');
define('_AM_WGGALLERY_IMAGE_DESC', 'Desc');
define('_AM_WGGALLERY_IMAGE_NAME', 'Name');
define('_AM_WGGALLERY_IMAGE_ORIGNAME', 'Origname');
define('_AM_WGGALLERY_IMAGE_MIMETYPE', 'Mimetype');
define('_AM_WGGALLERY_IMAGE_SIZE', 'Size');
define('_AM_WGGALLERY_IMAGE_RESX', 'Resx');
define('_AM_WGGALLERY_IMAGE_RESY', 'Resy');
define('_AM_WGGALLERY_IMAGE_DOWNLOADS', 'Downloads');
define('_AM_WGGALLERY_IMAGE_RATINGLIKES', 'Ratinglikes');
define('_AM_WGGALLERY_IMAGE_VOTES', 'Votes');
define('_AM_WGGALLERY_IMAGE_WEIGHT', 'Weight');
define('_AM_WGGALLERY_IMAGE_ALBID', 'Albums');
define('_AM_WGGALLERY_IMAGE_STATE', 'State');
define('_AM_WGGALLERY_IMAGE_DATE', 'Date');
define('_AM_WGGALLERY_IMAGE_SUBMITTER', 'Submitter');
define('_AM_WGGALLERY_IMAGE_IP', 'Ip');
// ---------------- Admin Permissions ----------------
// Permissions
define('_CO_WGGALLERY_PERMISSIONS_GLOBAL', 'Permissions global');
define('_CO_WGGALLERY_PERMISSIONS_GLOBAL_DESC', 'Permissions global to check type of.');
define('_CO_WGGALLERY_PERMISSIONS_GLOBAL_4', 'Permissions global to approve');
define('_CO_WGGALLERY_PERMISSIONS_GLOBAL_8', 'Permissions global to submit');
define('_CO_WGGALLERY_PERMISSIONS_GLOBAL_16', 'Permissions global to view');
define('_CO_WGGALLERY_PERMISSIONS_APPROVE', 'Permissions to approve');
define('_CO_WGGALLERY_PERMISSIONS_APPROVE_DESC', 'Permissions to approve');
define('_CO_WGGALLERY_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('_CO_WGGALLERY_PERMISSIONS_SUBMIT_DESC', 'Permissions to submit');
define('_CO_WGGALLERY_PERMISSIONS_VIEW', 'Permissions to view');
define('_CO_WGGALLERY_PERMISSIONS_VIEW_DESC', 'Permissions to view');
define('_AM_WGGALLERY_NO_PERMISSIONS_SET', 'No permission set');
// ---------------- Errors ----------------
define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Error: album image not found');
define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Error deleting image: the image was deleted in the database, but an error occured when deleting the image himself');

// ---------------- End ----------------