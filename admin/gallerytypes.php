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
 * @version        $Id: 1.0 gallerytypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op   = XoopsRequest::getString('op', 'list');
$gtId = XoopsRequest::getInt('gt_id');

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wggallery->getConfig('adminpager'));
		$templateMain = 'wggallery_admin_gallerytypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_GALLERYTYPE, 'gallerytypes.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		$gallerytypesCount = $gallerytypesHandler->getCountGallerytypes();
		$gallerytypesAll = $gallerytypesHandler->getAllGallerytypes($start, $limit);
		$GLOBALS['xoopsTpl']->assign('gallerytypes_count', $gallerytypesCount);
		$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
		// Table view gallerytypes
		if($gallerytypesCount > 0) {
			foreach(array_keys($gallerytypesAll) as $i) {
				$gallerytype = $gallerytypesAll[$i]->getValuesGallerytypes();
				$GLOBALS['xoopsTpl']->append('gallerytypes_list', $gallerytype);
				unset($gallerytype);
			}
			// Display Navigation
			if($gallerytypesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new XoopsPageNav($gallerytypesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_WGGALLERY_THEREARENT_GALLERYTYPES);
		}

	break;
	case 'options':
		$templateMain = 'wggallery_admin_gallerytypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$gallerytypesObj = $gallerytypesHandler->get($gtId );
		$form = $gallerytypesObj->getFormGallerytypeOptions();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'new':
		$templateMain = 'wggallery_admin_gallerytypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$gallerytypesObj = $gallerytypesHandler->create();
		$form = $gallerytypesObj->getFormGallerytypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'set_primary':
		if(isset($gtId)) {
			$gallerytypesObj = $gallerytypesHandler->get($gtId);
		} else {
			$redirect_header('gallerytypes.php', 3, 'missing Id');
		}
		// reset all
		$strSQL = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_gallerytypes') . ' SET ' . $GLOBALS['xoopsDB']->prefix('wggallery_gallerytypes') . '.gt_primary = 0';
		$GLOBALS['xoopsDB']->queryF($strSQL);
		// Set Vars
		$gallerytypesObj->setVar('gt_primary', 1);
		// Insert Data
		if($gallerytypesHandler->insert($gallerytypesObj)) {
			redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}

	break;
	case 'saveoptions':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('gallerytypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($gtId)) {
			$gallerytypesObj = $gallerytypesHandler->get($gtId);
		} else {
			redirect_header('gallerytypes.php', 3, 'invalid gt_id at saveoptions');
		}
		$options = array();
        //general
		if (isset($_POST['css'])) {$options[] = array('name' => 'css', 'value' => $_POST['css']);}
		if (isset($_POST['source'])) {$options[] = array('name' => 'source', 'value' => $_POST['source'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');}
        if (isset($_POST['source_preview'])) {$options[] = array('name' => 'source_preview', 'value' => $_POST['source_preview'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');}
		//jssor
		if (isset($_POST['jssor_arrows'])) {$options[] = array('name' => 'jssor_arrows', 'value' => $_POST['jssor_arrows'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ARROWS');}
		if (isset($_POST['jssor_bullets'])) {$options[] = array('name' => 'jssor_bullets', 'value' => $_POST['jssor_bullets'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BULLETS');}
		if (isset($_POST['jssor_thumbnails'])) {$options[] = array('name' => 'jssor_thumbnails', 'value' => $_POST['jssor_thumbnails'], 'caption' => '_AM_WGGALLERY_OPTION_GT_THUMBNAILS');}
		if (isset($_POST['jssor_loadings'])) {$options[] = array('name' => 'jssor_loadings', 'value' => $_POST['jssor_loadings'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LOADINGS');}
        if (isset($_POST['jssor_autoplay'])) {$options[] = array('name' => 'jssor_autoplay', 'value' => $_POST['jssor_autoplay'], 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS');}
        
        
        //
        if (isset($_POST['showThumbs'])) {$options[] = array('name' => 'showThumbs', 'value' => $_POST['showThumbs'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS');}
        if (isset($_POST['showTitle'])) {$options[] = array('name' => 'showTitle', 'value' => $_POST['showTitle'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');}
        if (isset($_POST['showDescr'])) {$options[] = array('name' => 'showDescr', 'value' => $_POST['showDescr'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR');}
        if (isset($_POST['slideshowSpeed'])) {$options[] = array('name' => 'slideshowSpeed', 'value' => $_POST['slideshowSpeed'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');}
        if (isset($_POST['slideshowAuto'])) {$options[] = array('name' => 'slideshowAuto', 'value' => $_POST['slideshowAuto'], 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY');}
        if (isset($_POST['rowHeight'])) {$options[] = array('name' => 'rowHeight', 'value' => $_POST['rowHeight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ROWHEIGHT');}
        if (isset($_POST['lastRow'])) {$options[] = array('name' => 'lastRow', 'value' => $_POST['lastRow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LASTROW_DESC');}
		if (isset($_POST['margins'])) {$options[] = array('name' => 'margins', 'value' => $_POST['margins'], 'caption' => '_AM_WGGALLERY_OPTION_GT_MARGINS');}
		if (isset($_POST['border'])) {$options[] = array('name' => 'border', 'value' => $_POST['border'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDER');}
		if (isset($_POST['randomize'])) {$options[] = array('name' => 'randomize', 'value' => $_POST['randomize'], 'caption' => '_AM_WGGALLERY_OPTION_GT_RANDOMIZE');}
        if (isset($_POST['slideshow'])) {$options[] = array('name' => 'slideshow', 'value' => $_POST['slideshow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOW');}
		// if (isset($_POST['slideshow_options'])) {$options[] = array('name' => 'slideshow_options', 'value' => $_POST['slideshow_options']);}
		if (isset($_POST['colorboxstyle'])) {$options[] = array('name' => 'colorboxstyle', 'value' => $_POST['colorboxstyle'], 'caption' => '_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE');}
		if (isset($_POST['transition'])) {$options[] = array('name' => 'transition', 'value' => $_POST['transition'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT');}
		if (isset($_POST['speed'])) {$options[] = array('name' => 'speed', 'value' => $_POST['speed'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN');}
		if (isset($_POST['open'])) {$options[] = array('name' => 'open', 'value' => $_POST['open'], 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOOPEN');}
        if (isset($_POST['opacity'])) {$options[] = array('name' => 'opacity', 'value' => $_POST['opacity'], 'caption' => '_AM_WGGALLERY_OPTION_OPACITIY');}
        if (isset($_POST['slideshowtype'])) {$options[] = array('name' => 'slideshowtype', 'value' => $_POST['slideshowtype'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE');}
        if (isset($_POST['button_close'])) {$options[] = array('name' => 'button_close', 'value' => $_POST['button_close'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE');}
        if (isset($_POST['navbar'])) {$options[] = array('name' => 'navbar', 'value' => $_POST['navbar'], 'caption' => '_AM_WGGALLERY_OPTION_GT_NAVBAR');}
        if (isset($_POST['toolbar'])) {$options[] = array('name' => 'toolbar', 'value' => $_POST['toolbar'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBAR');}
        if (isset($_POST['zoomable'])) {$options[] = array('name' => 'zoomable', 'value' => $_POST['zoomable'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM');}
        if (isset($_POST['download'])) {$options[] = array('name' => 'download', 'value' => $_POST['download'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD');}
        if (isset($_POST['fullscreen'])) {$options[] = array('name' => 'fullscreen', 'value' => $_POST['fullscreen'], 'caption' => '_AM_WGGALLERY_OPTION_GT_FULLSCREEN');}
        if (isset($_POST['transitionDuration'])) {$options[] = array('name' => 'transitionDuration', 'value' => $_POST['transitionDuration'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION');}
        if (isset($_POST['viewerjs_title'])) {$options[] = array('name' => 'viewerjs_title', 'value' => $_POST['viewerjs_title'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');}
        if (isset($_POST['loop'])) {$options[] = array('name' => 'loop', 'value' => $_POST['loop'], 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS');}
        if (isset($_POST['showThumbnails'])) {$options[] = array('name' => 'showThumbnails', 'value' => $_POST['showThumbnails'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS');}

		if (isset($_POST['showAlbumlabel'])) {$options[] = array('name' => 'showAlbumlabel', 'value' => $_POST['showAlbumlabel'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWLABEL');}
		if (isset($_POST['indexImage'])) {$options[] = array('name' => 'indexImage', 'value' => $_POST['indexImage'], 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMG');}
		if (isset($_POST['indexImageheight'])) {$options[] = array('name' => 'indexImageheight', 'value' => $_POST['indexImageheight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT');}

        
		// if (isset($_POST['transitionEffect'])) {$options[] = array('name' => 'transitionEffect', 'value' => $_POST['transitionEffect']);}
		// 
		// if (isset($_POST['adaptiveDuration'])) {$options[] = array('name' => 'adaptiveDuration', 'value' => $_POST['adaptiveDuration']);}
		// 
		// if (isset($_POST['intervalDuration'])) {$options[] = array('name' => 'intervalDuration', 'value' => $_POST['intervalDuration']);}
		// if (isset($_POST['displayControls'])) {$options[] = array('name' => 'displayControls', 'value' => $_POST['displayControls']);}
		// if (isset($_POST['displayList'])) {$options[] = array('name' => 'displayList', 'value' => $_POST['displayList']);}
		// if (isset($_POST['listPosition'])) {$options[] = array('name' => 'listPosition', 'value' => $_POST['listPosition']);}
		// if (isset($_POST['verticalCentering'])) {$options[] = array('name' => 'verticalCentering', 'value' => $_POST['verticalCentering']);}
		// if (isset($_POST['adaptiveHeight'])) {$options[] = array('name' => 'adaptiveHeight', 'value' => $_POST['adaptiveHeight']);}


		// colorbox
		// 


		// if (isset($_POST['maxWidth'])) {$options[] = array('name' => 'maxWidth', 'value' => $_POST['maxWidth']);}
		// if (isset($_POST['maxHeight'])) {$options[] = array('name' => 'maxHeight', 'value' => $_POST['maxHeight']);}
		// if (isset($_POST['width'])) {$options[] = array('name' => 'width', 'value' => $_POST['width']);}
		// if (isset($_POST['height'])) {$options[] = array('name' => 'height', 'value' => $_POST['height']);}
		// if (isset($_POST['innerWidth'])) {$options[] = array('name' => 'innerWidth', 'value' => $_POST['innerWidth']);}
		// if (isset($_POST['innerHeight'])) {$options[] = array('name' => 'innerHeight', 'value' => $_POST['innerHeight']);}
		// 
		
		// var_dump($options);die;
        
		// Set Vars
		$gallerytypesObj->setVar('gt_options', serialize($options));
		// Insert Data
		if($gallerytypesHandler->insert($gallerytypesObj)) {
			redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
		$form = $gallerytypesObj->getFormGallerytypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
    
    case 'reset':
		$gallerytypesObj = $gallerytypesHandler->get($gtId);
		$template = $gallerytypesObj->getVar('gt_template');
		$primary  = $gallerytypesObj->getVar('gt_primary');
		if($gallerytypesHandler->reset($gtId, $template, $primary)) {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        } else {
			redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_ERROR);
		}   
    break;
	
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('gallerytypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($gtId)) {
			$gallerytypesObj = $gallerytypesHandler->get($gtId);
		} else {
			$gallerytypesObj = $gallerytypesHandler->create();
		}
		// Set Vars
		$gallerytypesObj->setVar('gt_primary', $_POST['gt_primary']);
		$gallerytypesObj->setVar('gt_name', $_POST['gt_name']);
		$gallerytypesObj->setVar('gt_desc', $_POST['gt_desc']);
		$gallerytypesObj->setVar('gt_credits', $_POST['gt_credits']);
		$gallerytypesObj->setVar('gt_template', $_POST['gt_template']);
		$gallerytypesObj->setVar('gt_options', $_POST['gt_options']);
		$gallerytypeDate = date_create_from_format(_SHORTDATESTRING, $_POST['gt_date']);
		$gallerytypesObj->setVar('gt_date', $gallerytypeDate->getTimestamp());
		// Insert Data
		if($gallerytypesHandler->insert($gallerytypesObj)) {
			redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
		$form = $gallerytypesObj->getFormGallerytypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wggallery_admin_gallerytypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_GALLERYTYPE, 'gallerytypes.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$gallerytypesObj = $gallerytypesHandler->get($gtId);
		$form = $gallerytypesObj->getFormGallerytypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$gallerytypesObj = $gallerytypesHandler->get($gtId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('gallerytypes.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($gallerytypesHandler->delete($gallerytypesObj)) {
				redirect_header('gallerytypes.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(array('ok' => 1, 'gt_id' => $gtId, 'op' => 'delete'), $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $gallerytypesObj->getVar('gt_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
