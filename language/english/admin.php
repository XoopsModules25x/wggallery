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
define('_AM_WGGALLERY_GALLERYTYPE_DESC', 'Desc');
define('_AM_WGGALLERY_GALLERYTYPE_CREDITS', 'Credits');
define('_AM_WGGALLERY_GALLERYTYPE_TEMPLATE', 'Template');
define('_AM_WGGALLERY_GALLERYTYPE_OPTION', 'Option');
define('_AM_WGGALLERY_GALLERYTYPE_DATE', 'Date');
// Elements of Gallery options
define('_AM_WGGALLERY_OPTION_GT_SET', 'Set options for selected gallery');
define('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Slideshow source (large or medium images)');
define('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'Transition effect');
define('_AM_WGGALLERY_OPTION_GT_ADAPDURATION', 'Adaptive duration:<br>This duration is the period in milliseconds, during the adjustment of the previous option runs');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Transition duration:<br>Period of animation in milliseconds between 2 images');
define('_AM_WGGALLERY_OPTION_GT_INTDURATION', 'Interval duration for autoslide:<br>Interval in milliseconds before displaying of the next image');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Auto playing');
define('_AM_WGGALLERY_OPTION_GT_DISPLAYCONTROLS', 'Display control for the previous or next image');
define('_AM_WGGALLERY_OPTION_GT_ADAPTHEIGT', 'Adaptive height:<br>If your images have a different height, this option adjusts automatically the global height of the slider.');
define('_AM_WGGALLERY_OPTION_GT_VERTCENTER', 'Vertical centering:<br>If the height of the list or the main container is smaller than the height of the image, this option can vertically center the element.');
define('_AM_WGGALLERY_OPTION_GT_DISPLAYLIST', 'Display thumbs list');
define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS', 'Position of thumbs list');
define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_LEFT', 'Left');
define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_RIGHT', 'Right');

define('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Preview source (large or medium images)');
define('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Show close buttton');
define('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Show navbar with thumbs');
define('_AM_WGGALLERY_OPTION_GT_TITLE', 'Show image title');
define('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Show toolbar');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Show zoom buttons in toolbar');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Show download buttons in toolbar. if you enable this option, always the source file will be downloaded. Pay attention: this ingore the permissions set in the album settings.');
define('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Switch to full screen when starting slideshow');

define('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Row height');
define('_AM_WGGALLERY_OPTION_GT_JUSTIFY', 'Should the last row be justified to full width of row');
define('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Margin between the images');
define('_AM_WGGALLERY_OPTION_GT_BORDER', 'Outer margin of image container');
define('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Show image in random order');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Show slideshow');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Slideshow options (not all option apply to each colorbox style):');
define('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox style');
define('_AM_WGGALLERY_OPTION_GT_TRANSITION', 'Transition type');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'Slideshow speed');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWAUTO', 'Automatically start slideshow when opened');
define('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Speed for opening slideshow');
define('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Open colorbox automatically');

// Albumtype add/edit
define('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Add Gallerytype');
define('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Edit Gallerytype');
// Elements of Albumtype
define('_AM_WGGALLERY_ALBUMTYPE_ID', 'Id');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY', 'Primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_1', 'Currently primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_0', 'Currently not primary');
define('_AM_WGGALLERY_ALBUMTYPE_PRIMARY_SET', 'Set to primary');
define('_AM_WGGALLERY_ALBUMTYPE_NAME', 'Name');
define('_AM_WGGALLERY_ALBUMTYPE_DESC', 'Desc');
define('_AM_WGGALLERY_ALBUMTYPE_CREDITS', 'Credits');
define('_AM_WGGALLERY_ALBUMTYPE_TEMPLATE', 'Template');
define('_AM_WGGALLERY_ALBUMTYPE_OPTION', 'Option');
define('_AM_WGGALLERY_ALBUMTYPE_DATE', 'Date');
// options  of Albumtypes
define('_AM_WGGALLERY_OPTION_AT_HOVER', 'Hover effect');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Number of columns for albums');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Number of columns for categories');
define('_AM_WGGALLERY_OPTION_CSS', 'Select css for style');
// common ptions
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
// ---------------- Admin Others ----------------
define('_AM_WGGALLERY_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------