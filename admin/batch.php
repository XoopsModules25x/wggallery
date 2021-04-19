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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request img_id
$albId = Request::getInt('alb_id');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('adminpager'));

$templateMain = 'wggallery_admin_batch.tpl';
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', \WGGALLERY_ICONS_URL . '16/');

$params = [];
$params['maxsize']   = $helper->getConfig('maxsize');
$params['fileext']   = $helper->getConfig('fileext');
$params['maxwidth']  = $helper->getConfig('maxwidth');
$params['maxheight'] = $helper->getConfig('maxheight');

switch ($op) {
    case 'list':
    default:
        $templateMain = 'wggallery_admin_batch.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('batch.php'));

        $filesCount = 0;
        $files = \scandir(\WGGALLERY_UPLOAD_BATCH_PATH);
        foreach ($files as $file) {
            if ('.' !== $file && '..' !== $file && 'index.html' !== $file && 'index.php' !== $file) {
                if ($filesCount >= $start && $filesCount < ($start + $limit)) {
                    $mimetype =
                    $GLOBALS['xoopsTpl']->append('files', batchRead($filesCount, $file, $params));
                }
                $filesCount++;
            }
        }

        if ($filesCount > 0) {
            $adminObject->addItemButton(\_AM_WGGALLERY_BATCH_FORM, 'batch.php?op=new', 'add');
            $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
            $GLOBALS['xoopsTpl']->assign('filesCount', $filesCount);
            $GLOBALS['xoopsTpl']->assign('wggallery_upload_batch_url', \WGGALLERY_UPLOAD_BATCH_URL . '/');
            if ($filesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($filesCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('start', $start);
            $GLOBALS['xoopsTpl']->assign('limit', $limit);
        } else {
            $GLOBALS['xoopsTpl']->assign('noData', \str_replace('%s', \WGGALLERY_UPLOAD_BATCH_PATH, \_AM_WGGALLERY_BATCH_NODATA));
        }

        break;
    case 'new':
        $templateMain = 'wggallery_admin_batch.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('batch.php'));
        $adminObject->addItemButton(\_AM_WGGALLERY_BATCH_LIST, 'batch.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));

        $files = \scandir(\WGGALLERY_UPLOAD_BATCH_PATH);
        $filesCount = 0;
        $filesBatch = [];
        foreach ($files as $file) {
            if ('.' !== $file && '..' !== $file && 'index.html' !== $file && 'index.php' !== $file) {
                if ($filesCount < $limit) {
                    $filesBatch[$filesCount] = batchRead(1, $file, $params);
                }
                $filesCount++;
            }
        }
        if ($filesCount > 0) {
            $formBatchUpload = $imagesHandler->getFormBatchUpload($filesBatch);
            $GLOBALS['xoopsTpl']->assign('form', $formBatchUpload->render());
        }

        break;
    case 'delete':
        $file = Request::getString('file');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('images.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $filePath = \WGGALLERY_UPLOAD_BATCH_PATH . '/' . $file;
            if (\unlink($filePath)) {
                \redirect_header('batch.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 3, \_CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', \_CO_WGGALLERY_IMAGE_ERRORUNLINK);
            }
        } else {
            xoops_confirm(['ok' => 1, 'file' => $file, 'op' => 'delete', 'start' => $start, 'limit' => $limit], $_SERVER['REQUEST_URI'], \sprintf(\_CO_WGGALLERY_FORM_SURE_DELETE, $file));
        }

        break;
    case 'uploadBatch':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('batch.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $errors = [];
        $filesCount   = Request::getInt('filesCount');
        $arrFiles     = Request::getArray('img_name');
        $arrTitles    = Request::getArray('img_title');
        $arrDescs     = Request::getArray('img_desc');
        $arrMimetypes = Request::getArray('img_mimetype');
        $arrSizes     = Request::getArray('img_size');
        $arrPaths     = Request::getArray('img_path');
        for ($i = 0; $i < $filesCount; $i++) {
            \copy($arrPaths[$i], \WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $arrFiles[$i]);
            $ret = $imagesHandler->handleSingleUpload($arrFiles[$i], $arrTitles[$i], $arrDescs[$i], $arrMimetypes[$i], $arrSizes[$i], $albId);
            if ($ret) {
                \unlink($arrPaths[$i]);
            } else {
                $errors[] = \str_replace('%s', $arrFiles[$i], \_AM_WGGALLERY_BATCH_ERROR);
            }
        }
        if (\count($errors) > 0) {
            $GLOBALS['xoopsTpl']->assign('errors', $errors);
        } else {
            \redirect_header('batch.php?op=list', 2, \str_replace('%s', $filesCount, \_AM_WGGALLERY_BATCH_SUCCESS));
        }
        break;
}
require __DIR__ . '/footer.php';

/**
 * read data of files for batch upload
 * @param  $nb
 * @param  $file
 * @param  $params
 * @return array
 */
function batchRead($nb, $file, $params)
{
    $imagePath = \WGGALLERY_UPLOAD_BATCH_PATH . '/' . $file;
    list($width, $height, $type, $attr) = \getimagesize($imagePath);
    $size = \filesize($imagePath);
    $mimetype = \image_type_to_mime_type($type);
    $date = \formatTimestamp(\filemtime($imagePath));

    $check_size = $params['maxsize'] < $size ? \str_replace('%s', $params['maxsize'], \_AM_WGGALLERY_BATCH_CHECKSIZE) : '';
    $check_mimetype = \array_search($mimetype, $params['fileext']) ? '' :\str_replace('%s', $mimetype,  \_AM_WGGALLERY_BATCH_CHECKFILEEXT) ;
    $check_width   = $params['maxwidth'] < $width ? \str_replace('%s',  $params['maxwidth'],  \_AM_WGGALLERY_BATCH_CHECKWIDTH) : '';
    $check_height  = $params['maxheight'] < $height ? \str_replace('%s', $params['maxheight'],  \_AM_WGGALLERY_BATCH_CHECKHEIGHT) : '';

    $ret = ['nb' => $nb + 1, 'name' => $file,
        'mimetype' => $mimetype, 'check_mimetype' => $check_mimetype,
        'size' => $size, 'check_size' => $check_size,
        'width' => $width, 'check_width' => $check_width,
        'height' => $height, 'check_height' => $check_height,
        'date' => $date
    ];

    return $ret;
}
