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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require_once dirname(__DIR__) . '/include/common.php';

/**
 * @return array
 */
function wggalleryPluginGetDataTdmpicture()
{
    // get number of albums
    $sql = 'SELECT `cat_id` FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_cat');
    $result = $GLOBALS['xoopsDB']->query($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    $num_albums = $GLOBALS['xoopsDB']->getRowsNum($result);
    // get number of images
    $sql = 'SELECT `file_id` FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_file');
    $result = $GLOBALS['xoopsDB']->query($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    $num_images = $GLOBALS['xoopsDB']->getRowsNum($result);

    return [$num_albums, $num_images];
}

/**
 * @function getForm
 * @param mixed $im_name
 * @param mixed $num_albums
 * @param mixed $num_images
 * @return XoopsThemeForm
 */
function wggalleryPluginGetFormTdmpicture($im_name, $num_albums, $num_images)
{
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    $action = $_SERVER['REQUEST_URI'];

    // Get Theme Form
    xoops_load('XoopsFormLoader');
    $form = new \XoopsThemeForm(_AM_WGGALLERY_IMPORT, 'form', $action, 'post', true);
    $form->setExtra('enctype="multipart/form-data"');
    // Form Text
    $form->addElement(new \XoopsFormLabel(_AM_WGGALLERY_IMPORT_SUPPORT, $im_name));
    // Form Text
    $form->addElement(new \XoopsFormLabel(_AM_WGGALLERY_IMPORT_NUMALB, $num_albums));
    // Form Text
    $form->addElement(new \XoopsFormLabel(_AM_WGGALLERY_IMPORT_NUMIMG, $num_images));
    // Permissions
    $memberHandler              = xoops_getHandler('member');
    $groupList                  = $memberHandler->getGroupList();
    $gpermHandler               = xoops_getHandler('groupperm');
    $fullList[]                 = array_keys($groupList);
    $groupsCanViewCheckbox      = new \XoopsFormCheckBox('', 'groups_view', $fullList);
    $groupsCanDlFullAlbCheckbox = new \XoopsFormCheckBox('', 'groups_dlfullalb', $fullList);
    $groupsCanDlImageLCheckbox  = new \XoopsFormCheckBox('', 'groups_dlimage_large', $fullList);
    $groupsCanDlImageMCheckbox  = new \XoopsFormCheckBox('', 'groups_dlimage_medium', $fullList);
    // To View
    $groupsCanViewCheckbox->addOptionArray($groupList);
    $groupsCanViewTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_VIEW, '&nbsp;');
    $groupsCanViewTray->addElement($groupsCanViewCheckbox, false);
    $groupsCanViewAll = new \XoopsFormCheckBox('', 'all_groups_view', 0);
    $groupsCanViewAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_view'" . ')"');
    $groupsCanViewAll->addOption(1, _CO_WGGALLERY_ALL);
    $groupsCanViewTray->addElement($groupsCanViewAll, false);
    $form->addElement($groupsCanViewTray);

    // TODO
    // To Download full album
    // $groupsCanDlFullAlbCheckbox->addOptionArray($groupList);
    // $groupsCanDlFullAlbTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLFULLALB, '&nbsp;' );
    // $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbCheckbox, false);
    // $groupsCanDlFullAlbAll = new \XoopsFormCheckBox( '', 'all_groups_dlfullalb', 0);
    // $groupsCanDlFullAlbAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlfullalb'" . ')"');
    // $groupsCanDlFullAlbAll->addOption(1, _CO_WGGALLERY_ALL);
    // $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbAll, false);
    // $form->addElement($groupsCanDlFullAlbTray);

    // To Download Large Images
    $groupsCanDlImageLCheckbox->addOptionArray($groupList);
    $groupsCanDlImageLTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE, '&nbsp;');
    $groupsCanDlImageLTray->addElement($groupsCanDlImageLCheckbox, false);
    $groupsCanDlImageLAll = new \XoopsFormCheckBox('', 'all_groups_dlimage_large', 0);
    $groupsCanDlImageLAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_large'" . ')"');
    $groupsCanDlImageLAll->addOption(1, _CO_WGGALLERY_ALL);
    $groupsCanDlImageLTray->addElement($groupsCanDlImageLAll, false);
    $form->addElement($groupsCanDlImageLTray);
    // To Download Medium Images
    $groupsCanDlImageMCheckbox->addOptionArray($groupList);
    $groupsCanDlImageMTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM, '&nbsp;');
    $groupsCanDlImageMTray->addElement($groupsCanDlImageMCheckbox, false);
    $groupsCanDlImageMAll = new \XoopsFormCheckBox('', 'all_groups_dlimage_medium', 0);
    $groupsCanDlImageMAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_medium'" . ')"');
    $groupsCanDlImageMAll->addOption(1, _CO_WGGALLERY_ALL);
    $groupsCanDlImageMTray->addElement($groupsCanDlImageMAll, false);
    $form->addElement($groupsCanDlImageMTray);

    // To Save
    $form->addElement(new \XoopsFormHidden('op', 'import_' . $im_name));
    $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

    return $form;
}

