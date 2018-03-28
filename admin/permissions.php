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
$formSelect->addOption('global', _CO_WGGALLERY_PERMISSIONS_GLOBAL);
$formSelect->addOption('approve', _CO_WGGALLERY_PERMISSIONS_APPROVE);
$formSelect->addOption('submit', _CO_WGGALLERY_PERMISSIONS_SUBMIT);
$formSelect->addOption('view', _CO_WGGALLERY_PERMISSIONS_VIEW);
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch($op) {
	case 'global':
	default:
		$formTitle = _CO_WGGALLERY_PERMISSIONS_GLOBAL;
		$permName = 'wggallery_ac';
		$permDesc = _CO_WGGALLERY_PERMISSIONS_GLOBAL_DESC;
		$globalPerms = array( '4' => _CO_WGGALLERY_PERMISSIONS_GLOBAL_4, '8' => _CO_WGGALLERY_PERMISSIONS_GLOBAL_8, '16' => _CO_WGGALLERY_PERMISSIONS_GLOBAL_16 );
	break;
	case 'approve':
		$formTitle = _CO_WGGALLERY_PERMISSIONS_APPROVE;
		$permName = 'wggallery_approve';
		$permDesc = _CO_WGGALLERY_PERMISSIONS_APPROVE_DESC;
	break;
	case 'submit':
		$formTitle = _CO_WGGALLERY_PERMISSIONS_SUBMIT;
		$permName = 'wggallery_submit';
		$permDesc = _CO_WGGALLERY_PERMISSIONS_SUBMIT_DESC;
	break;
	case 'view':
		$formTitle = _CO_WGGALLERY_PERMISSIONS_VIEW;
		$permName = 'wggallery_view';
		$permDesc = _CO_WGGALLERY_PERMISSIONS_VIEW_DESC;
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
	$imagesCount = $imagesHandler->getCountImages();
	if($imagesCount > 0) {
		$imagesAll = $imagesHandler->getAllImages(0, 'img_name');
		foreach(array_keys($imagesAll) as $i) {
			$permform->addItem($imagesAll[$i]->getVar('img_id'), $imagesAll[$i]->getVar('img_name'));
		}
		$GLOBALS['xoopsTpl']->assign('form', $permform->render());
	} else {
		redirect_header('images.php?op=new', 3, _AM_WGGALLERY_NO_PERMISSIONS_SET);
		exit();
	}
}
unset($permform);
include __DIR__ . '/footer.php';
