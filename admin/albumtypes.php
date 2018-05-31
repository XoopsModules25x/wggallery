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
 * @version        $Id: 1.0 albumtypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op   = XoopsRequest::getString('op', 'list');
$atId = XoopsRequest::getInt('at_id');

switch($op) {
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$start = XoopsRequest::getInt('start', 0);
		$limit = XoopsRequest::getInt('limit', $wggallery->getConfig('adminpager'));
		$templateMain = 'wggallery_admin_albumtypes.tpl';
		$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('albumtypes.php'));
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUMTYPE, 'albumtypes.php?op=new', 'add');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
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
				$pagenav = new XoopsPageNav($albumtypesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
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
		$options = array();
        
   // $options[] = array('name' => 'hovereffect', 'value' => 'lily');

        
		if (isset($_POST['number_cols_album'])) {$options[] = array('name' => 'number_cols_album', 'value' => $_POST['number_cols_album']);}
        if (isset($_POST['number_cols_cat'])) {$options[] = array('name' => 'number_cols_cat', 'value' => $_POST['number_cols_cat']);}
        if (isset($_POST['hovereffect'])) {$options[] = array('name' => 'hovereffect', 'value' => $_POST['hovereffect']);}
		


        
		// Set Vars
		$albumtypesObj->setVar('at_options', serialize($options));
		// Insert Data
		if($albumtypesHandler->insert($albumtypesObj)) {
			redirect_header('albumtypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
		}
		// Get Form
		$GLOBALS['xoopsTpl']->assign('error', $albumtypesObj->getHtmlErrors());
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

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
		$adminObject->addItemButton(_AM_WGGALLERY_ADD_ALBUMTYPE, 'albumtypes.php?op=new', 'add');
		$adminObject->addItemButton(_AM_WGGALLERY_ALBUMTYPES_LIST, 'albumtypes.php', 'list');
		$GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
		// Get Form
		$albumtypesObj = $albumtypesHandler->get($atId);
		$form = $albumtypesObj->getFormAlbumtypes();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
}
include __DIR__ . '/footer.php';
