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
 * @version        $Id: 1.0 common.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */

include dirname(__DIR__) . '/preloads/autoloader.php';

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
define('WGGALLERY_UPLOAD_FONTS_PATH', WGGALLERY_UPLOAD_PATH.'/fonts');
define('WGGALLERY_ADMIN', WGGALLERY_URL . '/admin/index.php');
$localLogo = WGGALLERY_IMAGE_URL . '/wedega_logo.png';
// Module Information
$copyright = "<a href='https://wedega.com' title='Wedega - Webdesign Gabor' target='_blank'><img src='".$localLogo."' alt='Wedega - Webdesign Gabor'></a>";
require_once XOOPS_ROOT_PATH .'/class/xoopsrequest.php';
require_once WGGALLERY_PATH .'/class/helper.php';
require_once WGGALLERY_PATH .'/include/functions.php';

// common constants
// constants for state
define('WGGALLERY_STATE_OFFLINE_VAL',  0);
define('WGGALLERY_STATE_ONLINE_VAL',   1);
define('WGGALLERY_STATE_APPROVAL_VAL', 2);
// constants for perms
define('WGGALLERY_PERM_SUBMITNONE',  0);
define('WGGALLERY_PERM_SUBMITALL',   1);
define('WGGALLERY_PERM_SUBMITOWN',   2);
define('WGGALLERY_PERM_SUBMITAPPR',  3);
// constants for image size
define('WGGALLERY_IMAGE_THUMB',   0);
define('WGGALLERY_IMAGE_MEDIUM',  1);
define('WGGALLERY_IMAGE_LARGE',   2);
// constants for album image cat
define('WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL',    1);
define('WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED_VAL', 2);
//constants for jssor
define('WGGALLERY_OPTION_GT_SLIDERTYPE_1_VAL',  1);
define('WGGALLERY_OPTION_GT_SLIDERTYPE_2_VAL',  2);
// define('WGGALLERY_OPTION_GT_SLIDERTYPE_3_VAL',  3);
// constants for watermarks
define('WGGALLERY_WATERMARK_TYPETEXT',  1);
define('WGGALLERY_WATERMARK_TYPEIMAGE', 2);
define('WGGALLERY_WATERMARK_POSTOPLEFT',      1);
define('WGGALLERY_WATERMARK_POSTOPRIGHT',     2);
define('WGGALLERY_WATERMARK_POSTOPCENTER',    3);
define('WGGALLERY_WATERMARK_POSMIDDLELEFT',   4);
define('WGGALLERY_WATERMARK_POSMIDDLERIGHT',  5);
define('WGGALLERY_WATERMARK_POSMIDDLECENTER', 6);
define('WGGALLERY_WATERMARK_POSBOTTOMLEFT',   7);
define('WGGALLERY_WATERMARK_POSBOTTOMRIGHT',  8);
define('WGGALLERY_WATERMARK_POSBOTTOMCENTER', 9);
define('WGGALLERY_WATERMARK_USAGENONE',   0);
define('WGGALLERY_WATERMARK_USAGEALL',    1);
define('WGGALLERY_WATERMARK_USAGESINGLE', 2);
define('WGGALLERY_WATERMARK_TARGET_A', 0);
define('WGGALLERY_WATERMARK_TARGET_M', 1);
define('WGGALLERY_WATERMARK_TARGET_L', 2);
