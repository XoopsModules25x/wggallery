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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_index' . $wggallery->getConfig('style_index_album') . '.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';
$start = XoopsRequest::getInt('start', 0);
$limit = XoopsRequest::getInt('limit', $wggallery->getConfig('userpager'));
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_CSS_URL . '/style' . $wggallery->getConfig('style_index_album') . '.css' , null );

// 
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

$keywords = array();

// get all albums which are online
$crAlbums = new CriteriaCompo();
if (!permCreateAlbum()) {
    $crAlbums->add(new Criteria('alb_state', WGGALLERY_STATE_ONLINE_VAL));
}
$crAlbums->add(new Criteria('alb_pid', 0));
$crAlbums->setSort('alb_weight');
$crAlbums->setOrder('ASC');
$albumsCount = $albumsHandler->getCount($crAlbums);
$crAlbums->setStart( $start );
$crAlbums->setLimit( $limit );
$albumsAll = $albumsHandler->getAll($crAlbums);

if($albumsCount > 0) {
	$albums = array();
	// Get All Albums
	foreach(array_keys($albumsAll) as $i) {
		$albums[$i] = $albumsAll[$i]->getValuesAlbums();
        //check permissions
        $albums[$i]['edit'] = permEditAlbum($albumsAll[$i]->getVar('alb_id'));
        
		$keywords[] = $albumsAll[$i]->getVar('alb_name');
	}
	$GLOBALS['xoopsTpl']->assign('albums', $albums);
	$GLOBALS['xoopsTpl']->assign('gallery', 'none' != $wggallery->getConfig('gallery_type'));
	$GLOBALS['xoopsTpl']->assign('album_showsubmitter', $wggallery->getConfig('album_showsubmitter'));
	unset($albums);
	// Display Navigation
	if($albumsCount > $limit) {
		include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
		$pagenav = new XoopsPageNav($albumsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav_albums', $pagenav->renderNav(4));
	}
}

// get all categories which contains albums
$crAlbums = new CriteriaCompo();
if (!permCreateAlbum()) {
    $crAlbums->add(new Criteria('alb_state', WGGALLERY_STATE_ONLINE_VAL));
}
$crAlbums->add(new Criteria('alb_pid', 0, '>'));
$crAlbums->setSort('alb_weight');
$crAlbums->setOrder('ASC');
$albumsCount = $albumsHandler->getCount($crAlbums);
$crAlbums->setStart( $start );
$crAlbums->setLimit( $limit );
$albumsAll = $albumsHandler->getAll($crAlbums);

if($albumsCount > 0) {
	$albums = array();
	// Get All Albums
	foreach(array_keys($albumsAll) as $i) {
		$albums[$i] = $albumsAll[$i]->getValuesAlbums();
        //check permissions
        $albums[$i]['edit'] = permEditAlbum($albumsAll[$i]->getVar('alb_id'));
		$keywords[] = $albumsAll[$i]->getVar('alb_name');
	}
	$GLOBALS['xoopsTpl']->assign('categories', $albums);
	$GLOBALS['xoopsTpl']->assign('gallery', 'none' != $wggallery->getConfig('gallery_type'));
	$GLOBALS['xoopsTpl']->assign('album_showsubmitter', $wggallery->getConfig('album_showsubmitter'));
	unset($albums);
	// Display Navigation
	if($albumsCount > $limit) {
		include_once XOOPS_ROOT_PATH .'/class/pagenav.php';
		$pagenav = new XoopsPageNav($albumsCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
		$GLOBALS['xoopsTpl']->assign('pagenav_cats', $pagenav->renderNav(4));
	}
}
$GLOBALS['xoopsTpl']->assign('type', $wggallery->getConfig('table_type'));
$GLOBALS['xoopsTpl']->assign('divideby', $wggallery->getConfig('divideby'));
$GLOBALS['xoopsTpl']->assign('numb_col', $wggallery->getConfig('numb_col'));
	
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_ALBUMS);
// Keywords
wggalleryMetaKeywords($wggallery->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_MA_WGGALLERY_ALBUMS_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/albums.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
