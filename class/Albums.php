<?php

namespace XoopsModules\Wggallery;

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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Albums
 */
class Albums extends \XoopsObject
{
    public $start;

    public $limit;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('alb_id', XOBJ_DTYPE_INT);
        $this->initVar('alb_pid', XOBJ_DTYPE_INT);
        $this->initVar('alb_iscoll', XOBJ_DTYPE_INT);
        $this->initVar('alb_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('alb_desc', XOBJ_DTYPE_TXTAREA);
        $this->initVar('alb_weight', XOBJ_DTYPE_INT);
        $this->initVar('alb_imgtype', XOBJ_DTYPE_INT);
        $this->initVar('alb_image', XOBJ_DTYPE_TXTBOX);
        $this->initVar('alb_imgid', XOBJ_DTYPE_INT);
        $this->initVar('alb_state', XOBJ_DTYPE_INT);
        $this->initVar('alb_wmid', XOBJ_DTYPE_INT);
        $this->initVar('alb_cats', XOBJ_DTYPE_TXTAREA);
        $this->initVar('alb_tags', XOBJ_DTYPE_TXTAREA);
        $this->initVar('alb_date', XOBJ_DTYPE_INT);
        $this->initVar('alb_submitter', XOBJ_DTYPE_INT);
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     * @return int inserted id
     */
    public function getNewInsertedIdAlbums()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();

        return $newInsertedId;
    }

