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
 * @version        $Id: 1.0 admin.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */

include_once 'common.php'; 
 
// ---------------- Admin Index ----------------
define('_AM_WGGALLERY_STATISTICS', 'Statistics');
// There are
define('_AM_WGGALLERY_THEREARE_ALBUMS', "There are <span class='bold'>%s</span> albums in the database");
define('_AM_WGGALLERY_THEREARE_IMAGES', "There are <span class='bold'>%s</span> images in the database");
define('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "There are <span class='bold'>%s</span> gallery types in the database");
define('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "There are <span class='bold'>%s</span> album types in the database");
// There aren't
define('_AM_WGGALLERY_THEREARENT_GALLERYTYPES', "There aren't gallery types");
define('_AM_WGGALLERY_THEREARENT_ALBUMTYPES', "There aren't album types");
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGGALLERY_ADD_ALBUM', 'Add New Album');
define('_AM_WGGALLERY_ADD_IMAGE', 'Add New Image');
define('_AM_WGGALLERY_ADD_GALLERYTYPE', 'Add New Gallery Type');
define('_AM_WGGALLERY_ADD_ALBUMTYPE', 'Add New Album Type');
// Lists
define('_AM_WGGALLERY_ALBUMS_LIST', 'List of Albums');
define('_AM_WGGALLERY_IMAGES_LIST', 'List of Images');
define('_AM_WGGALLERY_GALLERYTYPES_LIST', 'List of Gallery types');
define('_AM_WGGALLERY_ALBUMTYPES_LIST', 'List of Album types');
// Gallerytype add/edit
define('_AM_WGGALLERY_GALLERYTYPE_ADD', 'Add Gallerytype');
define('_AM_WGGALLERY_GALLERYTYPE_EDIT', 'Edit Gallerytype');
// Elements of Gallerytype
define('_AM_WGGALLERY_GALLERYTYPE_ID', 'Id');
define('_AM_WGGALLERY_GALLERYTYPE_PRIMARY', 'Primary');
define('_AM_WGGALLERY_GALLERYTYPE_PRIMARY_1', 'Currently primary');
define('_AM_WGGALLERY_GALLERYTYPE_PRIMARY_0', 'Currently not primary');
define('_AM_WGGALLERY_GALLERYTYPE_PRIMARY_SET', 'Set to primary');
define('_AM_WGGALLERY_GALLERYTYPE_NAME', 'Name');
define('_AM_WGGALLERY_GALLERYTYPE_CREDITS', 'Credits');
define('_AM_WGGALLERY_GALLERYTYPE_TEMPLATE', 'Template');
define('_AM_WGGALLERY_GALLERYTYPE_OPTION', 'Option');
define('_AM_WGGALLERY_GALLERYTYPE_DATE', 'Date');
// Elements of Gallery options
define('_AM_WGGALLERY_OPTION_GT_SET', 'Set options for selected gallerytype');
define('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Slideshow source');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC', ' (large or medium images)');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Preview source');
// jssor
define('_AM_WGGALLERY_OPTION_GT_ARROWS', 'Type of arrows');
define('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Type of bullets');
define('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Do not use bullets together with Thumbnails');
define('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Type of thumbnail list');
define('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'Type of loading symbol');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Autoplay');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'Play options');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_1', 'play continuously');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_2', 'stop at last slide');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_4', 'stop on click');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_8', 'stop on user navigation (click on arrow/bullet/thumbnail, swipe slide, press keyboard left, right arrow key)');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_12', 'stop on click or user navigation');

define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Show thumbs or dots');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Show thumbs');
define('_AM_WGGALLERY_OPTION_GT_SHOWDOTS', 'Show dots');
// define('_AM_WGGALLERY_OPTION_GT_TITLE', 'Show image title');
// define('_AM_WGGALLERY_OPTION_GT_DESCRIPTION', 'Show image decription');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'Slideshow speed');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Interval in milliseconds before displaying the next image');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_DESC', 'Automatically start slideshow when opened');
define('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Row height');
define('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Last row');
define('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'Should the last row be justified to full width of row');
define('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Margin between the images');
define('_AM_WGGALLERY_OPTION_GT_BORDER', 'Outer margin of image container');
define('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Show image in random order');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Show slideshow');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Slideshow options (not all option apply to each colorbox style):');
define('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox style');
define('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'Transition effect');
define('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Speed for opening slideshow');
define('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Open colorbox automatically');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE', 'Slideshow type');
define('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Show close button');
define('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Show navbar with thumbs');
define('_AM_WGGALLERY_OPTION_GT_SHOW_1', 'Show always');
define('_AM_WGGALLERY_OPTION_GT_SHOW_2', 'Show the navbar only when the screen width is greater than 768 pixels');
define('_AM_WGGALLERY_OPTION_GT_SHOW_3', 'Show the navbar only when the screen width is greater than 992 pixels');
define('_AM_WGGALLERY_OPTION_GT_SHOW_4', 'Show the navbar only when the screen width is greater than 1200 pixels');
define('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Show toolbar');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Show zoom buttons in toolbar');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Show download buttons in toolbar');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD_DESC', 'If you enable this option, always the source file will be downloaded. Pay attention: this ingore the permissions set in the album settings.');
define('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Switch to full screen when starting slideshow');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Transition speed');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC', 'Period of animation in milliseconds between 2 images');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMG', 'Type of image  on index page');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT', 'Image height');