/**
 * @return bool
 */
function wggalleryPluginExecImportTdmpicture()
{
    // define source image path
    $dir_original = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/original/';
    $dir_large    = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/large/';
    $dir_medium   = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/medium/';
    $dir_thumb    = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/thumb/thumb_';

    // copy album data and album images
    // import all album data
    $sql = 'INSERT INTO ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums');
    $sql .= ' ( alb_id, alb_pid, alb_name, alb_date, alb_desc, alb_imgtype, alb_image, alb_weight, alb_state, alb_submitter ) ';
    $sql .= 'SELECT tc.cat_id, tc.cat_pid, tc.cat_title, tc.cat_date, tc.cat_text, 1, tc.cat_img, tc.cat_weight, If(tc.cat_display=1,' . Constants::STATE_OFFLINE_VAL . ',' . Constants::STATE_OFFLINE_VAL . '), tc.cat_uid';
    $sql .= ' FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_cat') . ' as tc';
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    unset($result);

    $sql = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . " SET alb_image = 'blank.gif' WHERE (alb_image='blank.png')";
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());

    // copy album images
    $sql = 'SELECT `cat_id`, `cat_img` FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_cat');
    $result = $GLOBALS['xoopsDB']->query($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    while (false !== (list($cat_id, $cat_imgurl) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $imageName = basename($cat_imgurl);
        if ('' !== $imageName) {
            $sql = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . ' SET alb_imgtype = 2 WHERE (alb_id=' . $cat_id . ')';
            $result2 = $GLOBALS['xoopsDB']->queryF($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
            if ('blank.png' !== $imageName) {
                copy(XOOPS_ROOT_PATH . '/uploads/tdmpicture/cat/' . $imageName, WGGALLERY_UPLOAD_IMAGE_PATH . '/albums/' . $imageName);
            }
        }
    }
    unset($result);
    unset($result2);

    // create perms for each album
    $sql = 'SELECT `alb_id` FROM ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums');
    $result = $GLOBALS['xoopsDB']->query($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    while (false !== (list($albId) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $permId       = $albId;
        $perm_modid   = $GLOBALS['xoopsModule']->getVar('mid');
        $gpermHandler = xoops_getHandler('groupperm');
        // set selected rights
        // Permission to view
        if (isset($_POST['groups_view'])) {
            foreach ($_POST['groups_view'] as $onegroupId) {
                $gpermHandler->addRight('wggallery_view', $permId, $onegroupId, $perm_modid);
            }
        }
        //TODO
        // Permission to download full album
        // if(isset($_POST['groups_dlfullalb'])) {
        // foreach($_POST['groups_dlfullalb'] as $onegroupId) {
        // $gpermHandler->addRight('wggallery_dlfullalb', $permId, $onegroupId, $perm_modid);
        // }
        // }
        // Permission to download large images
        if (isset($_POST['groups_dlimage_large'])) {
            foreach ($_POST['groups_dlimage_large'] as $onegroupId) {
                $gpermHandler->addRight('wggallery_dlimage_large', $permId, $onegroupId, $perm_modid);
            }
        }
        // Permission to download medium images
        if (isset($_POST['groups_dlimage_medium'])) {
            foreach ($_POST['groups_dlimage_medium'] as $onegroupId) {
                $gpermHandler->addRight('wggallery_dlimage_medium', $permId, $onegroupId, $perm_modid);
            }
        }
    }
    unset($result);

    // copy images and image data
    // import all album data
    $sql = 'INSERT INTO ' . $GLOBALS['xoopsDB']->prefix('wggallery_images');
    $sql .= ' ( img_id, img_albid, img_name, img_title, img_desc, img_mimetype, img_state, img_ratinglikes, img_downloads, img_date, ';
    $sql .= 'img_submitter, img_size, img_resx, img_resy ) ';
    $sql .= 'SELECT tp.file_id, tp.file_cat, tp.file_file, tp.file_title, tp.file_text, tp.file_type, tp.file_display, tp.file_hits, tp.file_dl, tp.file_indate, ';
    $sql .= 'tp.file_uid, tp.file_size, tp.file_res_x, tp.file_res_y ';
    $sql .= ' FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_file') . ' as tp';
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    unset($result);

    // copy all images
    $sql = 'SELECT `file_id`, `file_file` FROM ' . $GLOBALS['xoopsDB']->prefix('tdmpicture_file');
    $result = $GLOBALS['xoopsDB']->query($sql) or die('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());
    while (false !== (list($photo_id, $photo_name) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        copy(XOOPS_ROOT_PATH . '/uploads/tdmpicture/' . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $photo_name);
        copy(XOOPS_ROOT_PATH . '/uploads/tdmpicture/' . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $photo_name);
        copy(XOOPS_ROOT_PATH . '/uploads/tdmpicture/thumb/' . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $photo_name);
    }

    return true;
}
