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
 * @version        $Id: 1.0 gallerytypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WggalleryGallerytypes
 */
class WggalleryGallerytypes extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
		$this->initVar('gt_id', XOBJ_DTYPE_INT);
		$this->initVar('gt_primary', XOBJ_DTYPE_INT);
		$this->initVar('gt_name', XOBJ_DTYPE_TXTBOX);
		$this->initVar('gt_desc', XOBJ_DTYPE_TXTAREA);
		$this->initVar('gt_credits', XOBJ_DTYPE_TXTBOX);
		$this->initVar('gt_template', XOBJ_DTYPE_TXTBOX);
		$this->initVar('gt_options', XOBJ_DTYPE_TXTAREA);
		$this->initVar('gt_date', XOBJ_DTYPE_INT);
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
	public function getNewInsertedIdGallerytypes()
	{
		$newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
		return $newInsertedId;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormGallerytypes($action = false)
	{
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Title
		$title = $this->isNew() ? sprintf(_AM_WGGALLERY_GALLERYTYPE_ADD) : sprintf(_AM_WGGALLERY_GALLERYTYPE_EDIT);
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text GtPrimary
		$gtCat = $this->isNew() ? 0 : $this->getVar('gt_primary');
		$form->addElement(new XoopsFormRadioYN( _AM_WGGALLERY_GALLERYTYPE_CAT, 'gt_primary', $gtCat ), true);
		// Form Text GtName
		$form->addElement(new XoopsFormText( _AM_WGGALLERY_GALLERYTYPE_NAME, 'gt_name', 50, 255, $this->getVar('gt_name') ), true);
		// Form Text Area GtDesc
		$form->addElement(new XoopsFormTextArea( _AM_WGGALLERY_GALLERYTYPE_DESC, 'gt_desc', $this->getVar('gt_desc', 'e'), 4, 47 ));
		// Form Text GtCredits
		$form->addElement(new XoopsFormText( _AM_WGGALLERY_GALLERYTYPE_CREDITS, 'gt_credits', 50, 255, $this->getVar('gt_credits') ));
		// Form Text GtTemplate
		$form->addElement(new XoopsFormText( _AM_WGGALLERY_GALLERYTYPE_TEMPLATE, 'gt_template', 50, 255, $this->getVar('gt_template') ));
		// Form Text Area GtOption
		$form->addElement(new XoopsFormTextArea( _AM_WGGALLERY_GALLERYTYPE_OPTION, 'gt_options', $this->getVar('gt_options'), 4, 47 ));
		// Form Text Date Select GtDate
		$gtDate = $this->isNew() ? 0 : $this->getVar('gt_date');
		$form->addElement(new XoopsFormTextDateSelect( _AM_WGGALLERY_GALLERYTYPE_DATE, 'gt_date', '', $gtDate ));
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
		return $form;
	}

	/**
	 * @public function getForm
	 * @param bool $action
	 * @return XoopsThemeForm
	 */
	public function getFormGallerytypeOptions($action = false)
	{
		$wggallery = WggalleryHelper::getInstance();
		if(false === $action) {
			$action = $_SERVER['REQUEST_URI'];
		}
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm(_AM_WGGALLERY_OPTION_GT_SET, 'form', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text GtPrimary
		
		$tpl_options = $this->getVar('gt_options', 'N');
        $options = unserialize($tpl_options);
		
		foreach ($options as $option) {
			// echo '<br>name'.$option['name'];
            switch ($option['name']) {
				case 'showThumbs':
					$randomize = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS, 'showThumbs', $option['value']);
					$randomize->addOption('true', _AM_WGGALLERY_OPTION_GT_SHOWTHUMBS);
					$randomize->addOption('false', _AM_WGGALLERY_OPTION_GT_SHOWDOTS);
					$form->addElement($randomize);
				break;
				case 'rowHeight':
					$rowHeight = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ROWHEIGHT, 'rowHeight', $option['value']);
					for ($i = 10; $i <= 50; $i++) {
						$rowHeight->addOption( $i . '0', $i . '0');
					}
					$form->addElement($rowHeight);
				break;
				case 'lastRow':
					$lastRow = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_JUSTIFY, 'lastRow', $option['value']);
					$lastRow->addOption('justify', _YES);
					$lastRow->addOption('nojustify', _NO);
					$form->addElement($lastRow);
				break;
				case 'margins':
					$margins = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_MARGINS, 'margins', $option['value']);
					for ($i = 1; $i <= 30; $i++) {
						$margins->addOption( $i, $i);
					}
					$form->addElement($margins);
				break;
				case 'border':
					$border = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BORDER, 'border', $option['value']);
					for ($i = 1; $i <= 100; $i++) {
						$border->addOption( $i, $i);
					}
					$form->addElement($border);
				break;
				case 'randomize':
					$randomize = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_RANDOMIZE, 'randomize', $option['value']);
					$randomize->addOption('true', _YES);
					$randomize->addOption('false', _NO);
					$form->addElement($randomize);
				break;
				case 'slideshow':
					$randomize = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SLIDESHOW, 'slideshow', $option['value']);
					$randomize->addOption('true', _YES);
					$randomize->addOption('false', _NO);
					$form->addElement($randomize);
				break;
				case 'slideshow_options':
					$form->addElement(new XoopsFormLabel( '<br><u>' . _AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS . '</u>', ''));
					$form->addElement(new XoopsFormHidden( 'slideshow_options', ''));
				break;
				case 'colorboxstyle':
					$colorboxstyle = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE, 'colorboxstyle', $option['value']);
					$colorboxstyle->addOption('style1', 'style1');
					$colorboxstyle->addOption('style2', 'style2');
					$colorboxstyle->addOption('style3', 'style3');
					$colorboxstyle->addOption('style4', 'style4');
					$colorboxstyle->addOption('style5', 'style5');
					$form->addElement($colorboxstyle);
				break;
				case 'speed':
					$speed = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SPEEDOPEN, 'speed', $option['value']);
					for ($i = 1; $i <= 10; $i++) {
						$speed->addOption( $i . '00', $i . '00');
					}
					$form->addElement($speed);
				break;
				case 'open':
					$open = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOOPEN, 'open', $option['value']);
					$open->addOption('true', _YES);
					$open->addOption('false', _NO);
					$form->addElement($open);
				break;
				case 'transition':
					$transition = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSITION, 'transition', $option['value']);
					$transition->addOption('elastic', 'elastic');
					$transition->addOption('fade', 'fade');
					$transition->addOption('none', 'none');
					$form->addElement($transition);
				break;
				case 'slideshowSpeed':
					$slideshowSpeed = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED, 'slideshowSpeed', $option['value']);
					for ($i = 5; $i <= 50; $i+=5) {
						$slideshowSpeed->addOption( $i . '00', $i . '00');
					}
					$form->addElement($slideshowSpeed);
				break;
				case 'slideshowAuto':
					$slideshowAuto = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SLIDESHOWAUTO, 'slideshowAuto', $option['value']);
					$slideshowAuto->addOption('true', _YES);
					$slideshowAuto->addOption('false', _NO);
					$form->addElement($slideshowAuto);
				break;
				case 'opacity':
					$opacity = new XoopsFormSelect(_AM_WGGALLERY_OPTION_OPACITIY, 'opacity', $option['value']);
					$opacity->addOption('0.1', '0.1');
					$opacity->addOption('0.2', '0.2');
					$opacity->addOption('0.3', '0.3');
					$opacity->addOption('0.4', '0.4');
					$opacity->addOption('0.5', '0.5');
					$opacity->addOption('0.6', '0.6');
					$opacity->addOption('0.7', '0.7');
					$opacity->addOption('0.8', '0.8');
					$opacity->addOption('0.9', '0.9');
					$opacity->addOption('1.0', '1.0');
					$form->addElement($opacity);
				break;
                case 'fullscreen':
					$fullscreen = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_FULLSCREEN, 'fullscreen', $option['value']);
					$fullscreen->addOption('true', _YES);
					$fullscreen->addOption('false', _NO);
					$form->addElement($fullscreen);
				break;
                case 'download':
					$download = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD, 'download', $option['value']);
					$download->addOption('true', _YES);
					$download->addOption('false', _NO);
					$form->addElement($download);
				break;
                case 'zoomable':
					$zoomable = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM, 'zoomable', $option['value']);
					$zoomable->addOption('true', _YES);
					$zoomable->addOption('false', _NO);
					$form->addElement($zoomable);
				break;
                case 'toolbar':
					$toolbar = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TOOLBAR, 'toolbar', $option['value']);
					$toolbar->addOption('true', _YES);
					$toolbar->addOption('false', _NO);
					$form->addElement($toolbar);
				break;
                case 'title':
					$title = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TITLE, 'title', $option['value']);
					$title->addOption('true', _YES);
					$title->addOption('false', _NO);
					$form->addElement($title);
				break;
                case 'navbar':
					$navbar = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_NAVBAR, 'navbar', $option['value']);
					$navbar->addOption('true', _YES);
					$navbar->addOption('false', _NO);
					$form->addElement($navbar);
				break;
                case 'button_close':
					$button_close = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE, 'button_close', $option['value']);
					$button_close->addOption('true', _YES);
					$button_close->addOption('false', _NO);
					$form->addElement($button_close);
				break;
                case 'source_preview':
					$source_preview = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE, 'source_preview', $option['value']);
					$source_preview->addOption('medium', 'medium');
					$source_preview->addOption('large', 'large');
					$form->addElement($source_preview);
				break;
				case 'adaptiveHeight':
					$adaptiveHeight = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_ADAPTHEIGT, 'adaptiveHeight', $option['value']);
					$adaptiveHeight->addOption('true', _YES);
					$adaptiveHeight->addOption('false', _NO);
					$form->addElement($adaptiveHeight);
				break;
				case 'verticalCentering':
					$verticalCentering = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_VERTCENTER, 'verticalCentering', $option['value']);
					$verticalCentering->addOption('true', _YES);
					$verticalCentering->addOption('false', _NO);
					$form->addElement($verticalCentering);
				break;
				case 'displayList':
					$displayList = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYLIST, 'displayList', $option['value']);
					$displayList->addOption('true', _YES);
					$displayList->addOption('false', _NO);
					$form->addElement($displayList);
				break;
				case 'listPosition':
					$listPosition = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYPOS, 'listPosition', $option['value']);
					$listPosition->addOption('left', _AM_WGGALLERY_OPTION_GT_DISPLAYPOS_LEFT);
					$listPosition->addOption('right', _AM_WGGALLERY_OPTION_GT_DISPLAYPOS_RIGHT);
					$form->addElement($listPosition);
				break;
				case 'css_pgwslideshow':
					$css_pgwslideshow = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_THEME, 'css_pgwslideshow', $option['value']);
					$css_pgwslideshow->addOption('pgwslideshow.min.css', 'dark');
					$css_pgwslideshow->addOption('pgwslideshow_light.min.css', 'light');
					$form->addElement($css_pgwslideshow);
				break;
				case 'source':
					$source = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE, 'source', $option['value']);
					$source->addOption('medium', 'medium');
					$source->addOption('large', 'large');
					$form->addElement($source);
				break;
				case 'transitionEffect':
					$transitionEffect = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, 'transitionEffect', $option['value']);
					$transitionEffect->addOption('fading', 'fading');
					$transitionEffect->addOption('sliding', 'sliding');
					$form->addElement($transitionEffect);
				break;
				case 'adaptiveDuration':
					$dadapt = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ADAPDURATION, 'adaptiveDuration', $option['value']);
					$dadapt->addOption('100', '100');
					$dadapt->addOption('200', '200');
					$dadapt->addOption('300', '300');
					$dadapt->addOption('400', '400');
					$dadapt->addOption('500', '500');
					$dadapt->addOption('600', '600');
					$dadapt->addOption('700', '700');
					$dadapt->addOption('800', '800');
					$dadapt->addOption('900', '900');
					$dadapt->addOption('1000', '1000');
					$form->addElement($dadapt);
				break;
				case 'transitionDuration':
					$dtrans = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSDURATION, 'transitionDuration', $option['value']);
					$dtrans->addOption('100', '100');
					$dtrans->addOption('200', '200');
					$dtrans->addOption('300', '300');
					$dtrans->addOption('400', '400');
					$dtrans->addOption('500', '500');
					$dtrans->addOption('600', '600');
					$dtrans->addOption('700', '700');
					$dtrans->addOption('800', '800');
					$dtrans->addOption('900', '900');
					$dtrans->addOption('1000', '1000');
					$form->addElement($dtrans);
				break;
				case 'autoSlide':
					$autoSlide = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOPLAY, 'autoSlide', $option['value']);
					$autoSlide->addOption('true', _YES);
					$autoSlide->addOption('false', _NO);
					$form->addElement($autoSlide);
				break;
				case 'displayControls':
					$displayControls = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYCONTROLS, 'displayControls', $option['value']);
					$displayControls->addOption('true', _YES);
					$displayControls->addOption('false', _NO);
					$form->addElement($displayControls);
				break;
				case 'intervalDuration':
					$dint = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_INTDURATION, 'intervalDuration', $option['value']);
					$dint->addOption('500', '500');
					$dint->addOption('1000', '1000');
					$dint->addOption('1500', '1500');
					$dint->addOption('2000', '2000');
					$dint->addOption('2500', '2500');
					$dint->addOption('3000', '3000');
					$dint->addOption('3500', '3500');
					$dint->addOption('4000', '4000');
					$dint->addOption('4500', '4500');
					$dint->addOption('5000', '5000');
					$form->addElement($dint);
				break;
			}
		}
		// To Save
		$form->addElement(new XoopsFormHidden('op', 'saveoptions'));
		$form->addElement(new XoopsFormHidden('gt_id', $this->getVar('gt_id')));
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
	public function getValuesGallerytypes($keys = null, $format = null, $maxDepth = null)
	{
		$wggallery = WggalleryHelper::getInstance();
		$ret = $this->getValues($keys, $format, $maxDepth);
		$ret['id'] = $this->getVar('gt_id');
		$ret['primary'] = $this->getVar('gt_primary');
		$ret['name'] = $this->getVar('gt_name');
		$ret['desc'] = $this->getVar('gt_desc');
		$ret['credits'] = $this->getVar('gt_credits');
		$ret['template'] = $this->getVar('gt_template');
		$ret['options'] = $this->getVar('gt_options');
		$gt_options = $this->getVar('gt_options', 'N');
        $options_text = '';
		if ( '' !== $gt_options ) {
            $options = unserialize($gt_options);
            $counter = 0;
            foreach ($options as $option) {
                $options_text .= $option['name'] . ': ' . $option['value'] . '<br>';
            }
        }
		$ret['options_text'] = $options_text;
		$ret['date'] = formatTimeStamp($this->getVar('gt_date'), 's');
		return $ret;
	}

	/**
	 * Returns an array representation of the object
	 *
	 * @return array
	 */
	public function toArrayGallerytypes()
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
 * Class Object Handler WggalleryGallerytypes
 */
class WggalleryGallerytypesHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		parent::__construct($db, 'wggallery_gallerytypes', 'wggallerygallerytypes', 'gt_id', 'gt_name');
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
	 * Get Count Gallerytypes in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	public function getCountGallerytypes($start = 0, $limit = 0, $sort = 'gt_id ASC, gt_name', $order = 'ASC')
	{
		$crCountGallerytypes = new CriteriaCompo();
		$crCountGallerytypes = $this->getGallerytypesCriteria($crCountGallerytypes, $start, $limit, $sort, $order);
		return parent::getCount($crCountGallerytypes);
	}

	/**
	 * Get All Gallerytypes in the database
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return array
	 */
	public function getAllGallerytypes($start = 0, $limit = 0, $sort = 'gt_id ASC, gt_name', $order = 'ASC')
	{
		$crAllGallerytypes = new CriteriaCompo();
		$crAllGallerytypes = $this->getGallerytypesCriteria($crAllGallerytypes, $start, $limit, $sort, $order);
		return parent::getAll($crAllGallerytypes);
	}

	/**
	 * Get Criteria Gallerytypes
	 * @param        $crGallerytypes
	 * @param int    $start 
	 * @param int    $limit 
	 * @param string $sort 
	 * @param string $order 
	 * @return int
	 */
	private function getGallerytypesCriteria($crGallerytypes, $start, $limit, $sort, $order)
	{
		$crGallerytypes->setStart( $start );
		$crGallerytypes->setLimit( $limit );
		$crGallerytypes->setSort( $sort );
		$crGallerytypes->setOrder( $order );
		return $crGallerytypes;
	}
	
	/**
	 * Get primary Gallerytype
	 * @return string
	 */
	public function getPrimaryGallery()
	{
		$gallerytype = array();
		$crGallerytypes = new CriteriaCompo();
		$crGallerytypes->add(new Criteria('gt_primary', 1));
		$crGallerytypes->setLimit( 1 );
		$gallerytypesAll = $this->getAll($crGallerytypes);
		foreach(array_keys($gallerytypesAll) as $i) {
			$gallerytype['name'] = $gallerytypesAll[$i]->getVar('gt_name');
            $gallerytype['template'] = $gallerytypesAll[$i]->getVar('gt_template');
			$gallerytype['options'] = $gallerytypesAll[$i]->getVar('gt_options', 'N');
		}
		return $gallerytype;
	}
	
	/**
	 * Get primary Gallerytype
	 * @return array
	 */
	public function getGalleryOptions()
	{
		$options = array();
		$crGallerytypes = new CriteriaCompo();
		$crGallerytypes->add(new Criteria('gt_primary', 1));
		$crGallerytypes->setLimit( 1 );
		$gallerytypesAll = $this->getAll($crGallerytypes);
		foreach(array_keys($gallerytypesAll) as $i) {
			$gt_options = $gallerytypesAll[$i]->getVar('gt_options');
		}
		$optionsTmp = explode('|', gt_options);
		
		return $gallerytype;
	}
}
