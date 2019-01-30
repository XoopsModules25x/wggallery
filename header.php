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
 * @version        $Id: 1.0 header.php 1 Mon 2018-03-19 10:04:54Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

include dirname(dirname(__DIR__)) . '/mainfile.php';
include __DIR__ . '/include/common.php';
$dirname = basename(__DIR__);
// Get instance of module
$helper              = \XoopsModules\Wggallery\Helper::getInstance();
$albumsHandler       = $helper->getHandler('Albums');
$imagesHandler       = $helper->getHandler('Images');
$gallerytypesHandler = $helper->getHandler('Gallerytypes');
$albumtypesHandler   = $helper->getHandler('Albumtypes');
$permissionsHandler  = $helper->getHandler('Permissions');
$watermarksHandler   = $helper->getHandler('Watermarks');
// Permission
require XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
$gpermHandler = xoops_getHandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
    $groups = XOOPS_GROUP_ANONYMOUS;
}
// Breadcrumbs
$xoBreadcrumbs = [];
if ($helper->getConfig('show_bcrumb_mname')) {
    if (isset($GLOBALS['xoopsModule']) && is_object($GLOBALS['xoopsModule'])) { // necessary to check, otherwise uploader runs into errors
        $xoBreadcrumbs[] = ['title' => $GLOBALS['xoopsModule']->getVar('name'), 'link' => WGGALLERY_URL . '/'];
    }
}

$myts = MyTextSanitizer::getInstance();
// Default Css Style
$style = WGGALLERY_URL . '/assets/css/style.css';
if (!file_exists($style)) {
    return false;
}
// Smarty Default
$sysPathIcon16   = $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32   = $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16   = $GLOBALS['xoopsModule']->getInfo('modicons16');
$modPathIcon32   = $GLOBALS['xoopsModule']->getInfo('modicons16');
// Load Languages
xoops_loadLanguage('main');
xoops_loadLanguage('modinfo');
xoops_loadLanguage('common');