// define('_AM_WGGALLERY_OPTION_GT_INTDURATION', 'Interval duration');
// define('_AM_WGGALLERY_OPTION_GT_INTDURATION_DESC', 'Interval in milliseconds before displaying of the next image');




// 
// define('_AM_WGGALLERY_OPTION_GT_ADAPDURATION', 'Adaptive duration:<br>This duration is the period in milliseconds, during the adjustment of the previous option runs');

// define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Transition duration:<br>Period of animation in milliseconds between 2 images');
// define('_AM_WGGALLERY_OPTION_GT_INTDURATION', 'Interval duration for autoslide:<br>Interval in milliseconds before displaying of the next image');
// define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Auto playing');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYCONTROLS', 'Display control for the previous or next image');
// define('_AM_WGGALLERY_OPTION_GT_ADAPTHEIGT', 'Adaptive height:<br>If your images have a different height, this option adjusts automatically the global height of the slider.');
// define('_AM_WGGALLERY_OPTION_GT_VERTCENTER', 'Vertical centering:<br>If the height of the list or the main container is smaller than the height of the image, this option can vertically center the element.');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYLIST', 'Display thumbs list');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS', 'Position of thumbs list');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_LEFT', 'Left');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_RIGHT', 'Right');
// 
// 

// 

// define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Automatically start slideshow when opened');



// Albumtype add/edit
define('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Add Albumtype');
define('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Edit Albumtype');
// Elements of Albumtype
define('_AM_WGGALLERY_ALBUMTYPE_ID', 'Id');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY', 'Primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_1', 'Currently primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_0', 'Currently not primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_SET', 'Set to primary');
define('_AM_WGGALLERY_ALBUMTYPE_NAME', 'Name');
define('_AM_WGGALLERY_ALBUMTYPE_CREDITS', 'Credits');
define('_AM_WGGALLERY_ALBUMTYPE_TEMPLATE', 'Template');
define('_AM_WGGALLERY_ALBUMTYPE_OPTION', 'Option');
define('_AM_WGGALLERY_ALBUMTYPE_DATE', 'Date');
// options  of Albumtypes
define('_AM_WGGALLERY_OPTION_AT_SET', 'Set options for selected album type');
define('_AM_WGGALLERY_OPTION_AT_SETINFO', 'The settings for album types will be used for index page and album blocks');
define('_AM_WGGALLERY_OPTION_AT_HOVER', 'Hover effect');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Number of columns for albums');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Number of columns for categories');
define('_AM_WGGALLERY_OPTION_GT_SHOWLABEL', 'Show index label (image {current} of {total}%)');
define('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Show title');
define('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Show description');
define('_AM_WGGALLERY_OPTION_CSS', 'Select css for style');
define('_AM_WGGALLERY_OPTION_AT_SHOWSUBMITTER', 'Show submitter of album');

// common ptions
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
// Maintenance
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Delete and reset');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'Only reset all');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Resize medium');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Resize thumbs');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'Successfully reset: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Successfully created: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Successfully resized: %s of %t images');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Error when reseting: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Error when deleting: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Error when resizing: ');
define('_AM_WGGALLERY_MAINTENANCE_TYP', 'Typ of maintenance');
define('_AM_WGGALLERY_MAINTENANCE_DESC', 'Description');
define('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Results');
define('_AM_WGGALLERY_MAINTENANCE_GT', 'Maintain gallerytypes');
define('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Delete gallerytypes not supported anymore and/or reset all gallerytypes to default values');
define('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'All existing gallerytypes (settings included) will be updated by current gallerytypes. Do you want to continue?');
define('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'All existing gallerytypes (settings included) will be deleted and replaced by current gallerytypes. Do you want to continue?');
define('_AM_WGGALLERY_MAINTENANCE_AT', 'Maintain albumtypes');
define('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Delete albumtypes not supported anymore and/or reset all albumtypes to default values');
define('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'All existing albumtypes (settings included) will be updated by current albumtypes. Do you want to continue?');
define('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'All existing albumtypes (settings included) will be deleted and replaced by current albumtypes. Do you want to continue?');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Resize images');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC', 'Resize images or thumbs to max height corresponding preferences:<br>medium: max width %mw px / max height %mh px<br>thumb: max width %tw px / max height %th px');
// ---------------- Admin Others ----------------
define('_AM_WGGALLERY_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------