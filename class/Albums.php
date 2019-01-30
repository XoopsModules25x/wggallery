<?php namespace XoopsModules\Wggallery;
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
use XoopsModules\Wggallery\Constants;

defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Albums
 */
class Albums extends \XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('alb_id', XOBJ_DTYPE_INT);
		$this->initVar('alb_pid', XOBJ_DTYPE_INT);
        $this->initVar('alb_iscat', XOBJ_DTYPE_INT);
		$this->initVar('alb_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('alb_desc', XOBJ_DTYPE_TXTAREA);
		$this->initVar('alb_weight', XOBJ_DTYPE_INT);
        $this->initVar('alb_imgcat', XOBJ_DTYPE_INT);
		$this->initVar('alb_image', XOBJ_DTYPE_TXTBOX);
		$this->initVar('alb_imgid', XOBJ_DTYPE_INT);
		$this->initVar('alb_state', XOBJ_DTYPE_INT);
        $this->initVar('alb_wmid', XOBJ_DTYPE_INT);
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
		if(!$instance) {
			$instance = new self();
		}
	}

	/**
	 * The new inserted $Id
	 * @return inserted id
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
     * @return XoopsThemeForm
     */
	public function getFormAlbums($action = false, $admin = false)
	{
		$helper = Wggallery\Helper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGGALLERY_ALBUM_ADD) : sprintf(_CO_WGGALLERY_ALBUM_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text AlbName
		$form->addElement(new \XoopsFormText( _CO_WGGALLERY_ALBUM_NAME, 'alb_name', 50, 255, $this->getVar('alb_name') ), true);
        // Form Select Parent Album
        $albumsHandler = $helper->getHandler('Albums');
		$criteria = new \CriteriaCompo();
		$criteria->add(new \Criteria('alb_id', $this->getVar('alb_id'), '<>'));
        $criteria->setSort('alb_weight ASC, alb_date');
        $criteria->setOrder('DESC');
		$albPid = new \XoopsFormSelect( _CO_WGGALLERY_ALBUM_PID, 'alb_pid', $this->getVar('alb_pid'));
		$albPid->addOption(0, '&nbsp;');
        $albumsAll = $albumsHandler->getAll($criteria);
        foreach(array_keys($albumsAll) as $i) {
			$albName = $albumsAll[$i]->getVar('alb_name');
			$albAlbPid = $albumsAll[$i]->getVar('alb_pid');
			if ( 0 < $albAlbPid ) {
				$albumsObj = $albumsHandler->get($albAlbPid);
                if (is_object($albumsObj)) {
                    $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                } else {
                    $albName .= ' (' . _CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                }
			}
			$albPid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
		}
		$form->addElement($albPid);
		unset($criteria);
		// Form editor AlbDesc
		$editorConfigs = [];
		$editorConfigs['name'] = 'alb_desc';
		$editorConfigs['value'] = $this->getVar('alb_desc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $helper->getConfig('editor');
		$form->addElement(new \XoopsFormEditor( _CO_WGGALLERY_ALBUM_DESC, 'alb_desc', $editorConfigs));
		// Form Text AlbWeight
		$albWeight = $this->isNew() ? '0' : $this->getVar('alb_weight');
		$form->addElement(new \XoopsFormHidden('alb_weight', $albWeight));

        // Form Select Album image
		$albImgcat = $this->isNew() ? WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED_VAL : $this->getVar('alb_imgcat');
		$form->addElement(new \XoopsFormHidden('alb_imgcat', $albImgcat));
		$albImage = $this->isNew() ? 'blank.gif' : $this->getVar('alb_image');
		$form->addElement(new \XoopsFormHidden('alb_image', $albImage));
		$albImgid = $this->isNew() ? 0 : $this->getVar('alb_imgid');
		$form->addElement(new \XoopsFormHidden('alb_imgid', $albImgid));

		// Form Select Albstate
		$albState = $this->isNew() ? 0 : $this->getVar('alb_state');
		$albStateSelect = new \XoopsFormRadio( _CO_WGGALLERY_ALBUM_STATE, 'alb_state', $albState);
		$albStateSelect->addOption(WGGALLERY_STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
		$form->addElement($albStateSelect);
		// Permissions
		$memberHandler = xoops_getHandler('member');
		$groupList = $memberHandler->getGroupList();
		$gpermHandler = xoops_getHandler('groupperm');
		$listNone[] = array_keys($groupList);
		foreach (array_keys($groupList) as $i) {
            $listSelected[] = $i;
        }
		if(!$this->isNew()) {
			$groupsIdsView = $gpermHandler->getGroupIds('wggallery_view', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsView[] = array_values($groupsIdsView);
			$groupsCanViewCheckbox = new \XoopsFormCheckBox( '', 'groups_view', $groupsIdsView);

            // TODO
			// $groupsIdsDlFullAlb = $gpermHandler->getGroupIds('wggallery_dlfullalb', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			// $groupsIdsDlFullAlb[] = array_values($groupsIdsDlFullAlb);
			// $groupsCanDlFullAlbCheckbox = new \XoopsFormCheckBox( '', 'groups_dlfullalb', $groupsIdsDlFullAlb);
			
			$groupsIdsDlImageL = $gpermHandler->getGroupIds('wggallery_dlimage_large', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlImageL[] = array_values($groupsIdsDlImageL);
			$groupsCanDlImageLCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_large', $groupsIdsDlImageL);
            
            $groupsIdsDlImageM = $gpermHandler->getGroupIds('wggallery_dlimage_medium', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlImageM[] = array_values($groupsIdsDlImageM);
			$groupsCanDlImageMCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_medium', $groupsIdsDlImageM);
		} else {
			$groupsCanViewCheckbox = new \XoopsFormCheckBox( '', 'groups_view', $listSelected);
			// $groupsCanDlFullAlbCheckbox = new \XoopsFormCheckBox( '', 'groups_dlfullalb', $listNone);
			$groupsCanDlImageLCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_large', $listNone);
            $groupsCanDlImageMCheckbox = new \XoopsFormCheckBox( '', 'groups_dlimage_medium', $listSelected);
		}
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
        // Form Select Album watermark
        $albWmid = $this->isNew() ? 0 : $this->getVar('alb_wmid');
        // is there a watermark for usage in all albums
        $watermarksHandler = $helper->getHandler('Watermarks');
        $criteria = new \CriteriaCompo();
        $countWmTotal = $watermarksHandler->getCount($criteria);
        if ( 0 < $countWmTotal ) {
            $criteria->add(new \Criteria('wm_usage', WGGALLERY_WATERMARK_USAGEALL));
            $countWm = $watermarksHandler->getCount($criteria);
            if ( 0 < $countWm ) {
                if ( 0 === $albWmid ) {
                    // load "usage for all" as default
                    $watermarksAll = $watermarksHandler->getAll($criteria);
                    foreach(array_keys($watermarksAll) as $wm) {
                        $watermarkObj = $watermarksAll[$wm]->getValuesWatermarks();
                        $albWmid      = $watermarkObj['wm_id'];
                        $wmname       = $watermarkObj['wm_name'];
                    }
                }
                $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_WATERMARK, $wmname));
                $form->addElement(new \XoopsFormHidden('alb_wmid', $albWmid));
            } else {
                $albWidSelect = new \XoopsFormSelect( _CO_WGGALLERY_WATERMARK, 'alb_wmid', $albWmid);
                $albWidSelect->addOption(0, '&nbsp;');
                $criteria = new \CriteriaCompo();
                $criteria->add(new \Criteria('wm_usage', WGGALLERY_WATERMARK_USAGENONE, '>'));
                $albWidSelect->addOptionArray($watermarksHandler->getList($criteria));
                $form->addElement($albWidSelect);
            }
        } else {
            $form->addElement(new \XoopsFormHidden('alb_wmid', 0));
        }
        unset($criteria);
		// Form Text Date Select AlbDate
		$albDate = $this->isNew() ? 0 : $this->getVar('alb_date');
		$form->addElement(new \XoopsFormTextDateSelect( _CO_WGGALLERY_DATE, 'alb_date', '', $albDate ));
		// Form Select User AlbSubmitter
        if ( $this->isNew() ) {
            $alb_submitter = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
        } else {
            $alb_submitter = $this->getVar('alb_submitter');
        }
		$form->addElement(new \XoopsFormSelectUser( _CO_WGGALLERY_SUBMITTER, 'alb_submitter', false, $alb_submitter ));
		// To Save
		$form->addElement(new \XoopsFormHidden('op', 'save'));
		$btnTray = new \XoopsFormElementTray('', '&nbsp;' );
		$btnTray->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        if ( false === $admin ) {
            $btnSubmitUpload = new \XoopsFormButton('', 'submit_upload',_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD, 'submit');
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
	 * @return XoopsThemeForm
	 */
	public function getFormUploadToAlbum($action = false)
	{
		$helper = Wggallery\Helper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm(_CO_WGGALLERY_ALBUM_SELECT, 'formselalbum', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Table Albums
		$albumsHandler = $helper->getHandler('albums');
		$crAlbums = new \CriteriaCompo();
		$crAlbums->add(new \Criteria('alb_iscat', 0));
		$crAlbums->setSort('alb_weight ASC, alb_date');
		$crAlbums->setOrder('DESC');
		// Form Select Albums
		$albIdSelect = new \XoopsFormSelect( _CO_WGGALLERY_ALBUM_SELECT, 'alb_id', $this->getVar('alb_id'));
        $albIdSelect->setExtra('onchange="submit()"');
		$albIdSelect->addOption(0, '&nbsp;');
		$albumsAll = $albumsHandler->getAll($crAlbums);
		
		foreach(array_keys($albumsAll) as $i) {
			$albName = $albumsAll[$i]->getVar('alb_name');
			$albPid = $albumsAll[$i]->getVar('alb_pid');
			if ( 0 < $albPid ) {
                $albumsObj = $albumsHandler->get($albPid);
                if (is_object( $albumsObj)) {
                    $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                } else {
                    $albName .= ' (' . _CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                }
			}
			$albIdSelect->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
		}
		$form->addElement($albIdSelect);
		unset($crAlbums);
		
		$form->addElement(new \XoopsFormHidden('start', 0));
		$form->addElement(new \XoopsFormHidden('limit', 0));

		return $form;
	}

    /**
     * @public function getFormUploadAlbumimage:
     * provide form for uploading a new album image
     * @return XoopsThemeForm
     */
	public function getFormUploadAlbumimage()
	{
		$helper = Wggallery\Helper::getInstance();
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm('', 'formalbumimmage', 'album_images.php', 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
        // Form File AlbImage
		// uploaded images
        $imageTray2 = new \XoopsFormElementTray( _CO_WGGALLERY_ALBUM_USE_UPLOADED, '<br>' );
        $albImage = $this->getVar('alb_image');
        if ( $albImage == '' ) {  $albImage = 'blank.gif';}
		$imageDirectory = '/uploads/wggallery/images/albums';
		$imageSelect = new \XoopsFormSelect( sprintf(_CO_WGGALLERY_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'alb_image', $albImage, 5);
		$imageArray = \XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach($imageArray as $imagepreview2) {
			$imageSelect->addOption((string)($imagepreview2), $imagepreview2);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"imagepreview2\", \"alb_image\", \"".$imageDirectory. '", "", "' .XOOPS_URL."\")'");
		$imageTray2->addElement($imageSelect, false);
		$imageTray2->addElement(new \XoopsFormLabel('', "<br><img src='".XOOPS_URL.$imageDirectory. '/' .$albImage."' name='imagepreview2' id='imagepreview2' alt='' style='max-width:100px'>"));
        $form->addElement($imageTray2);
        
        // upload new image
        $imageTray3 = new \XoopsFormElementTray( _CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE, '<br>' );
		$imageFileSelect = new \XoopsFormFile( '', 'attachedfile', $helper->getConfig('maxsize') );
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
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesAlbums($keys = null, $format = null, $maxDepth = null)
	{
		$helper = Wggallery\Helper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('alb_id');
		$ret['pid'] = $this->getVar('alb_pid');
        $ret['iscat'] = $this->getVar('alb_iscat');
		$ret['name'] = $this->getVar('alb_name');
		$ret['desc'] = $this->getVar('alb_desc', 'show');
		$ret['weight'] = $this->getVar('alb_weight');
		$imagesHandler = $helper->getHandler('images');
		if (WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL === $this->getVar('alb_imgcat')) {
			if ( 0 < $this->getVar('alb_imgid') ) {
				$imagesObj = $imagesHandler->get($this->getVar('alb_imgid'));
				if ($imagesObj !== null && is_object($imagesObj)) {
					$image = WGGALLERY_UPLOAD_IMAGE_URL . '/medium/' .  $imagesObj->getVar('img_name');
				} else {
					$ret['image_err'] = true;
                    $ret['image_errtext'] = str_replace('%s', $this->getVar('alb_imgid'), _AM_WGGALLERY_ALBUMS_ERRNOTFOUND);
					$image = WGGALLERY_UPLOAD_IMAGE_URL . '/medium/blank.gif';
				}
			} else {
				$image = WGGALLERY_UPLOAD_IMAGE_URL . '/albums/noimage.png';
			}
        
        // TODO
/* 		} else if (WGGALLERY_ALBUM_IMGCAT_USE_GRID === $this->getVar('alb_imgcat')) {
            $crImages = new \CriteriaCompo();
            $crImages->add(new \Criteria('img_albid', $this->getVar('alb_id')));
            $crImages->add(new \Criteria('img_state', 1));
            $crImages->setSort('img_weight ASC, img_id');
            $crImages->setOrder('ASC');
            $crImages->setStart( 0 );
            $crImages->setLimit( 4 );
            $imagesCount = $imagesHandler->getCount($crImages);
            $imagesAll = $imagesHandler->getAll($crImages);
            if($imagesCount > 0) {
                $images = array();
                foreach(array_keys($imagesAll) as $i) {
                    $images[] = $imagesAll[$i]->getValuesImages();
                }
                $GLOBALS['xoopsTpl']->assign('grid', $images);
                $ret['grid'] = $images;
                unset($images);
            }
            $image = ''; */
        } else {
			$image = WGGALLERY_UPLOAD_IMAGE_URL . '/albums/' . $this->getVar('alb_image');
		}
		$ret['image'] = $image;
		$ret['nb_images'] = $imagesHandler->getCountImages($this->getVar('alb_id'));
		$ret['state'] = $this->getVar('alb_state');
        $alb_wmid = $this->getVar('alb_wmid');
        $ret['wmid'] = $alb_wmid;
        if ( 0 < $alb_wmid) {
            $watermarksHandler = $helper->getHandler('Watermarks');
            $ret['wmname'] = $watermarksHandler->get($alb_wmid)->getVar('wm_name');
        }
		$ret['state_text'] = $helper->getStateText($this->getVar('alb_state'));
		$ret['date'] = formatTimestamp($this->getVar('alb_date'), 's');
		$ret['submitter'] = \XoopsUser::getUnameFromId($this->getVar('alb_submitter'));
		$crAlbums = new \CriteriaCompo();
		$crAlbums->add(new \Criteria('alb_pid', $this->getVar('alb_id')));
		$albumsCount = $helper->getHandler('Albums')->getCount($crAlbums);
		$ret['nb_subalbums'] = $albumsCount;
		return $ret;
	}

	/**
	 * Get specified number of images from album
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
/* 	public function getSpecImagesAlbum ($albId, $limit)
	{
		$helper = Wggallery\Helper::getInstance();
		$imagesHandler = $helper->getHandler('images');

		$crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_albid', $albId));
        if (!$permissionsHandler->permAlbumEdit($albId, $albSubmitter)) {
            $crImages->add(new \Criteria('img_state', 1));
        }
        $crImages->setSort('img_weight');
        $crImages->setOrder('ASC');
        $crImages->setLimit( $limit );
		$imagesCount = $imagesHandler->getCount($crImages);
		$imagesAll = $imagesHandler->getAll($crImages);
		if($imagesCount > 0) {
			$images = array();
			// Get All Images
			foreach(array_keys($imagesAll) as $i) {
				$images[$i] = $imagesAll[$i]->getValuesImages();
			}
			return $images;
			unset($images);			
		}
		return false;
	} */
	
	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayAlbums()
	{
		$ret = [];
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}
