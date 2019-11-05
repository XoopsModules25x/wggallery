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
 * @version        $Id: 1.0 menu.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */

$dirname       = basename(dirname(__DIR__));
$moduleHandler = xoops_getHandler('module');
$xoopsModule   = \XoopsModule::getByDirname($dirname);
$moduleInfo    = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => 'assets/icons/32/dashboard.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU2,
    'link'  => 'admin/albums.php',
    'icon'  => 'assets/icons/32/albums.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU3,
    'link'  => 'admin/images.php',
    'icon'  => 'assets/icons/32/images.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU4,
    'link'  => 'admin/gallerytypes.php',
    'icon'  => 'assets/icons/32/gallerytypes.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU5,
    'link'  => 'admin/albumtypes.php',
    'icon'  => 'assets/icons/32/albumtypes.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU11,
    'link'  => 'admin/categories.php',
    'icon'  => 'assets/icons/32/categories.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU9,
    'link'  => 'admin/watermarks.php',
    'icon'  => 'assets/icons/32/watermarks.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU7,
    'link'  => 'admin/permissions.php',
    'icon'  => 'assets/icons/32/permissions.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU8,
    'link'  => 'admin/maintenance.php',
    'icon'  => 'assets/icons/32/maintenance.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ADMENU10,
    'link'  => 'admin/import.php',
    'icon'  => 'assets/icons/32/import.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_FEEDBACK,
    'link'  => 'admin/feedback.php',
    'icon'  => 'assets/icons/32/feedback.png',
];

$adminmenu[] = [
    'title' => _MI_WGGALLERY_ABOUT,
    'link'  => 'admin/about.php',
    'icon'  => 'assets/icons/32/about.png',
];
