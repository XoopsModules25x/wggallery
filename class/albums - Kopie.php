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
		$this->initVar('alb_allowdownload', XOBJ_DTYPE_INT);
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
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormAlbums($action = false)
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
		// Form Table Albums
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
				$albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
			}
			$albPid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
		}
		$form->addElement($albPid);
		unset($criteria);
		// Form Text AlbName
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_ALBUM_NAME, 'alb_name', 50, 255, $this->getVar('alb_name') ), true);
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
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_ALBUM_WEIGHT, 'alb_weight', 20, 150, $albWeight ), true);
		
        // Form Select AlbImgcat
		$albImgcat = $this->isNew() ? WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED : $this->getVar('alb_imgcat');
		$albImgcatSelect = new XoopsFormRadio( _CO_WGGALLERY_ALBUM_IMGCAT, 'alb_imgcat', $albImgcat);
		$albImgcatSelect->addOption(WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL, _CO_WGGALLERY_ALBUM_USE_EXIST);
		$albImgcatSelect->addOption(WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED, _CO_WGGALLERY_ALBUM_USE_UPLOADED);
        // $albImgcatSelect->addOption(WGGALLERY_ALBUM_IMGCAT_USE_GRID, _CO_WGGALLERY_ALBUM_USE_GRID);
		$form->addElement($albImgcatSelect);
        
		$form->addElement(new XoopsFormLabel('', '(' . WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL . ') ' . _CO_WGGALLERY_ALBUM_USE_EXIST));
		// Form Table Images
		$imagesHandler = $wggallery->getHandler('images');
		$albImgid = $this->getVar('alb_imgid');
		$albImage1 = 'blank.gif';
		if (0 < $albImgid) {
			$imagesObj = $imagesHandler->get($albImgid);
			if (isset($imagesObj) & is_object($imagesObj) ) {
				$albImage1 = $imagesObj->getVar('img_name');
			}
		}
		$imageDirectory = '/uploads/wggallery/images/medium';
		$imageTray1 = new XoopsFormElementTray('', '&nbsp;' );
		$albImgidSelect = new XoopsFormSelect( _CO_WGGALLERY_ALBUM_IMGID, 'alb_imgid', $albImage1);
        // Get All Images of this album
        $albumsChilds = explode( '|', $this->getVar('alb_id') . $albumsHandler->getChildsOfCategory($this->getVar('alb_id')));       
        $images = array();
		$albImgidSelect->addOption(0, '&nbsp;');
        foreach ($albumsChilds as $child) {
            $alb_name = '';
            $crImages = new CriteriaCompo();
            $crImages->add(new Criteria('img_albid', $child));
            $crImages->setSort('img_weight');
            $crImages->setOrder('DESC');
            $imagesAll = $imagesHandler->getAll($crImages);
            foreach(array_keys($imagesAll) as $i) {
                $images[$i] = $imagesAll[$i]->getValuesImages();
                if ($albImage1 == $images[$i]['img_name']) {$images[$i]['selected'] = 1;}
                if ( '' === $alb_name ) {
                    $albums = $wggallery->getHandler('albums');
                    $alb_name = $albums->get($child)->getVar('alb_name');
                    $images[$i]['alb_name'] = $alb_name;
                } 
            }
        }
        foreach($images as $image) {
            $albImgidSelect->addOption($image['img_name'],$image['img_title']);
        }
		$albImgidSelect->setExtra("onchange='wgshowImgSelected(\"imagepreview1\", \"alb_imgid\", \"".$imageDirectory."\", \"\", \"".XOOPS_URL."\")'");
		$imageTray1->addElement($albImgidSelect);
        if ( 0 < count($images)) {
            $imageTray1->addElement(new XoopsFormLabel('', "&nbsp;<button type='button' id='myModalImagePicker-btn' class='btn btn-primary' data-toggle='modal' data-target='#myModalImagePicker'>" . _CO_WGGALLERY_FORM_IMAGEPICKER . "</button>"));
			$GLOBALS['xoopsTpl']->assign('images', $images);
        }
        $imageTray1->addElement(new XoopsFormLabel('', "<img src='".XOOPS_URL."/".$imageDirectory."/".$albImage1."' name='imagepreview1' id='imagepreview1' alt='' style='max-width:100px' />"));
		$form->addElement($imageTray1);
		
		// Form Upload Image AlbImage
        $form->addElement(new XoopsFormLabel('', '(' . WGGALLERY_ALBUM_IMGCAT_USE_UPLOADED . ') ' . _CO_WGGALLERY_ALBUM_USE_UPLOADED));
        $albImage = $this->isNew() ? 'noimage.png' : $this->getVar('alb_image');
		$imageDirectory = '/uploads/wggallery/images/albums';
		$imageTray2 = new XoopsFormElementTray('', '<br>' );
		$imageSelect = new XoopsFormSelect( sprintf(_CO_WGGALLERY_FORM_IMAGE_PATH, ".{$imageDirectory}/"), 'alb_image', $albImage, 5);
		$imageArray = XoopsLists::getImgListAsArray( XOOPS_ROOT_PATH . $imageDirectory );
		foreach($imageArray as $imagepreview2) {
			$imageSelect->addOption("{$imagepreview2}", $imagepreview2);
		}
		$imageSelect->setExtra("onchange='showImgSelected(\"imagepreview2\", \"alb_image\", \"".$imageDirectory."\", \"\", \"".XOOPS_URL."\")'");
		$imageTray2->addElement($imageSelect, false);
		$imageTray2->addElement(new XoopsFormLabel('', "<br><img src='".XOOPS_URL."/".$imageDirectory."/".$albImage."' name='imagepreview2' id='imagepreview2' alt='' style='max-width:100px' />"));
		// Form File AlbImage
		$fileSelectTray = new XoopsFormElementTray('', '<br>' );
		$fileSelectTray->addElement(new XoopsFormFile( _CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE, 'attachedfile', $wggallery->getConfig('maxsize', true) ));
		
		$imageTray2->addElement($fileSelectTray);
		$form->addElement($imageTray2);
		unset($criteria);
		// Form Select Albstate
		$albState = $this->isNew() ? 0 : $this->getVar('alb_state');
		$albStateSelect = new XoopsFormRadio( _CO_WGGALLERY_ALBUM_STATE, 'alb_state', $albState);
		$albStateSelect->addOption(WGGALLERY_STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
		$albStateSelect->addOption(WGGALLERY_STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
		$form->addElement($albStateSelect);
		// Permissions
		$memberHandler = xoops_gethandler('member');
		$groupList = $memberHandler->getGroupList();
		$gpermHandler = xoops_gethandler('groupperm');
		$fullList[] = array_keys($groupList);
		if(!$this->isNew()) {
			$groupsIdsView = $gpermHandler->getGroupIds('wggallery_view', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsView[] = array_values($groupsIdsView);
			$groupsCanViewCheckbox = new XoopsFormCheckBox( '', 'groups_view[]', $groupsIdsView);
			
			$groupsIdsDlFullAlb = $gpermHandler->getGroupIds('wggallery_dlfullalb', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlFullAlb[] = array_values($groupsIdsDlFullAlb);
			$groupsCanDlFullAlbCheckbox = new XoopsFormCheckBox( '', 'groups_dlfullalb[]', $groupsIdsDlFullAlb);
			
			$groupsIdsDlImage = $gpermHandler->getGroupIds('wggallery_dlimage', $this->getVar('alb_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsDlImage[] = array_values($groupsIdsDlImage);
			$groupsCanDlImageCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage[]', $groupsIdsDlImage);
		} else {
			$groupsCanViewCheckbox = new XoopsFormCheckBox( '', 'groups_view[]', $fullList);
			$groupsCanDlFullAlbCheckbox = new XoopsFormCheckBox( '', 'groups_dlfullalb[]', $fullList);
			$groupsCanDlImageCheckbox = new XoopsFormCheckBox( '', 'groups_dlimage[]', $fullList);
		}
		// To View
        $groupsCanViewCheckbox->addOptionArray($groupList);
        $groupsCanViewTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_VIEW, '&nbsp;' );
        $groupsCanViewTray->addElement($groupsCanViewCheckbox, false);
        $groupsCanViewAll = new XoopsFormCheckBox( '', 'all_groups_view', 0);
        $groupsCanViewAll->setExtra('onclick="javascript:toggleCheckbox(this)"');
        $groupsCanViewAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanViewTray->addElement($groupsCanViewAll, false);
		$form->addElement($groupsCanViewTray);
		// To Download Large Images
        $groupsCanDlFullAlbCheckbox->addOptionArray($groupList);
        $groupsCanDlFullAlbTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLFULLALB, '&nbsp;' );
        $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbCheckbox, false);
        $groupsCanDlFullAlbAll = new XoopsFormCheckBox( '', 'all_groups_dlfullalb', 0);
        $groupsCanDlFullAlbAll->setExtra('onclick="javascript:toggleCheckbox(this)"');
        $groupsCanDlFullAlbAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlFullAlbTray->addElement($groupsCanDlFullAlbAll, false);
		$form->addElement($groupsCanDlFullAlbTray);
		// To Download Medium Images
        $groupsCanDlImageCheckbox->addOptionArray($groupList);
        $groupsCanDlImageTray = new XoopsFormElementTray(_CO_WGGALLERY_PERMS_ALB_DLIMAGE, '&nbsp;' );
        $groupsCanDlImageTray->addElement($groupsCanDlImageCheckbox, false);
        $groupsCanDlImageAll = new XoopsFormCheckBox( '', 'all_groups_dlimage', 0);
        $groupsCanDlImageAll->setExtra('onclick="javascript:toggleCheckbox(this)"');
        $groupsCanDlImageAll->addOption(1, _CO_WGGALLERY_ALL);
        $groupsCanDlImageTray->addElement($groupsCanDlImageAll, false);
		$form->addElement($groupsCanDlImageTray);
        // Form Select Allowdownload
		$albAllowdownload = $this->isNew() ? 0 : $this->getVar('alb_allowdownload');
		$allowdownloadSelect = new XoopsFormRadio( _CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD, 'alb_allowdownload', $albAllowdownload);
		$allowdownloadSelect->addOption(0, _CO_WGGALLERY_NONE);
		$allowdownloadSelect->addOption(WGGALLERY_DOWNLOAD_MEDIUM, _CO_WGGALLERY_ALBUM_DOWNLOAD_MEDIUM);
		$allowdownloadSelect->addOption(WGGALLERY_DOWNLOAD_LARGE, _CO_WGGALLERY_ALBUM_DOWNLOAD_LARGE);
		$form->addElement($allowdownloadSelect);
		// Form Text Date Select AlbDate
		$albDate = $this->isNew() ? 0 : $this->getVar('alb_date');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGGALLERY_ALBUM_DATE, 'alb_date', '', $albDate ));
		// Form Select User AlbSubmitter
        echo 'uid'.$GLOBALS['xoopsUser']->getVar('uid');
        if ( $this->isNew() ) {
            $alb_submitter = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getVar('uid') : 0;
        } else {
            $alb_submitter = $this->getVar('alb_submitter');
        }
        
		$form->addElement(new XoopsFormSelectUser( _CO_WGGALLERY_ALBUM_SUBMITTER, 'alb_submitter', false, $alb_submitter ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$btnTray = new XoopsFormElementTray('', '&nbsp;' );
		$btnTray->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		$btnSubmitUpload = new XoopsFormButton('', 'submit_upload',_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD, 'submit');
		$btnSubmitUpload->setClass('btn btn-primary');
		$btnTray->addElement($btnSubmitUpload);
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
		$form = new XoopsThemeForm(_CO_WGGALLERY_ALBUM_SELECT_DESC, 'formselalbum', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Table Albums
		$albumsHandler = $wggallery->getHandler('albums');
		$crAlbums = new CriteriaCompo();
		$crAlbums->add(new Criteria('alb_iscat', 0));
		$crAlbums->setSort('alb_date');
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
				$albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
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
		// $albums = $wggallery->getHandler('albums');
		// $albumsObj = $albums->get($this->getVar('alb_pid'));
		$ret['pid'] = $this->getVar('alb_pid');
        $ret['iscat'] = $this->getVar('alb_iscat');
		$ret['name'] = $this->getVar('alb_name');
		$ret['desc'] = $this->getVar('alb_desc', 'n');
		$ret['weight'] = $this->getVar('alb_weight');
		$imagesHandler = $wggallery->getHandler('images');
		if (WGGALLERY_ALBUM_IMGCAT_USE_EXIST_VAL === $this->getVar('alb_imgcat')) {
			$imagesObj = $imagesHandler->get($this->getVar('alb_imgid'));
			if (isset($imagesObj) && is_object($imagesObj)) {
				$image = WGGALLERY_UPLOAD_IMAGE_URL . '/medium/' .  $imagesObj->getVar('img_name');
			} else {
				$image = _CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND;
				$ret['image_err'] = true;
			}
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
		$ret['allowdownload'] = $this->getVar('alb_allowdownload');
		$ret['state_text'] = $wggallery->getStateText($this->getVar('alb_state'));
		$ret['date'] = formatTimeStamp($this->getVar('alb_date'), 's');
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
	public function getCountAlbums($start = 0, $limit = 0, $sort = 'alb_id ASC, alb_name', $order = 'ASC')
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
	public function getAllAlbums($start = 0, $limit = 0, $sort = 'alb_id ASC, alb_name', $order = 'ASC')
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
	 * @param int $albId 
	 * @return array
	 */
    function getChildsOfCategory($albPid)
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
				$childsAll .= "|" . $albumsAll[$i]->getVar('alb_id');
                $child = $this->getChildsOfCategory($albumsAll[$i]->getVar('alb_id'));
                if ( 0 < count($child)) {
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
    function getListChildsOfCategory($albPid)
    {
        
        $listChilds = array();
        if ( 0 < $albPid) {
			$listChilds = array('typ' =>'group-start');
		};
       
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
                $listChilds = array('typ' =>'item', 'alb_id' => $albumsAll[$i]->getVar('alb_id'), 'alb_name' => $albumsAll[$i]->getVar('alb_name'), 'alb_pid' => $alb_pid, 'child' => $child,);
            }
		} else {
			return false;
		}
		if ( 0 < $albPid) {
			$listChilds = array('typ' =>'group-end');
		}
        return $listChilds;
    }
    
    function getListChildsOfCategory_sav($albPid)
    {
        if ( 0 < $albPid) {
			$childsAll = '<ol>';
		} else {
			$childsAll = '';
		};
       
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
