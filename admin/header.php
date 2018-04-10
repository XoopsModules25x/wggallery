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
 * @version        $Id: 1.0 header.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
include dirname(dirname(dirname(__DIR__))) .'/include/cp_header.php';
include_once dirname(__DIR__) .'/include/common.php';
$sysPathIcon16  = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32  = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin  = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16  = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32  = $GLOBALS['xoopsModule']->getInfo('modicons32');
// Get instance of module
$wggallery = WggalleryHelper::getInstance();
$albumsHandler = $wggallery->getHandler('albums');
$imagesHandler = $wggallery->getHandler('images');
$gallerytypesHandler = $wggallery->getHandler('gallerytypes');
$permissionsHandler = $wggallery->getHandler('permissions');
$myts = MyTextSanitizer::getInstance();
// 
if(!isset($xoopsTpl) || !is_object($xoopsTpl)) {
	include_once XOOPS_ROOT_PATH .'/class/template.php';
	$xoopsTpl = new XoopsTpl();
}
// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);
// Load languages
xoops_loadLanguage('admin');
xoops_loadLanguage('modinfo');
// Local admin menu class
if(file_exists($GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php'))) {
	include_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
} else {
	redirect_header('../../../admin.php.php', 5, _AM_MODULEADMIN_MISSING);
}
xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
$style = WGGALLERY_URL . '/assets/css/admin/style.css';
