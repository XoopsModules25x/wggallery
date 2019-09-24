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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

require __DIR__ . '/header.php';
$pr_gallery                              = $gallerytypesHandler->getPrimaryGallery();
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_gallery_' . $pr_gallery['template'] . '.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

$albId = Request::getInt('alb_id');
/** @var \XoopsModules\Wggallery\Utility $utility */
$utility = new \XoopsModules\Wggallery\Utility();

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
if ($helper->getConfig('addjquery')) {
	$GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/jquery-1.9.1.min.js');
}

// $GLOBALS['xoopsTpl']->assign('xoops_icons32_url', XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
$GLOBALS['xoopsTpl']->assign('show_breadcrumbs', $helper->getConfig('show_breadcrumbs'));

// Breadcrumbs
$xoBreadcrumbs[] = ['title' => _CO_WGGALLERY_ALBUMS, 'link' => WGGALLERY_URL . '/'];

// set default size
$GLOBALS['xoopsTpl']->assign('source', 'medium');

// assign all gallery options
$options = unserialize($pr_gallery['options'], ['allowed_classes' => false]);
foreach ($options as $option) {
    if ('none' !== $option['value']) {
        $optionValue = str_replace('|', ',', $option['value']);
        $GLOBALS['xoopsTpl']->assign($option['name'], $optionValue);
    }
    // special options for specific galleries
    if ('jssor' === $pr_gallery['template']) {
        if ('jssor_slidertype' === $option['name']) {
            $jssor_slidertype = $option['value'];
        }
        if ('jssor_maxwidth' === $option['name']) {
            $jssor_maxwidth = $option['value'];
        }
        if ('jssor_maxheight' === $option['name']) {
            $jssor_maxheight = $option['value'];
        }
    }
    if ('lclightboxlite' === $pr_gallery['template']) {
        if ('lcl_skin' === $option['name']) {
            $lcl_skin = $option['value'];
        }
    }
    // echo "<br>".$option['name'].":".$optionValue;
}


// echo '<br>template:wggallery_gallery_' . $pr_gallery['template'] . '.tpl';
// echo '<br>isdir template: ' . is_dir(WGGALLERY_URL . '/assets/wggallery_gallery_' . $pr_gallery['template'] . '.tpl');

$albumsObj = $albumsHandler->get($albId);
if (isset($albumsObj) && is_object($albumsObj)) {
    $albName      = $albumsObj->getVar('alb_name');
    $albSubmitter = $albumsObj->getVar('alb_submitter');
}
$GLOBALS['xoopsTpl']->assign('alb_name', $albName);
// $GLOBALS['xoopsTpl']->assign('alb_allowdownload', $permissionsHandler->permAlbumDownload($albId));
// $GLOBALS['xoopsTpl']->assign('alb_pid', $albPid);

$crImages = new \CriteriaCompo();
$crImages->add(new \Criteria('img_albid', $albId));
if (!$permissionsHandler->permAlbumEdit($albId, $albSubmitter)) {
    $crImages->add(new \Criteria('img_state', 1));
}
$crImages->setSort('img_weight ASC, img_date');
$crImages->setOrder('DESC');
$imagesCount = $imagesHandler->getCount($crImages);
$imagesAll   = $imagesHandler->getAll($crImages);
$GLOBALS['xoopsTpl']->assign('images_nb', $imagesCount);
if ($imagesCount > 0) {
    $images = [];
    // Get All Images
    foreach (array_keys($imagesAll) as $i) {
        $images[$i] = $imagesAll[$i]->getValuesImages();
    }
    $GLOBALS['xoopsTpl']->assign('images', $images);
}

