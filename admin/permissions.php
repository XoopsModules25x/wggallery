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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 permissions.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

require __DIR__ . '/header.php';
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
$imagesHandler = $helper->getHandler('Images');
// Check admin have access to this page
$templateMain = 'wggallery_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));
$op = Request::getString('op', 'global');
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect    = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_CO_WGGALLERY_PERMS_GLOBAL);
$formSelect->addOption('albdefault', \_AM_WGGALLERY_PERMS_ALBDEFAULT);
$formSelect->addOption('view', \_CO_WGGALLERY_PERMS_ALB_VIEW);
$formSelect->addOption('dlfullalb', \_CO_WGGALLERY_PERMS_ALB_DLFULLALB);
$formSelect->addOption('dlimage_large', \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE);
$formSelect->addOption('dlimage_medium', \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM);
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle   = \_CO_WGGALLERY_PERMS_GLOBAL;
        $permName    = 'wggallery_global';
        $permDesc    = \_CO_WGGALLERY_PERMS_GLOBAL_DESC;
        $globalPerms = ['2' => \_CO_WGGALLERY_PERMS_GLOBAL_USECOLL, '4' => \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL, '8' => \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN, '16' => \_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR];
        break;
    case 'albdefault':
        $formTitle   = \_AM_WGGALLERY_PERMS_ALBDEFAULT;
        $permName    = 'wggallery_albdefault';
        $permDesc    = \_AM_WGGALLERY_PERMS_ALBDEFAULT_DESC;
        $globalPerms = ['4' => \_CO_WGGALLERY_PERMS_ALB_VIEW, '8' => \_CO_WGGALLERY_PERMS_ALB_DLFULLALB, '16' => \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE, '32' => \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM
        ];
        break;
    case 'view':
        $formTitle = \_CO_WGGALLERY_PERMS_ALB_VIEW;
        $permName  = 'wggallery_view';
        $permDesc  = \_CO_WGGALLERY_PERMS_ALB_VIEW_DESC;
        break;
    case 'dlfullalb':
        $formTitle = \_CO_WGGALLERY_PERMS_ALB_DLFULLALB;
        $permName  = 'wggallery_dlfullalb';
        $permDesc  = \_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC;
        break;
    case 'dlimage_large':
        $formTitle = \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE;
        $permName  = 'wggallery_dlimage_large';
        $permDesc  = \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE_DESC;
        break;
    case 'dlimage_medium':
        $formTitle = \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM;
        $permName  = 'wggallery_dlimage_medium';
        $permDesc  = \_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM_DESC;
        break;
}
$moduleId = $xoopsModule->getVar('mid');

if ('global' === $op) {
    $permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php', false);
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
} elseif ('albdefault' === $op) {
    $permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php', true);
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
} else {
    $permform    = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
    $albumsCount = $albumsHandler->getCountAlbums();
    if ($albumsCount > 0) {
        $albumsAll = $albumsHandler->getAllAlbums(0, 'alb_name');
        foreach (\array_keys($albumsAll) as $i) {
            $permform->addItem($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_name'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    } else {
        $GLOBALS['xoopsTpl']->assign('error', \_CO_WGGALLERY_THEREARENT_ALBUMS);
    }
}
unset($permform);
require __DIR__ . '/footer.php';
