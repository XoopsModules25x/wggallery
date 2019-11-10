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

use Xmf\Request;
use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op      = Request::getString('op', 'list');
$albId   = Request::getInt('alb_id');
$start   = Request::getInt('start', 0);
$limit   = Request::getInt('limit', $helper->getConfig('adminpager'));
$sort    = Request::getString('sort', 'alb_id');
$orderby = Request::getString('orderby', 'DESC');

// add scripts
$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/admin.js');
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '16/');

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $templateMain = 'wggallery_admin_albums.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albums.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUM, 'albums.php?op=new', 'add');
        if ('approve' === $op) {
            $adminObject->addItemButton(_AM_WGGALLERY_ALBUMS_LIST, 'albums.php', 'list');
        } else {
            $crAlbums = new \CriteriaCompo();
            $crAlbums->add(new \Criteria('alb_state', Constants::STATE_APPROVAL_VAL));
            $albumsCount = $albumsHandler->getCount($crAlbums);
            if ($albumsCount > 0) {
                $adminObject->addItemButton(_AM_WGGALLERY_ALBUMS_APPROVE, 'albums.php?op=approve', 'alert');
            }
            unset($crAlbums);
        }
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $crAlbums = new \CriteriaCompo();
        if ('approve' === $op) {
            $crAlbums->add(new \Criteria('alb_state', Constants::STATE_APPROVAL_VAL));
        }
        $crAlbums->setStart($start);
        $crAlbums->setLimit($limit);
        $crAlbums->setSort($sort);
        $crAlbums->setOrder($orderby);
        $albumsCount = $albumsHandler->getCount($crAlbums);
        $albumsAll   = $albumsHandler->getAll($crAlbums);
        $GLOBALS['xoopsTpl']->assign('albums_count', $albumsCount);
        $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
        $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('start', $start);
        $GLOBALS['xoopsTpl']->assign('limit', $limit);
        // Table view albums
        if ($albumsCount > 0) {
            foreach (array_keys($albumsAll) as $i) {
                $album    = $albumsAll[$i]->getValuesAlbums();
                $crImages = new \CriteriaCompo();
                $crImages->add(new \Criteria('img_albid', $album['alb_id']));
                $crImages->setSort('img_weight');
                $crImages->setOrder('ASC');
                $album['nb_images'] = $imagesHandler->getCount($crImages);
                $GLOBALS['xoopsTpl']->append('albums_list', $album);
                unset($album);
            }
            // Display Navigation
            if ($albumsCount > $limit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($albumsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('use_tags', $helper->getConfig('use_tags'));
            $GLOBALS['xoopsTpl']->assign('use_categories', $helper->getConfig('use_categories'));
        } else {
            $GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_THEREARENT_ALBUMS);
        }

        break;
    case 'new':
        $templateMain = 'wggallery_admin_albums.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albums.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_ALBUMS_LIST, 'albums.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $albumsObj = $albumsHandler->create();
        $form      = $albumsObj->getFormAlbums(false, true);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('albums.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($albId)) {
            $albumsObj = $albumsHandler->get($albId);
        } else {
            $albumsObj = $albumsHandler->create();
        }
        // Set Vars
        $albumsObj->setVar('alb_pid', Request::getInt('alb_pid'));
        $albumsObj->setVar('alb_iscoll', Request::getInt('alb_iscoll'));
        $albumsObj->setVar('alb_name', Request::getString('alb_name'));
        $albumsObj->setVar('alb_desc', Request::getString('alb_desc'));
        $albumsObj->setVar('alb_weight', Request::getInt('alb_weight'));
        $albumsObj->setVar('alb_state', Request::getInt('alb_state'));
        $albumsObj->setVar('alb_imgtype', Request::getInt('alb_imgtype'));
        $albumsObj->setVar('alb_image', Request::getString('alb_image'));
        $albumsObj->setVar('alb_imgid', Request::getInt('alb_imgid'));
        $albumsObj->setVar('alb_wmid', Request::getInt('alb_wmid'));
        $albCats = serialize(Request::getArray('alb_cats'));
        $albumsObj->setVar('alb_cats', $albCats);
        $albumsObj->setVar('alb_tags', Request::getString('alb_tags'));
        $albumDate = date_create_from_format(_SHORTDATESTRING, $_POST['alb_date']);
        $albumsObj->setVar('alb_date', $albumDate->getTimestamp());
        $albumsObj->setVar('alb_submitter', Request::getInt('alb_submitter'));
        // Insert Data
        if ($albumsHandler->insert($albumsObj)) {
            $newAlbId     = $albumsHandler->getInsertId();
            $permId       = isset($_REQUEST['alb_id']) ? $albId : $newAlbId;
            $perm_modid   = $GLOBALS['xoopsModule']->getVar('mid');
            $gpermHandler = xoops_getHandler('groupperm');
            // remove all existing rights
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_view', $permId);
            //TODO
            // $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlfullalb', $permId);
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_large', $permId);
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_medium', $permId);
            // set selected rights new
            // Permission to view
            if (isset($_POST['groups_view'])) {
                foreach ($_POST['groups_view'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_view', $permId, $onegroupId, $perm_modid);
                }
            }
            //TODO
            // Permission to download full album
            // if(isset($_POST['groups_dlfullalb'])) {
            // foreach($_POST['groups_dlfullalb'] as $onegroupId) {
            // $gpermHandler->addRight('wggallery_dlfullalb', $permId, $onegroupId, $perm_modid);
            // }
            // }
            // Permission to download large images
            if (isset($_POST['groups_dlimage_large'])) {
                foreach ($_POST['groups_dlimage_large'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_large', $permId, $onegroupId, $perm_modid);
                }
            }
            // Permission to download medium images
            if (isset($_POST['groups_dlimage_medium'])) {
                foreach ($_POST['groups_dlimage_medium'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_medium', $permId, $onegroupId, $perm_modid);
                }
            }
            $albumsHandler->setAlbumIsColl();
            redirect_header('albums.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
        $form = $albumsObj->getFormAlbums();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'edit':
        $templateMain = 'wggallery_admin_albums.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albums.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUM, 'albums.php?op=new', 'add');
        $adminObject->addItemButton(_AM_WGGALLERY_ALBUMS_LIST, 'albums.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $albumsObj = $albumsHandler->get($albId);
        $form      = $albumsObj->getFormAlbums(false, true);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'change_state':
        if (isset($albId)) {
            $albumsObj = $albumsHandler->get($albId);
            $stateOld  = $albumsObj->getVar('alb_state');
            $stateNew  = Request::getInt('alb_state');
            // Set Vars
            $albumsObj->setVar('alb_state', Request::getInt('alb_state'));
            // Insert Data
            if ($albumsHandler->insert($albumsObj)) {
                if (Constants::STATE_APPROVAL_VAL === $stateOld && Constants::STATE_OFFLINE_VAL === $stateNew) {
                    $crImages = new \CriteriaCompo();
                    $crImages->add(new \Criteria('img_albid', $albId));
                    $crImages->add(new \Criteria('img_state', Constants::STATE_APPROVAL_VAL));
                    $imgApprove = $imagesHandler->getCount($crImages);
                    if ($imgApprove > 0) {
                        redirect_header('images.php?op=approve&amp;alb_id=' . $albId, 2, _CO_WGGALLERY_FORM_OK_APPROVE);
                    }
                }
                redirect_header('albums.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, _CO_WGGALLERY_FORM_OK);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
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
                if ('blank.gif' !== $alb_image && 'noimage.png' !== $alb_image) {
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
}
require __DIR__ . '/footer.php';
