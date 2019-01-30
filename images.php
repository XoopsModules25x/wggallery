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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

include __DIR__ . '/header.php';

$op = Request::getString('op', 'list');
if ('manage' === $op) {
    $GLOBALS['xoopsOption']['template_main'] = 'wggallery_images_manage.tpl';
} else {
    $GLOBALS['xoopsOption']['template_main'] = 'wggallery_images_default.tpl';
}
require_once XOOPS_ROOT_PATH . '/header.php';

$imgId   = Request::getInt('img_id');
$albId   = Request::getInt('alb_id');
$albPid  = Request::getInt('alb_pid');
$ref     = Request::getString('ref');
$imgSubm = Request::getInt('img_submitter');
$start   = Request::getInt('start', 0);
$limit   = Request::getInt('limit', $helper->getConfig('userpager'));

if (_CANCEL === Request::getString('cancel', 'none')) {
    $op = 'list';
}

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/style.css', null);
//
// $GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
$GLOBALS['xoopsTpl']->assign('show_breadcrumbs', $helper->getConfig('show_breadcrumbs'));

$albName   = '';
$albumsObj = $albumsHandler->get($albId);
if (isset($albumsObj) && is_object($albumsObj)) {
    $albName      = $albumsObj->getVar('alb_name');
    $albSubmitter = $albumsObj->getVar('alb_submitter');
}
$permAlbumEdit = $permissionsHandler->permAlbumEdit($albId, $albSubmitter);

// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _CO_WGGALLERY_ALBUMS, 'link' => WGGALLERY_URL . '/'];
if ($albPid > 0) {
    $albumsObj       = $albumsHandler->get($albPid);
    $xoBreadcrumbs[] = ['title' => $albumsObj->getVar('alb_name'), 'link' => WGGALLERY_URL . '/index.php?op=list&amp;alb_pid=' . $albPid];
}
$xoBreadcrumbs[] = ['title' => $albName, 'link' => WGGALLERY_URL . '/images.php?op=list&amp;alb_id=' . $albId];
$xoBreadcrumbs[] = ['title' => _CO_WGGALLERY_IMAGES];

