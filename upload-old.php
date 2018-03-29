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
 * @version        $Id: 1.0 submit.php 1 Sat 2018-03-17 09:55:45Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
xoops_loadLanguage('admin', 'wggallery');
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'form');
// Template
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_upload.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
$GLOBALS['xoTheme']->addStylesheet($style, null);
$GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
$GLOBALS['xoTheme']->addScript('browse.php?modules/wggallery/fineuploader/jquery.fine-uploader.js');
$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/wggallery/fineuploader/fine-uploader-new.css', null);

echo "<br>Dir:" . getcwd();
echo "<br>Dir:" . dirname(dirname(__DIR__)) . '\mainfile.php';
/*
switch($op) {
    case 'form':
    default:
        // Navigation
        $navigation = _MA_WGGALLERY_SUBMIT_PROPOSER;
        $GLOBALS['xoopsTpl']->assign('navigation', $navigation);
        // Title of page
        $title = _MA_WGGALLERY_SUBMIT_PROPOSER . '&nbsp;-&nbsp;';
        $title .= $GLOBALS['xoopsModule']->name();
        $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', $title);
        // Description
        $GLOBALS['xoTheme']->addMeta( 'meta', 'description', strip_tags(_MA_WGGALLERY_SUBMIT_PROPOSER));
        // Form Create
        $picturesObj = $picturesHandler->create();
        $form = $picturesObj->getFormPictures();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

    break;
    case 'save':
        // Security Check
        if(!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('pictures.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $picturesObj = $picturesHandler->create();
        $pictureDate = date_create_from_format(_SHORTDATESTRING, $_POST['pic_date']);
        $picturesObj->setVar('pic_date', $pictureDate->getTimestamp());
        // Insert Data
        if($picturesHandler->insert($picturesObj)) {
            redirect_header('index.php', 2, _MA_WGGALLERY_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $picturesObj->getHtmlErrors());
        $form = $picturesObj->getFormPictures();
        $GLOBALS['xoopsTpl']->assign('form', $form->display());

    break;
} */
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_SUBMIT);
include __DIR__ . '/footer.php';
