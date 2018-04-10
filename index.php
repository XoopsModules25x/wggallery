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
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_index' . $wggallery->getConfig('style_index_album', true) . '.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';
$start       = XoopsRequest::getInt('start', 0);
$limit       = XoopsRequest::getInt('limit', $wggallery->getConfig('userpager'));
$albForId    = XoopsRequest::getInt('alb_for_id', 0);
$submitterId = XoopsRequest::getInt('subm_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_CSS_URL . '/style' . $wggallery->getConfig('style_index_album', true) . '.css' , null );

// general template assigns
// $GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

$keywords = array();

// Breadcrumbs
if ($albForId) {
	$xoBreadcrumbs[] = array('title' => _CO_WGGALLERY_ALBUMS, 'link' => WGGALLERY_URL . '/');
	$albumsObj = $albumsHandler->get($albForId);
	$xoBreadcrumbs[] = array('title' => $albumsObj->getVar('alb_name'));
} else {
	$xoBreadcrumbs[] = array('title' => _CO_WGGALLERY_ALBUMS);
}
if ( 0 < $submitterId ) {
	$GLOBALS['xoopsTpl']->assign('subm_id', $submitterId);
}
// get all albums which are online
$crAlbums = new CriteriaCompo();
if ($permissionsHandler->permGlobalSubmit()) {
    $crAlbums->add(new Criteria('alb_state', WGGALLERY_STATE_ONLINE_VAL));
}
if ( 0 < $submitterId ) {
    $crAlbums->add(new Criteria('alb_submitter', $submitterId));
}
$crAlbums->add(new Criteria('alb_pid', $albForId));
$crAlbums->add(new Criteria('alb_iscat', 0));
$crAlbums->setSort('alb_weight ASC, alb_date');
$crAlbums->setOrder('DESC');
$albumsCount = $albumsHandler->getCount($crAlbums);
$crAlbums->setStart( $start );
$crAlbums->setLimit( $limit );
$albumsAll = $albumsHandler->getAll($crAlbums);

if($albumsCount > 0) {
	$albums = array();
	// Get All Albums
	foreach(array_keys($albumsAll) as $i) {
		$albums[$i] = $albumsAll[$i]->getValuesAlbums();
		$submitter = $albumsAll[$i]->getVar('alb_submitter');
        //check permissions
        $albums[$i]['edit'] = $permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'));
        
		$keywords[] = $albumsAll[$i]->getVar('alb_name');
		
		// echo "<br>------------------------------------------------------------";
		// echo "<br>alb_name:".$albumsAll[$i]->getVar('alb_name');
		// echo "<br>permAlbumView:".$permissionsHandler->permAlbumView($albumsAll[$i]->getVar('alb_id'));
		// echo "<br>permAlbumEdit:".$permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'));
		// echo "<br>permAlbumDownload:".$permissionsHandler->permAlbumDownload($albumsAll[$i]->getVar('alb_id'));
		// echo "<br>permGlobalSubmit:".$permissionsHandler->permGlobalSubmit();
		// echo "<br>permGlobalSubmitAll:".$permissionsHandler->permGlobalSubmitAll();
		// echo "<br>permGlobalApprove:".$permissionsHandler->permGlobalApprove();
		
		
	}
	$GLOBALS['xoopsTpl']->assign('albums', $albums);
	$GLOBALS['xoopsTpl']->assign('alb_for_id', $albForId);
	$pr_gallery = $gallerytypesHandler->getPrimaryGallery();
	$GLOBALS['xoopsTpl']->assign('gallery', 'none' != $pr_gallery['template']);
	$GLOBALS['xoopsTpl']->assign('album_showsubmitter', $wggallery->getConfig('album_showsubmitter'));
	if ( 0 < $submitterId ) {
		$GLOBALS['xoopsTpl']->assign('index_title', _CO_WGGALLERY_ALBUMS_TITLE . ": " . XoopsUser::getUnameFromId($submitter));
	} else {
		$GLOBALS['xoopsTpl']->assign('index_title', _CO_WGGALLERY_ALBUMS_TITLE);
	}

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
if (!$permissionsHandler->permGlobalSubmit()) {
    $crAlbums->add(new Criteria('alb_state', WGGALLERY_STATE_ONLINE_VAL));
}
if ( 0 < $submitterId ) {
    $crAlbums->add(new Criteria('alb_submitter', $submitterId));
}
$crAlbums->add(new Criteria('alb_pid', $albForId));
$crAlbums->add(new Criteria('alb_iscat', 1));
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
		// count albums
		$crSubAlbums = new CriteriaCompo();
		$crSubAlbums->add(new Criteria('alb_pid', $albums[$i]['alb_id']));
		$nbAlbums = $albumsHandler->getCount($crSubAlbums);
		$albums[$i]['nb_albums'] = $nbAlbums;
        //check permissions
        $albums[$i]['edit'] = $permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'));
		$keywords[] = $albumsAll[$i]->getVar('alb_name');
	}
	$GLOBALS['xoopsTpl']->assign('categories', $albums);
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
	
// Keywords
wggalleryMetaKeywords($wggallery->getConfig('keywords').', '. implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_CO_WGGALLERY_ALBUMS_DESC);
// $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/albums.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
