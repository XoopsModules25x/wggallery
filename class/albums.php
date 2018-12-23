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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WggalleryAlbums
 */
class WggalleryAlbums extends XoopsObject
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
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGGALLERY_ALBUM_ADD) : sprintf(_CO_WGGALLERY_ALBUM_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text AlbName
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_ALBUM_NAME, 'alb_name', 50, 255, $this->getVar('alb_name') ), true);
        // Form Select Parent Album
		$albumsHandler = $wggallery->getHandler('albums');
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('alb_id', $this->getVar('alb_id'), '<>'));
        $criteria->setSort('alb_weight ASC, alb_date');
        $criteria->setOrder('DESC');
		$albPid = new XoopsFormSelect( _CO_WGGALLERY_ALBUM_PID, 'alb_pid', $this->getVar('alb_pid'));
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
		$editorConfigs = array();
		$editorConfigs['name'] = 'alb_desc';
		$editorConfigs['value'] = $this->getVar('alb_desc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wggallery->getConfig('editor');
		$form->addElement(new XoopsFormEditor( _CO_WGGALLERY_ALBUM_DESC, 'alb_desc', $editorConfigs));
		// Form Text AlbWeight
		$albWeight = $this->isNew() ? '0' : $this->getVar('alb_weight');
		$form->addElement(new XoopsFormHidden('alb_weight', $albWeight));

        // Form Select AlbImgcat
		$albImgcat = $this->isNew() ? WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED :  intval( $this->getVar('alb_imgcat'));
        echo "albImgcat:".$albImgcat;
        $albImgcatSelect = new XoopsFormRadio( _CO_WGGALLERY_ALBUM_IMGCAT, 'alb_imgcat', $albImgcat );
		$albImgcatSelect->addOption(WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL, _CO_WGGALLERY_ALBUM_USE_EXIST);
        $albImgcatSelect->addOption(WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED, _CO_WGGALLERY_ALBUM_USE_UPLOADED);
        $albImgcatSelect->setExtra("onchange='wgshowAlbumImageSelect(this)'");
		$form->addElement($albImgcatSelect);
        
		// Form Table Images
		$imagesHandler = $wggallery->getHandler('images');
		$albImgid = $this->getVar('alb_imgid');
		$albImage1 = 'blank.gif';
		if (0 < $albImgid) {
			$imagesObj = $imagesHandler->get($albImgid);
			if ($imagesObj !== null & is_object($imagesObj) ) {
				$albImage1 = $imagesObj->getVar('img_name');
			}
		}
		$imageDirectory = '/uploads/wggallery/images/medium';
		$imageTray1 = new XoopsFormElementTray(_CO_WGGALLERY_ALBUM_IMGID, '&nbsp;' );
		$albImgidSelect = new XoopsFormSelect( '', 'alb_imgid', $albImage1);
        // Get All Images of this album
        $albumsChilds = [];
        if ( 0 < $this->getVar('alb_id') ) {
            $albumsChilds = explode( '|', $this->getVar('alb_id') . $albumsHandler->getChildsOfCategory($this->getVar('alb_id')));  
        }            
        $images = array();
        $albImgidSelect->addOption(0, '&nbsp;');
        if ( 0 < count($albumsChilds)) {
            foreach ($albumsChilds as $child) {
                $alb_name = '';
                $crImages = new CriteriaCompo();
                $crImages->add(new Criteria('img_albid', $child));
                $crImages->setSort('img_weight');
                $crImages->setOrder('DESC');
                $imagesAll = $imagesHandler->getAll($crImages);
                foreach(array_keys($imagesAll) as $i) {
                    $images[$i] = $imagesAll[$i]->getValuesImages();
                    if ($albImage1 === $images[$i]['img_name']) {$images[$i]['selected'] = 1;}
                    if ( '' === $alb_name ) {
                        $albums = $wggallery->getHandler('albums');
                        $alb_name = $albums->get($child)->getVar('alb_name');
                        $images[$i]['alb_name'] = $alb_name;
                    } 
                }
            }
        }
        if ( 0 < count($images)) {
            foreach($images as $image) {
                $albImgidSelect->addOption($image['img_name'],$image['img_title']);
                $albImgidSelect->setExtra("onchange='wgshowImgSelected(\"imagepreview1\", \"alb_imgid\", \"".$imageDirectory. '", "", "' .XOOPS_URL."\")'");
            }
        } else {
            $albImgidSelect->setExtra("disabled='disabled'");
        }
        if ( $albImgcat === 2 ) { $albImgidSelect->setExtra("disabled='disabled'");}
        $imageTray1->addElement($albImgidSelect);
        if ( 0 < count($images) ) {
            if ( $albImgcat === 2 ) { 
                $imageButtonStyle = 'display:none';
            } else {
                $imageButtonStyle = 'display:inline';
            }
            $imageButton = new XoopsFormLabel('', "&nbsp;<button type='button' id='myModalImagePicker-btn' class='btn btn-primary' style='" . $imageButtonStyle . "' data-toggle='modal' data-target='#myModalImagePicker'>" . _CO_WGGALLERY_FORM_IMAGEPICKER . '</button>');
            $GLOBALS['xoopsTpl']->assign('images', $images);
            $imageTray1->addElement($imageButton);
        }
        $imageTray1->addElement(new XoopsFormLabel('', "<img src='".XOOPS_URL. '/' .$imageDirectory. '/' .$albImage1."' name='imagepreview1' id='imagepreview1' alt='' style='max-width:100px' />"));
        $form->addElement($imageTray1);
        
        // Form File AlbImage
		// uploaded images
        $imageTray2 = new XoopsFormElementTray( _CO_WGGALLERY_ALBUM_USE_UPLOADED, '<br>' );
        $albImage = $this->getVar('alb_image');
        if ( $albImage == '' ) {  $albImage = 'blank.gif';}
		$imageDirectory = '/uploads/wggallery/images/albums';
		$imageSelect = new XoopsFormSelect( sprintf(_CO_WGGALLERY_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'alb_image', $albImage, 5);
		$imageArray = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach($imageArray as $imagepreview2) {
			$imageSelect->addOption("{$imagepreview2}", $imagepreview2);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"imagepreview2\", \"alb_image\", \"".$imageDirectory. '", "", "' .XOOPS_URL."\")'");
        if ( $albImgcat === 1 ) { $imageSelect->setExtra("disabled='disabled'");}
        // $imageSelect->setExtra("onchange='wgshowAlbumImageSelect(\"imagepreview2\", \"alb_image\", \"".$imageDirectory. '", "", "' .XOOPS_URL."\")'");
		$imageTray2->addElement($imageSelect, false);
        // if ( $albImgcat === 2 ) {
		$imageTray2->addElement(new XoopsFormLabel('', "<br><img src='".XOOPS_URL.$imageDirectory. '/' .$albImage."' name='imagepreview2' id='imagepreview2' alt='' style='max-width:100px' />"));
        // }
        $form->addElement($imageTray2);
        
        // upload new image
        $imageTray3 = new XoopsFormElementTray( _CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE, '<br>' );
		$imageFileSelect = new XoopsFormFile( '', 'attachedfile', $wggallery->getConfig('maxsize') );
        if ( $albImgcat === 1 ) { $imageFileSelect->setExtra("disabled='disabled'");}
        $imageTray3->addElement($imageFileSelect);
		// resize options for uploading new image
        $fileSizeSelect = new XoopsFormRadio( _CO_WGGALLERY_IMAGE_RESIZE, 'alb_resize', 1);
		$fileSizeSelect->addOption(WGGALLERY_IMAGE_THUMB, _CO_WGGALLERY_IMAGE_THUMB);
        $fileSizeSelect->addOption(WGGALLERY_IMAGE_MEDIUM, _CO_WGGALLERY_IMAGE_MEDIUM);
		$fileSizeSelect->addOption(WGGALLERY_IMAGE_LARGE, _CO_WGGALLERY_IMAGE_LARGE);
        if ( $albImgcat === 1 ) { $fileSizeSelect->setExtra("disabled='disabled'"); }
		$imageTray3->addElement($fileSizeSelect);
        $form->addElement($imageTray3);
        
		unset($criteria);
		// Form Select Albstate
		$albState = $this->isNew() ? 0 : $this->getVar('alb_state');
		$albStateSelect = new XoopsFormRadio( _CO_WGGALLERY_ALBUM_STATE, 'alb_state', $albState);
		$albStateSelect->addOption(WGGALLERY_STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
		$form->addElement($albStateSelect);
		// Permissions
		$memberHandler = xoops_getHandler('member');
		$groupList = $memberHandler->getGroupList();
		$gpermHandler = xoops_getHandler('groupperm');
		$fullList[] = array_keys($groupList);
		if(!$this->isNew()) {
			$groupsIdsView = $gpermHandler->getGroupIds('wggallery_view', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsView[] = array_values($groupsIdsView);
			$groupsCanViewCheckbox = new XoopsFormCheckBox( '', 'groups_view', $groupsIdsView);
			
            // TODO
			// $groupsIdsDlFullAlb = $gpermHandler->getGroupIds('wggallery_dlfullalb', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			// $groupsIdsDlFullAlb[] = array_values($groupsIdsDlFullAlb);
			// $groupsCanDlFullAlbCheckbox = new XoopsFormCheckBox( '', 'groups_dlfullalb', $groupsIdsDlFullAlb);
			
			$groupsIdsDlImageL = $gpermHandler->getGroupIds('wggallery_dlimage_large', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlImageL[] = array_values($groupsIdsDlImageL);
			$groupsCanDlImageLCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage_large', $groupsIdsDlImageL);
            
            $groupsIdsDlImageM = $gpermHandler->getGroupIds('wggallery_dlimage_medium', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlImageM[] = array_values($groupsIdsDlImageM);
			$groupsCanDlImageMCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage_medium', $groupsIdsDlImageM);
		} else {
			$groupsCanViewCheckbox = new XoopsFormCheckBox( '', 'groups_view', $fullList);
			$groupsCanDlFullAlbCheckbox = new XoopsFormCheckBox( '', 'groups_dlfullalb', $fullList);
			$groupsCanDlImageLCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage_large', $fullList);
            $groupsCanDlImageMCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage_medium', $fullList);
		}
		// To View
        $groupsCanViewCheckbox->addOptionArray($groupList);
        $groupsCanViewTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_VIEW, '&nbsp;' );
        $groupsCanViewTray->addElement($groupsCanViewCheckbox, false);
        $groupsCanViewAll = new XoopsFormCheckBox( '', 'all_groups_view', 0);
        $groupsCanViewAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_view'" . ')"');
        $groupsCanViewAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanViewTray->addElement($groupsCanViewAll, false);
		$form->addElement($groupsCanViewTray);
        
        // TODO
		// To Download full album
        // $groupsCanDlFullAlbCheckbox->addOptionArray($groupList);
        // $groupsCanDlFullAlbTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLFULLALB, '&nbsp;' );
        // $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbCheckbox, false);
        // $groupsCanDlFullAlbAll = new XoopsFormCheckBox( '', 'all_groups_dlfullalb', 0);
        // $groupsCanDlFullAlbAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlfullalb'" . ')"');
        // $groupsCanDlFullAlbAll->addOption(1, _CO_WGGALLERY_ALL);
        // $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbAll, false);
		// $form->addElement($groupsCanDlFullAlbTray);

         // To Download Large Images
        $groupsCanDlImageLCheckbox->addOptionArray($groupList);
        $groupsCanDlImageLTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE, '&nbsp;' );
        $groupsCanDlImageLTray->addElement($groupsCanDlImageLCheckbox, false);
        $groupsCanDlImageLAll = new XoopsFormCheckBox( '', 'all_groups_dlimage_large', 0);
        $groupsCanDlImageLAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_large'" . ')"');
        $groupsCanDlImageLAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlImageLTray->addElement($groupsCanDlImageLAll, false);
		$form->addElement($groupsCanDlImageLTray);
        // To Download Medium Images
        $groupsCanDlImageMCheckbox->addOptionArray($groupList);
        $groupsCanDlImageMTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM, '&nbsp;' );
        $groupsCanDlImageMTray->addElement($groupsCanDlImageMCheckbox, false);
        $groupsCanDlImageMAll = new XoopsFormCheckBox( '', 'all_groups_dlimage_medium', 0);
        $groupsCanDlImageMAll->setExtra('onclick="javascript:toggleCheckboxGroupPerm(' . "'groups_dlimage_medium'" . ')"');
        $groupsCanDlImageMAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlImageMTray->addElement($groupsCanDlImageMAll, false);
		$form->addElement($groupsCanDlImageMTray);
        // Form Select Album watermark
        $albWmid = $this->isNew() ? 0 : $this->getVar('alb_wmid');
        // is there a watermark for usage in all albums
        $watermarksHandler = $wggallery->getHandler('watermarks');
        $criteria = new CriteriaCompo();
        $countWmTotal = $watermarksHandler->getCount($criteria);
        if ( 0 < $countWmTotal ) {
            $criteria->add(new Criteria('wm_usage', WGGALLERY_WATERMARK_USAGEALL));
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
                $form->addElement(new XoopsFormLabel(_CO_WGGALLERY_WATERMARK, $wmname));
                $form->addElement(new XoopsFormHidden('alb_wmid', $albWmid));
            } else {
                $albWidSelect = new XoopsFormSelect( _CO_WGGALLERY_WATERMARK, 'alb_wmid', $albWmid);
                $albWidSelect->addOption(0, '&nbsp;');
                $criteria = new CriteriaCompo();
                $criteria->add(new Criteria('wm_usage', WGGALLERY_WATERMARK_USAGENONE, '>'));
                $albWidSelect->addOptionArray($watermarksHandler->getList($criteria));
                $form->addElement($albWidSelect);
            }
        } else {
            $form->addElement(new XoopsFormHidden('alb_wmid', 0));
        }
        unset($criteria);
		// Form Text Date Select AlbDate
		$albDate = $this->isNew() ? 0 : $this->getVar('alb_date');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGGALLERY_DATE, 'alb_date', '', $albDate ));
		// Form Select User AlbSubmitter
        if ( $this->isNew() ) {
            $alb_submitter = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
        } else {
            $alb_submitter = $this->getVar('alb_submitter');
        }
		$form->addElement(new XoopsFormSelectUser( _CO_WGGALLERY_SUBMITTER, 'alb_submitter', false, $alb_submitter ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$btnTray = new XoopsFormElementTray('', '&nbsp;' );
		$btnTray->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        if ( false === $admin ) {
            $btnSubmitUpload = new XoopsFormButton('', 'submit_upload',_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD, 'submit');
            $btnSubmitUpload->setClass('btn btn-primary');
            $btnTray->addElement($btnSubmitUpload);
        }
		$form->addElement($btnTray);
		return $form;
	}

    /**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormUploadToAlbum($action = false)
	{
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm(_CO_WGGALLERY_ALBUM_SELECT, 'formselalbum', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Table Albums
		$albumsHandler = $wggallery->getHandler('albums');
		$crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_iscat', 0));
		$crAlbums->setSort('alb_weight ASC, alb_date');
		$crAlbums->setOrder('DESC');
		// Form Select Albums
		$albIdSelect = new XoopsFormSelect( _CO_WGGALLERY_ALBUM_SELECT, 'alb_id', $this->getVar('alb_id'));
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
		
		$form->addElement(new XoopsFormHidden('start', 0));
		$form->addElement(new XoopsFormHidden('limit', 0));

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
		$wggallery = WggalleryHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('alb_id');
		$ret['pid'] = $this->getVar('alb_pid');
        $ret['iscat'] = $this->getVar('alb_iscat');
		$ret['name'] = $this->getVar('alb_name');
		$ret['desc'] = $this->getVar('alb_desc', 'show');
		$ret['weight'] = $this->getVar('alb_weight');
		$imagesHandler = $wggallery->getHandler('images');
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
            $crImages = new CriteriaCompo();
            $crImages->add(new Criteria('img_albid', $this->getVar('alb_id')));
            $crImages->add(new Criteria('img_state', 1));
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
            $watermarksHandler = $wggallery->getHandler('watermarks');
            $ret['wmname'] = $watermarksHandler->get($alb_wmid)->getVar('wm_name');
        }
		$ret['state_text'] = $wggallery->getStateText($this->getVar('alb_state'));
		$ret['date'] = formatTimestamp($this->getVar('alb_date'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('alb_submitter'));
		$crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_pid', $this->getVar('alb_id')));
		$albumsCount = $wggallery->getHandler('albums')->getCount($crAlbums);
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
		$wggallery = WggalleryHelper::getInstance();
		$imagesHandler = $wggallery->getHandler('images');

		$crImages = new CriteriaCompo();
        $crImages->add(new Criteria('img_albid', $albId));
        if (!$permissionsHandler->permAlbumEdit($albId, $albSubmitter)) {
            $crImages->add(new Criteria('img_state', 1));
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
		$ret = array();
		$vars = $this->getVars();
		foreach(array_keys($vars) as $var) {
			$ret[$var] = $this->getVar('"{$var}"');
		}
		return $ret;
	}
}

/**
 * Class Object Handler WggalleryAlbums
 */
class WggalleryAlbumsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wggallery_albums', 'wggalleryalbums', 'alb_id', 'alb_name');
	}

	/**
	 * @param bool $isNew
	 *
	 * @return object
	 */
	public function create($isNew = true)
	{
		return parent::create($isNew);
	}

	/**
	 * retrieve a field
	 *
	 * @param int $i field id
	 * @param null fields
	 * @return mixed reference to the {@link Get} object
	 */
	public function get($i = null, $fields = null)
	{
		return parent::get($i, $fields);
	}

	/**
	 * get inserted id
	 *
	 * @param null
	 * @return integer reference to the {@link Get} object
	 */
	public function getInsertId()
	{
		return $this->db->getInsertId();
	}

	/**
	 * Get Count Albums in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountAlbums($start = 0, $limit = 0, $sort = 'alb_weight ASC, alb_date', $order = 'DESC')
	{
		$crCountAlbums = new CriteriaCompo();
		$crCountAlbums = $this->getAlbumsCriteria($crCountAlbums, $start, $limit, $sort, $order);
		return parent::getCount($crCountAlbums);
	}

	/**
	 * Get All Albums in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllAlbums($start = 0, $limit = 0, $sort = 'alb_weight ASC, alb_date', $order = 'DESC')
	{
		$crAllAlbums = new CriteriaCompo();
		$crAllAlbums = $this->getAlbumsCriteria($crAllAlbums, $start, $limit, $sort, $order);
		return parent::getAll($crAllAlbums);
	}

	/**
	 * Get Criteria Albums
	 * @param        $crAlbums
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getAlbumsCriteria($crAlbums, $start, $limit, $sort, $order)
	{
		$crAlbums->setStart( $start );
		$crAlbums->setLimit( $limit );
		$crAlbums->setSort( $sort );
		$crAlbums->setOrder( $order );
		return $crAlbums;
	}
    
    /**
	 * Get Criteria Albums
	 * @return boolean
	 */
	public function setAlbumIsCat()
	{
		// reset (necessary after deleting)
		$strSQL = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . ' SET ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '.alb_iscat = 0';
		$GLOBALS['xoopsDB']->queryF($strSQL);
		
		// set values new
		$albumsAll = $this->getAllAlbums();
		foreach(array_keys($albumsAll) as $i) {
			$albPid = $albumsAll[$i]->getVar('alb_pid');
			$strSQL = 'UPDATE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . ' SET ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '.alb_iscat = 1 WHERE ' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '.alb_id = ' . $albPid;
			$GLOBALS['xoopsDB']->query($strSQL);
			
		}
		unset($albumsAll);
		
		return false;
	}

    /**
     * Get all childs of a category
     * @param $albPid
     * @return string
     */
    public function getChildsOfCategory($albPid)
    {
        $childsAll = '';
       
        $wggallery = WggalleryHelper::getInstance();
		$albumsHandler = $wggallery->getHandler('albums');
        $crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_pid', $albPid));
		$albumsCount = $albumsHandler->getCount($crAlbums);
		$albumsAll = $albumsHandler->getAll($crAlbums);
		// Table view albums
		if($albumsCount > 0) {
			foreach(array_keys($albumsAll) as $i) {
                // if ( 0 < count($childsAll) ) {$childsAll .= "#".('' !== $childsAll)."|";}
				$childsAll .= '|' . $albumsAll[$i]->getVar('alb_id');
                $child = $this->getChildsOfCategory($albumsAll[$i]->getVar('alb_id'));
                if ( $child ) {
                    $childsAll .= $child;
                }
            }
		}
        return $childsAll;
    }
	
	/**
	 * Get all childs of a category
	 * @param int $albId 
	 * @return array
	 */