    /**
     * @public function getFormAlbums
     * @param bool $action
     * @param bool $admin
     * @return \XoopsThemeForm
     */
    public function getFormAlbums($action = false, $admin = false)
    {
        /** @var \XoopsModules\Wggallery\Helper $helper */
        $helper        = \XoopsModules\Wggallery\Helper::getInstance();
        $albumsHandler = $helper->getHandler('Albums');
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? sprintf(_CO_WGGALLERY_ALBUM_ADD) : sprintf(_CO_WGGALLERY_ALBUM_EDIT);
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text AlbName
        $form->addElement(new \XoopsFormText(_CO_WGGALLERY_ALBUM_NAME, 'alb_name', 50, 255, $this->getVar('alb_name')), true);
        // Form Select Parent Album
        $albumsHandler      = $helper->getHandler('Albums');
        $permissionsHandler = $helper->getHandler('Permissions');
        $criteria           = new \CriteriaCompo();
        $criteria->add(new \Criteria('alb_id', $this->getVar('alb_id'), '<>'));
        $criteria->setSort('alb_weight ASC, alb_date');
        $criteria->setOrder('DESC');
        $albPid = new \XoopsFormSelect(_CO_WGGALLERY_ALBUM_PID, 'alb_pid', $this->getVar('alb_pid'));
        $albPid->addOption(0, '&nbsp;');
        $albumsAll = $albumsHandler->getAll($criteria);
        foreach (array_keys($albumsAll) as $i) {
            if ($permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'))) {
                $albName   = $albumsAll[$i]->getVar('alb_name');
                $albAlbPid = $albumsAll[$i]->getVar('alb_pid');
                if ($albAlbPid > 0) {
                    $albumsObj = $albumsHandler->get($albAlbPid);
                    if (is_object($albumsObj)) {
                        $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                    } else {
                        $albName .= ' (' . _CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                    }
                }
                $albPid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
            }
        }
        $form->addElement($albPid);
        unset($criteria);
        // Form editor AlbDesc
        $editorConfigs           = [];
        $editorConfigs['name']   = 'alb_desc';
        $editorConfigs['value']  = $this->getVar('alb_desc', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $helper->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(_CO_WGGALLERY_ALBUM_DESC, 'alb_desc', $editorConfigs));
        // Form Text AlbWeight
        $albWeight = $this->isNew() ? '0' : $this->getVar('alb_weight');
        $form->addElement(new \XoopsFormHidden('alb_weight', $albWeight));

        // Form Album image
        $albImgcat = $this->isNew() ? Constants::ALBUM_IMGCAT_USE_UPLOADED_VAL : $this->getVar('alb_imgtype');
        $albImage  = $this->isNew() ? 'noimage.png' : $this->getVar('alb_image');
        $albImgid  = $this->isNew() ? 0 : $this->getVar('alb_imgid');
        if ($admin) {
            $albImgcatSelect = new \XoopsFormRadio(_CO_WGGALLERY_ALBUM_IMGTYPE, 'alb_imgtype', $albImgcat);
            $albImgcatSelect->addOption(Constants::ALBUM_IMGCAT_USE_UPLOADED_VAL, _CO_WGGALLERY_ALBUM_USE_UPLOADED);
            $albImgcatSelect->addOption(Constants::ALBUM_IMGCAT_USE_EXIST_VAL, _CO_WGGALLERY_ALBUM_IMGID);
            $form->addElement($albImgcatSelect);
            $form->addElement(new \XoopsFormText(_AM_WGGALLERY_ALBUM_IMGNAME, 'alb_image', 50, 255, $albImage));
            $form->addElement(new \XoopsFormText(_AM_WGGALLERY_ALBUM_IMGID, 'alb_imgid', 50, 255, $albImgid));
        } else {
            $form->addElement(new \XoopsFormHidden('alb_imgtype', $albImgcat));
            $form->addElement(new \XoopsFormHidden('alb_image', $albImage));
            $form->addElement(new \XoopsFormHidden('alb_imgid', $albImgid));
        }

        // Form Select Albstate
        $albState       = $this->isNew() ? 0 : $this->getVar('alb_state');
        $albStateSelect = new \XoopsFormRadio(_CO_WGGALLERY_ALBUM_STATE, 'alb_state', $albState);
        $albStateSelect->addOption(Constants::STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
        $albStateSelect->addOption(Constants::STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
        if (Constants::STATE_APPROVAL_VAL == $albState) {
            $albStateSelect->addOption(Constants::STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
        }
        $form->addElement($albStateSelect);

        // Permissions
        $memberHandler = xoops_getHandler('member');
        $groupList     = $memberHandler->getGroupList();
        $gpermHandler  = xoops_getHandler('groupperm');
        if ($this->isNew()) {
            $groupsIdsView        = $gpermHandler->getGroupIds('wggallery_albdefault', 4, $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsView[]      = array_values($groupsIdsView);
            $groupsIdsDlFullAlb   = $gpermHandler->getGroupIds('wggallery_albdefault', 8, $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlFullAlb[] = array_values($groupsIdsDlFullAlb);
            $groupsIdsDlImageL    = $gpermHandler->getGroupIds('wggallery_albdefault', 16, $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlImageL[]  = array_values($groupsIdsDlImageL);
            $groupsIdsDlImageM    = $gpermHandler->getGroupIds('wggallery_albdefault', 32, $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlImageM[]  = array_values($groupsIdsDlImageM);
        } else {
            $groupsIdsView        = $gpermHandler->getGroupIds('wggallery_view', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsView[]      = array_values($groupsIdsView);
            $groupsIdsDlFullAlb   = $gpermHandler->getGroupIds('wggallery_dlfullalb', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlFullAlb[] = array_values($groupsIdsDlFullAlb);
            $groupsIdsDlImageL    = $gpermHandler->getGroupIds('wggallery_dlimage_large', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlImageL[]  = array_values($groupsIdsDlImageL);
            $groupsIdsDlImageM    = $gpermHandler->getGroupIds('wggallery_dlimage_medium', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsDlImageM[]  = array_values($groupsIdsDlImageM);
        }
        // To View
        $groupsCanViewCheckbox = new \XoopsFormCheckBox('', 'groups_view', $groupsIdsView);
        $groupsCanViewCheckbox->addOptionArray($groupList);
        $groupsCanViewTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_VIEW, '&nbsp;');
        $groupsCanViewTray->addElement($groupsCanViewCheckbox, false);
        $groupsCanViewAll = new \XoopsFormCheckBox('', 'all_groups_view', 0);
        $groupsCanViewAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_view'" . ')"');
        $groupsCanViewAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanViewTray->addElement($groupsCanViewAll, false);
        $form->addElement($groupsCanViewTray);
        // To Download full album
        $groupsCanDlFullAlbCheckbox = new \XoopsFormCheckBox('', 'groups_dlfullalb', $groupsIdsDlFullAlb);
        $groupsCanDlFullAlbCheckbox->addOptionArray($groupList);
        $groupsCanDlFullAlbTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLFULLALB, '&nbsp;');
        $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbCheckbox, false);
        $groupsCanDlFullAlbAll = new \XoopsFormCheckBox('', 'all_groups_dlfullalb', 0);
        $groupsCanDlFullAlbAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlfullalb'" . ')"');
        $groupsCanDlFullAlbAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbAll, false);
        $form->addElement($groupsCanDlFullAlbTray);
        // To Download Large Images
        $groupsCanDlImageLCheckbox = new \XoopsFormCheckBox('', 'groups_dlimage_large', $groupsIdsDlImageL);
        $groupsCanDlImageLCheckbox->addOptionArray($groupList);
        $groupsCanDlImageLTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE, '&nbsp;');
        $groupsCanDlImageLTray->addElement($groupsCanDlImageLCheckbox, false);
        $groupsCanDlImageLAll = new \XoopsFormCheckBox('', 'all_groups_dlimage_large', 0);
        $groupsCanDlImageLAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_large'" . ')"');
        $groupsCanDlImageLAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlImageLTray->addElement($groupsCanDlImageLAll, false);
        $form->addElement($groupsCanDlImageLTray);
        // To Download Medium Images
        $groupsCanDlImageMCheckbox = new \XoopsFormCheckBox('', 'groups_dlimage_medium', $groupsIdsDlImageM);
        $groupsCanDlImageMCheckbox->addOptionArray($groupList);
        $groupsCanDlImageMTray = new \XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM, '&nbsp;');
        $groupsCanDlImageMTray->addElement($groupsCanDlImageMCheckbox, false);
        $groupsCanDlImageMAll = new \XoopsFormCheckBox('', 'all_groups_dlimage_medium', 0);
        $groupsCanDlImageMAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_medium'" . ')"');
        $groupsCanDlImageMAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlImageMTray->addElement($groupsCanDlImageMAll, false);
        $form->addElement($groupsCanDlImageMTray);

        // Form Select Album watermark
        $albWmid = $this->isNew() ? 0 : $this->getVar('alb_wmid');
        // is there a watermark for usage in all albums
        $watermarksHandler = $helper->getHandler('Watermarks');
        $criteria          = new \CriteriaCompo();
        $countWmTotal      = $watermarksHandler->getCount($criteria);
        if ($countWmTotal > 0) {
            $criteria->add(new \Criteria('wm_usage', Constants::WATERMARK_USAGEALL));
            $countWm = $watermarksHandler->getCount($criteria);
            $wmname  = '';
            if ($countWm > 0) {
                if (0 === $albWmid) {
                    // load "usage for all" as default
                    $watermarksAll = $watermarksHandler->getAll($criteria);
                    foreach (array_keys($watermarksAll) as $wm) {
                        $watermarkObj = $watermarksAll[$wm]->getValuesWatermarks();
                        $albWmid      = $watermarkObj['wm_id'];
                        $wmname       = $watermarkObj['wm_name'];
                    }
                }
                $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_WATERMARK, $wmname));
                $form->addElement(new \XoopsFormHidden('alb_wmid', $albWmid));
            } else {
                $albWidSelect = new \XoopsFormSelect(_CO_WGGALLERY_WATERMARK, 'alb_wmid', $albWmid);
                $albWidSelect->addOption(0, '&nbsp;');
                $criteria = new \CriteriaCompo();
                $criteria->add(new \Criteria('wm_usage', Constants::WATERMARK_USAGENONE, '>'));
                $albWidSelect->addOptionArray($watermarksHandler->getList($criteria));
                $form->addElement($albWidSelect);
            }
        } else {
            $form->addElement(new \XoopsFormHidden('alb_wmid', '0'));
        }
        unset($criteria);

