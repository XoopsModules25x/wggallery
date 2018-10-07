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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_images_default.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op       = Request::getString('op', 'list');
$imgId    = Request::getInt('img_id');
$albId    = Request::getInt('alb_id');
$albPid   = Request::getInt('alb_pid');
$imgSubm  = Request::getInt('img_submitter');
$start    = Request::getInt('start', 0);
$limit    = Request::getInt('limit', $wggallery->getConfig('userpager'));

if (_CANCEL === Request::getString('cancel', 'none')) {
	$op = 'list';
}

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/css/style' . $wggallery->getConfig('style_index_image', true) . '.css' , null );
// 
// $GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
// 

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _CO_WGGALLERY_ALBUMS, 'link' => WGGALLERY_URL . '/');
if ( 0 < $albPid ) {
	$albumsObj = $albumsHandler->get($albPid);
	$xoBreadcrumbs[] = array('title' => $albumsObj->getVar('alb_name'), 'link' => WGGALLERY_URL . '/index.php?op=list&amp;alb_pid=' . $albPid);
}
$albumsObj = $albumsHandler->get($albId);
$xoBreadcrumbs[] = array('title' => $albumsObj->getVar('alb_name'));

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_IMAGES);

switch($op) {
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($imgId)) {
			$imagesObj = $imagesHandler->get($imgId);
		} else {
			$imagesObj = $imagesHandler->create();
		}
		// Set Vars
		$imagesObj->setVar('img_title', $_POST['img_title']);
		$imagesObj->setVar('img_desc', $_POST['img_desc']);
		$imagesObj->setVar('img_name', $_POST['img_name']);
		$imagesObj->setVar('img_nameorig', $_POST['img_nameorig']);
		$imagesObj->setVar('img_mimetype', isset($_POST['img_mimetype']) ? $_POST['img_mimetype'] : 0);
		$imagesObj->setVar('img_size', isset($_POST['img_size']) ? $_POST['img_size'] : 0);
		$imagesObj->setVar('img_resx', isset($_POST['img_resx']) ? $_POST['img_resx'] : 0);
		$imagesObj->setVar('img_resy', isset($_POST['img_resy']) ? $_POST['img_resy'] : 0);
		$imagesObj->setVar('img_downloads', isset($_POST['img_downloads']) ? $_POST['img_downloads'] : 0);
		$imagesObj->setVar('img_ratinglikes', isset($_POST['img_ratinglikes']) ? $_POST['img_ratinglikes'] : 0);
		$imagesObj->setVar('img_votes', isset($_POST['img_votes']) ? $_POST['img_votes'] : 0);
		$imagesObj->setVar('img_weight', isset($_POST['img_weight']) ? $_POST['img_weight'] : 0);
		$imagesObj->setVar('img_albid', isset($_POST['img_albid']) ? $_POST['img_albid'] : 0);
		$imagesObj->setVar('img_state', isset($_POST['img_state']) ? $_POST['img_state'] : 0);
		$imageDate = date_create_from_format(_SHORTDATESTRING, $_POST['img_date']);
		$imagesObj->setVar('img_date', $imageDate->getTimestamp());
		$imagesObj->setVar('img_submitter', isset($_POST['img_submitter']) ? $_POST['img_submitter'] : 0);
		$imagesObj->setVar('img_ip', $_SERVER['REMOTE_ADDR']);
		// Insert Data
		if($imagesHandler->insert($imagesObj)) {
			redirect_header('images.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		// Get Form
		$imagesObj = $imagesHandler->get($imgId);
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$imagesObj = $imagesHandler->get($imgId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('images.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			$img_name = $imagesObj->getVar('img_name');
			if($imagesHandler->delete($imagesObj)) {
				if($imagesHandler->unlinkImages($img_name, $imagesObj->getVar('img_namelarge'))) {
					redirect_header('images.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
				} else {
					$GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_IMAGE_ERRORUNLINK);
				}
				redirect_header('images.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
			}
		} else {
			// xoops_confirm(array('ok' => 1, 'img_id' => $imgId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $imagesObj->getVar('img_name')));
			$form = $wggallery->getFormDelete(array('ok' => 1, 'img_id' => $imgId, 'op' => 'delete'), _CO_WGGALLERY_FORM_DELETE, $imagesObj->getVar('img_name'));
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
		}
	break;

    case 'list':
    default:

        $albums = $wggallery->getHandler('albums');
        $albumsObj = $albums->get($albId);
        if (isset($albumsObj) && is_object($albumsObj)) {
            $albName = $albumsObj->getVar('alb_name');
            $albAllowdownload = $albumsObj->getVar('alb_allowdownload');
            $albSubmitter = $albumsObj->getVar('alb_submitter');
        }
        $GLOBALS['xoopsTpl']->assign('alb_name', $albName);
        if ($permissionsHandler->permAlbumDownload($albId)) {
            $GLOBALS['xoopsTpl']->assign('alb_allowdownload', $albAllowdownload);
        }
        $GLOBALS['xoopsTpl']->assign('alb_pid', $albPid);

        $crImages = new CriteriaCompo();
        $crImages->add(new Criteria('img_albid', $albId));
        if (!$permissionsHandler->permAlbumEdit($albSubmitter)) {
            $crImages->add(new Criteria('img_state', 1));
        }
        $crImages->setSort('img_weight');
        $crImages->setOrder('ASC');
        $imagesCount = $imagesHandler->getCount($crImages);
        $crImages->setStart( $start );
        $crImages->setLimit( $limit );
        $imagesAll = $imagesHandler->getAll($crImages);
        $keywords = array();
        if($imagesCount > 0) {
            $images = array();
            // Get All Images
            foreach(array_keys($imagesAll) as $i) {
                $images[$i] = $imagesAll[$i]->getValuesImages();
                //check permissions
                $images[$i]['edit'] = $permissionsHandler->permAlbumEdit($images[$i]['img_submitter']);
                $keywords[] = $imagesAll[$i]->getVar('img_name');
            }
            $GLOBALS['xoopsTpl']->assign('images', $images);
            unset($images);
            // Display Navigation
            if($imagesCount > $limit) {
                include_once XOOPS_ROOT_PATH .'/class/pagenav.php';



                $pagenav = new XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&limit=' . $limit . '&alb_id=' . $albId . '&alb_pid=' . $albPid . '&img_submitter=' . $imgSubm );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('type', $wggallery->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $wggallery->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $wggallery->getConfig('numb_col'));
        }
        break;
}

// Keywords
wggalleryMetaKeywords($wggallery->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_MA_WGGALLERY_IMAGES_DESC);
// $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/images.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
