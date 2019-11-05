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
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';

$op    = Request::getString('op', 'list');
$imgId = Request::getInt('img_id');
$albId = Request::getInt('alb_id');

switch ($op) {
    case 'album':
        if ($albId > 0) {
            // check permission whether download of full album is allowed
            if ($permissionsHandler->permAlbumDownload($albId)) {
                //Archive name
                $archive_file_name = preg_replace ( '/[^a-z0-9_]/i', '', $albumsHandler->get($albId)->getVar('alb_name'));
                $archive_file_name .= uniqid('_') . '.zip';
                $archive_file_path = WGGALLERY_UPLOAD_PATH . '/temp/' . $archive_file_name;
                unlink($archive_file_path);
                
                $zip = new ZipArchive();
                //create the file and throw the error if unsuccessful
                if ($zip->open($archive_file_path, ZIPARCHIVE::CREATE )!==TRUE) {
                    redirect_header('albums.php', 5, _MA_WGGALLERY_ERROR_CREATE_ZIP);
                }
                
                $crImages = new \CriteriaCompo();
                $crImages->add(new \Criteria('img_albid', $albId));
                $crImages->add(new \Criteria('img_state', Constants::STATE_ONLINE_VAL));
                $crImages->setSort('img_weight ASC, img_date');
                $crImages->setOrder('DESC');
                $imagesCount = $imagesHandler->getCount($crImages);
                if ($imagesCount > 0) {
                    $imagesAll = $imagesHandler->getAll($crImages);
                    // Get All Images
                    foreach (array_keys($imagesAll) as $i) {
                        $file = '';
                        if ($permissionsHandler->permImageDownloadMedium($albId)) {
                            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imagesAll[$i]->getVar('img_name');
                        }
                        if ($permissionsHandler->permImageDownloadLarge($albId)) {
                            $file = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imagesAll[$i]->getVar('img_namelarge');
                        }
                        if (file_exists($file)) {
                            $zip->addFile($file, $imagesAll[$i]->getVar('img_name'));
                        }
                    }
                }
                
                $zip->close();
                
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-type: application/octet-stream");
                header('Content-Disposition: attachment; filename="'.$archive_file_name.'"');
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: ".filesize($archive_file_path));
                ob_end_flush();
                @readfile($archive_file_path);
                unlink($archive_file_path);

                // mark all images of album as downloaded
                foreach (array_keys($imagesAll) as $i) {
                    $imagesObj = $imagesHandler->get($imagesAll[$i]->getVar('img_id'));
                    $imagesObj->setVar('img_downloads', $imagesObj->getVar('img_downloads') + 1);
                    $imagesHandler->insert($imagesObj, true);
                }
            } else {
                redirect_header('albums.php', 3, _NOPERM);
            }
            
        }
    break;
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
