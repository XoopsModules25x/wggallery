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
 * @version        $Id: 1.0 download.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

include __DIR__ . '/header.php';

$op    = Request::getString('op', 'list');
$imgId = Request::getInt('img_id');

switch ($op) {
    case 'viewerjs':
        //src: provided by viewer.js
        $file     = Request::getString('src', 'none');
        $filename = basename($file);

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_name', $filename), 'OR');
        $crImages->add(new \Criteria('img_namelarge', $filename), 'OR');
        $imagesAll = $imagesHandler->getAll($crImages);
        // Get All Images
        foreach (array_keys($imagesAll) as $i) {
            $image = $imagesAll[$i]->getValuesImages();
        }
        $albId = $image['albid'];
        // check permissions
        $file = '';
        if ($permissionsHandler->permImageDownloadMedium($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
        }
        if ($permissionsHandler->permImageDownloadLarge($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
        }
        if ('' === $file) {
            redirect_header('images.php?op=list&amp;alb_id=' . $albId, 3, _CO_WGGALLERY_PERMS_NODOWNLOAD);
        }
        // count downloads
        $imagesObj = $imagesHandler->get($image['id']);
        $imagesObj->setVar('img_downloads', $image['downloads'] + 1);
        $imagesHandler->insert($imagesObj, true);

        // provide download is made by tpl
        break;
    case 'lclightboxlite':
        //src: provided by wggallery_lclightboxlite.tpl
        $file     = Request::getString('src', 'none');
        $filename = basename($file);

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_name', $filename), 'OR');
        $crImages->add(new \Criteria('img_namelarge', $filename), 'OR');
        $imagesAll = $imagesHandler->getAll($crImages);
        // Get All Images
        foreach (array_keys($imagesAll) as $i) {
            $image = $imagesAll[$i]->getValuesImages();
        }
        $albId = $image['albid'];
        // check permissions
        $file = '';
        if ($permissionsHandler->permImageDownloadMedium($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
        }
        if ($permissionsHandler->permImageDownloadLarge($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
        }
        if ('' === $file) {
            redirect_header('images.php?op=list&amp;alb_id=' . $albId, 3, _CO_WGGALLERY_PERMS_NODOWNLOAD);
        }
        // count downloads
        $imagesObj = $imagesHandler->get($image['id']);
        $imagesObj->setVar('img_downloads', $image['downloads'] + 1);
        $imagesHandler->insert($imagesObj, true);

        // provide download is made by js
        break;
    case 'download':
    default:
        // download image and save download rate
        $imagesObj = $imagesHandler->get($imgId);
        $image     = $imagesObj->getValuesImages();
        $albId     = $image['albid'];
        // check permissions
        $file = '';
        if ($permissionsHandler->permImageDownloadMedium($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
        }
        if ($permissionsHandler->permImageDownloadLarge($albId)) {
            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
        }
        if ('' === $file) {
            redirect_header('images.php?op=list&amp;alb_id=' . $albId, 3, _CO_WGGALLERY_PERMS_NODOWNLOAD);
        }
        // count downloads
        $imagesObj->setVar('img_downloads', $image['downloads'] + 1);
        $imagesHandler->insert($imagesObj, true);

        $fp = fopen($file, 'rb');
        header('Content-type: ' . $image['img_mimetype']);
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        fpassthru($fp);

        break;
}
