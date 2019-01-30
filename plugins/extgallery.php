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

require_once dirname(__DIR__) . '/include/common.php';

/**
 * @param none
 *
 * @return array
 */
function wggalleryPluginGetDataExtgallery() {
    // get number of albums
    $sql = 'SELECT `cat_id` FROM '.$GLOBALS['xoopsDB']->prefix('extgallery_publiccat');
    $result = $GLOBALS['xoopsDB']->query($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    $num_albums = $GLOBALS['xoopsDB']->getRowsNum( $result );
    // get number of images
    $sql = 'SELECT `photo_id` FROM '.$GLOBALS['xoopsDB']->prefix('extgallery_publicphoto');
    $result = $GLOBALS['xoopsDB']->query($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    $num_images = $GLOBALS['xoopsDB']->getRowsNum( $result );
    return [$num_albums, $num_images];
}

/**
 * @function getForm
 * @param 
 * @return XoopsThemeForm
 */
function wggalleryPluginGetFormExtgallery($im_name, $num_albums, $num_images)
{
    $helper = Wggallery\Helper::getInstance();
    $action = $_SERVER['REQUEST_URI'];

    // Get Theme Form
    xoops_load('XoopsFormLoader');
    $form = new \XoopsThemeForm(_AM_WGGALLERY_IMPORT, 'form', $action, 'post', true);
    $form->setExtra('enctype="multipart/form-data"');
    // Form Text 
    $form->addElement(new \XoopsFormLabel( _AM_WGGALLERY_IMPORT_SUPPORT, $im_name));
    // Form Text 
    $form->addElement(new \XoopsFormLabel( _AM_WGGALLERY_IMPORT_NUMALB, $num_albums));
    // Form Text 
    $form->addElement(new \XoopsFormLabel( _AM_WGGALLERY_IMPORT_NUMIMG, $num_images));
    // Form Select Albstate
    $albStateSelect = new \XoopsFormRadio( _CO_WGGALLERY_ALBUM_STATE, 'alb_state', WGGALLERY_STATE_OFFLINE_VAL);
    $albStateSelect->addOption(WGGALLERY_STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
    $albStateSelect->addOption(WGGALLERY_STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
    $albStateSelect->addOption(WGGALLERY_STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
    $form->addElement($albStateSelect);
    // Permissions
    $memberHandler = xoops_getHandler('member');
    $groupList = $memberHandler->getGroupList();
    $gpermHandler = xoops_getHandler('groupperm');
    $fullList[] = array_keys($groupList);
    $groupsCanViewCheckbox = new \XoopsFormCheckBox( '', 'groups_view[]', $fullList);
    $groupsCanDlFullAlbCheckbox = new \XoopsFormCheckBox( '', 'groups_dlfullalb[]', $fullList);
    $groupsCanDlImageLCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_large[]', $fullList);
    $groupsCanDlImageMCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_medium[]', $fullList);
    // To View
    $groupsCanViewCheckbox->addOptionArray($groupList);
    $groupsCanViewTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_VIEW, '&nbsp;' );
    $groupsCanViewTray->addElement($groupsCanViewCheckbox, false);
    $groupsCanViewAll = new \XoopsFormCheckBox( '', 'all_groups_view', 0);
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
    $groupsCanDlImageLTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE, '&nbsp;' );
    $groupsCanDlImageLTray->addElement($groupsCanDlImageLCheckbox, false);
    $groupsCanDlImageLAll = new \XoopsFormCheckBox( '', 'all_groups_dlimage_large', 0);
    $groupsCanDlImageLAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_large'" . ')"');
    $groupsCanDlImageLAll->addOption(1, _CO_WGGALLERY_ALL);
    $groupsCanDlImageLTray->addElement($groupsCanDlImageLAll, false);
    $form->addElement($groupsCanDlImageLTray);
    // To Download Medium Images
    $groupsCanDlImageMCheckbox->addOptionArray($groupList);
    $groupsCanDlImageMTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM, '&nbsp;' );
    $groupsCanDlImageMTray->addElement($groupsCanDlImageMCheckbox, false);
    $groupsCanDlImageMAll = new \XoopsFormCheckBox( '', 'all_groups_dlimage_medium', 0);
    $groupsCanDlImageMAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_medium'" . ')"');
    $groupsCanDlImageMAll->addOption(1, _CO_WGGALLERY_ALL);
    $groupsCanDlImageMTray->addElement($groupsCanDlImageMAll, false);
    $form->addElement($groupsCanDlImageMTray);

    // Form Select User AlbSubmitter
    $alb_submitter = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
    $form->addElement(new \XoopsFormSelectUser( _CO_WGGALLERY_SUBMITTER, 'alb_submitter', false, $alb_submitter ));
    // To Save
    $form->addElement(new \XoopsFormHidden('op', 'import_' . $im_name));
    $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
    return $form;
}

/**
 * @param none
 *
 * @return array
 */
