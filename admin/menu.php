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
 * @version        $Id: 1.0 menu.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
$dirname = basename(dirname(__DIR__));
$moduleHandler = xoops_getHandler('module');
$xoopsModule = XoopsModule::getByDirname($dirname);
$moduleInfo = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');
$i = 1;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU1;
$adminmenu[$i]['link'] = 'admin/index.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/dashboard.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU2;
$adminmenu[$i]['link'] = 'admin/albums.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/albums.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU3;
$adminmenu[$i]['link'] = 'admin/images.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/images.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU4;
$adminmenu[$i]['link'] = 'admin/gallerytypes.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/gallerytypes.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU5;
$adminmenu[$i]['link'] = 'admin/albumtypes.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/albumtypes.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU9;
$adminmenu[$i]['link'] = 'admin/watermarks.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/watermarks.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU7;
$adminmenu[$i]['link'] = 'admin/permissions.php';
$adminmenu[$i]['icon'] = 'assets/icons/32//permissions.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU8;
$adminmenu[$i]['link'] = 'admin/maintenance.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/maintenance.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ADMENU10;
$adminmenu[$i]['link'] = 'admin/import.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/import.png';
++$i;
$adminmenu[$i]['title'] = _MI_WGGALLERY_ABOUT;
$adminmenu[$i]['link'] = 'admin/about.php';
$adminmenu[$i]['icon'] = 'assets/icons/32/about.png';
unset($i);
