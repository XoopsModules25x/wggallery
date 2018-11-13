<?php /** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpIncludeInspection */
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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request alb_id
$albId = Request::getInt('alb_id');

// add scripts 
$GLOBALS['xoTheme']->addScript( XOOPS_URL . '/modules/wggallery/assets/js/admin.js' );

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = Request::getInt('start', 0);
		$limit = Request::getInt('limit', $wggallery->getConfig('adminpager'));
		$templateMain = 'wggallery_admin_albums.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albums.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUM, 'albums.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$albumsCount = $albumsHandler->getCountAlbums();
		$albumsAll = $albumsHandler->getAllAlbums($start, $limit);
		$GLOBALS['xoopsTpl']->assign('albums_count', $albumsCount);
		$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
		// Table view albums
		if($albumsCount > 0) {
			foreach(array_keys($albumsAll) as $i) {
				$album = $albumsAll[$i]->getValuesAlbums();
                $crImages = new CriteriaCompo();
                $crImages->add(new Criteria('img_albid',$album['alb_id']));
                $crImages->setSort('img_weight');
                $crImages->setOrder('ASC');
                $album['nb_images'] = $imagesHandler->getCount($crImages);
				$GLOBALS['xoopsTpl']->append('albums_list', $album);
				unset($album);
			}
			// Display Navigation
			if($albumsCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($albumsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
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
		$form = $albumsObj->getFormAlbums(false, true);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('albums.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($albId)) {
			$albumsObj = $albumsHandler->get($albId);
		} else {
			$albumsObj = $albumsHandler->create();
		}
		// Set Vars
		$albumsObj->setVar('alb_pid', Request::getInt('alb_pid'));
		$albumsObj->setVar('alb_iscat', Request::getInt('alb_iscat'));
		$albumsObj->setVar('alb_name', Request::getString('alb_name'));
		$albumsObj->setVar('alb_desc', Request::getString('alb_desc'));
		$albumsObj->setVar('alb_weight', Request::getInt('alb_weight'));
		// Set Var alb_image
        $albumsObj->setVar('alb_imgcat', Request::getInt('alb_imgcat'));
		include_once XOOPS_ROOT_PATH .'/class/uploader.php';
		$uploader = new XoopsMediaUploader(WGGALLERY_UPLOAD_IMAGE_PATH.'/albums/', 
													$wggallery->getConfig('mimetypes'), 
													$wggallery->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $_FILES['attachedfile']['name']);
			$imgName = str_replace(' ', '', $_POST['alb_name']).'.'.$extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if(!$uploader->upload()) {
				$errors = $uploader->getErrors();
				redirect_header('javascript:history.go(-1).php', 3, $errors);
			} else {
				$albumsObj->setVar('alb_image', $uploader->getSavedFileName());
			}
		} else {
			$albumsObj->setVar('alb_image', Request::getString('alb_image'));
		}
        $imgName = Request::getString('alb_imgid', 'none');
        $albImgid = 0;
        if ('none' !== $imgName) {
            $crImages = new CriteriaCompo();
            $crImages->add(new Criteria('img_name', $imgName));
            $imagesAll = $imagesHandler->getAll($crImages);
			// Get All Images
			foreach(array_keys($imagesAll) as $i) {
				$albImgid = $imagesAll[$i]->getVar('img_id');
			}
        }
		$albumsObj->setVar('alb_imgid', $albImgid);
		$albumsObj->setVar('alb_state', Request::getInt('alb_state'));
		$albumsObj->setVar('alb_allowdownload', Request::getInt('alb_allowdownload'));
		$albumDate = date_create_from_format(_SHORTDATESTRING, $_POST['alb_date']);
		$albumsObj->setVar('alb_date', $albumDate->getTimestamp());
		$albumsObj->setVar('alb_submitter', Request::getInt('alb_submitter'));
		// Insert Data
		if($albumsHandler->insert($albumsObj)) {
			$newAlbId = $albumsObj->getNewInsertedIdAlbums();
			$permId = isset($_REQUEST['alb_id']) ? $albId : $newAlbId;
			$perm_modid = $GLOBALS['xoopsModule']->getVar('mid');
			$gpermHandler = xoops_getHandler('groupperm');
			// remove all existing rights
			$gpermHandler->deleteByModule($perm_modid, 'wggallery_view', $permId);
			// $gpermHandler->deleteByModule($perm_modid, 'wggallery_submit', $permId);
			// $gpermHandler->deleteByModule($perm_modid, 'wggallery_approve', $permId);
			$gpermHandler->deleteByModule($perm_modid, 'wggallery_dlfullalb', $permId);
			$gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage', $permId);
			// set selected rights new
			// Permission to view
			if(isset($_POST['groups_view'])) {
				foreach($_POST['groups_view'] as $onegroupId) {
					$gpermHandler->addRight('wggallery_view', $permId, $onegroupId, $perm_modid);
				}
			}
/* 			// Permission to submit
			if(isset($_POST['groups_submit'])) {
				foreach($_POST['groups_submit'] as $onegroupId) {
					$gpermHandler->addRight('wggallery_submit', $permId, $onegroupId, $perm_modid);
				}
			}
			// Permission to approve
			if(isset($_POST['groups_approve'])) {
				foreach($_POST['groups_approve'] as $onegroupId) {
					$gpermHandler->addRight('wggallery_approve', $permId, $onegroupId, $perm_modid);
				}
			} */
			// Permission to download large images
			if(isset($_POST['groups_dlfullalb'])) {
				foreach($_POST['groups_dlfullalb'] as $onegroupId) {
					$gpermHandler->addRight('wggallery_dlfullalb', $permId, $onegroupId, $perm_modid);
				}
			}
			// Permission to download medium images
			if(isset($_POST['groups_dlimage'])) {
				foreach($_POST['groups_dlimage'] as $onegroupId) {
					$gpermHandler->addRight('wggallery_dlimage', $permId, $onegroupId, $perm_modid);
				}
			}
			$albumsHandler->setAlbumIsCat();
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
		$form = $albumsObj->getFormAlbums(false, true);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$albumsObj = $albumsHandler->get($albId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('albums.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($albumsHandler->delete($albumsObj)) {
				redirect_header('albums.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'alb_id' => $albId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $albumsObj->getVar('alb_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