        // Form Text Select AlbCats
        $albCats = $this->isNew() ? [] : unserialize($this->getVar('alb_cats'));
        if ($helper->getConfig('use_categories')) {
            $categoriesHandler = $helper->getHandler('Categories');
            $crCategories      = new \CriteriaCompo();
            $crCategories->add(new \Criteria('cat_album', 1));
            $categoriesCount = $categoriesHandler->getCount($crCategories);
            if ($categoriesCount > 0) {
                $categoriesAll    = $categoriesHandler->getAll($crCategories);
                $selectCategories = new \XoopsFormCheckBox(_CO_WGGALLERY_CATS_SELECT, 'alb_cats', $albCats);
                foreach (array_keys($categoriesAll) as $i) {
                    $selectCategories->addOption($categoriesAll[$i]->getVar('cat_id'), $categoriesAll[$i]->getVar('cat_text'));
                }
                $form->addElement($selectCategories, false);
            }
        } else {
            $form->addElement(new \XoopsFormHidden('alb_cats', ''));
        }
        // Form Text AlbTags
        if ($helper->getConfig('use_tags')) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_TAGS_ENTER, 'alb_tags', 50, 255, $this->getVar('alb_tags')), false);
        } else {
            $form->addElement(new \XoopsFormHidden('alb_tags', $this->getVar('alb_tags')));
        }

        // Form Text Date Select AlbDate
        $albDate = $this->isNew() ? 0 : $this->getVar('alb_date');
        $form->addElement(new \XoopsFormTextDateSelect(_CO_WGGALLERY_DATE, 'alb_date', '', $albDate));
        // Form Select User AlbSubmitter
        if ($this->isNew()) {
            $alb_submitter = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
        } else {
            $alb_submitter = $this->getVar('alb_submitter');
        }
        $form->addElement(new \XoopsFormSelectUser(_CO_WGGALLERY_SUBMITTER, 'alb_submitter', false, $alb_submitter));

        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $btnTray = new \XoopsFormElementTray('', '&nbsp;');
        $btnTray->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        if (!$admin) {
            $btnSubmitUpload = new \XoopsFormButton('', 'submit_upload', _CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD, 'submit');
            $btnSubmitUpload->setClass('btn btn-primary');
            $btnTray->addElement($btnSubmitUpload);
        }
        $form->addElement($btnTray);

        return $form;
    }

    /**
     * @public function getFormUploadToAlbum:
     * provide form with a dropdown select containing all existing albums
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormUploadToAlbum($action = false)
    {
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_CO_WGGALLERY_ALBUM_SELECT, 'formselalbum', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Table Albums
        $albumsHandler      = $helper->getHandler('Albums');
        $permissionsHandler = $helper->getHandler('Permissions');
        $crAlbums           = new \CriteriaCompo();
        $crAlbums->add(new \Criteria('alb_iscoll', 0));
        $crAlbums->setSort('alb_weight ASC, alb_date');
        $crAlbums->setOrder('DESC');
        // Form Select Albums
        $albIdSelect = new \XoopsFormSelect(_CO_WGGALLERY_ALBUM_SELECT, 'alb_id', $this->getVar('alb_id'));
        $albIdSelect->setExtra('onchange="submit()"');
        $albIdSelect->addOption(0, '&nbsp;');
        $albumsAll = $albumsHandler->getAll($crAlbums);

        foreach (array_keys($albumsAll) as $i) {
            if ($permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'))) {
                $albName = $albumsAll[$i]->getVar('alb_name');
                $albPid  = $albumsAll[$i]->getVar('alb_pid');
                if ($albPid > 0) {
                    $albumsObj = $albumsHandler->get($albPid);
                    if (is_object($albumsObj)) {
                        $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                    } else {
                        $albName .= ' (' . _CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                    }
                }
                $albIdSelect->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
            }
        }
        $form->addElement($albIdSelect);
        unset($crAlbums);

        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));

        return $form;
    }

    /**
     * @public function getFormUploadAlbumimage:
     * provide form for uploading a new album image
     * @return \XoopsThemeForm
     */
    public function getFormUploadAlbumimage()
    {
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm('', 'formalbumimmage', 'album_images.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form File AlbImage
        // uploaded images
        $imageTray2 = new \XoopsFormElementTray(_CO_WGGALLERY_ALBUM_USE_UPLOADED, '<br>');
        $albImage   = $this->getVar('alb_image');
        if ('' == $albImage) {
            $albImage = 'blank.gif';
        }
        $imageDirectory = '/uploads/wggallery/images/albums';
        $imageSelect    = new \XoopsFormSelect(sprintf(_CO_WGGALLERY_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'alb_image', $albImage, 5);
        $imageArray     = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $imageDirectory);
        foreach ($imageArray as $imagepreview2) {
            $imageSelect->addOption((string)$imagepreview2, $imagepreview2);
        }
        $imageSelect->setExtra("onchange='showImgSelected(\"imagepreview2\", \"alb_image\", \"" . $imageDirectory . '", "", "' . XOOPS_URL . "\")'");
        $imageTray2->addElement($imageSelect, false);
        $imageTray2->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . $imageDirectory . '/' . $albImage . "' name='imagepreview2' id='imagepreview2' alt='' style='max-width:100px'>"));
        $form->addElement($imageTray2);

        // upload new image
        $imageTray3      = new \XoopsFormElementTray(_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE, '<br>');
        $imageFileSelect = new \XoopsFormFile('', 'attachedfile', $helper->getConfig('maxsize'));
        $imageTray3->addElement($imageFileSelect);
        $form->addElement($imageTray3);

        $form->addElement(new \XoopsFormHidden('alb_id', $this->getVar('alb_id')));
        $form->addElement(new \XoopsFormHidden('alb_state', $this->getVar('alb_state')));
        $form->addElement(new \XoopsFormHidden('alb_pid', $this->getVar('alb_pid')));
        $form->addElement(new \XoopsFormHidden('op', 'uploadAlbumImage'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param null        $keys
     * @param string|null $format
     * @param int|null    $maxDepth
     * @return array
     */
    public function getValuesAlbums($keys = null, $format = null, $maxDepth = null)
    {
        $helper        = \XoopsModules\Wggallery\Helper::getInstance();
        $ret           = $this->getValues($keys, $format, $maxDepth);
        $ret['id']     = $this->getVar('alb_id');
        $ret['pid']    = $this->getVar('alb_pid');
        $ret['iscoll'] = $this->getVar('alb_iscoll');
        $ret['name']   = $this->getVar('alb_name');
        $ret['desc']   = $this->getVar('alb_desc', 'show');
        $ret['weight'] = $this->getVar('alb_weight');
        $imagesHandler = $helper->getHandler('Images');
        $image_path    = '';
        if (Constants::ALBUM_IMGCAT_USE_EXIST_VAL === $this->getVar('alb_imgtype')) {
            if ($this->getVar('alb_imgid') > 0) {
                $imagesObj = $imagesHandler->get($this->getVar('alb_imgid'));
                if (null !== $imagesObj && is_object($imagesObj)) {
                    $image      = WGGALLERY_UPLOAD_IMAGES_URL . '/medium/' . $imagesObj->getVar('img_name');
                    $image_path = '../uploads/wggallery/images/medium/' . $imagesObj->getVar('img_name');
                } else {
                    $ret['image_err']     = true;
                    $ret['image_errtext'] = str_replace('%s', $this->getVar('alb_imgid'), _CO_WGGALLERY_ALBUMS_ERRNOTFOUND);
                    $image                = WGGALLERY_UPLOAD_IMAGES_URL . '/medium/blank.gif';
                }
            } else {
                $image = WGGALLERY_UPLOAD_IMAGES_URL . '/albums/noimage.png';
            }
        } else {
            $image = WGGALLERY_UPLOAD_IMAGES_URL . '/albums/' . $this->getVar('alb_image');
            if ('noimage.png' !== $this->getVar('alb_image')) {
                $image_path = '../uploads/wggallery/images/albums/' . $this->getVar('alb_image');
            }
        }
        $ret['image']      = $image;
        $ret['image_path'] = $image_path;
        $ret['nb_images']  = $imagesHandler->getCountImages($this->getVar('alb_id'));
        $ret['state']      = $this->getVar('alb_state');
        $alb_wmid          = $this->getVar('alb_wmid');
        $ret['wmid']       = $alb_wmid;
        if ($alb_wmid > 0) {
            $watermarksHandler = $helper->getHandler('Watermarks');
            $ret['wmname']     = $watermarksHandler->get($alb_wmid)->getVar('wm_name');
        }
        $ret['state_text'] = $helper->getStateText($this->getVar('alb_state'));
        $ret['date']       = formatTimestamp($this->getVar('alb_date'), 's');
        $ret['submitter']  = \XoopsUser::getUnameFromId($this->getVar('alb_submitter'));
        $crAlbums          = new \CriteriaCompo();
        $crAlbums->add(new \Criteria('alb_pid', $this->getVar('alb_id')));
        $albumsCount         = $helper->getHandler('Albums')->getCount($crAlbums);
        $ret['nb_subalbums'] = $albumsCount;

        $ret['cats']      = $this->getVar('alb_cats');
        $albCats          = unserialize($this->getVar('alb_cats'));
        $ret['cats_list'] = $helper->getHandler('Categories')->getCatsList($albCats);
        $ret['tags']      = $this->getVar('alb_tags');

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayAlbums()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