function wggalleryPluginExecImportExtgallery($albState = 0, $albSubmitter = 0) {
    // define source image path
    $dir_original = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/original/';
    $dir_large    = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/large/';
    $dir_medium   = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/medium/';
    $dir_thumb    = XOOPS_ROOT_PATH . '/uploads/extgallery/public-photo/thumb/thumb_';
    
    // copy album data and album images
    // import all album data    
    $sql = 'INSERT INTO ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums');
    $sql .= ' ( alb_id, alb_pid, alb_name, alb_desc, alb_date, alb_iscat, alb_weight, alb_image, alb_imgid, alb_imgcat, ';
    $sql .= 'alb_state, alb_submitter ) ';
    $sql .= "SELECT ec.cat_id, ec.cat_pid, ec.cat_name, ec.cat_desc, ec.cat_date, Not (ec.cat_isalbum) AS iscat, ec.cat_weight, ec.cat_imgurl, If(ec.cat_imgurl='', ec.photo_id, 0), If(ec.cat_imgurl='', 1, 2), ";
    $sql .= $albState .  ', ' . $albSubmitter;
    $sql .= ' FROM '. $GLOBALS['xoopsDB']->prefix('extgallery_publiccat') . ' as ec';
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    unset ($result);
    
    // copy album images
    $sql = 'SELECT `cat_id`, `cat_imgurl`, `photo_id` FROM '.$GLOBALS['xoopsDB']->prefix('extgallery_publiccat');
    $result = $GLOBALS['xoopsDB']->query($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    while (false !== (list($cat_id, $cat_imgurl, $photo_id) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        if ( '' !== $cat_imgurl) {
            $imageName = basename($cat_imgurl);
            $sql = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . " SET alb_image = '" . $imageName . "' WHERE (((wgg_wggallery_albums.alb_id)=" . $cat_id . '))';
            $result2 = $GLOBALS['xoopsDB']->query($sql);
            $content = file_get_contents($cat_imgurl);
            file_put_contents(WGGALLERY_UPLOAD_IMAGE_PATH . '/albums/' . $imageName, $content);
        }
    }
    unset ($result);
    unset ($result2);
    $sql = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . " SET alb_image = 'noimage.png', alb_imgcat = 2 WHERE (alb_image='' and alb_imgid=0)";
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    unset ($result);
    
    // create perms for each album
    $sql = 'SELECT `alb_id` FROM '.$GLOBALS['xoopsDB']->prefix('wggallery_albums');
    $result = $GLOBALS['xoopsDB']->query($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    while (false !== (list($albId) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $permId = $albId;
        $perm_modid = $GLOBALS['xoopsModule']->getVar('mid');
        $gpermHandler = xoops_getHandler('groupperm');
        // set selected rights
        // Permission to view
        if(isset($_POST['groups_view'])) {
            foreach($_POST['groups_view'] as $onegroupId) {
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
        if(isset($_POST['groups_dlimage_large'])) {
            foreach($_POST['groups_dlimage_large'] as $onegroupId) {
                $gpermHandler->addRight('wggallery_dlimage_large', $permId, $onegroupId, $perm_modid);
            }
        }
        // Permission to download medium images
        if(isset($_POST['groups_dlimage_medium'])) {
            foreach($_POST['groups_dlimage_medium'] as $onegroupId) {
                $gpermHandler->addRight('wggallery_dlimage_medium', $permId, $onegroupId, $perm_modid);
            }
        }
    }
    unset ($result);
    
    // copy images and image data
    // import all album data
    $sql = 'INSERT INTO ' . $GLOBALS['xoopsDB']->prefix('wggallery_images');
    $sql .= ' ( img_id, img_title, img_desc, img_name, img_namelarge, img_nameorig, img_size, img_resx, img_resy, img_ratinglikes, ';
    $sql .= 'img_downloads, img_weight, img_albid, img_submitter, img_date ) ';
    $sql .= 'SELECT ep.photo_id, ep.photo_title, ep.photo_desc, ep.photo_name, ep.photo_name, ep.photo_orig_name, ep.photo_size, ep.photo_res_x, ep.photo_res_y, ep.photo_rating, ';
    $sql .= 'ep.photo_download, ep.photo_weight, ep.cat_id, ep.uid, ' . time();
    $sql .= ' FROM '. $GLOBALS['xoopsDB']->prefix('extgallery_publicphoto') . ' as ep'; 
    $result = $GLOBALS['xoopsDB']->queryF($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    unset ($result);
    
    // copy all images
    $sql = 'SELECT `photo_id`, `photo_name` FROM '.$GLOBALS['xoopsDB']->prefix('extgallery_publicphoto');
    $result = $GLOBALS['xoopsDB']->query($sql) or die ('MySQL-Error: ' . $GLOBALS['xoopsDB']->error());  
    while (false !== (list($photo_id, $photo_name) = $GLOBALS['xoopsDB']->fetchRow($result))) {
        $imageEG = basename($cat_imgurl);
        $largeExists    = file_exists($dir_large . $photo_name)? 1 : 0;
        $mediumExists   = file_exists($dir_medium . $photo_name)? 1 : 0;
        $thumbExists    = file_exists($dir_thumb . $photo_name)? 1 : 0;
        if ( $largeExists ) {
            copy( $dir_large . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $photo_name );
        } else {
            copy( $dir_medium . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $photo_name );
        }
        if ( $mediumExists ) {
            copy( $dir_medium . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $photo_name );
        }
        if ( $thumbExists ) {
            copy( $dir_thumb . $photo_name, WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $photo_name );
        }
    }
    return true;
}
