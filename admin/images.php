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
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request img_id
$imgId = Request::getInt('img_id');
$albId = Request::getInt('alb_id');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));

$templateMain = 'wggallery_admin_images.tpl';
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '16/');

switch ($op) {
    case 'list':
    case 'approve':
    default:
        // Form
        if (isset($albId)) {
            $albumsObj = $albumsHandler->get($albId);
        } else {
            $albumsObj = $albumsHandler->create();
        }
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
        if ('list' === $op) {
            $form = $albumsObj->getFormUploadToAlbum('images.php');
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
            $crImages = new \CriteriaCompo();
            $crImages->add(new \Criteria('img_state', Constants::STATE_APPROVAL_VAL));
            $imagesCount = $imagesHandler->getCount($crImages);
            if ($imagesCount > 0) {
                $adminObject->addItemButton(_AM_WGGALLERY_IMAGES_APPROVE, 'images.php?op=approve', 'alert');
            }
            unset($crImages);
        }
        if ($albId > 0 || 'approve' === $op) {
            if ($albId > 0) {
                $adminObject->addItemButton(_AM_WGGALLERY_ADD_IMAGE, '../upload.php?op=list&amp;alb_id=' . $albId, 'add');
            }
            $adminObject->addItemButton(_AM_WGGALLERY_IMAGES_LIST, 'images.php?op=list', 'list');

            $crImages = new \CriteriaCompo();
            if ($albId > 0) {
                $crImages->add(new \Criteria('img_albid', $albId));
                $crImages->setSort('img_weight');
                $crImages->setOrder('ASC');
            }
            if ('approve' === $op) {
                $crImages->add(new \Criteria('img_state', Constants::STATE_APPROVAL_VAL));
                $crImages->setSort('img_albid');
                $crImages->setOrder('ASC');
            }
            $imagesCount = $imagesHandler->getCount($crImages);
            $crImages->setStart($start);
            $crImages->setLimit($limit);
            $imagesAll = $imagesHandler->getAll($crImages);
            $GLOBALS['xoopsTpl']->assign('images_count', $imagesCount);
            $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
            $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
            // Table view images
            if ($imagesCount > 0) {
                foreach (array_keys($imagesAll) as $i) {
                    $image = $imagesAll[$i]->getValuesImages();
                    if ('approve' === $op) {
                        $albumsHandler = $helper->getHandler('Albums');
                        $albumsObj     = $albumsHandler->get($image['img_albid']);
                        if (isset($albumsObj) && is_object($albumsObj)) {
                            $image['alb_name'] = $albumsObj->getVar('alb_name');
                        }
                        unset($albumsObj);
                    }
                    $GLOBALS['xoopsTpl']->append('images_list', $image);
                    unset($image);
                }
                if ('approve' === $op) {
                    $GLOBALS['xoopsTpl']->append('images_approve', true);
                }
                // Display Navigation
                if ($imagesCount > $limit) {
                    require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                    $pagenav = new \XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit . '&amp;alb_id=' . $albId);
                    $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
                }
                $GLOBALS['xoopsTpl']->assign('show_exif', $helper->getConfig('store_exif'));
                $GLOBALS['xoopsTpl']->assign('use_tags', $helper->getConfig('use_tags'));
                $GLOBALS['xoopsTpl']->assign('use_categories', $helper->getConfig('use_categories'));
            } else {
                $GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_THEREARENT_IMAGES);
            }
        }
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        break;
    case 'new':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_IMAGES_LIST, 'images.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $imagesObj = $imagesHandler->create();
        $form      = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($imgId)) {
            $imagesObj = $imagesHandler->get($imgId);
        } else {
            $imagesObj = $imagesHandler->create();
        }
        // Set Vars
        $imagesObj->setVar('img_title',     Request::getString('img_title'));
        $imagesObj->setVar('img_desc',      Request::getString('img_desc'));
        $imagesObj->setVar('img_name',      Request::getString('img_name'));
        $imagesObj->setVar('img_namelarge', Request::getString('img_namelarge'));
        $imagesObj->setVar('img_nameorig',  Request::getString('img_nameorig'));
        $imagesObj->setVar('img_mimetype',  Request::getString('img_mimetype'));
        $imagesObj->setVar('img_size',      Request::getInt('img_size'));
        $imagesObj->setVar('img_resx',      Request::getInt('img_resx'));
        $imagesObj->setVar('img_resy',      Request::getInt('img_resy'));
        $imagesObj->setVar('img_downloads', Request::getInt('img_downloads'));
        $imagesObj->setVar('img_ratinglikes', Request::getInt('img_ratinglikes'));
        $imagesObj->setVar('img_votes',     Request::getInt('img_votes'));
        $imagesObj->setVar('img_weight',    Request::getInt('img_weight'));
        $imagesObj->setVar('img_albid',     Request::getInt('img_albid'));
        $imagesObj->setVar('img_state',     Request::getInt('img_state'));
        $imagesObj->setVar('img_exif',      Request::getString('img_exif'));
        $imagesObj->setVar('img_cats',      serialize(Request::getArray('img_cats')));
        $imagesObj->setVar('img_tags',      Request::getString('img_tags'));
        $imageDate = date_create_from_format(_SHORTDATESTRING, $_POST['img_date']);
        $imagesObj->setVar('img_date', $imageDate->getTimestamp());
        $imagesObj->setVar('img_submitter', Request::getInt('img_submitter'));
        $imagesObj->setVar('img_ip', $_SERVER['REMOTE_ADDR']);
        // Insert Data
        if ($imagesHandler->insert($imagesObj)) {
            redirect_header('images.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit . '&amp;alb_id=' . $albId, 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        $form = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_ADD_IMAGE, 'images.php?op=new', 'add');
        $adminObject->addItemButton(_AM_WGGALLERY_IMAGES_LIST, 'images.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $imagesObj = $imagesHandler->get($imgId);
        $form      = $imagesObj->getFormImages(true);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'change_state':
        if (isset($imgId)) {
            $imagesObj = $imagesHandler->get($imgId);
            // Set Vars
            $imagesObj->setVar('img_state', Request::getInt('img_state'));
            // Insert Data
            if ($imagesHandler->insert($imagesObj)) {
                $crImages = new \CriteriaCompo();
                $crImages->add(new \Criteria('img_state', Constants::STATE_APPROVAL_VAL));
                $imagesCount = $imagesHandler->getCount($crImages);
                unset($crImages);
                if ($imagesCount > 0) {
                    redirect_header('images.php?op=approve&amp;start=' . $start . '&amp;limit=' . $limit . '&amp;alb_id=' . $albId, 2, _CO_WGGALLERY_FORM_OK);
                }
                redirect_header('images.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit . '&amp;alb_id=' . $albId, 2, _CO_WGGALLERY_FORM_OK);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        }
        break;
    case 'delete':
        $imagesObj = $imagesHandler->get($imgId);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('images.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $img_name = $imagesObj->getVar('img_name');
            if ($imagesHandler->delete($imagesObj)) {
                if ($imagesHandler->unlinkImages($img_name, $imagesObj->getVar('img_namelarge'))) {
                    redirect_header('images.php?alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
                } else {
                    $GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_IMAGE_ERRORUNLINK);
                }
                redirect_header('images.php?alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'img_id' => $imgId, 'op' => 'delete', 'alb_id' => $albId], $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $imagesObj->getVar('img_name')));
        }

        break;
}
require __DIR__ . '/footer.php';
