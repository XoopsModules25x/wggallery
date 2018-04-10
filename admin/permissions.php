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
 * @version        $Id: 1.0 permissions.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
include_once XOOPS_ROOT_PATH .'/class/xoopsform/grouppermform.php';
$imagesHandler = $wggallery->getHandler('images');
// Check admin have access to this page
$templateMain = 'wggallery_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));
$op = XoopsRequest::getString('op', 'global');
xoops_load('XoopsFormLoader');
$permTableForm = new XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', _CO_WGGALLERY_PERMS_GLOBAL);
$formSelect->addOption('view', _CO_WGGALLERY_PERMS_ALB_VIEW);
$formSelect->addOption('dllarge', _CO_WGGALLERY_PERMS_ALB_DLLARGE);
$formSelect->addOption('dlmedium', _CO_WGGALLERY_PERMS_ALB_DLMEDIUM);
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch($op) {
 	case 'global':
	default:
		$formTitle = _CO_WGGALLERY_PERMS_GLOBAL;
		$permName = 'wggallery_global';
		$permDesc = _CO_WGGALLERY_PERMS_GLOBAL_DESC;
		$globalPerms = array( '4' => _CO_WGGALLERY_PERMS_GLOBAL_4, '8' => _CO_WGGALLERY_PERMS_GLOBAL_8, '16' => _CO_WGGALLERY_PERMS_GLOBAL_16 );
	break;
	case 'view':
		$formTitle = _CO_WGGALLERY_PERMS_ALB_VIEW;
		$permName = 'wggallery_view';
		$permDesc = _CO_WGGALLERY_PERMS_ALB_VIEW_DESC;
	break;
	case 'dllarge':
		$formTitle = _CO_WGGALLERY_PERMS_ALB_DLLARGE;
		$permName = 'wggallery_dllarge';
		$permDesc = _CO_WGGALLERY_PERMS_ALB_DLLARGE_DESC;
	break;
	case 'dlmedium':
		$formTitle = _CO_WGGALLERY_PERMS_ALB_DLMEDIUM;
		$permName = 'wggallery_dlmedium';
		$permDesc = _CO_WGGALLERY_PERMS_ALB_DLMEDIUM_DESC;
	break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
if($op === 'global') {
	foreach($globalPerms as $gPermId => $gPermName) {
		$permform->addItem($gPermId, $gPermName);
	}
	$GLOBALS['xoopsTpl']->assign('form', $permform->render());
} else {
	$albumsCount = $albumsHandler->getCountAlbums();
	if($albumsCount > 0) {
		$albumsAll = $albumsHandler->getAllAlbums(0, 'alb_name');
		foreach(array_keys($albumsAll) as $i) {
			$permform->addItem($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_name'));		}
		$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	} else {
		$GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_THEREARENT_ALBUMS);
	}
}
unset($permform);
include __DIR__ . '/footer.php';
