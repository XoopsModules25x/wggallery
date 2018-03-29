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
 * @version        $Id: 1.0 single.php 1 Mon 2018-03-19 10:04:55Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$imgId                                   = XoopsRequest::getInt('img_id', 0);
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_single.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$keywords = array();
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_IMAGES);
// Keywords
wggalleryMetaKeywords($wggallery->getConfig('keywords') . ', ' . implode(',', $keywords));
unset($keywords);
// Description
wggalleryMetaDescription(_MA_WGGALLERY_IMAGES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL . '/index.php');
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
