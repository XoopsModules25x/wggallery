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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */
require __DIR__ . '/header.php';

use Xmf\Request;

$op   = Request::getString('op', 'list');
$wmId = Request::getInt('wm_id');
if (_CANCEL === Request::getString('cancel', 'none')) {
    $op = 'list';
}

$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/admin.js');

$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_upload_fonts_path', WGGALLERY_UPLOAD_FONTS_PATH);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

$templateMain = 'wggallery_admin_import.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('import.php'));

$sup_modules               = [];
$sup_modules['extgallery'] = ['name' => 'eXtGallery', 'dir' => 'extgallery'];
$sup_modules['tdmpicture'] = ['name' => 'TDMPicture', 'dir' => 'tdmpicture'];

$albumsCount    = $albumsHandler->getCount();
$imagesCount    = $imagesHandler->getCount();
$error_notempty = 0;
if ($imagesCount > 0 || $albumsCount > 0) {
    $GLOBALS['xoopsTpl']->assign('error_exist', _AM_WGGALLERY_IMPORT_ERR);
    $error_notempty = 1;
    if ($albumsCount > 0) {
        $GLOBALS['xoopsTpl']->assign('error_albexist', _AM_WGGALLERY_IMPORT_ERR_ALBEXIST);
    }
    if ($imagesCount > 0) {
        $GLOBALS['xoopsTpl']->assign('error_imgexist', _AM_WGGALLERY_IMPORT_ERR_IMGEXIST);
    }
}

switch ($op) {
    case 'read_eXtGallery':
        $im_name = 'eXtGallery';
        $adminObject->addItemButton(_AM_WGGALLERY_IMPORT_LIST, 'import.php?op=list', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        require_once WGGALLERY_PATH . '/plugins/extgallery.php';
        $result     = wggalleryPluginGetDataExtgallery();
        $num_albums = $result[0];
        $num_images = $result[1];
        // Get Form
        $form = wggalleryPluginGetFormExtgallery($im_name, $num_albums, $num_images);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'import_eXtGallery':
        require_once WGGALLERY_PATH . '/plugins/extgallery.php';
        $albState     = Request::getInt('alb_state');
        $albSubmitter = Request::getInt('alb_submitter');
        $result       = wggalleryPluginExecImportExtgallery($albState, $albSubmitter);
        if ($result) {
            redirect_header('albums.php', 3, str_replace(['%a', '%i'], [$albumsHandler->getCount(), $imagesHandler->getCount()], _AM_WGGALLERY_IMPORT_SUCCESS));
        } else {
            redirect_header('albums.php', 3, _AM_WGGALLERY_IMPORT_ERROR);
        }
        break;
    case 'read_TDMPicture':
        $im_name = 'TDMPicture';
        $adminObject->addItemButton(_AM_WGGALLERY_IMPORT_LIST, 'import.php?op=list', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        require_once WGGALLERY_PATH . '/plugins/tdmpicture.php';
        $result     = wggalleryPluginGetDataTdmpicture();
        $num_albums = $result[0];
        $num_images = $result[1];
        // Get Form
        $form = wggalleryPluginGetFormTdmpicture($im_name, $num_albums, $num_images);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'import_TDMPicture':
        require_once WGGALLERY_PATH . '/plugins/tdmpicture.php';
        $result = wggalleryPluginExecImportTdmpicture();
        if ($result) {
            redirect_header('albums.php', 3, str_replace(['%a', '%i'], [$albumsHandler->getCount(), $imagesHandler->getCount()], _AM_WGGALLERY_IMPORT_SUCCESS));
        } else {
            redirect_header('albums.php', 3, _AM_WGGALLERY_IMPORT_ERROR);
        }
        break;
    case 'list':
    default:
        $import_modules = [];
        $moduleHandler  = xoops_getHandler('module');
        foreach ($sup_modules as $s) {
            $im_found         = is_object($moduleHandler->getByDirname($s['dir'])) ? 1 : 0;
            $import_modules[] = ['name' => $s['name'], 'dir' => $s['dir'], 'found' => $im_found];
        }
        $GLOBALS['xoopsTpl']->assign('import_modules', $import_modules);

        break;
}
require __DIR__ . '/footer.php';
