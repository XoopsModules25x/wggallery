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
 * @version        $Id: 1.0 header.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

include dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require dirname(__DIR__) . '/include/common.php';

$moduleDirName = basename(dirname(__DIR__));
/** @var \XoopsModules\Wggallery\Helper $helper */
$helper = \XoopsModules\Wggallery\Helper::getInstance();
/** @var \XoopsModules\Wggallery\Utility $utility */
$utility = new \XoopsModules\Wggallery\Utility();

$sysPathIcon16   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16   = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32   = $GLOBALS['xoopsModule']->getInfo('modicons32');
// Get instance of module
$albumsHandler       = $helper->getHandler('Albums');
$imagesHandler       = $helper->getHandler('Images');
$gallerytypesHandler = $helper->getHandler('Gallerytypes');
$albumtypesHandler   = $helper->getHandler('Albumtypes');
$permissionsHandler  = $helper->getHandler('Permissions');
$watermarksHandler   = $helper->getHandler('Watermarks');
$categoriesHandler   = $helper->getHandler('Categories');
$myts                = \MyTextSanitizer::getInstance();

if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}
// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);
// Load languages
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');

xoops_cp_header();
$adminObject = \Xmf\Module\Admin::getInstance();
$GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/admin/style.css', null);