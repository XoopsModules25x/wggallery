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
 * @version        $Id: 1.0 index.php 1 Mon 2018-03-19 10:04:55Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$keywords    = array();
$albumsCount = $albumsHandler->getCountAlbums();
// If there are  albums
$count = 1;
if ($albumsCount > 0) {
    $albumsAll = $albumsHandler->getAllAlbums(0);
    include_once XOOPS_ROOT_PATH . '/class/tree.php';
    $albums = array();
    foreach (array_keys($albumsAll) as $alb) {
        $albumValues = $albumsAll[$alb]->getValuesAlbums();
        $acount      = array('count', $count);
        $albums[]    = array_merge($albumValues, $acount);
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('albums', $albums);
    unset($albums);
    $GLOBALS['xoopsTpl']->assign('numb_col', $wggallery->getConfig('numb_col'));
}
unset($count);
//
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
//
$imagesCount = $imagesHandler->getCountImages();
$count       = 1;
if ($imagesCount > 0) {
    $start     = XoopsRequest::getInt('start', 0);
    $limit     = XoopsRequest::getInt('limit', $wggallery->getConfig('userpager'));
    $imagesAll = $imagesHandler->getAllImages($start, $limit);
    // Get All Images
    $images = array();
    foreach (array_keys($imagesAll) as $i) {
        $image      = $imagesAll[$i]->getValuesImages();
        $acount     = array('count', $count);
        $images[]   = array_merge($image, $acount);
        $keywords[] = $imagesAll[$i]->getVar('img_name');
        ++$count;
    }
    $GLOBALS['xoopsTpl']->assign('images', $images);
    unset($images);
    // Display Navigation
    if ($imagesCount > $limit) {
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
    $GLOBALS['xoopsTpl']->assign('lang_thereare', sprintf(_MA_WGGALLERY_INDEX_THEREARE, $imagesCount));
    $GLOBALS['xoopsTpl']->assign('divideby', $wggallery->getConfig('divideby'));
}
unset($count);
$GLOBALS['xoopsTpl']->assign('table_type', $wggallery->getConfig('table_type'));
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_INDEX);
// Keywords
wggalleryMetaKeywords($wggallery->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_MA_WGGALLERY_INDEX_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL . '/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
