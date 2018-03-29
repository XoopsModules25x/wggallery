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
 * @version        $Id: 1.0 submit.php 1 Mon 2018-03-19 10:04:55Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
xoops_loadLanguage('admin', 'wggallery');
// It recovered the value of argument op in URL$
$op = XoopsRequest::getString('op', 'form');
// Template
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_submit.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';
$GLOBALS['xoTheme']->addStylesheet($style, null);
$permSubmit = $gpermHandler->checkRight('wggallery_ac', 4, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
// Redirection if not permissions
if ($permSubmit === false) {
    redirect_header('index.php', 2, _NOPERM);
    exit();
}
switch ($op) {
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
        $GLOBALS['xoTheme']->addMeta('meta', 'description', strip_tags(_MA_WGGALLERY_SUBMIT_PROPOSER));
        // Form Create
        $imagesObj = $imagesHandler->create();
        $form      = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('images.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $imagesObj = $imagesHandler->create();
        $imageDate = date_create_from_format(_SHORTDATESTRING, $_POST['img_date']);
        $imagesObj->setVar('img_date', $imageDate->getTimestamp());
        // Insert Data
        if ($imagesHandler->insert($imagesObj)) {
            redirect_header('index.php', 2, _MA_WGGALLERY_FORM_OK);
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $imagesObj->getHtmlErrors());
        $form = $imagesObj->getFormImages();
        $GLOBALS['xoopsTpl']->assign('form', $form->display());

        break;
}
// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _MA_WGGALLERY_SUBMIT);
include __DIR__ . '/footer.php';
