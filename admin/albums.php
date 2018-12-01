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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request alb_id
$albId = Request::getInt('alb_id');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $wggallery->getConfig('adminpager'));

// add scripts 
$GLOBALS['xoTheme']->addScript( XOOPS_URL . '/modules/wggallery/assets/js/admin.js' );
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16/');

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$templateMain = 'wggallery_admin_albums.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albums.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUM, 'albums.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$albumsCount = $albumsHandler->getCountAlbums();
		$albumsAll = $albumsHandler->getAllAlbums($start, $limit);
		$GLOBALS['xoopsTpl']->assign('albums_count', $albumsCount);
		$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('start', $start);
        $GLOBALS['xoopsTpl']->assign('limit', $limit);
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
        $fileName = $_FILES['attachedfile']['name'];
        $uploaderErrors = '';
		$uploader = new XoopsMediaUploader(WGGALLERY_UPLOAD_IMAGE_PATH.'/albums/', 
													$wggallery->getConfig('mimetypes'), 
													$wggallery->getConfig('maxsize'), null, null);
		if($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
			$extension = preg_replace('/^.+\.([^.]+)$/sU', '', $fileName);
			$imgName = str_replace(' ', '', $_POST['alb_name']).'.'.$extension;
			$uploader->setPrefix($imgName);
			$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
			if(!$uploader->upload()) {
				$uploaderErrors = $uploader->getErrors();
			} else {
				$albumsObj->setVar('alb_image', $uploader->getSavedFileName());
                $albumsObj->setVar('alb_imgcat', WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED);
			}
		} else {
			if ( '' < $fileName ) { 
                $uploaderErrors = $uploader->getErrors();
            }
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
        $albumsObj->setVar('alb_wmid', Request::getInt('alb_wmid')); 
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
			//TODO
            // $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlfullalb', $permId);
			$gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_large', $permId);
            $gpermHandler->deleteByModule($perm_modid, 'wggallery_dlimage_medium', $permId);
			// set selected rights new
			// Permission to view
			if(isset($_POST['groups_view'])) {
				foreach($_POST['groups_view'] as $onegroupId) {
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
            if(isset($_POST['groups_dlimage_large'])) {
                foreach($_POST['groups_dlimage_large'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_large', $permId, $onegroupId, $perm_modid);
                }
            }
            // Permission to download medium images
            if(isset($_POST['groups_dlimage_medium'])) {
                foreach($_POST['groups_dlimage_medium'] as $onegroupId) {
                    $gpermHandler->addRight('wggallery_dlimage_medium', $permId, $onegroupId, $perm_modid);
                }
            }
			$albumsHandler->setAlbumIsCat();
            if ( '' !== $uploaderErrors ) {
                $redirAlbId = isset($_REQUEST['alb_id']) ? $albId : $newAlbId;
                redirect_header('albums.php?op=edit&alb_id=' . $redirAlbId, 4, $uploaderErrors);
            } else {
                redirect_header('albums.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
            }
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
    case 'change_state':
		if(isset($albId)) {
			$albumsObj = $albumsHandler->get($albId);
		    // Set Vars
            $albumsObj->setVar('alb_state', Request::getInt('alb_state'));
            // Insert Data
            if($albumsHandler->insert($albumsObj)) {
                redirect_header('albums.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, _CO_WGGALLERY_FORM_OK);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $albumsObj->getHtmlErrors());
        }
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
