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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_albums_default.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

$op      = Request::getString('op', 'list');
$albId   = Request::getInt('alb_id', 0);
$albPid  = Request::getInt('alb_pid');
$albSubm = Request::getInt('alb_submitter');
$start   = Request::getInt('start', 0);
$limit   = Request::getInt('limit', $helper->getConfig('adminpager'));

if (_CANCEL === Request::getString('cancel', 'none')) {
    $op = 'list';
}

$redir = '';
if (_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD === Request::getString('submit_upload', 'none')) {
    $redir = 'upload';
}

$uid = $xoopsUser instanceof \XoopsUser ? $xoopsUser->id() : 0;

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/style_default.css');

// add scripts
$GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/admin.js');

// assign vars
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '16/');
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_32', WGGALLERY_ICONS_URL . '/32');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_image_url', WGGALLERY_UPLOAD_IMAGES_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('gallery_target', $helper->getConfig('gallery_target'));
$GLOBALS['xoopsTpl']->assign('show_breadcrumbs', $helper->getConfig('show_breadcrumbs'));
$GLOBALS['xoopsTpl']->assign('displayButtonText', $helper->getConfig('displayButtonText'));

$keywords = [];

switch ($op) {
    case 'list':
    case 'show':
    default:
        // add scripts
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/jquery-ui.min.js');
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/sortable.js');
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/jquery.mjs.nestedSortable.js');
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/nestedsortable.css');
        $GLOBALS['xoopsTpl']->assign('albpid', $albPid);

        $crAlbums = new \CriteriaCompo();
        if (!$permissionsHandler->permGlobalSubmit()) {
            $crAlbums->add(new \Criteria('alb_state', Constants::STATE_OFFLINE_VAL));
        }
        if ('show' === $op) {
            $crAlbums->add(new \Criteria('alb_id', $albId));
        }
        $crAlbums->add(new \Criteria('alb_pid', $albPid));
        $crAlbums->setStart($start);
        $crAlbums->setLimit($limit);
        $crAlbums->setSort('alb_weight ASC, alb_date');
        $crAlbums->setOrder('DESC');
        $albumsCount = $albumsHandler->getCount($crAlbums);
        $albumsAll   = $albumsHandler->getAll($crAlbums);
        $GLOBALS['xoopsTpl']->assign('albums_count', $albumsCount);
        $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
        // Table view albums
        $albumsPermEdit = 0;
        if ($albumsCount > 0) {
            foreach (array_keys($albumsAll) as $i) {
                //check permissions
                if ($permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'))) {
                    $album = $albumsAll[$i]->getValuesAlbums();
                    $album['edit'] = true;
                    $albumsPermEdit++;
                    $keywords[]    = $albumsAll[$i]->getVar('alb_name');
                }
                if ($permissionsHandler->permAlbumDownload($albumsAll[$i]->getVar('alb_id'))) {
                    $album['download'] = true;
                }
                $GLOBALS['xoopsTpl']->append('albums_list', $album);
                unset($album);
            }
            // Display Navigation
            if ($albumsPermEdit > $limit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($albumsCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit . '&amp;alb_id=' . $albId . '&amp;alb_pid=' . $albPid . '&amp;alb_submitter=' . $albSubm);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_THEREARENT_ALBUMS);
        }
        // add list for sorting
        $albumlist_sort = $albumsHandler->getListChildsOfCategory(0);
        // var_dump($albumlist_sort);
        $GLOBALS['xoopsTpl']->assign('albumlist_sort', $albumlist_sort);
        $GLOBALS['xoopsTpl']->assign('global_submit', $permissionsHandler->permGlobalSubmit());
        $pr_gallery = $gallerytypesHandler->getPrimaryGallery();
        $GLOBALS['xoopsTpl']->assign('gallery', 'none' !== $pr_gallery['template']);
        $GLOBALS['xoopsTpl']->assign('goback', $albPid > 0);
        $GLOBALS['xoopsTpl']->assign('force', time());
        break;
    case 'new':
        // Get Form
        if ($permissionsHandler->permGlobalSubmit() > 0) {
            $albumsObj = $albumsHandler->create();
            $albumsObj->setVar('alb_pid', $albPid);
            $form = $albumsObj->getFormAlbums();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        } else {
            redirect_header('albums.php', 3, _NOPERM);
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('albums.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (!$permissionsHandler->permGlobalSubmit()) {
            redirect_header('albums.php', 3, _NOPERM);
        }
        $albNew = 0;
        if ($albId > 0) {
            $albumsObj = $albumsHandler->get($albId);
            if (!$permissionsHandler->permAlbumEdit($albId, $albumsObj->getVar('alb_submitter'))) {
                redirect_header('albums.php', 3, _NOPERM);
            }
        } else {
            $albumsObj = $albumsHandler->create();
            $albNew    = 1;
        }
        // Set Vars
        $albumsObj->setVar('alb_pid', $albPid);
        $albIscoll = Request::getInt('alb_iscoll');
        $albumsObj->setVar('alb_iscoll', $albIscoll);
        $alb_name = Request::getString('alb_name');
        $albumsObj->setVar('alb_name', $alb_name);
        $albumsObj->setVar('alb_desc', Request::getString('alb_desc'));
        $albumsObj->setVar('alb_weight', Request::getInt('alb_weight'));
        $albumsObj->setVar('alb_imgtype', Request::getInt('alb_imgtype'));
        $albumsObj->setVar('alb_image', Request::getString('alb_image'));
        $albumsObj->setVar('alb_imgid', Request::getInt('alb_imgid'));
        $albState = Request::getInt('alb_state');
        if (Constants::PERM_SUBMITAPPR === $permissionsHandler->permGlobalSubmit() && Constants::STATE_OFFLINE_VAL === $albState) {
            $albState = Constants::STATE_APPROVAL_VAL;
        }
        $albumsObj->setVar('alb_state', $albState);
        $albumsObj->setVar('alb_wmid', Request::getInt('alb_wmid'));
        $albumDate = date_create_from_format(_SHORTDATESTRING, $_POST['alb_date']);
        $albumsObj->setVar('alb_date', $albumDate->getTimestamp());
        $albumsObj->setVar('alb_submitter', Request::getInt('alb_submitter'));
        // Insert Data
        if ($albumsHandler->insert($albumsObj)) {
            if ($albNew) {
                $albId = $albumsHandler->getInsertId();
            }
            $gpermHandler = xoops_getHandler('groupperm');
            $perm_modid   = $GLOBALS['xoopsModule']->getVar('mid');
            // remove all existing rights
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_view', $albId);
            //TODO
            // $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlfullalb', $albId);
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_large', $albId);
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_medium', $albId);
            // set selected rights new
            // Permission to view
            if (isset($_POST['groups_view'])) {
                foreach ($_POST['groups_view'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_view', $albId, $onegroupId, $perm_modid);
                }
            }
            //TODO
            // Permission to download full album
            // if(isset($_POST['groups_dlfullalb'])) {
            // foreach($_POST['groups_dlfullalb'] as $onegroupId) {
            // $gpermHandler->addRight('wggallery_dlfullalb', $albId, $onegroupId, $perm_modid);
            // }
            // }
            // Permission to download large images
            if (isset($_POST['groups_dlimage_large'])) {
                foreach ($_POST['groups_dlimage_large'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_large', $albId, $onegroupId, $perm_modid);
                }
            }
            // Permission to download medium images
            if (isset($_POST['groups_dlimage_medium'])) {
                foreach ($_POST['groups_dlimage_medium'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_medium', $albId, $onegroupId, $perm_modid);
                }
            }

            // set category of album
            $albumsHandler->setAlbumIsColl();

            // send notifications
            $tags                = [];
            $tags['ALBUM_NAME']  = $alb_name;
            $tags['ALBUM_URL']   = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . "/albums.php?op=show&alb_id={$albId}&amp;alb_pid={$albPid}";
            $notificationHandler = xoops_getHandler('notification');

            if (WGGALLERY_STATE_APPROVAL_VAL === $albState) {
                $notificationHandler->triggerEvent('global', 0, 'album_approve_all', $tags);
            } else {
                if ($albNew) {
                    $notificationHandler->triggerEvent('global', 0, 'album_new_all', $tags);
                } else {
                    $notificationHandler->triggerEvent('global', 0, 'album_modify_all', $tags);
                    $notificationHandler->triggerEvent('albums', $albId, 'album_modify', $tags);
                }
            }

            if ('upload' === $redir) {
                redirect_header('upload.php?alb_id=' . $albId, 2, _CO_WGGALLERY_FORM_OK);
            } else {
                redirect_header('albums.php?op=list' . '&amp;alb_pid=' . $albPid, 2, _CO_WGGALLERY_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
        $form = $albumsObj->getFormAlbums();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'edit':
        // Get Form
        $albumsObj = $albumsHandler->get($albId);
        if ($permissionsHandler->permAlbumEdit($albId, $albumsObj->getVar('alb_submitter'))) {
            $form = $albumsObj->getFormAlbums();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        } else {
            redirect_header('albums.php', 3, _NOPERM);
        }

        break;
    case 'delete':
        $albumsObj = $albumsHandler->get($albId);
        if (!$permissionsHandler->permAlbumEdit($albId, $albumsObj->getVar('alb_submitter'))) {
            redirect_header('albums.php', 3, _NOPERM);
        }
        if (1 == Request::getInt('ok')) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('albums.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $alb_image = $albumsObj->getVar('alb_image');
            if ($albumsHandler->delete($albumsObj)) {
                // delete albimage
                if ('blank.gif' !== $alb_image) {
                    unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/albums/' . $alb_image);
                }
                // delete all images linked to this album
                $crit_img = new \CriteriaCompo();
                $crit_img->add(new \Criteria('img_albid', $albId));
                $imagesAll = $imagesHandler->getAll($crit_img);
                foreach (array_keys($imagesAll) as $i) {
                    $imagesHandler->unlinkImages($imagesAll[$i]->getVar('img_name'), $imagesAll[$i]->getVar('img_namelarge'));
                    $imagesObj = $imagesHandler->get($imagesAll[$i]->getVar('img_id'));
                    $imagesHandler->delete($imagesObj, true);
                    // delete ratings
                    $ratingsHandler->deleteAllRatings($imagesAll[$i]->getVar('img_id'), 1);
                }
                // send notifications
                $tags                = [];
                $tags['ALBUM_NAME']  = $alb_name;
                $notificationHandler = xoops_getHandler('notification');
                $notificationHandler->triggerEvent('global', 0, 'album_delete_all', $tags);
                $notificationHandler->triggerEvent('albums', $albId, 'album_delete', $tags);
                // delete all notifications linked to this album
                $notificationHandler->unsubscribeByItem($GLOBALS['xoopsModule']->getVar('mid'), 'albums', $albId);

                redirect_header('albums.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
            }
        } else {
            // xoops_confirm(array('ok' => 1, 'alb_id' => $albId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $albumsObj->getVar('alb_name')));
            $form = $helper->getFormDelete(['ok' => 1, 'alb_id' => $albId, 'op' => 'delete'], _CO_WGGALLERY_FORM_DELETE, $albumsObj->getVar('alb_name'), _CO_WGGALLERY_ALBUM_DELETE_DESC);
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
    case 'order':
        $aorder = $_POST['menuItem'];
        $i      = 0;
        foreach (array_keys($aorder) as $key) {
            $albumsObj = $albumsHandler->get($key);
            $albumsObj->setVar('alb_pid', $aorder[$key]);
            $albumsObj->setVar('alb_weight', $i + 1);
            $albumsHandler->insert($albumsObj);
            $i++;
        }
        break;
}

// Breadcrumbs
if ($albPid > 0) {
    $xoBreadcrumbs[] = ['title' => _CO_WGGALLERY_ALBUMS, 'link' => 'albums.php?op=list'];
    $albumsObjPid    = $albumsHandler->get($albPid);
    $xoBreadcrumbs[] = ['title' => $albumsObjPid->getVar('alb_name')];
    unset($albumsObjPid);
} else {
    $xoBreadcrumbs[] = ['title' => _CO_WGGALLERY_ALBUMS];
}

$GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));

// Keywords
$utility::getMetaKeywords($helper->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);
// Description
$utility::getMetaDescription(_CO_WGGALLERY_ALBUMS);
//$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/albums.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
require __DIR__ . '/footer.php';
