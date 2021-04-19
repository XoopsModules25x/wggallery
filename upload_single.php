<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xmf\Request;
/**
 * wgGallery module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 upload.php 1 Sat 2018-03-17 09:55:45Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;
use XoopsModules\Wggallery\Common\FineimpuploadHandler;

require_once __DIR__ . '/header.php';
// \xoops_loadLanguage('admin', 'wggallery');
// It recovered the value of argument op in URL$
$op     = Request::getString('op', 'form');
$albId  = Request::getInt('alb_id', 0);
$albPid = Request::getInt('alb_pid', 0);

// Template
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_upload_single.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', \WGGALLERY_ICONS_URL . '16/');
$GLOBALS['xoopsTpl']->assign('show_breadcrumbs', $helper->getConfig('show_breadcrumbs'));
$GLOBALS['xoopsTpl']->assign('displayButtonText', $helper->getConfig('displayButtonText'));

// check permissions
if ($albId > 0) {
    $albumsObj = $albumsHandler->get($albId);
    if (!$permissionsHandler->permAlbumEdit($albId, $albumsObj->getVar('alb_submitter'))) {
        \redirect_header('albums.php', 3, _NOPERM);
    }
    $xoBreadcrumbs[] = ['title' => $albumsObj->getVar('alb_name'), 'link' => \WGGALLERY_URL . '/images.php?op=list&amp;alb_id=' . $albId];
} else {
    if (!$permissionsHandler->permGlobalSubmit()) {
        \redirect_header('albums.php', 3, _NOPERM);
    }
    $albumsObj = $albumsHandler->create();
}

// show form
$form = $albumsObj->getFormUploadToAlbum();
$GLOBALS['xoopsTpl']->assign('form', $form->render());

switch ($op) {
    case 'uploadSingle':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('images.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }

        // Set Var img_name
        include_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['img_name']['name'];
        $imgMimetype    = $_FILES['img_name']['type'];
        $imgSize        = $_FILES['img_name']['size'];
        $imgTitle       = \preg_replace("/[^a-zA-Z0-9]+/", '', Request::getString('img_title'));
        $uploaderErrors = '';
        $uploader = new \XoopsMediaUploader(\WGGALLERY_UPLOAD_IMAGE_PATH . '/large/',
            $helper->getConfig('mimetypes_image'),
            $helper->getConfig('maxsize_image'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $imgName = $imgTitle  . '_imgl';
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if (!$uploader->upload()) {
                $uploaderErrors = $uploader->getErrors();
            } else {
                $savedFilename = $uploader->getSavedFileName();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors = $uploader->getErrors();
            }
        }

        $imgDesc = Request::getString('img_desc');

        $ret = $imagesHandler->handleSingleUpload($savedFilename, $imgTitle, $imgDesc, $imgMimetype, $imgSize, $albId);
        if ($ret) {
            \redirect_header('images.php?op=list&amp;alb_id=' . $albId . '&amp;alb_pid=' . $albPid, 2, \_CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $ret['error']);
        break;

    case 'default':
    default:
        if ($albId > 0) {
            $formSingleUpload = $imagesHandler->getFormSingleUpload($albId);
            $xoopsTpl->assign('formSingleUpload', $formSingleUpload->render());
        }
        break;
}



// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_CO_WGGALLERY_IMAGES_UPLOAD];
require __DIR__ . '/footer.php';