switch ($op) {
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $imgAlbId = Request::getInt('img_albid');
        if (!$permAlbumEdit || $imgAlbId !== $albId) {
            redirect_header('images.php', 3, _NOPERM);
        }
        if (isset($imgId)) {
            $imagesObj = $imagesHandler->get($imgId);
        } else {
            $imagesObj = $imagesHandler->create();
        }
        // Set Vars
        $imagesObj->setVar('img_title', Request::getString('img_title', ''));
        $imagesObj->setVar('img_desc', Request::getString('img_desc', ''));
        $imagesObj->setVar('img_name', Request::getString('img_name', ''));
        $imagesObj->setVar('img_nameorig', Request::getString('img_nameorig', ''));
        $imagesObj->setVar('img_mimetype', Request::getInt('img_mimetype'));
        $imagesObj->setVar('img_size', Request::getInt('img_size'));
        $imagesObj->setVar('img_resx', Request::getInt('img_resx'));
        $imagesObj->setVar('img_resy', Request::getInt('img_resy'));
        $imagesObj->setVar('img_downloads', Request::getInt('img_downloads'));
        $imagesObj->setVar('img_ratinglikes', Request::getInt('img_ratinglikes'));
        $imagesObj->setVar('img_votes', Request::getInt('img_votes'));
        $imagesObj->setVar('img_weight', Request::getInt('img_weight'));

        $albumsObj = $albumsHandler->get($albId);
        $imgAlbPid = $albumsObj->getVar('alb_pid');
        $imagesObj->setVar('img_albid', $imgAlbId);
        $imagesObj->setVar('img_state', Request::getInt('img_state'));
        $imageDate = date_create_from_format(_SHORTDATESTRING, $_POST['img_date']);
        $imagesObj->setVar('img_date', $imageDate->getTimestamp());
        $imagesObj->setVar('img_submitter', Request::getInt('img_submitter'));
        $imagesObj->setVar('img_ip', $_SERVER['REMOTE_ADDR']);
        // Insert Data
        if ($imagesHandler->insert($imagesObj)) {
            redirect_header('images.php?op=list&amp;alb_id=' . $imgAlbId . '&amp;alb_pid=' . $imgAlbPid, 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        $form = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'edit':
        // Get Form
        $imagesObj = $imagesHandler->get($imgId);
        $form      = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'show':
        // Get Form
        $imagesObj = $imagesHandler->get($imgId);
        $image     = $imagesObj->getValuesImages();
        $albId     = $image['albid'];
        // check permissions
        $file = '';
        if ($permissionsHandler->permImageDownloadMedium($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_URL . '/large/' . $image['medium'];
        }
        if ($permissionsHandler->permImageDownloadLarge($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_URL . '/large/' . $image['img_namelarge'];
        }
        $GLOBALS['xoopsTpl']->assign('showimage', true);
        $GLOBALS['xoopsTpl']->assign('file', $file);
        $GLOBALS['xoopsTpl']->assign('image', $image);
        $GLOBALS['xoopsTpl']->assign('alb_id', $albId);
        $GLOBALS['xoopsTpl']->assign('alb_pid', $albPid);
        $GLOBALS['xoopsTpl']->assign('start', $start);
        $GLOBALS['xoopsTpl']->assign('limit', $limit);
        $GLOBALS['xoopsTpl']->assign('img_submitter', $$imgSubm);

        break;
    case 'delete':
        $imagesObj = $imagesHandler->get($imgId);
        $imgAlbId  = $imagesObj->getVar('img_albid');
        if (!$permAlbumEdit || $imgAlbId !== $albId) {
            redirect_header('images.php', 3, _NOPERM);
        }
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('images.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $img_name = $imagesObj->getVar('img_name');
            if ($imagesHandler->delete($imagesObj)) {
                if ($imagesHandler->unlinkImages($img_name, $imagesObj->getVar('img_namelarge'))) {
                    redirect_header('images.php?op=list&amp;alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
                } else {
                    $GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_IMAGE_ERRORUNLINK);
                }
                redirect_header('images.php?op=list&amp;alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
            }
        } else {
            // xoops_confirm(array('ok' => 1, 'img_id' => $imgId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $imagesObj->getVar('img_name')));
            $form = $helper->getFormDelete(['ok' => 1, 'img_id' => $imgId, 'op' => 'delete', 'alb_id=' . $albId], _CO_WGGALLERY_FORM_DELETE, $imagesObj->getVar('img_name'));
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'manage':
        $GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/jquery-ui.min.js');
        $GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/sortable-images.js');
        $GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/jquery.mjs.nestedSortable.js');
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/nestedsortable.css');
        if (!$permAlbumEdit) {
            redirect_header('images.php', 3, _NOPERM);
        }

        $GLOBALS['xoopsTpl']->assign('alb_name', $albName);
        $GLOBALS['xoopsTpl']->assign('alb_id', $albId);
        $GLOBALS['xoopsTpl']->assign('alb_pid', $albPid);
        $GLOBALS['xoopsTpl']->assign('ref', $ref);

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_albid', $albId));
        $crImages->setSort('img_weight ASC, img_date');
        $crImages->setOrder('DESC');
        $imagesCount = $imagesHandler->getCount($crImages);
        $imagesAll   = $imagesHandler->getAll($crImages);
        if ($imagesCount > 0) {
            $images = [];
            // Get All Images
            foreach (array_keys($imagesAll) as $i) {
                $images[$i] = $imagesAll[$i]->getValuesImages();
            }
            $GLOBALS['xoopsTpl']->assign('images', $images);
            unset($images);
        }
        break;
    case 'order':
        $aorder = $_POST['menuItem'];
        $i      = 0;
        foreach (array_keys($aorder) as $key) {
            $imagesObj = $imagesHandler->get($key);
            $imagesObj->setVar('img_weight', $i + 1);
            $imagesHandler->insert($imagesObj);
            $i++;
        }
        break;
    case 'list':
    default:

        $albums    = $helper->getHandler('albums');
        $albumsObj = $albums->get($albId);
        if (isset($albumsObj) && is_object($albumsObj)) {
            $albName      = $albumsObj->getVar('alb_name');
            $albSubmitter = $albumsObj->getVar('alb_submitter');
        }
        $GLOBALS['xoopsTpl']->assign('alb_name', $albName);
        // $GLOBALS['xoopsTpl']->assign('alb_allowdownload', $permissionsHandler->permAlbumDownload($albId));
        $GLOBALS['xoopsTpl']->assign('img_allowdownload', $permissionsHandler->permImageDownloadLarge($albId)
                                                          || $permissionsHandler->permImageDownloadMedium($albId));
        $GLOBALS['xoopsTpl']->assign('permAlbumEdit', $permissionsHandler->permAlbumEdit($albId, $albSubmitter));
        $GLOBALS['xoopsTpl']->assign('alb_id', $albId);
        $GLOBALS['xoopsTpl']->assign('alb_pid', $albPid);

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_albid', $albId));
        if (!$permAlbumEdit) {
            $crImages->add(new \Criteria('img_state', WGGALLERY_STATE_ONLINE_VAL));
        }
        $crImages->setSort('img_weight ASC, img_date');
        $crImages->setOrder('DESC');
        $imagesCount = $imagesHandler->getCount($crImages);

        $crImages->setStart($start);
        $crImages->setLimit($limit);
        $imagesAll = $imagesHandler->getAll($crImages);
        $keywords  = [];
        if ($imagesCount > 0) {
            $images = [];
            // Get All Images
            foreach (array_keys($imagesAll) as $i) {
                $images[$i] = $imagesAll[$i]->getValuesImages();
                //check permissions
                $images[$i]['edit'] = $permAlbumEdit;
                $keywords[]         = $imagesAll[$i]->getVar('img_name');
            }
            $GLOBALS['xoopsTpl']->assign('images', $images);
            unset($images);
            // Display Navigation
            if ($imagesCount > $limit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&limit=' . $limit . '&alb_id=' . $albId . '&alb_pid=' . $albPid . '&img_submitter=' . $imgSubm);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            $GLOBALS['xoopsTpl']->assign('showlist', true);
            $GLOBALS['xoopsTpl']->assign('ref', $ref);
            $GLOBALS['xoopsTpl']->assign('start', $start);
            $GLOBALS['xoopsTpl']->assign('limit', $limit);
            $GLOBALS['xoopsTpl']->assign('img_submitter', $imgSubm);
        }
        break;
}

// Keywords
wggalleryMetaKeywords($helper->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_CO_WGGALLERY_IMAGES);
// $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/images.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
