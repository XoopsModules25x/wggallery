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
 * @version        $Id: 1.0 upload.php 1 Sat 2018-03-17 09:55:45Z XOOPS Project (www.xoops.org) $
 */
 
use \XMF\Request;

include_once __DIR__ . '/header.php';
// xoops_loadLanguage('admin', 'wggallery');
// It recovered the value of argument op in URL$
$op     = Request::getString('op', 'form');
$albId  = Request::getInt('alb_id', 0);

// Template
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_upload.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');


// Form Create
if(isset($albId)) {
    $albumsObj = $albumsHandler->get($albId);
} else {
    $albumsObj = $albumsHandler->create();
}

if ($permissionsHandler->permGlobalSubmit()) {
	$form = $albumsObj->getFormUploadToAlbum();
	$GLOBALS['xoopsTpl']->assign('form', $form->render());
	
	if (0 < $albId) {
		$GLOBALS['xoopsTpl']->assign('albId', $albId);
		
		$albumObj = $albumsHandler->get($albId);
		// get config for file type/extenstion
		$fileextions = $wggallery->getConfig('mimetypes');
		$mimetypes = array();
		foreach ($fileextions as $fe) {
			switch ($fe) {
				case 'jpg':
				case 'jpeg':
				case 'jpe':
					$mimetypes['image/jpeg'] = 'image/jpeg';
				break;
				case 'gif':
					$mimetypes['image/gif'] = 'image/gif';
				break;
				case 'png':
					$mimetypes['image/png'] = 'image/png';
				break;
				case 'bmp':
					$mimetypes['image/bmp'] = 'image/bmp';
				break;
				case 'tiff':
				case 'tif':
					$mimetypes['image/tiff'] = 'image/tiff';
				break;
				case 'else':
				default:
					
				break;
			}
		}  

		$allowedfileext = implode("', '", $fileextions);
		if ('' !== $allowedfileext) {
			$allowedfileext = "'" . $allowedfileext . "'";
		}
		$allowedmimetypes = implode("', '", $mimetypes);
		if ('' !== $allowedmimetypes) {
			$allowedmimetypes = "'" . $allowedmimetypes . "'";
		}	
		// Define Stylesheet
		$xoTheme->addStylesheet(XOOPS_URL . '/media/fine-uploader/fine-uploader-new.css');
		$xoTheme->addStylesheet(XOOPS_URL . '/media/fine-uploader/ManuallyTriggerUploads.css');
		$xoTheme->addStylesheet(XOOPS_URL . '/media/font-awesome/css/font-awesome.min.css');        
		$xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
		// Define scripts
		$xoTheme->addScript('browse.php?Frameworks/jquery/jquery.js');
		$xoTheme->addScript('modules/system/js/admin.js');
		$xoTheme->addScript('media/fine-uploader/fine-uploader.js');
		// Define Breadcrumb and tips
		$xoopsTpl->assign('multiupload', true);
		// echo $wggallery->getConfig('mimetypes');
		$xoopsTpl->assign('img_maxsize', $wggallery->getConfig('maxsize'));
		$xoopsTpl->assign('img_maxwidth', $wggallery->getConfig('maxwidth'));
		$xoopsTpl->assign('img_maxheight', $wggallery->getConfig('maxheight'));
		$xoopsTpl->assign('img_albname', $albumObj->getVar('alb_name'));
		$xoopsTpl->assign('allowedfileext', $albumObj->getVar('allowedfileext'));
		$xoopsTpl->assign('allowedmimetypes', $albumObj->getVar('allowedmimetypes'));
		$payload = array(
			'aud' => 'ajaxfineupload.php',
			'cat' => $albId,
			'uid' => $xoopsUser instanceof \XoopsUser ? $xoopsUser->id() : 0,
			'handler' => 'fineimpuploadhandler',
			'moddir' => 'wggallery',
		);
		$jwt = \Xmf\Jwt\TokenFactory::build('fineuploader', $payload, 60*30); // token good for 30 minutes
		$xoopsTpl->assign('jwt', $jwt);
		setcookie ( 'jwt', $jwt );
		$fineup_debug = 'false';
		if (($xoopsUser instanceof \XoopsUser ? $xoopsUser->isAdmin() : false)
			&& isset($_REQUEST['FINEUPLOADER_DEBUG']))
		{
			$fineup_debug = 'true';
		}
		$xoopsTpl->assign('fineup_debug', $fineup_debug);
	}
}

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _CO_WGGALLERY_IMAGES_UPLOAD);
include __DIR__ . '/footer.php';
