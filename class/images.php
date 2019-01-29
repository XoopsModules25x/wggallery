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
        $this->initVar('img_namelarge', XOBJ_DTYPE_TXTBOX);
		$this->initVar('img_nameorig', XOBJ_DTYPE_TXTBOX);
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
        $this->initVar('img_exif', XOBJ_DTYPE_TXTAREA);
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
     * @param bool $adminarea
     * @param bool $action
     * @return XoopsThemeForm
     */
	public function getFormImages($adminarea = false, $action = false)
	{
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
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
		$editorConfigs = [];
		$editorConfigs['name'] = 'img_desc';
		$editorConfigs['value'] = $this->getVar('img_desc', 'e');
		$editorConfigs['rows'] = 5;
		$editorConfigs['cols'] = 40;
		$editorConfigs['width'] = '100%';
		$editorConfigs['height'] = '400px';
		$editorConfigs['editor'] = $wggallery->getConfig('editor');
		$form->addElement(new XoopsFormEditor( _CO_WGGALLERY_IMAGE_DESC, 'img_desc', $editorConfigs));
        $imgMimetype = $this->isNew() ? '0' : $this->getVar('img_mimetype');
        $imgSize = $this->isNew() ? '0' : $this->getVar('img_size');
        $imgResx = $this->isNew() ? '0' : $this->getVar('img_resx');
        $imgResy = $this->isNew() ? '0' : $this->getVar('img_resy');
        if ( $adminarea ) {
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_NAME, 'img_name', 50, 255, $this->getVar('img_name') ), true);
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_NAMELARGE, 'img_namelarge', 50, 255, $this->getVar('img_namelarge') ), true);
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_NAMEORIG, 'img_nameorig', 50, 255, $this->getVar('img_nameorig') ), true);
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_MIMETYPE, 'img_mimetype', 20, 150, $imgMimetype ));
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_SIZE, 'img_size', 20, 150, $imgSize ));
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RESX, 'img_resx', 20, 150, $imgResx ));
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RESY, 'img_resy', 20, 150, $imgResy ));
        } else {
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_NAME, $this->getVar('img_name') ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_NAMELARGE, $this->getVar('img_namelarge') ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_NAMEORIG, $this->getVar('img_nameorig') ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_MIMETYPE, $imgMimetype ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_SIZE, $imgSize ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_RESX, $imgResx ));
            $form->addElement(new XoopsFormLabel( _CO_WGGALLERY_IMAGE_RESY, $imgResy ));
            $form->addElement(new XoopsFormHidden('img_name', $this->getVar('img_name')));
            $form->addElement(new XoopsFormHidden('img_namelarge', $this->getVar('img_namelarge')));
            $form->addElement(new XoopsFormHidden('img_nameorig', $this->getVar('img_nameorig')));
            $form->addElement(new XoopsFormHidden('img_mimetype', $imgMimetype));
            $form->addElement(new XoopsFormHidden('img_size', $imgSize));
            $form->addElement(new XoopsFormHidden('img_resx', $imgResx));
            $form->addElement(new XoopsFormHidden('img_resy', $imgResy));
        }
		
		// Form Text ImgDownloads
		$imgDownloads = $this->isNew() ? '0' : $this->getVar('img_downloads');
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_DOWNLOADS, 'img_downloads', 20, 150, $imgDownloads ));
		// Form Text ImgRatinglikes TODO
		// $imgRatinglikes = $this->isNew() ? '0' : $this->getVar('img_ratinglikes');
		// $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_RATINGLIKES, 'img_ratinglikes', 20, 150, $imgRatinglikes ));
		// Form Text ImgVotes TODO
		// $imgVotes = $this->isNew() ? '0' : $this->getVar('img_votes');
		// $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_VOTES, 'img_votes', 20, 150, $imgVotes ));
		// Form Text ImgWeight
		$imgWeight = $this->isNew() ? '0' : $this->getVar('img_weight');
        if ( $adminarea ) {
            $form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_WEIGHT, 'img_weight', 20, 150, $imgWeight ));
		} else {
            $form->addElement(new XoopsFormHidden('img_weight', $imgWeight));
        }
        // Form Table albums
		$albumsHandler = $wggallery->getHandler('albums');
		$imgAlbidSelect = new XoopsFormSelect( _CO_WGGALLERY_IMAGE_ALBID, 'img_albid', $this->getVar('img_albid'));
		$imgAlbidSelect->addOptionArray($albumsHandler->getList());
		$form->addElement($imgAlbidSelect, true);
		// Images handler
		$imagesHandler = $wggallery->getHandler('images');
		// Form Select Images
		$imgStateSelect = new XoopsFormSelect( _CO_WGGALLERY_IMAGE_STATE, 'img_state', $this->getVar('img_state'));
        $imgStateSelect->addOption(WGGALLERY_STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
		$imgStateSelect->addOption(WGGALLERY_STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
		$imgStateSelect->addOption(WGGALLERY_STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
		$form->addElement($imgStateSelect, true);
		// Form Text Date Select ImgDate
		$imgDate = $this->isNew() ? 0 : $this->getVar('img_date');
		$form->addElement(new XoopsFormTextDateSelect( _CO_WGGALLERY_DATE, 'img_date', '', $imgDate ));
		// Form Select User ImgSubmitter
		$form->addElement(new XoopsFormSelectUser( _CO_WGGALLERY_SUBMITTER, 'img_submitter', false, $this->getVar('img_submitter') ));
		// Form Text ImgIp
		$form->addElement(new XoopsFormText( _CO_WGGALLERY_IMAGE_IP, 'img_ip', 50, 255, $this->getVar('img_ip') ));
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
        $ret['namelarge'] = $this->getVar('img_namelarge');
		$ret['nameorig'] = $this->getVar('img_nameorig');
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
		$ret['date'] = formatTimestamp($this->getVar('img_date'), 's');
		$ret['submitter'] = XoopsUser::getUnameFromId($this->getVar('img_submitter'));
		$ret['ip'] = $this->getVar('img_ip');
        $exif_text = '';
        if ( $wggallery->getConfig('store_exif') ) {
            $exifs = unserialize ( $this->getVar('img_exif'), ['allowed_classes' => false]);
			if ( is_array( $exifs ) ) {
				foreach ( $exifs as $key => $value) {
					if (is_array ( $value )) {
						$exif_text .= $key . ': <br>';
						foreach ( $value as $skey => $svalue) {
							$exif_text .= ' - ' . $skey . ': ' . $svalue . '<br>';
						}
					} else {
						$exif_text .= $key . ': ' . $value . '<br>';
					}
				}
			}
        }
        $ret['exif'] =  $exif_text;
        $ret['exif_short'] =  substr($exif_text, 0, 100) . '...';
		$ret['large'] = WGGALLERY_UPLOAD_IMAGE_URL . '/large/' .  $this->getVar('img_namelarge');
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
		$ret = [];
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
     * @param int $albId
     * @param int $start
     * @param int $limit
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
     * @param $crImages
     * @param $albId
     * @param int $start
     * @param int $limit
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
     * @param $imageName
     * @param $imageNameLarge
     * @return bool
     */
	public function unlinkImages($imageName, $imageNameLarge)
	{
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge)) {return false;}
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName)) {return false;}
		unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName);
		if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName)) {return false;}		
		
		return true;
	}
}
