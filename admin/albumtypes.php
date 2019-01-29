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
 * @version        $Id: 1.0 albumtypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op   = Request::getString('op', 'list');
$atId = Request::getInt('at_id');

$atCount = $albumtypesHandler->getCount();
if (1 > $atCount) {
	redirect_header('maintenance.php?op=list', 3, _AM_WGGALLERY_THEREARENT_ALBUMTYPES);
}

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = Request::getInt('start', 0);
		$limit = Request::getInt('limit', $helper->getConfig('adminpager'));
		$templateMain = 'wggallery_admin_albumtypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albumtypes.php'));
		$albumtypesCount = $albumtypesHandler->getCountAlbumtypes();
		$albumtypesAll = $albumtypesHandler->getAllAlbumtypes($start, $limit);
		$GLOBALS['xoopsTpl']->assign('albumtypes_count', $albumtypesCount);
		$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
		$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
		// Table view albumtypes
		if($albumtypesCount > 0) {
			foreach(array_keys($albumtypesAll) as $i) {
				$albumtype = $albumtypesAll[$i]->getValuesAlbumtypes();
				$GLOBALS['xoopsTpl']->append('albumtypes_list', $albumtype);
				unset($albumtype);
			}
			// Display Navigation
			if($albumtypesCount > $limit) {
				include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
				$pagenav = new \XoopsPageNav($albumtypesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
				$GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
			}
		} else {
			$GLOBALS['xoopsTpl']->assign('error', _AM_WGGALLERY_THEREARENT_ALBUMTYPES);
		}

	break;
	case 'options':
		$templateMain = 'wggallery_admin_albumtypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albumtypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ALBUMTYPES_LIST, 'albumtypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$albumtypesObj = $albumtypesHandler->get($atId );
		$form = $albumtypesObj->getFormAlbumtypeOptions();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'new':
		$templateMain = 'wggallery_admin_albumtypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albumtypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ALBUMTYPES_LIST, 'albumtypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$albumtypesObj = $albumtypesHandler->create();
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'set_primary':
		if(isset($atId)) {
			$albumtypesObj = $albumtypesHandler->get($atId);
		} else {
			$redirect_header('albumtypes.php', 3, 'missing Id');
		}
		// reset all
		$strSQL = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albumtypes') . ' SET ' . $GLOBALS['xoopsDB']->prefix('wggallery_albumtypes') . '.at_primary = 0';
		$GLOBALS['xoopsDB']->queryF($strSQL);
		// Set Vars
		$albumtypesObj->setVar('at_primary', 1);
		// Insert Data
		if($albumtypesHandler->insert($albumtypesObj)) {
			redirect_header('albumtypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}

	break;
	case 'saveoptions':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('albumtypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($atId)) {
			$albumtypesObj = $albumtypesHandler->get($atId);
		} else {
			redirect_header('albumtypes.php', 3, 'invalid at_id at saveoptions');
		}
		$options = [];

		if (isset($_POST['number_cols_album'])) {$options[] = ['name' => 'number_cols_album', 'value' => $_POST['number_cols_album'], 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB'];}
		if (isset($_POST['number_cols_cat'])) {$options[] = ['name' => 'number_cols_cat', 'value' => $_POST['number_cols_cat'], 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT'];}
		if (isset($_POST['hovereffect'])) {$options[] = ['name' => 'hovereffect', 'value' => $_POST['hovereffect'], 'caption' => '_AM_WGGALLERY_OPTION_AT_HOVER'];}
        if (isset($_POST['showTitle'])) {$options[] = ['name' => 'showTitle', 'value' => $_POST['showTitle'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];}
        if (isset($_POST['showDesc'])) {$options[] = ['name' => 'showDesc', 'value' => $_POST['showDesc'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];}
		if (isset($_POST['album_showsubmitter'])) {$options[] = ['name' => 'album_showsubmitter', 'value' => $_POST['album_showsubmitter'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWSUBMITTER'];}
        
        // apply sort order
		$option_sort = Request::getString('option_sort', '');
		$sort_arr = explode('|', $option_sort);
		$options_final = []; // result array
		foreach($sort_arr as $val){ // loop
			foreach ($options as $option) {
				if ($val == $option['name']) {$options_final[] = ['name' => $option['name'], 'value' => $option['value'], 'caption' => $option['caption']];} // adding values
			}
		}
		$options_final[] = ['name' => 'option_sort', 'value' => $option_sort];
        
		// Set Vars
		$albumtypesObj->setVar('at_options', serialize($options_final));
		// Insert Data
		if($albumtypesHandler->insert($albumtypesObj)) {
			redirect_header('albumtypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $albumtypesObj->getHtmlErrors());
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'reset':
		$albumtypesObj = $albumtypesHandler->get($atId);
		$template = $albumtypesObj->getVar('at_template');
		$primary  = $albumtypesObj->getVar('at_primary');
		if($albumtypesHandler->reset($atId, $template, $primary)) {
            redirect_header('albumtypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        } else {
			redirect_header('albumtypes.php?op=list', 3, _CO_WGGALLERY_FORM_ERROR);
		} 
	break;
	
	case 'save':
		// Security Check
		if(!$GLOBALS['xoopsSecurity']->check()) {
			redirect_header('albumtypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		if(isset($atId)) {
			$albumtypesObj = $albumtypesHandler->get($atId);
		} else {
			$albumtypesObj = $albumtypesHandler->create();
		}
		// Set Vars
		$albumtypesObj->setVar('at_primary', $_POST['at_primary']);
		$albumtypesObj->setVar('at_name', $_POST['at_name']);
		$albumtypesObj->setVar('at_desc', $_POST['at_desc']);
		$albumtypesObj->setVar('at_credits', $_POST['at_credits']);
		$albumtypesObj->setVar('at_template', $_POST['at_template']);
		$albumtypesObj->setVar('at_options', $_POST['at_options']);
		$albumtypeDate = date_create_from_format(_SHORTDATESTRING, $_POST['at_date']);
		$albumtypesObj->setVar('at_date', $albumtypeDate->getTimestamp());
		// Insert Data
		if($albumtypesHandler->insert($albumtypesObj)) {
			redirect_header('albumtypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $albumtypesObj->getHtmlErrors());
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'edit':
		$templateMain = 'wggallery_admin_albumtypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albumtypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ALBUMTYPES_LIST, 'albumtypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$albumtypesObj = $albumtypesHandler->get($atId);
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'delete':
		$albumtypesObj = $albumtypesHandler->get($atId);
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('albumtypes.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
			if($albumtypesHandler->delete($albumtypesObj)) {
				redirect_header('albumtypes.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
			} else {
				$GLOBALS['xoopsTpl']->assign('error', $albumtypesObj->getHtmlErrors());
			}
		} else {
			xoops_confirm(['ok' => 1, 'at_id' => $atId, 'op' => 'delete'], $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $albumtypesObj->getVar('at_name')));
		}

	break;
}
include __DIR__ . '/footer.php';
