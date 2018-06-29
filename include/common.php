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
 * @version        $Id: 1.0 common.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */
if (!defined('XOOPS_ICONS32_PATH')) {
    define('XOOPS_ICONS32_PATH', XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!defined('XOOPS_ICONS32_URL')) {
    define('XOOPS_ICONS32_URL', XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
define('WGGALLERY_DIRNAME', 'wggallery');
define('WGGALLERY_PATH', XOOPS_ROOT_PATH.'/modules/'.WGGALLERY_DIRNAME);
define('WGGALLERY_URL', XOOPS_URL.'/modules/'.WGGALLERY_DIRNAME);
define('WGGALLERY_ICONS_PATH', WGGALLERY_PATH.'/assets/icons');
define('WGGALLERY_ICONS_URL', WGGALLERY_URL.'/assets/icons');
define('WGGALLERY_IMAGE_PATH', WGGALLERY_PATH.'/assets/images');
define('WGGALLERY_IMAGE_URL', WGGALLERY_URL.'/assets/images');
define('WGGALLERY_UPLOAD_PATH', XOOPS_UPLOAD_PATH.'/'.WGGALLERY_DIRNAME);
define('WGGALLERY_UPLOAD_URL', XOOPS_UPLOAD_URL.'/'.WGGALLERY_DIRNAME);
define('WGGALLERY_UPLOAD_IMAGE_PATH', WGGALLERY_UPLOAD_PATH.'/images');
define('WGGALLERY_UPLOAD_IMAGE_URL', WGGALLERY_UPLOAD_URL.'/images');
define('WGGALLERY_ADMIN', WGGALLERY_URL . '/admin/index.php');
$localLogo = WGGALLERY_IMAGE_URL . '/wedega_logo.png';
// Module Information
$copyright = "<a href='https://wedega.com' title='Wedega - Webdesign Gabor' target='_blank'><img src='".$localLogo."' alt='Wedega - Webdesign Gabor' /></a>";
include_once XOOPS_ROOT_PATH .'/class/xoopsrequest.php';
include_once WGGALLERY_PATH .'/class/helper.php';
include_once WGGALLERY_PATH .'/include/functions.php';

// common constants
// constants for state
define('WGGALLERY_STATE_OFFLINE_VAL',  0);
define('WGGALLERY_STATE_ONLINE_VAL',   1);
define('WGGALLERY_STATE_APPROVAL_VAL', 2);
// constants for download
define('WGGALLERY_DOWNLOAD_MEDIUM',  1);
define('WGGALLERY_DOWNLOAD_LARGE',   2);
