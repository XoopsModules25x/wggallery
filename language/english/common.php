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
 
// defines for state
define('_CO_WGGALLERY_STATE_OFFLINE', 'Offline');
define('_CO_WGGALLERY_STATE_ONLINE', 'Online');
define('_CO_WGGALLERY_STATE_APPROVAL', 'Waiting for approval');
// defines for download

// General
define('_CO_WGGALLERY_NONE', 'None');
define('_CO_WGGALLERY_BACK', 'Go back');
define('_CO_WGGALLERY_ALL', 'All');
define('_CO_WGGALLERY_DOWNLOAD', 'Download');
define('_CO_WGGALLERY_FORM_UPLOAD', 'Upload file');
define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Files in %s ');
define('_CO_WGGALLERY_FORM_ACTION', 'Action');
define('_CO_WGGALLERY_FORM_EDIT', 'Modification');
define('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'select/unselect all');
define('_CO_WGGALLERY_FORM_IMAGEPICKER', 'Select an image');

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

// Elements of categories
define('_CO_WGGALLERY_CATS_TITLE', 'Available categories');
define('_CO_WGGALLERY_CATS_ALBUMS', 'Show sub albums');
// Elements of Album
define('_CO_WGGALLERY_ALBUMS_TITLE', 'Gallery of albums');
define('_CO_WGGALLERY_ALBUMS_COUNT', 'Number of albums');
define('_CO_WGGALLERY_ALBUM', 'Album');
define('_CO_WGGALLERY_ALBUMS', 'Albums');
define('_CO_WGGALLERY_ALBUM_ID', 'Id');
define('_CO_WGGALLERY_ALBUM_PID', 'Parent album');
define('_CO_WGGALLERY_ALBUM_ISCAT', 'Album is category');
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
define('_CO_WGGALLERY_ALBUM_SELECT', 'Select album');
define('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Please select album for uploading images');
define('_CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD', 'Allow download');
define('_CO_WGGALLERY_ALBUM_DOWNLOAD_MEDIUM', 'Medium images');
define('_CO_WGGALLERY_ALBUM_DOWNLOAD_LARGE', 'Large images');
define('_CO_WGGALLERY_ALBUMS_SHOW', 'Show all albums');

define('_CO_WGGALLERY_IMAGE', 'Image');
define('_CO_WGGALLERY_IMAGES', 'Images');
define('_CO_WGGALLERY_IMAGES_COUNT', 'Number of images');
define('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Show Album');
define('_CO_WGGALLERY_IMAGES_INDEX', 'Show Images Index'); 
define('_CO_WGGALLERY_IMAGES_UPLOAD', 'Upload Images'); 
// Image add/edit
define('_CO_WGGALLERY_IMAGE_ADD', 'Add Image');
define('_CO_WGGALLERY_IMAGE_EDIT', 'Edit Image');
// Elements of Image
define('_CO_WGGALLERY_IMAGE_ID', 'Id');
define('_CO_WGGALLERY_IMAGE_TITLE', 'Title');
define('_CO_WGGALLERY_IMAGE_DESC', 'Desc');
define('_CO_WGGALLERY_IMAGE_NAME', 'Name');
define('_CO_WGGALLERY_IMAGE_ORIGNAME', 'Origname');
define('_CO_WGGALLERY_IMAGE_MIMETYPE', 'Mimetype');
define('_CO_WGGALLERY_IMAGE_SIZE', 'Size');
define('_CO_WGGALLERY_IMAGE_RESX', 'Resx');
define('_CO_WGGALLERY_IMAGE_RESY', 'Resy');
define('_CO_WGGALLERY_IMAGE_DOWNLOADS', 'Downloads');
define('_CO_WGGALLERY_IMAGE_RATINGLIKES', 'Ratinglikes');
define('_CO_WGGALLERY_IMAGE_VOTES', 'Votes');
define('_CO_WGGALLERY_IMAGE_WEIGHT', 'Weight');
define('_CO_WGGALLERY_IMAGE_ALBID', 'Albums');
define('_CO_WGGALLERY_IMAGE_STATE', 'State');
define('_CO_WGGALLERY_IMAGE_DATE', 'Date');
define('_CO_WGGALLERY_IMAGE_SUBMITTER', 'Submitter');
define('_CO_WGGALLERY_IMAGE_IP', 'Ip');
// ---------------- Admin Permissions ----------------
// Permissions
define('_CO_WGGALLERY_PERMS_GLOBAL', 'Permissions global');
define('_CO_WGGALLERY_PERMS_GLOBAL_4', 'Permissions global to approve');
define('_CO_WGGALLERY_PERMS_GLOBAL_8', 'Permissions global to submit all');
define('_CO_WGGALLERY_PERMS_GLOBAL_16', 'Permissions global to submit own');
define('_CO_WGGALLERY_PERMS_GL_APPROVE', 'Permissions to approve');
define('_CO_WGGALLERY_PERMS_GL_APPROVE_DESC', 'Groups which should have permissions to approve submitted albums');
define('_CO_WGGALLERY_PERMS_GL_SUBMIT_ALL', 'Permissions to submit all');
define('_CO_WGGALLERY_PERMS_GL_SUBMIT_ALL_DESC', 'Groups which should have permissions to <ul><li>create albums</li><li>edit all albums</li><li>upload images to all albums</li></ul>');
define('_CO_WGGALLERY_PERMS_GL_SUBMIT', 'Permissions to submit');
define('_CO_WGGALLERY_PERMS_GL_SUBMIT_DESC', 'Groups which should have permissions to <ul><li>create albums</li><li>edit own albums</li><li>upload images to own albums</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
												<li>' . _CO_WGGALLERY_PERMS_GL_APPROVE . ': ' . _CO_WGGALLERY_PERMS_GL_APPROVE_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GL_SUBMIT_ALL . ': ' . _CO_WGGALLERY_PERMS_GL_SUBMIT_ALL_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GL_SUBMIT . ': ' . _CO_WGGALLERY_PERMS_GL_SUBMIT_DESC. '</li>
										   </ul>');
define('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Permissions to view');
define('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Groups which should have permissions to view an album');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Permissions to download full album');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Groups which should have permissions to download the full album at once');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE', 'Permissions to download images');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_DESC', 'Groups which should have permissions to download images');
define('_AM_WGGALLERY_NO_PERMISSIONS_SET', 'No permission set');

// ---------------- Errors ----------------
define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Error: album image not found');
define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Error deleting image: the image was deleted in the database, but an error occured when deleting the image himself');

// ---------------- End ----------------