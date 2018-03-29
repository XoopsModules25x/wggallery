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
 * @version        $Id: 1.0 rate.php 1 Mon 2018-03-19 10:04:54Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$op = XoopsRequest::getString('op', 'form');
$lid = XoopsRequest::getInt('lid');
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_images.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
switch($op) {
	case 'form':
	default:
		// Navigation
		$navigation = _MA_WGGALLERY_RATE;
		$GLOBALS['xoopsTpl']->assign('navigation', $navigation);
		// Title of page
		$title = _MA_WGGALLERY_RATE . '&nbsp;-&nbsp;';
		$title .= $GLOBALS['xoopsModule']->name();
		$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $title);
		// Description
		$GLOBALS['xoTheme']->addMeta( 'meta', 'description', strip_tags(_MA_WGGALLERY_RATE));
		// Form Create
		$imagesObj = $imagesHandler->create();
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->render());

	break;
	case 'save':
		// Security Check
		if($GLOBALS['xoopsSecurity']->check()) {
			redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
		}
		$imagesObj = $imagesHandler->create();
		$imagesObj->setVar('img_title', $_POST['img_title']);
		$imagesObj->setVar('img_desc', $_POST['img_desc']);
		$imagesObj->setVar('img_name', $_POST['img_name']);
		$imagesObj->setVar('img_origname', $_POST['img_origname']);
		$imagesObj->setVar('img_mimetype', $_POST['img_mimetype']);
		$imagesObj->setVar('img_size', $_POST['img_size']);
		$imagesObj->setVar('img_resx', $_POST['img_resx']);
		$imagesObj->setVar('img_resy', $_POST['img_resy']);
		$imagesObj->setVar('img_downloads', $_POST['img_downloads']);
		$imagesObj->setVar('img_ratinglikes', $_POST['img_ratinglikes']);
		$imagesObj->setVar('img_votes', $_POST['img_votes']);
		$imagesObj->setVar('img_weight', $_POST['img_weight']);
		$imagesObj->setVar('img_albid', $_POST['img_albid']);
		$imagesObj->setVar('img_state', $_POST['img_state']);
		$imageDate = date_create_from_format(_SHORTDATESTRING, $_POST['img_date']);
$imagesObj->setVar('img_date', $imageDate->getTimestamp());
		$imagesObj->setVar('img_submitter', $_POST['img_submitter']);
		$imagesObj->setVar('img_ip', $_POST['img_ip']);
		// Insert Data
		if($images1->insert($imagesObj)) {
			redirect_header('index.php', 2, _MA_WGGALLERY_FORM_OK);
		}
		// Get Form Error
		$GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
		$form = $imagesObj->getFormImages();
		$GLOBALS['xoopsTpl']->assign('form', $form->display());

	break;
}
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => RATE_MA_WGGALLERY_);
include __DIR__ . '/footer.php';
