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
// There aren't
define('_AM_WGGALLERY_THEREARENT_GALLERYTYPES', "There aren't gallerytypes");
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGGALLERY_ADD_ALBUM', 'Add New Album');
define('_AM_WGGALLERY_ADD_IMAGE', 'Add New Image');
define('_AM_WGGALLERY_ADD_GALLERYTYPE', 'Add New Gallerytype');
// Lists
define('_AM_WGGALLERY_ALBUMS_LIST', 'List of Albums');
define('_AM_WGGALLERY_IMAGES_LIST', 'List of Images');
define('_AM_WGGALLERY_GALLERYTYPES_LIST', 'List of Gallerytypes');
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
define('_AM_WGGALLERY_OPTION_SET', 'Set options for selected gallery');
define('_AM_WGGALLERY_OPTION_THEME', 'Select theme for style');
define('_AM_WGGALLERY_OPTION_SOURCE', 'Slideshow source (large or medium images)');
define('_AM_WGGALLERY_OPTION_TRANSEFFECT', 'Transition effect');
define('_AM_WGGALLERY_OPTION_ADAPDURATION', 'Adaptive duration:<br>This duration is the period in milliseconds, during the adjustment of the previous option runs');
define('_AM_WGGALLERY_OPTION_TRANSDURATION', 'Transition duration:<br>Period of animation in milliseconds between 2 images');
define('_AM_WGGALLERY_OPTION_INTDURATION', 'Interval duration for autoslide:<br>Interval in milliseconds before displaying of the next image');
define('_AM_WGGALLERY_OPTION_AUTOPLAY', 'Auto playing');
define('_AM_WGGALLERY_OPTION_DISPLAYCONTROLS', 'Display control for the previous or next image');
define('_AM_WGGALLERY_OPTION_ADAPTHEIGT', 'Adaptive height:<br>If your images have a different height, this option adjusts automatically the global height of the slider.');
define('_AM_WGGALLERY_OPTION_VERTCENTER', 'Vertical centering:<br>If the height of the list or the main container is smaller than the height of the image, this option can vertically center the element.');
define('_AM_WGGALLERY_OPTION_DISPLAYLIST', 'Display thumbs list');
define('_AM_WGGALLERY_OPTION_DISPLAYPOS', 'Position of thumbs list');
define('_AM_WGGALLERY_OPTION_DISPLAYPOS_LEFT', 'Left');
define('_AM_WGGALLERY_OPTION_DISPLAYPOS_RIGHT', 'Right');

define('_AM_WGGALLERY_OPTION_SOURCE_PREVIEW', 'Preview source (large or medium images)');
define('_AM_WGGALLERY_OPTION_BUTTTONCLOSE', 'Show close buttton');
define('_AM_WGGALLERY_OPTION_NAVBAR', 'Show navbar with thumbs');
define('_AM_WGGALLERY_OPTION_TITLE', 'Show image title');
define('_AM_WGGALLERY_OPTION_TOOLBAR', 'Show toolbar');
define('_AM_WGGALLERY_OPTION_TOOLBARZOOM', 'Show zoom buttons in toolbar');
define('_AM_WGGALLERY_OPTION_TOOLBARDOWNLOAD', 'Show download buttons in toolbar. if you enable this option, always the source file will be downloaded. Pay attention: this ingore the permissions set in the album settings.');
define('_AM_WGGALLERY_OPTION_FULLSCREEN', 'Switch to full screen when starting slideshow');

define('_AM_WGGALLERY_OPTION_ROWHEIGHT', 'Row height');
define('_AM_WGGALLERY_OPTION_JUSTIFY', 'Should the last row be justified to full width of row');
define('_AM_WGGALLERY_OPTION_MARGINS', 'Margin between the images');
define('_AM_WGGALLERY_OPTION_BORDER', 'Outer margin of image container');
define('_AM_WGGALLERY_OPTION_RANDOMIZE', 'Show image in random order');
define('_AM_WGGALLERY_OPTION_SLIDESHOW', 'Show slideshow');
define('_AM_WGGALLERY_OPTION_SLIDESHOW_OPTIONS', 'Slideshow options (not all option apply to each colorbox style):');
define('_AM_WGGALLERY_OPTION_COLORBOXSTYLE', 'Colorbox style');
define('_AM_WGGALLERY_OPTION_TRANSITION', 'Transition type');
define('_AM_WGGALLERY_OPTION_SLIDESHOWSPEED', 'Slideshow speed');
define('_AM_WGGALLERY_OPTION_SLIDESHOWAUTO', 'Automatically start slideshow when opened');
define('_AM_WGGALLERY_OPTION_SPEEDOPEN', 'Speed for opening slideshow');
define('_AM_WGGALLERY_OPTION_AUTOOPEN', 'Open colorbox automatically');
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');

// ---------------- Admin Others ----------------
define('_AM_WGGALLERY_MAINTAINEDBY', ' is maintained by ');
// ---------------- End ----------------