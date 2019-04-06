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
 * @version        $Id: 1.0 gallerytypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op   = Request::getString('op', 'list');
$gtId = Request::getInt('gt_id');

$gtCount = $gallerytypesHandler->getCount();
if ($gtCount < 1) {
    redirect_header('maintenance.php?op=list', 3, _AM_WGGALLERY_THEREARENT_GALLERYTYPES);
}

switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $start        = Request::getInt('start', 0);
        $limit        = Request::getInt('limit', $helper->getConfig('adminpager'));
        $templateMain = 'wggallery_admin_gallerytypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
        $gallerytypesCount = $gallerytypesHandler->getCountGallerytypes();
        $gallerytypesAll   = $gallerytypesHandler->getAllGallerytypes($start, $limit);
        $GLOBALS['xoopsTpl']->assign('gallerytypes_count', $gallerytypesCount);
        $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
        $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
        $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
        // Table view gallerytypes
        if ($gallerytypesCount > 0) {
            foreach (array_keys($gallerytypesAll) as $i) {
                $gallerytype = $gallerytypesAll[$i]->getValuesGallerytypes(true);
                $GLOBALS['xoopsTpl']->append('gallerytypes_list', $gallerytype);
                unset($gallerytype);
            }
            // Display Navigation
            if ($gallerytypesCount > $limit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($gallerytypesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', _AM_WGGALLERY_THEREARENT_GALLERYTYPES);
        }

        break;
    case 'options':
        $templateMain = 'wggallery_admin_gallerytypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $gallerytypesObj = $gallerytypesHandler->get($gtId);
        $form            = $gallerytypesObj->getFormGallerytypeOptions();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'new':
        $templateMain = 'wggallery_admin_gallerytypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $gallerytypesObj = $gallerytypesHandler->create();
        $form            = $gallerytypesObj->getFormGallerytypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'set_primary':
        if (isset($gtId)) {
            $gallerytypesObj = $gallerytypesHandler->get($gtId);
        } else {
            $redirect_header('gallerytypes.php', 3, 'missing Id');
        }
        // reset all
        $strSQL = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_gallerytypes') . ' SET ' . $GLOBALS['xoopsDB']->prefix('wggallery_gallerytypes') . '.gt_primary = 0';
        $GLOBALS['xoopsDB']->queryF($strSQL);
        // Set Vars
        $gallerytypesObj->setVar('gt_primary', 1);
        // Insert Data
        if ($gallerytypesHandler->insert($gallerytypesObj)) {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        }

        break;
    case 'saveoptions':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('gallerytypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($gtId)) {
            $gallerytypesObj = $gallerytypesHandler->get($gtId);
        } else {
            redirect_header('gallerytypes.php', 3, 'invalid gt_id at saveoptions');
        }
        $options = [];
        //general
        if (isset($_POST['css'])) {
            $options[] = ['name' => 'css', 'value' => $_POST['css']];
        }
        if (isset($_POST['source'])) {
            $options[] = ['name' => 'source', 'value' => $_POST['source'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
        }
        if (isset($_POST['source_preview'])) {
            $options[] = ['name' => 'source_preview', 'value' => $_POST['source_preview'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW'];
        }
        //jssor
        if (isset($_POST['jssor_arrows'])) {
            $options[] = ['name' => 'jssor_arrows', 'value' => $_POST['jssor_arrows'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ARROWS'];
        }
        if (isset($_POST['jssor_bullets'])) {
            $options[] = ['name' => 'jssor_bullets', 'value' => $_POST['jssor_bullets'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BULLETS'];
        }
        if (isset($_POST['jssor_thumbnails'])) {
            $options[] = ['name' => 'jssor_thumbnails', 'value' => $_POST['jssor_thumbnails'], 'caption' => '_AM_WGGALLERY_OPTION_GT_THUMBNAILS'];
        }
        if (isset($_POST['jssor_thumborient'])) {
            $options[] = ['name' => 'jssor_thumborient', 'value' => $_POST['jssor_thumborient'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ORIENTATION'];
        }
        if (isset($_POST['jssor_loadings'])) {
            $options[] = ['name' => 'jssor_loadings', 'value' => $_POST['jssor_loadings'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LOADINGS'];
        }
        if (isset($_POST['jssor_autoplay'])) {
            $options[] = ['name' => 'jssor_autoplay', 'value' => $_POST['jssor_autoplay'], 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
        }
        if (isset($_POST['jssor_fillmode'])) {
            $options[] = ['name' => 'jssor_fillmode', 'value' => $_POST['jssor_fillmode'], 'caption' => '_AM_WGGALLERY_OPTION_GT_FILLMODE'];
        }
        if (isset($_POST['jssor_transition'])) {
            $jssor_transition = $_POST['jssor_transition'];
            $transText        = '';
            foreach ($jssor_transition as $transition) {
                if (0 !== mb_strpos($transition, '-')) {
                    if ('' !== $transText) {
                        $transText .= '|';
                    }
                    $transText .= $transition;
                }
            }
            // if nothing selected take fade as default
            if ('' === $transText) {
                $transText = '{$Duration:800,$Opacity:2}';
            }
            $options[] = ['name' => 'jssor_transition', 'value' => $transText, 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT'];
        }
        if (isset($_POST['jssor_transitionorder'])) {
            $options[] = ['name' => 'jssor_transitionorder', 'value' => $_POST['jssor_transitionorder'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSORDER'];
        }
        if (isset($_POST['jssor_slidertype'])) {
            $options[] = ['name' => 'jssor_slidertype', 'value' => $_POST['jssor_slidertype'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDERTYPE'];
        }
        if (isset($_POST['jssor_maxwidth'])) {
            $options[] = ['name' => 'jssor_maxwidth', 'value' => $_POST['jssor_maxwidth'], 'caption' => '_AM_WGGALLERY_OPTION_GT_MAXWIDTH'];
        }
        if (isset($_POST['jssor_maxheight'])) {
            $options[] = ['name' => 'jssor_maxheight', 'value' => $_POST['jssor_maxheight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_MAXWIDTH'];
        }
        // lcl
        if (isset($_POST['lcl_skin'])) {
            $options[] = ['name' => 'lcl_skin', 'value' => $_POST['lcl_skin'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSKIN'];
        }
        if (isset($_POST['lcl_animationtime'])) {
            $options[] = ['name' => 'lcl_animationtime', 'value' => $_POST['lcl_animationtime'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ANIMTIME'];
        }
        if (isset($_POST['lcl_counter'])) {
            $options[] = ['name' => 'lcl_counter', 'value' => $_POST['lcl_counter'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLCOUNTER'];
        }
        if (isset($_POST['lcl_carousel'])) {
            $options[] = ['name' => 'lcl_carousel', 'value' => $_POST['lcl_carousel'], 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
        }
        if (isset($_POST['lcl_slideshow'])) {
            $options[] = ['name' => 'lcl_slideshow', 'value' => $_POST['lcl_slideshow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW'];
        }

        if (isset($_POST['lcl_progressbar'])) {
            $options[] = ['name' => 'lcl_progressbar', 'value' => $_POST['lcl_progressbar'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR'];
        }
        if (isset($_POST['lcl_backgroundcolor'])) {
            $options[] = ['name' => 'lcl_backgroundcolor', 'value' => $_POST['lcl_backgroundcolor'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BACKGROUND'];
        }
        if (isset($_POST['lcl_backgroundheight'])) {
            $options[] = ['name' => 'lcl_backgroundheight', 'value' => $_POST['lcl_backgroundheight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BACKHEIGHT'];
        }
        if (isset($_POST['lcl_maxwidth'])) {
            $options[] = ['name' => 'lcl_maxwidth', 'value' => $_POST['lcl_maxwidth'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH'];
        }
        if (isset($_POST['lcl_maxheight'])) {
            $options[] = ['name' => 'lcl_maxheight', 'value' => $_POST['lcl_maxheight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH'];
        }
        if (isset($_POST['lcl_borderwidth'])) {
            $options[] = ['name' => 'lcl_borderwidth', 'value' => $_POST['lcl_borderwidth'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERWIDTH'];
        }
        if (isset($_POST['lcl_bordercolor'])) {
            $options[] = ['name' => 'lcl_bordercolor', 'value' => $_POST['lcl_bordercolor'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERCOLOR'];
        }
        if (isset($_POST['lcl_borderpadding'])) {
            $options[] = ['name' => 'lcl_borderpadding', 'value' => $_POST['lcl_borderpadding'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERPADDING'];
        }
        if (isset($_POST['lcl_borderradius'])) {
            $options[] = ['name' => 'lcl_borderradius', 'value' => $_POST['lcl_borderradius'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERRADIUS'];
        }
        if (isset($_POST['lcl_shadow'])) {
            $options[] = ['name' => 'lcl_shadow', 'value' => $_POST['lcl_shadow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHADOW'];
        }
        if (isset($_POST['lcl_dataposition'])) {
            $options[] = ['name' => 'lcl_dataposition', 'value' => $_POST['lcl_dataposition'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION'];
        }
        if (isset($_POST['lcl_cmdposition'])) {
            $options[] = ['name' => 'lcl_cmdposition', 'value' => $_POST['lcl_cmdposition'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION'];
        }
        if (isset($_POST['lcl_cmdposition'])) {
            $options[] = ['name' => 'lcl_cmdposition', 'value' => $_POST['lcl_cmdposition'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION'];
        }
        if (isset($_POST['showSubmitter'])) {
            $options[] = ['name' => 'showSubmitter', 'value' => $_POST['showSubmitter'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWSUBMITTER'];
        }
        if (isset($_POST['thumbsWidth'])) {
            $options[] = ['name' => 'thumbsWidth', 'value' => $_POST['thumbsWidth'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH'];
        }
        if (isset($_POST['thumbsHeight'])) {
            $options[] = ['name' => 'thumbsHeight', 'value' => $_POST['thumbsHeight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH'];
        }
        if (isset($_POST['lcl_fullscreen'])) {
            $options[] = ['name' => 'lcl_fullscreen', 'value' => $_POST['lcl_fullscreen'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN'];
        }
        if (isset($_POST['lcl_fsimgbehavior'])) {
            $options[] = ['name' => 'lcl_fsimgbehavior', 'value' => $_POST['lcl_fsimgbehavior'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR'];
        }
        if (isset($_POST['lcl_socials'])) {
            $options[] = ['name' => 'lcl_socials', 'value' => $_POST['lcl_socials'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSOCIALS'];
        }
        if (isset($_POST['lcl_download'])) {
            $options[] = ['name' => 'lcl_download', 'value' => $_POST['lcl_download'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD'];
        }
        if (isset($_POST['lcl_rclickprevent'])) {
            $options[] = ['name' => 'lcl_rclickprevent', 'value' => $_POST['lcl_rclickprevent'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLRCLICK'];
        }
        if (isset($_POST['lcl_txttogglecmd'])) {
            $options[] = ['name' => 'lcl_txttogglecmd', 'value' => $_POST['lcl_txttogglecmd'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT'];
        }
        // others
        if (isset($_POST['showThumbs'])) {
            $options[] = ['name' => 'showThumbs', 'value' => $_POST['showThumbs'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS'];
        }
        if (isset($_POST['showTitle'])) {
            $options[] = ['name' => 'showTitle', 'value' => $_POST['showTitle'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
        }
        if (isset($_POST['showDescr'])) {
            $options[] = ['name' => 'showDescr', 'value' => $_POST['showDescr'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];
        }
        if (isset($_POST['slideshowSpeed'])) {
            $options[] = ['name' => 'slideshowSpeed', 'value' => $_POST['slideshowSpeed'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
        }
        if (isset($_POST['slideshowAuto'])) {
            $options[] = ['name' => 'slideshowAuto', 'value' => $_POST['slideshowAuto'], 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY'];
        }
        if (isset($_POST['rowHeight'])) {
            $options[] = ['name' => 'rowHeight', 'value' => $_POST['rowHeight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_ROWHEIGHT'];
        }
        if (isset($_POST['lastRow'])) {
            $options[] = ['name' => 'lastRow', 'value' => $_POST['lastRow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_LASTROW_DESC'];
        }
        if (isset($_POST['margins'])) {
            $options[] = ['name' => 'margins', 'value' => $_POST['margins'], 'caption' => '_AM_WGGALLERY_OPTION_GT_MARGINS'];
        }
        if (isset($_POST['outerborder'])) {
            $options[] = ['name' => 'outerborder', 'value' => $_POST['outerborder'], 'caption' => '_AM_WGGALLERY_OPTION_GT_OUTERBORDER'];
        }
        if (isset($_POST['randomize'])) {
            $options[] = ['name' => 'randomize', 'value' => $_POST['randomize'], 'caption' => '_AM_WGGALLERY_OPTION_GT_RANDOMIZE'];
        }
        if (isset($_POST['slideshow'])) {
            $options[] = ['name' => 'slideshow', 'value' => $_POST['slideshow'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOW'];
        }
        // if (isset($_POST['slideshow_options'])) {$options[] = array('name' => 'slideshow_options', 'value' => $_POST['slideshow_options']);}
        if (isset($_POST['colorboxstyle'])) {
            $options[] = ['name' => 'colorboxstyle', 'value' => $_POST['colorboxstyle'], 'caption' => '_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE'];
        }
        if (isset($_POST['transition'])) {
            $options[] = ['name' => 'transition', 'value' => $_POST['transition'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT'];
        }
        if (isset($_POST['speedOpen'])) {
            $options[] = ['name' => 'speedOpen', 'value' => $_POST['speedOpen'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN'];
        }
        if (isset($_POST['open'])) {
            $options[] = ['name' => 'open', 'value' => $_POST['open'], 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOOPEN'];
        }
        if (isset($_POST['opacity'])) {
            $options[] = ['name' => 'opacity', 'value' => $_POST['opacity'], 'caption' => '_AM_WGGALLERY_OPTION_OPACITIY'];
        }
        if (isset($_POST['slideshowtype'])) {
            $options[] = ['name' => 'slideshowtype', 'value' => $_POST['slideshowtype'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE'];
        }
        if (isset($_POST['button_close'])) {
            $options[] = ['name' => 'button_close', 'value' => $_POST['button_close'], 'caption' => '_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE'];
        }
        if (isset($_POST['navbar'])) {
            $options[] = ['name' => 'navbar', 'value' => $_POST['navbar'], 'caption' => '_AM_WGGALLERY_OPTION_GT_NAVBAR'];
        }
        if (isset($_POST['toolbar'])) {
            $options[] = ['name' => 'toolbar', 'value' => $_POST['toolbar'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBAR'];
        }
        if (isset($_POST['zoomable'])) {
            $options[] = ['name' => 'zoomable', 'value' => $_POST['zoomable'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM'];
        }
        if (isset($_POST['download'])) {
            $options[] = ['name' => 'download', 'value' => $_POST['download'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD'];
        }
        if (isset($_POST['fullscreen'])) {
            $options[] = ['name' => 'fullscreen', 'value' => $_POST['fullscreen'], 'caption' => '_AM_WGGALLERY_OPTION_GT_FULLSCREEN'];
        }
        if (isset($_POST['transitionDuration'])) {
            $options[] = ['name' => 'transitionDuration', 'value' => $_POST['transitionDuration'], 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION'];
        }
        if (isset($_POST['viewerjs_title'])) {
            $options[] = ['name' => 'viewerjs_title', 'value' => $_POST['viewerjs_title'], 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
        }
        if (isset($_POST['loop'])) {
            $options[] = ['name' => 'loop', 'value' => $_POST['loop'], 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
        }
        if (isset($_POST['showThumbnails'])) {
            $options[] = ['name' => 'showThumbnails', 'value' => $_POST['showThumbnails'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS'];
        }
        if (isset($_POST['showAlbumlabel'])) {
            $options[] = ['name' => 'showAlbumlabel', 'value' => $_POST['showAlbumlabel'], 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWLABEL'];
        }
        if (isset($_POST['indexImage'])) {
            $options[] = ['name' => 'indexImage', 'value' => $_POST['indexImage'], 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMG'];
        }
        if (isset($_POST['indexImageheight'])) {
            $options[] = ['name' => 'indexImageheight', 'value' => $_POST['indexImageheight'], 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT'];
        }

        // apply sort order
        $option_sort   = Request::getString('option_sort', '');
        $sort_arr      = explode('|', $option_sort);
        $options_final = []; // result array
        foreach ($sort_arr as $val) { // loop
            foreach ($options as $option) {
                if ($val == $option['name']) {
                    $options_final[] = ['name' => $option['name'], 'value' => $option['value'], 'caption' => $option['caption']];
                } // adding values
            }
        }
        $options_final[] = ['name' => 'option_sort', 'value' => $option_sort];

        // Set Vars
        $gallerytypesObj->setVar('gt_options', serialize($options_final));
        // Insert Data
        if ($gallerytypesHandler->insert($gallerytypesObj)) {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
        $form = $gallerytypesObj->getFormGallerytypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'reset':
        $gallerytypesObj = $gallerytypesHandler->get($gtId);
        $template        = $gallerytypesObj->getVar('gt_template');
        $primary         = $gallerytypesObj->getVar('gt_primary');
        if ($gallerytypesHandler->reset($gtId, $template, $primary)) {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        } else {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_ERROR);
        }
        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('gallerytypes.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($gtId)) {
            $gallerytypesObj = $gallerytypesHandler->get($gtId);
        } else {
            $gallerytypesObj = $gallerytypesHandler->create();
        }
        // Set Vars
        $gallerytypesObj->setVar('gt_primary', $_POST['gt_primary']);
        $gallerytypesObj->setVar('gt_name', $_POST['gt_name']);
        $gallerytypesObj->setVar('gt_desc', $_POST['gt_desc']);
        $gallerytypesObj->setVar('gt_credits', $_POST['gt_credits']);
        $gallerytypesObj->setVar('gt_template', $_POST['gt_template']);
        $gallerytypesObj->setVar('gt_options', $_POST['gt_options']);
        $gallerytypeDate = date_create_from_format(_SHORTDATESTRING, $_POST['gt_date']);
        $gallerytypesObj->setVar('gt_date', $gallerytypeDate->getTimestamp());
        // Insert Data
        if ($gallerytypesHandler->insert($gallerytypesObj)) {
            redirect_header('gallerytypes.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
        $form = $gallerytypesObj->getFormGallerytypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'edit':
        $templateMain = 'wggallery_admin_gallerytypes.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('gallerytypes.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_GALLERYTYPES_LIST, 'gallerytypes.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $gallerytypesObj = $gallerytypesHandler->get($gtId);
        $form            = $gallerytypesObj->getFormGallerytypes();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'delete':
        $gallerytypesObj = $gallerytypesHandler->get($gtId);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('gallerytypes.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($gallerytypesHandler->delete($gallerytypesObj)) {
                redirect_header('gallerytypes.php', 3, _CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $gallerytypesObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'gt_id' => $gtId, 'op' => 'delete'], $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $gallerytypesObj->getVar('gt_name')));
        }

        break;
}
require __DIR__ . '/footer.php';