switch ($pr_gallery['template']) {
    case 'none':
    default:
        echo 'invalid gallery type';
        break;
    case 'lclightboxlite':
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/gallerytypes/lclightboxlite/css/lc_lightbox.min.css', null);
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/gallerytypes/lclightboxlite/skins/' . $lcl_skin . '.css', null);
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/lclightboxlite/js/lc_lightbox.lite.min.js');
        break;
    case 'jssor':
        $GLOBALS['xoopsTpl']->assign('uniqid', preg_replace('/[^a-zA-Z0-9]+/', '_', uniqid('', true)));
        switch ($jssor_slidertype) {
            // case WGGALLERY_OPTION_GT_SLIDERTYPE_3_VAL:
            // $GLOBALS['xoopsTpl']->assign('jssor_maxwidth_js', 3000);
            // break;
            case WGGALLERY_OPTION_GT_SLIDERTYPE_2_VAL:
                $GLOBALS['xoopsTpl']->assign('jssor_maxwidth_js', 3000);
                break;
            case WGGALLERY_OPTION_GT_SLIDERTYPE_1_VAL:
            default:
                $GLOBALS['xoopsTpl']->assign('jssor_maxwidth_js', $jssor_maxwidth);
                break;
        }
        if (WGGALLERY_OPTION_GT_SLIDERTYPE_1_VAL == $jssor_slidertype) {
            $GLOBALS['xoopsTpl']->assign('jssor_maxwidth_js', $jssor_maxwidth);
        }
        $GLOBALS['xoopsTpl']->assign('jssor_maxwidth', $jssor_maxwidth);
        $GLOBALS['xoopsTpl']->assign('jssor_maxheight', $jssor_maxheight);

        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/jssor/js/jssor.slider.min.js');
        break;
    case 'viewerjs':
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/gallerytypes/viewerjs/dist/viewer.min.css', null);
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/viewerjs/dist/viewer.min.js');
        break;
    case 'lightbox2':
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/gallerytypes/lightbox2/dist/css/lightbox.min.css', null);
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/lightbox2/dist/js/lightbox-plus-jquery.js');
        $GLOBALS['xoopsTpl']->assign('albumLabel', _MA_WGGALLERY_CURRENT_LABEL);
        break;
    case 'justifiedgallery':
        $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/gallerytypes/justifiedgallery/dist/css/justifiedGallery.min.css', null);
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/justifiedgallery/dist/js/jquery.justifiedGallery.min.js');
        // $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/justifiedgallery/dist/js/justifiedGallery.min.js');
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/justifiedgallery/dist/js/jquery.colorbox-min.js');
        // $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/galleries/colorbox/jquery.colorbox.js');
        $GLOBALS['xoopsTpl']->assign('colorbox_current', _MA_WGGALLERY_CURRENT_LABEL);
        $GLOBALS['xoopsTpl']->assign('colorbox_previous', _MA_WGGALLERY_COLORBOX_PREVIOUS);
        $GLOBALS['xoopsTpl']->assign('colorbox_next', _MA_WGGALLERY_COLORBOX_NEXT);
        $GLOBALS['xoopsTpl']->assign('colorbox_close', _MA_WGGALLERY_COLORBOX_CLOSE);
        $GLOBALS['xoopsTpl']->assign('colorbox_slideshowstart', _MA_WGGALLERY_COLORBOX_SLIDESHOWSTART);
        $GLOBALS['xoopsTpl']->assign('colorbox_slideshowstop', _MA_WGGALLERY_COLORBOX_SLIDESHOWSTOP);
        break;
    // case 'blueimpgallery':
    // $GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/css/blueimp-gallery.min.css', null );
    // $GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/css/blueimp-gallery-indicator.css', null );
    // $GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/css/blueimp-gallery-video.css', null );
    // $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-fullscreen.js');

    // $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery.js');
    /*         $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-helper.js');

    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-fullscreen.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-indicator.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-video.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-vimeo.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/blueimp-gallery-youtube.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/vendor/jquery.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/jquery.blueimp-gallery.js');
    $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/gallerytypes/blueimpgallery/js/demo/demo.js');
     */
    // break;
}

unset($images);

// Description
$utility::getMetaDescription(_CO_WGGALLERY_ALBUMS_DESC);
// $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/images.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
require __DIR__ . '/footer.php';
