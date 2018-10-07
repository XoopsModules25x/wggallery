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
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request img_id
$imgId = Request::getInt('img_id');
$albId = Request::getInt('alb_id');

$templateMain = 'wggallery_admin_images.tpl';
	
switch($op) {
	case 'list':
	default:
		// Form
		if(isset($albId)) {
			$albumsObj = $albumsHandler->get($albId);
		} else {
			$albumsObj = $albumsHandler->create();
		}
		$form = $albumsObj->getFormUploadToAlbum('images.php');
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		
		if (0 < $albId) {
			// Define Stylesheet
			$GLOBALS['xoTheme']->addStylesheet( $style, null );
			$start = Request::getInt('start', 0);
			$limit = Request::getInt('limit', $wggallery->getConfig('adminpager'));
			$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
			$adminObject->addItemButton(_AM_WGGALLERY_ADD_IMAGE, 'images.php?op=new', 'add');
			$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
			$crImages = new CriteriaCompo();
			$crImages->add(new Criteria('img_albid', $albId));
			$crImages->setSort('img_weight');
			$crImages->setOrder('ASC');
			$imagesCount = $imagesHandler->getCount($crImages);
			$crImages->setStart( $start );
			$crImages->setLimit( $limit );
			$imagesAll = $imagesHandler->getAll($crImages);
			$GLOBALS['xoopsTpl']->assign('images_count', $imagesCount);
			$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
			$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
			// Table view images
			if($imagesCount > 0) {
				foreach(array_keys($imagesAll) as $i) {
					$image = $imagesAll[$i]->getValuesImages();
					$GLOBALS['xoopsTpl']->append('images_list', $image);
					unset($image);
				}
				// Display Navigation
				if($imagesCount > $limit) {
					include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
					$pagenav = new XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit . '&amp;alb_id=' . $albId);
					$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
				}
			} else {
				$GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_THEREARENT_IMAGES);
			}
		}
	break;
	case 'new':
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_IMAGES_LIST, 'images.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$imagesObj = $imagesHandler->create();
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
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
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('images.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_IMAGE, 'images.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGGALLERY_IMAGES_LIST, 'images.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
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
					redirect_header('images.php?alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
				} else {
					$GLOBALS['xoopsTpl']->assign('error', _CO_WGGALLERY_IMAGE_ERRORUNLINK);
				}
				redirect_header('images.php?alb_id=' . $albId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'img_id' => $imgId, 'op' => 'delete', 'alb_id' => $albId,), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $imagesObj->getVar('img_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