/*     function getListChildsOfCategory($albPid)
    {
        $childrens = array();
		$firstAlbId = 0;
       
        $wggallery = WggalleryHelper::getInstance();
		$albumsHandler = $wggallery->getHandler('albums');
        $crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_pid', $albPid));
		$crAlbums->setSort('alb_weight ASC, alb_date');
		$crAlbums->setOrder('DESC');
		$albumsCount = $albumsHandler->getCount($crAlbums);
		$albumsAll = $albumsHandler->getAll($crAlbums);
		// Table view albums
		if($albumsCount > 0) {
			foreach(array_keys($albumsAll) as $i) {
                // if ( 0 < count($childsAll) ) {$childsAll .= "#".('' !== $childsAll)."|";}
				if ( 0 === $firstAlbId) {$firstAlbId = $albumsAll[$i]->getVar('alb_id');}
				$child = $this->getListChildsOfCategory($albumsAll[$i]->getVar('alb_id'));
				if ( $child ) {
                    $childrens[$albumsAll[$i]->getVar('alb_id')] = $child;
                } else {
					$childrens[$albumsAll[$i]->getVar('alb_id')] = array('first' => 0, 'last' => 0,'alb_pid' => $albumsAll[$i]->getVar('alb_pid'), 'alb_name' => $albumsAll[$i]->getVar('alb_name'));
				}
            }
			$childrens[$firstAlbId]['first'] = 1;
			$childrens[$albumsAll[$i]->getVar('alb_id')]['last'] = 1;
		} else {
			return false;
		}
        return $childrens;
    } */

    /**
     * @param $albPid
     * @return bool|string
     */
    public function getListChildsOfCategory($albPid)
    {
        if ( 0 < $albPid) {
			$childsAll = '<ol>';
		} else {
			$childsAll = '';
		}

        $wggallery = WggalleryHelper::getInstance();
		$albumsHandler = $wggallery->getHandler('albums');
        $crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_pid', $albPid));
		$crAlbums->setSort('alb_weight ASC, alb_date');
		$crAlbums->setOrder('DESC');
		$albumsCount = $albumsHandler->getCount($crAlbums);
		$albumsAll = $albumsHandler->getAll($crAlbums);
		// Table view albums
		if($albumsCount > 0) {
			foreach(array_keys($albumsAll) as $i) {
                // if ( 0 < count($childsAll) ) {$childsAll .= "#".('' !== $childsAll)."|";}
				$child = $this->getListChildsOfCategory($albumsAll[$i]->getVar('alb_id'));
				$childsAll .= '<li style="display: list-item;" class="mjs-nestedSortable-branch mjs-nestedSortable-collapsed" id="menuItem_' . $albumsAll[$i]->getVar('alb_id') . '">';
				
				$childsAll .= '<div class="menuDiv">';
				if ( $child ) {
					$childsAll .= '<span title="Click to show/hide children" class="disclose ui-icon ui-icon-plusthick"><span>-</span></span>';
				}
				$childsAll .= '<span>';
				$childsAll .= '<span data-id="' . $albumsAll[$i]->getVar('alb_id') . '" class="itemTitle">' . $albumsAll[$i]->getVar('alb_name') . '</span>';
				$childsAll .= '<span class="pull-right">
								<a class="" href="albums.php?op=edit&amp;alb_id=' . $albumsAll[$i]->getVar('alb_id') . '" title="' . _CO_WGGALLERY_ALBUM_EDIT . '">
									<img class="wgg-btn-icon" src="' . WGGALLERY_ICONS_URL . '/16/edit.png" alt="' . _CO_WGGALLERY_ALBUM_EDIT . '">
								</a></span>';
				$childsAll .= '</span>';
				$childsAll .= '</div>';
				                
                if ( $child ) {
                    $childsAll .= $child;
                }
            }
		} else {
			return false;
		}
		if ( 0 < $albPid) {
			$childsAll .= '</ol>';
		}
        return $childsAll;
    }
}