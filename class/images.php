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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WggalleryImages
 */
class WggalleryImages extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('img_id', XOBJ_DTYPE_INT);
		$this->initVar('img_title', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_desc', XOBJ_DTYPE_TXTAREA);
		$this->initVar('img_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_origname', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_mimetype', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_size', XOBJ_DTYPE_INT);
		$this->initVar('img_resx', XOBJ_DTYPE_INT);
		$this->initVar('img_resy', XOBJ_DTYPE_INT);
		$this->initVar('img_downloads', XOBJ_DTYPE_INT);
		$this->initVar('img_ratinglikes', XOBJ_DTYPE_INT);
		$this->initVar('img_votes', XOBJ_DTYPE_INT);
		$this->initVar('img_weight', XOBJ_DTYPE_INT);
		$this->initVar('img_albid', XOBJ_DTYPE_INT);
		$this->initVar('img_state', XOBJ_DTYPE_INT);
		$this->initVar('img_date', XOBJ_DTYPE_INT);
		$this->initVar('img_submitter', XOBJ_DTYPE_INT);
		$this->initVar('img_ip', XOBJ_DTYPE_TXTAREA);
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
	public function getNewInsertedIdImages()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormImages($action = false)
	{
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Permissions for uploader
		$gpermHandler = xoops_gethandler('groupperm');
		$groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
		if($GLOBALS['xoopsUser']) {
			if(!$GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid())) {
				$permissionUpload = $gpermHandler->checkRight('', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
			} else {
				$permissionUpload = true;
			}
		} else {
				$permissionUpload = $gpermHandler->checkRight('', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
		}
		// Title
		$title = $this->isNew() ? sprintf(_CO_WGGALLERY_IMAGE_ADD) : sprintf(_CO_WGGALLERY_IMAGE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text ImgTitle
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_TITLE, 'img_title', 50, 255, $this->getVar('img_title') ));
		// Form editor ImgDesc
		$editorConfigs = array();
		$editorConfigs['name'] = 'img_desc';
		$editorConfigs['value'] = $this->getVar('img_desc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wggallery->getConfig('editor');
		$form->addElement(new XoopsFormEditor( _CO_WGGALLERY_IMAGE_DESC, 'img_desc', $editorConfigs));
		// Form Text ImgName
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_NAME, 'img_name', 50, 255, $this->getVar('img_name') ), true);
		// Form Text ImgOrigname
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_ORIGNAME, 'img_origname', 50, 255, $this->getVar('img_origname') ), true);
		// Form Text ImgMimetype
		$imgMimetype = $this->isNew() ? '0' : $this->getVar('img_mimetype');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_MIMETYPE, 'img_mimetype', 20, 150, $imgMimetype ));
		// Form Text ImgSize
		$imgSize = $this->isNew() ? '0' : $this->getVar('img_size');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_SIZE, 'img_size', 20, 150, $imgSize ));
		// Form Text ImgResx
		$imgResx = $this->isNew() ? '0' : $this->getVar('img_resx');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RESX, 'img_resx', 20, 150, $imgResx ));
		// Form Text ImgResy
		$imgResy = $this->isNew() ? '0' : $this->getVar('img_resy');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RESY, 'img_resy', 20, 150, $imgResy ));
		// Form Text ImgDownloads
		$imgDownloads = $this->isNew() ? '0' : $this->getVar('img_downloads');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_DOWNLOADS, 'img_downloads', 20, 150, $imgDownloads ));
		// Form Text ImgRatinglikes
		$imgRatinglikes = $this->isNew() ? '0' : $this->getVar('img_ratinglikes');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RATINGLIKES, 'img_ratinglikes', 20, 150, $imgRatinglikes ));
		// Form Text ImgVotes
		$imgVotes = $this->isNew() ? '0' : $this->getVar('img_votes');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_VOTES, 'img_votes', 20, 150, $imgVotes ));
		// Form Text ImgWeight
		$imgWeight = $this->isNew() ? '0' : $this->getVar('img_weight');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_WEIGHT, 'img_weight', 20, 150, $imgWeight ));
		// Form Table albums
		$albumsHandler = $wggallery->getHandler('albums');
		$imgAlbidSelect = new XoopsFormSelect( _CO_WGGALLERY_IMAGE_ALBID, 'img_albid', $this->getVar('img_albid'));
		$imgAlbidSelect->addOptionArray($albumsHandler->getList());
		$form->addElement($imgAlbidSelect, true);
		// Images handler
		$imagesHandler = $wggallery->getHandler('images');
		// Form Select Images
		$imgStateSelect = new XoopsFormSelect( _CO_WGGALLERY_IMAGE_STATE, 'img_state', $this->getVar('img_state'));
		$imgStateSelect->addOption('Empty');
		$imgStateSelect->addOptionArray($imagesHandler->getList());
		$form->addElement($imgStateSelect, true);
		// Form Text Date Select ImgDate
		$imgDate = $this->isNew() ? 0 : $this->getVar('img_date');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGGALLERY_IMAGE_DATE, 'img_date', '', $imgDate ));
		// Form Select User ImgSubmitter
		$form->addElement(new XoopsFormSelectUser( _CO_WGGALLERY_IMAGE_SUBMITTER, 'img_submitter', false, $this->getVar('img_submitter') ));
		// Form Text ImgIp
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_IP, 'img_ip', 50, 255, $this->getVar('img_ip') ));
		// Permissions
		$memberHandler = xoops_gethandler('member');
		$groupList = $memberHandler->getGroupList();
		$gpermHandler = xoops_gethandler('groupperm');
		$fullList[] = array_keys($groupList);
		if(!$this->isNew()) {
			$groupsIdsApprove = $gpermHandler->getGroupIds('wggallery_approve', $this->getVar('img_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsApprove[] = array_values($groupsIdsApprove);
			$groupsCanApproveCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_GL_APPROVE, 'groups_approve[]', $groupsIdsApprove);
			$groupsIdsSubmit = $gpermHandler->getGroupIds('wggallery_submit', $this->getVar('img_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsSubmit[] = array_values($groupsIdsSubmit);
			$groupsCanSubmitCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_GL_SUBMIT, 'groups_submit[]', $groupsIdsSubmit);
			$groupsIdsView = $gpermHandler->getGroupIds('wggallery_view', $this->getVar('img_id'), $GLOBALS['xoopsModule']->getVar('mid'));
			$groupsIdsView[] = array_values($groupsIdsView);
			$groupsCanViewCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_ALB_VIEW, 'groups_view[]', $groupsIdsView);
		} else {
			$groupsCanApproveCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_GL_APPROVE, 'groups_approve[]', $fullList);
			$groupsCanSubmitCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_GL_SUBMIT, 'groups_submit[]', $fullList);
			$groupsCanViewCheckbox = new XoopsFormCheckBox( _CO_WGGALLERY_PERMS_ALB_VIEW, 'groups_view[]', $fullList);
		}
		// To Approve
		$groupsCanApproveCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanApproveCheckbox);
		// To Submit
		$groupsCanSubmitCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanSubmitCheckbox);
		// To View
		$groupsCanViewCheckbox->addOptionArray($groupList);
		$form->addElement($groupsCanViewCheckbox);
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * Get Values
	 * @param null $keys 
	 * @param null $format 
	 * @param null$maxDepth 
	 * @return array
	 */
	public function getValuesImages($keys = null, $format = null, $maxDepth = null)
	{
		$wggallery = WggalleryHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('img_id');
		$ret['title'] = $this->getVar('img_title');
		$ret['desc'] = $this->getVar('img_desc', 'n');
		$ret['name'] = $this->getVar('img_name');
		$ret['origname'] = $this->getVar('img_origname');
		$ret['mimetype'] = $this->getVar('img_mimetype');
		$ret['size'] = $this->getVar('img_size');
		$ret['resx'] = $this->getVar('img_resx');
		$ret['resy'] = $this->getVar('img_resy');
		$ret['downloads'] = $this->getVar('img_downloads');
		$ret['ratinglikes'] = $this->getVar('img_ratinglikes');
		$ret['votes'] = $this->getVar('img_votes');
		$ret['weight'] = $this->getVar('img_weight');
		$ret['albid'] = $this->getVar('img_albid');
		// $albums = $wggallery->getHandler('albums');
		// $albumsObj = $albums->get($this->getVar('img_albid'));
		// if (isset($albumsObj) && is_object($albumsObj)) {
			// $ret['alb_name'] = $albumsObj->getVar('alb_name');
		// }
		$ret['state'] = $this->getVar('img_state');
		$ret['state_text'] = $wggallery->getStateText($this->getVar('img_state'));
		$ret['date'] = formatTimeStamp($this->getVar('img_date'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('img_submitter'));
		$ret['ip'] = $this->getVar('img_ip');
		$ret['large'] = WGGALLERY_UPLOAD_IMAGE_URL . '/large/' .  $this->getVar('img_name');
		$ret['medium'] = WGGALLERY_UPLOAD_IMAGE_URL . '/medium/' .  $this->getVar('img_name');
		$ret['thumb'] = WGGALLERY_UPLOAD_IMAGE_URL . '/thumbs/' .  $this->getVar('img_name');
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayImages()
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
 * Class Object Handler WggalleryImages
 */
class WggalleryImagesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wggallery_images', 'wggalleryimages', 'img_id', 'img_name');
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
	 * Get Count Images in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountImages($albId = 0, $start = 0, $limit = 0, $sort = 'img_id ASC, img_name', $order = 'ASC')
	{
		$crCountImages = new CriteriaCompo();
		$crCountImages = $this->getImagesCriteria($crCountImages, $albId, $start, $limit, $sort, $order);
		return parent::getCount($crCountImages);
	}

	/**
	 * Get All Images in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllImages($start = 0, $limit = 0, $sort = 'img_id ASC, img_name', $order = 'ASC')
	{
		$crAllImages = new CriteriaCompo();
		$crAllImages = $this->getImagesCriteria($crAllImages, 0, $start, $limit, $sort, $order);
		return parent::getAll($crAllImages);
	}    

	/**
	 * Get Criteria Images
	 * @param        $crImages
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getImagesCriteria($crImages, $albId, $start, $limit, $sort, $order)
	{
		if ( 0 < $albId) {
			$crImages->add(new Criteria('img_albid', $albId));
		}
		$crImages->setStart( $start );
		$crImages->setLimit( $limit );
		$crImages->setSort( $sort );
		$crImages->setOrder( $order );
		return $crImages;
	}
		
	/**
	 * delete all copies of a specific image
	 * @param string $imgName
	 * @return bool
	 */
	public function unlinkImages($imageName)
	{
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageName);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageName)) {return false;}
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName)) {return false;}
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName)) {return false;}		
		
		return true;
	}
}
