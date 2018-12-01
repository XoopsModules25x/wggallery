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
 * @copyright module for xoops
 * @license GPL 2.0 or later
 * @package wggallery
 * @since 1.0
 * @min_xoops 2.5.7
 * @author Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
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
define('_CO_WGGALLERY_UPDATE', 'Update');
define('_CO_WGGALLERY_DOWNLOAD', 'Download');
define('_CO_WGGALLERY_FORM_UPLOAD', 'Upload file');
define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Files in %s ');
define('_CO_WGGALLERY_FORM_ACTION', 'Action');
define('_CO_WGGALLERY_FORM_EDIT', 'Modification');
define('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'select/unselect all');
define('_CO_WGGALLERY_FORM_IMAGEPICKER', 'Select an image');
define('_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD', 'Submit and goto images upload');
define('_CO_WGGALLERY_FORM_SUBMIT_WMTEST', 'Submit and show test image');

// Save/Delete
define('_CO_WGGALLERY_FORM_OK', 'Successfully saved');
define('_CO_WGGALLERY_FORM_DELETE_OK', 'Successfully deleted');
define('_CO_WGGALLERY_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>"); //default xoops confirm
define('_CO_WGGALLERY_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
define('_CO_WGGALLERY_FORM_DELETE', 'Delete'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_DELETE_SURE', 'Do you really want to delete?'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1', 'Error when reseting usage of a watermark');
define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2', 'Error when reseting watermark usage in albums');
define('_CO_WGGALLERY_FORM_ERROR_ALBPID', 'Error: parent albums not found');
// There aren't
define('_CO_WGGALLERY_THEREARENT_ALBUMS', "There aren't albums");
define('_CO_WGGALLERY_THEREARENT_IMAGES', "There aren't images");
// Album buttons
define('_CO_WGGALLERY_ALBUM_ADD', 'Add Album');
define('_CO_WGGALLERY_ALBUM_EDIT', 'Edit Album'); 
// general
define('_CO_WGGALLERY_DATE', 'Date');
define('_CO_WGGALLERY_SUBMITTER', 'Submitter'); 
// Elements of categories
define('_CO_WGGALLERY_CATS_TITLE', 'Available categories');
define('_CO_WGGALLERY_CATS_ALBUMS', 'Show sub albums');
// Elements of Album
define('_CO_WGGALLERY_ALBUMS_TITLE', 'Gallery of albums');
define('_CO_WGGALLERY_ALBUMS_COUNT', 'Number of albums');
define('_CO_WGGALLERY_ALBUM', 'Album');
define('_CO_WGGALLERY_ALBUMS', 'Albums');
define('_CO_WGGALLERY_ALBUMS_DESC', 'wgGallery is a XOOPS module for presenting images in albums and categories');
define('_CO_WGGALLERY_ALBUM_CAT', 'Category');
define('_CO_WGGALLERY_ALBUM_NB_CATS', 'album(s) in this category');
define('_CO_WGGALLERY_ALBUM_NB_IMAGES', 'image(s) in this album');
define('_CO_WGGALLERY_ALBUM_ID', 'Id');
define('_CO_WGGALLERY_ALBUM_PID', 'Parent album');
define('_CO_WGGALLERY_ALBUM_ISCAT', 'Album is category');
define('_CO_WGGALLERY_ALBUM_NAME', 'Name');
define('_CO_WGGALLERY_ALBUM_DESC', 'Description');
define('_CO_WGGALLERY_ALBUM_WEIGHT', 'Weight');
define('_CO_WGGALLERY_ALBUM_IMAGE', 'Album image');
define('_CO_WGGALLERY_ALBUM_IMGCAT', 'Source for album image');
define('_CO_WGGALLERY_ALBUM_USE_EXIST', 'Use an image of album as album image');
define('_CO_WGGALLERY_ALBUM_IMGID', 'Existing images in this album');
define('_CO_WGGALLERY_ALBUM_USE_UPLOADED', 'Use an uploaded image as album image');
// define('_CO_WGGALLERY_ALBUM_USE_GRID', 'Create a grid of top 4');
define('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'Upload a new image');
define('_CO_WGGALLERY_ALBUM_STATE', 'State');
define('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Attention: All images linked to this album will also be deleted');
define('_CO_WGGALLERY_ALBUM_SELECT', 'Select album');
define('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Please select album for uploading images');
// define('_CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD', 'Image download size');
// define('_CO_WGGALLERY_ALBUM_DOWNLOAD_MEDIUM', 'Medium images');
// define('_CO_WGGALLERY_ALBUM_DOWNLOAD_LARGE', 'Large images');
define('_CO_WGGALLERY_ALBUMS_SHOW', 'Show all albums');
define('_CO_WGGALLERY_ALBUMS_SORT', 'Sorting of albums');
define('_CO_WGGALLERY_ALBUM_SORT_SHOWHIDE', 'Click to show/hide the sub items');

define('_CO_WGGALLERY_IMAGE', 'Image');
define('_CO_WGGALLERY_IMAGES', 'Images');
define('_CO_WGGALLERY_IMAGES_TITLE', 'Gallery of images of ');
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
define('_CO_WGGALLERY_IMAGE_NAMEORIG', 'Origname');
define('_CO_WGGALLERY_IMAGE_NAMELARGE', 'Name of large image');
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
define('_CO_WGGALLERY_IMAGE_IP', 'Ip');
define('_CO_WGGALLERY_IMAGE_RESIZE', 'Resize image to following size:');
define('_CO_WGGALLERY_IMAGE_THUMB', 'Thumb image');
define('_CO_WGGALLERY_IMAGE_MEDIUM', 'Medium image');
define('_CO_WGGALLERY_IMAGE_LARGE', 'Large image');
// Watermark add/edit
define('_CO_WGGALLERY_WATERMARK_ADD', 'Add Watermark');
define('_CO_WGGALLERY_WATERMARK_EDIT', 'Edit Watermark');
// Elements of Watermark
define('_CO_WGGALLERY_WATERMARK', 'Watermark');
define('_CO_WGGALLERY_WATERMARKS', 'Watermarks');
define('_CO_WGGALLERY_WATERMARK_ID', 'Id');
define('_CO_WGGALLERY_WATERMARK_PREVIEW', 'Preview');
define('_CO_WGGALLERY_WATERMARK_NAME', 'Name');
define('_CO_WGGALLERY_WATERMARK_TYPE', 'Type');
define('_CO_WGGALLERY_WATERMARK_TYPETEXT', 'Use text');
define('_CO_WGGALLERY_WATERMARK_TYPEIMAGE', 'Use an image');
define('_CO_WGGALLERY_WATERMARK_POSITION', 'Position');
define('_CO_WGGALLERY_WATERMARK_POSTOPLEFT', 'Top left');
define('_CO_WGGALLERY_WATERMARK_POSTOPRIGHT', 'Top right');
define('_CO_WGGALLERY_WATERMARK_POSTOPCENTER', 'Top center');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT', 'Middle left');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT', 'Middle right');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER', 'Middle center');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT', 'Bottom left');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT', 'Bottom right');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER', 'Bottom center');
define('_CO_WGGALLERY_WATERMARK_USAGENONE', 'Currently not used');
define('_CO_WGGALLERY_WATERMARK_USAGEALL', 'Use in all albums');
define('_CO_WGGALLERY_WATERMARK_USAGESINGLE', 'Defined in each album seperately');
define('_CO_WGGALLERY_WATERMARK_MARGIN', 'Margin');
define('_CO_WGGALLERY_WATERMARK_MARGINLR', 'Left/right');
define('_CO_WGGALLERY_WATERMARK_MARGINTB', 'Top/bottom');
define('_CO_WGGALLERY_WATERMARK_IMAGE', 'Image');
define('_CO_WGGALLERY_FORM_UPLOAD_IMAGE_WATERMARKS', 'Image in uploads images');
define('_CO_WGGALLERY_WATERMARK_TEXT', 'Text');
define('_CO_WGGALLERY_WATERMARK_FONT', 'Font');
define('_CO_WGGALLERY_WATERMARK_FONTFAMILY', 'Font-Family');
define('_CO_WGGALLERY_WATERMARK_FONTSIZE', 'Fontsize');
define('_CO_WGGALLERY_WATERMARK_COLOR', 'Color');
define('_CO_WGGALLERY_WATERMARK_USAGE', 'Usage');
define('_CO_WGGALLERY_WATERMARK_TARGET', 'Kind of images for adding watermark');
define('_CO_WGGALLERY_WATERMARK_TARGET_A', 'Add to all');
define('_CO_WGGALLERY_WATERMARK_TARGET_M', 'Add to medium');
define('_CO_WGGALLERY_WATERMARK_TARGET_L', 'Add to large');

// ---------------- Admin Permissions ----------------
// Permissions
define('_CO_WGGALLERY_PERMS_GLOBAL', 'Permissions global');
define('_CO_WGGALLERY_PERMS_GLOBAL_APPROVE', 'Permissions global to approve');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL', 'Permissions global to submit/edit all albums');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMIT', 'Permissions global to submit/edit own albums');
define('_CO_WGGALLERY_PERMS_GLOBAL_APPROVE_DESC', 'Groups which should have permissions to approve submitted albums');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC', 'Groups which should have permissions to <ul><li>create albums</li><li>edit all albums</li><li>upload images to all albums</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMIT_DESC', 'Groups which should have permissions to <ul><li>create albums</li><li>edit own albums</li><li>upload images to own albums</li></ul>');
// define('_CO_WGGALLERY_PERMS_GLOBAL_WATERMARK', 'Permission to define global watermarks');
// define('_CO_WGGALLERY_PERMS_GLOBAL_WATERMARK_DESC', 'Groups with this permisssion have he right to define watermarks, which are used in all albums, even if they are not creator of the album');
define('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_APPROVE . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_APPROVE_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMIT . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMIT_DESC. '</li>
										   </ul>');
define('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Permissions to view');
define('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Groups which should have permissions to view an album');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Permissions to download full album');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Groups which should have permissions to download the full album at once');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE', 'Permissions to download large images');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE_DESC', 'Groups which should have permissions to download large images');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM', 'Permissions to download medium images');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM_DESC', 'Groups which should have permissions to download medium images');
define('_CO_WGGALLERY_PERMS_NOTSET', 'No permission set');

// ---------------- Errors ----------------
define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Error: album image not found');
define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Error deleting image: the image was deleted in the database, but an error occured when deleting the image himself');

// ---------------- End ----------------