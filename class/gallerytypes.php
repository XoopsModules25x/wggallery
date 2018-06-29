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
		$form->addElement(new XoopsFormRadioYN( _AM_WGGALLERY_GALLERYTYPE_PRIMARY, 'gt_primary', $gtCat ), true);
		// Form Text GtName
		$form->addElement(new XoopsFormText( _AM_WGGALLERY_GALLERYTYPE_NAME, 'gt_name', 50, 255, $this->getVar('gt_name') ), true);
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
                case 'source':
					$source = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_SOURCE_DESC . '</span>', 'source', $option['value']);
					$source->addOption('medium', 'medium');
					$source->addOption('large', 'large');
					$form->addElement($source);
				break;
                case 'source_preview':
					$source_preview = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_SOURCE_DESC . '</span>', 'source_preview', $option['value']);
					$source_preview->addOption('medium', 'medium');
					$source_preview->addOption('large', 'large');
					$form->addElement($source_preview);
				break;
				case 'jssor_arrows':
					$arrows = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ARROWS, 'arrows', $option['value']);
					$arrows->addOption('none', _NONE);
					$arrows->addOption('arrow-051');
					$arrows->addOption('arrow-052');
					$arrows->addOption('arrow-053');
					$arrows->addOption('arrow-054');
					$arrows->addOption('arrow-055');
					$arrows->addOption('arrow-056');
					$arrows->addOption('arrow-071');
					$arrows->addOption('arrow-072');
					$arrows->addOption('arrow-073');
					$arrows->addOption('arrow-074');
					$arrows->addOption('arrow-081');
					$arrows->addOption('arrow-082');
					$arrows->addOption('arrow-091');
					$arrows->addOption('arrow-092');
					$arrows->addOption('arrow-093');
					$arrows->addOption('arrow-094');
					$form->addElement($arrows);
				break;
				case 'jssor_bullets':
					$bullets = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BULLETS . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_BULLETS_DESC . '</span>', 'bullets', $option['value']);
					$bullets->addOption('none', _NONE);
					$bullets->addOption('bullet-031');
					$bullets->addOption('bullet-032');
					$bullets->addOption('bullet-033');
					$bullets->addOption('bullet-034');
					$bullets->addOption('bullet-035');
					$bullets->addOption('bullet-036');
					$bullets->addOption('bullet-051');
					$bullets->addOption('bullet-052');
					$bullets->addOption('bullet-053');
					$bullets->addOption('bullet-054');
					$bullets->addOption('bullet-055');
					$bullets->addOption('bullet-056');
					$bullets->addOption('bullet-057');
					$bullets->addOption('bullet-058');
					$bullets->addOption('bullet-061');
					$bullets->addOption('bullet-062');
					$bullets->addOption('bullet-063');
					$bullets->addOption('bullet-064');
					$bullets->addOption('bullet-071');
					$bullets->addOption('bullet-072');
					$form->addElement($bullets);
				break;
				case 'jssor_thumbnails':
					$thumbnails = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_THUMBNAILS, 'thumbnails', $option['value']);
					$thumbnails->addOption('none', _NONE);
					$thumbnails->addOption('thumbnail-031');
					$thumbnails->addOption('thumbnail-032');
					$thumbnails->addOption('thumbnail-033');
					$thumbnails->addOption('thumbnail-034');
					$thumbnails->addOption('thumbnail-035');
					$thumbnails->addOption('thumbnail-036');
					$thumbnails->addOption('thumbnail-051');
					$thumbnails->addOption('thumbnail-052');
					$thumbnails->addOption('thumbnail-053');
					$thumbnails->addOption('thumbnail-054');
					$thumbnails->addOption('thumbnail-055');
					$thumbnails->addOption('thumbnail-056');
					$thumbnails->addOption('thumbnail-057');
					$thumbnails->addOption('thumbnail-058');
					$thumbnails->addOption('thumbnail-061');
					$thumbnails->addOption('thumbnail-062');
					$thumbnails->addOption('thumbnail-063');
					$thumbnails->addOption('thumbnail-064');
					$thumbnails->addOption('thumbnail-071');
					$thumbnails->addOption('thumbnail-072');
					$form->addElement($thumbnails);
				break;
				case 'jssor_loadings':
					$loadings = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LOADINGS, 'loadings', $option['value']);
					$loadings->addOption('none', _NONE);
					$loadings->addOption('loading-003-oval');
					$loadings->addOption('loading-004-double-tail-spin');
					$loadings->addOption('loading-005-circles');
					$loadings->addOption('loading-006-tail-spi');
					$loadings->addOption('loading-008-ball-triangle');
					$loadings->addOption('loading-009-spin');
					$form->addElement($loadings);
				break;
                case 'jssor_autoplay':
                    $jssor_autoplay = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS, 'jssor_autoplay', $option['value']);
                    $jssor_autoplay->addOption('0', _NONE);
                    $jssor_autoplay->addOption('1', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_1);
                    $jssor_autoplay->addOption('2', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_2);
                    $jssor_autoplay->addOption('4', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_4);
                    $jssor_autoplay->addOption('8', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_8);
                    $jssor_autoplay->addOption('12', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_12);
                    $form->addElement($jssor_autoplay);
                break;
                case 'showThumbs':
					$showThumbs = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS, 'showThumbs', $option['value']);
					$showThumbs->addOption('true', _AM_WGGALLERY_OPTION_GT_SHOWTHUMBS);
					$showThumbs->addOption('false', _AM_WGGALLERY_OPTION_GT_SHOWDOTS);
					$form->addElement($showThumbs);
				break;
                case 'showTitle':
					$showTitle = new XoopsFormRadio(_AM_WGGALLERY_OPTION_SHOWTITLE, 'showTitle', $option['value']);
					$showTitle->addOption('true', _YES);
					$showTitle->addOption('false', _NO);
					$form->addElement($showTitle);
				break;
                case 'showDescr':
					$showDescr = new XoopsFormRadio(_AM_WGGALLERY_OPTION_SHOWDESCR, 'showDescr', $option['value']);
					$showDescr->addOption('true', _YES);
					$showDescr->addOption('false', _NO);
					$form->addElement($showDescr);
				break;
                case 'slideshowSpeed':
					$slideshowSpeed = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC . '</span>', 'slideshowSpeed', $option['value']);
					for ($i = 5; $i <= 50; $i+=5) {
						$slideshowSpeed->addOption( $i . '00', $i . '00');
					}
					$form->addElement($slideshowSpeed);
				break;
                case 'slideshowAuto':
					$slideshowAuto = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOPLAY . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_AUTOPLAY_DESC . '</span>', 'slideshowAuto', $option['value']);
					$slideshowAuto->addOption('true', _YES);
					$slideshowAuto->addOption('false', _NO);
					$form->addElement($slideshowAuto);
				break;
                case 'rowHeight':
					$rowHeight = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ROWHEIGHT, 'rowHeight', $option['value']);
					for ($i = 10; $i <= 50; $i++) {
						$rowHeight->addOption( $i . '0', $i . '0');
					}
					$form->addElement($rowHeight);
				break;
                case 'lastRow':
					$lastRow = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LASTROW . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_LASTROW_DESC . '</span>', 'lastRow', $option['value']);
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
                // case 'slideshow_options':
					// $form->addElement(new XoopsFormLabel( '<br><u>' . _AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS . '</u>', ''));
					// $form->addElement(new XoopsFormHidden( 'slideshow_options', ''));
				// break;
				case 'colorboxstyle':
					$colorboxstyle = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE, 'colorboxstyle', $option['value']);
					$colorboxstyle->addOption('style1', 'style1');
					$colorboxstyle->addOption('style2', 'style2');
					$colorboxstyle->addOption('style3', 'style3');
					$colorboxstyle->addOption('style4', 'style4');
					$colorboxstyle->addOption('style5', 'style5');
					$form->addElement($colorboxstyle);
				break;
                case 'transition':
					$transition = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, 'transition', $option['value']);
					$transition->addOption('elastic', 'elastic');
					$transition->addOption('fade', 'fade');
					$transition->addOption('none', 'none');
					$form->addElement($transition);
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
                case 'slideshowtype':
					$slideshowtype = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE, 'slideshowtype', $option['value']);
					$slideshowtype->addOption('lightbox');
					$slideshowtype->addOption('inline');
					$form->addElement($slideshowtype);
				break;
                case 'button_close':
					$button_close = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE, 'button_close', $option['value']);
					$button_close->addOption('true', _YES);
					$button_close->addOption('false', _NO);
					$form->addElement($button_close);
				break;
                case 'navbar':
					$navbar = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_NAVBAR, 'navbar', $option['value']);
					$navbar->addOption(0, _NO);
                    $navbar->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
					$navbar->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $navbar->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $navbar->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
					$form->addElement($navbar);
				break;
                case 'toolbar':
					$toolbar = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TOOLBAR, 'toolbar', $option['value']);
                    $toolbar->addOption(0, _NO);
                    $toolbar->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
					$toolbar->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $toolbar->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $toolbar->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
					$form->addElement($toolbar);
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
                case 'fullscreen':
					$fullscreen = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_FULLSCREEN, 'fullscreen', $option['value']);
					$fullscreen->addOption('true', _YES);
					$fullscreen->addOption('false', _NO);
					$form->addElement($fullscreen);
				break;
                case 'viewerjs_title':
					$viewerjs_title = new XoopsFormSelect(_AM_WGGALLERY_OPTION_SHOWTITLE, 'viewerjs_title', $option['value']);
					$viewerjs_title->addOption(0, _NO);
                    $viewerjs_title->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
					$viewerjs_title->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $viewerjs_title->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $viewerjs_title->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
					$form->addElement($viewerjs_title);
				break;
                case 'transitionDuration':
					$dtrans = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSDURATION . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC . '</span>', 'transitionDuration', $option['value']);
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
                case 'loop':
					$loop = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS, 'loop', $option['value']);
                    $loop->addOption('1', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_1);
                    $loop->addOption('2', _AM_WGGALLERY_OPTION_GT_AUTOPLAY_2);
					$form->addElement($loop);
				break;
                case 'showThumbnails':
					$showThumbnails = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS, 'showThumbnails', $option['value']);
					$showThumbnails->addOption('true', _YES);
					$showThumbnails->addOption('false', _NO);
					$form->addElement($showThumbnails);
				break;
                case 'indexImage':
					$indexImage = new XoopsFormElementTray(_AM_WGGALLERY_OPTION_GT_INDEXIMG, '&nbsp;' );
					$indexImage1 = new XoopsFormSelect('', 'indexImage', $option['value']);
					$indexImage1->addOption('none', _NONE);
					$indexImage1->addOption('fixedHeight', 'fixedHeight');
					$indexImage1->addOption('squareSize', 'squareSize');
					$indexImage1->addOption('simpleContainer', 'simpleContainer');
					$indexImage->addElement($indexImage1);
					foreach ($options as $option2) {
						if ($option2['name'] == 'indexImageheight') $option2value = $option2['value'];
					}
					$indexImage2 = new XoopsFormText( _AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT, 'indexImageheight', 50, 255, $option2value );
					$indexImage->addElement($indexImage2);
					$form->addElement($indexImage);
				break;
			
                

                
                
                
                
                
                
				
				
                
                
                
                
                
                
                
				
				
				
				
                
                
                
				// case 'adaptiveHeight':
					// $adaptiveHeight = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_ADAPTHEIGT, 'adaptiveHeight', $option['value']);
					// $adaptiveHeight->addOption('true', _YES);
					// $adaptiveHeight->addOption('false', _NO);
					// $form->addElement($adaptiveHeight);
				// break;
				// case 'verticalCentering':
					// $verticalCentering = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_VERTCENTER, 'verticalCentering', $option['value']);
					// $verticalCentering->addOption('true', _YES);
					// $verticalCentering->addOption('false', _NO);
					// $form->addElement($verticalCentering);
				// break;
				// case 'displayList':
					// $displayList = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYLIST, 'displayList', $option['value']);
					// $displayList->addOption('true', _YES);
					// $displayList->addOption('false', _NO);
					// $form->addElement($displayList);
				// break;
				// case 'listPosition':
					// $listPosition = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYPOS, 'listPosition', $option['value']);
					// $listPosition->addOption('left', _AM_WGGALLERY_OPTION_GT_DISPLAYPOS_LEFT);
					// $listPosition->addOption('right', _AM_WGGALLERY_OPTION_GT_DISPLAYPOS_RIGHT);
					// $form->addElement($listPosition);
				// break;

				case 'transitionEffect':
					$transitionEffect = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, 'transitionEffect', $option['value']);
					$transitionEffect->addOption('fading', 'fading');
					$transitionEffect->addOption('sliding', 'sliding');
					$form->addElement($transitionEffect);
				break;
				// case 'adaptiveDuration':
					// $dadapt = new XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ADAPDURATION, 'adaptiveDuration', $option['value']);
					// $dadapt->addOption('100', '100');
					// $dadapt->addOption('200', '200');
					// $dadapt->addOption('300', '300');
					// $dadapt->addOption('400', '400');
					// $dadapt->addOption('500', '500');
					// $dadapt->addOption('600', '600');
					// $dadapt->addOption('700', '700');
					// $dadapt->addOption('800', '800');
					// $dadapt->addOption('900', '900');
					// $dadapt->addOption('1000', '1000');
					// $form->addElement($dadapt);
				// break;
				
				// case 'autoSlide':
					// $autoSlide = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOPLAY, 'autoSlide', $option['value']);
					// $autoSlide->addOption('true', _YES);
					// $autoSlide->addOption('false', _NO);
					// $form->addElement($autoSlide);
				// break;
				// case 'displayControls':
					// $displayControls = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_DISPLAYCONTROLS, 'displayControls', $option['value']);
					// $displayControls->addOption('true', _YES);
					// $displayControls->addOption('false', _NO);
					// $form->addElement($displayControls);
				// break;
				case 'showAlbumlabel':
					$showAlbumlabel = new XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWLABEL, 'showAlbumlabel', $option['value']);
					$showAlbumlabel->addOption('true', _YES);
					$showAlbumlabel->addOption('false', _NO);
					$form->addElement($showAlbumlabel);
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
		$ret['credits'] = $this->getVar('gt_credits');
		$ret['template'] = $this->getVar('gt_template');
		$ret['options'] = $this->getVar('gt_options');
		$gt_options = $this->getVar('gt_options', 'N');
		if ( '' !== $gt_options ) {
            $options = unserialize($gt_options);
            $options_text = '<ul>';
            foreach ($options as $option) {
                $options_text .= '<li>';
                if ('' == $option['caption']) {
                    $options_text .= '"' . $option['name'] . '"';
                } else {
                    $options_text .= constant($option['caption']);
                }
                $options_text .= ': ' . $option['value'] . '</li>';
            }
            $options_text .= '</ul>';
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
	 * Reset Gallerytype
	 * @param int    $gtId
	 * @param string $sort
	 * @return boolean
	 */
 	public function reset($gtId, $template, $primary)
	{
		$options = array();
        switch ($template) {
			case 'none':
				$gt_name = 'none';
				$gt_credits = '';
				$gt_primary = '1';
			break;
            case 'jssor':
				$gt_name = 'Jssor';
				$gt_credits = 'https://www.jssor.com';
				$gt_primary = $primary;
                $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                $options[] = array('name' => 'jssor_arrows', 'value' => 'arrow-051', 'caption' => '_AM_WGGALLERY_OPTION_GT_ARROWS');
                $options[] = array('name' => 'jssor_bullets', 'value' => 'bullet-031', 'caption' => '_AM_WGGALLERY_OPTION_GT_BULLETS');
                $options[] = array('name' => 'jssor_thumbnails', 'value' => 'thumbnail-031', 'caption' => '_AM_WGGALLERY_OPTION_GT_THUMBNAILS');
                $options[] = array('name' => 'jssor_loadings', 'value' => 'loading-003-oval', 'caption' => '_AM_WGGALLERY_OPTION_GT_LOADINGS');
                $options[] = array('name' => 'jssor_autoplay', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS');
         
            break;
            case 'lightbox2':
				$gt_name = 'Lightbox2';
				$gt_credits = 'https://lokeshdhakar.com';
				$gt_primary = $primary;
                $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                $options[] = array('name' => 'source_preview', 'value' => 'medium', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');
                // $options[] = array('name' => 'showThumbs', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS');
                $options[] = array('name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');
                $options[] = array('name' => 'showDescr', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR');
                $options[] = array('name' => 'slideshowSpeed', 'value'=> '1000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');
                $options[] = array('name' => 'showAlbumlabel', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWLABEL');
				$options[] = array('name' => 'speed', 'value' => '600', 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN');
				$options[] = array('name' => 'indexImage', 'value' => 'fixedHeight', 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMG');
				$options[] = array('name' => 'indexImageheight', 'value' => '600', 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT');
            break;            
            case 'justifiedgallery':
				$gt_name = 'Justified Gallery with Colorbox';
				$gt_credits = 'http://miromannino.com/';
				$gt_primary = $primary;
                $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                $options[] = array('name' => 'source_preview', 'value' => 'medium', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');
                $options[] = array('name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');
                $options[] = array('name' => 'rowHeight', 'value' => '150', 'caption' => '_AM_WGGALLERY_OPTION_GT_ROWHEIGHT');
                $options[] = array('name' => 'lastRow', 'value' => 'nojustify', 'caption' => '_AM_WGGALLERY_OPTION_GT_LASTROW_DESC');
                $options[] = array('name' => 'margins', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_MARGINS');
                $options[] = array('name' => 'border', 'value'=> '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDER');
                $options[] = array('name' => 'randomize', 'value' => 'false', 'caption' => '_AM_WGGALLERY_OPTION_GT_RANDOMIZE');
                $options[] = array('name' => 'slideshow', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOW');
                // $options[] = array('name' => 'slideshow_options', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS');
                $options[] = array('name' => 'colorboxstyle', 'value' => 'style1', 'caption' => '_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE');
                $options[] = array('name' => 'transition', 'value' => 'elastic', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT');
                $options[] = array('name' => 'slideshowSpeed', 'value' => '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');
                $options[] = array('name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY');
                $options[] = array('name' => 'speed', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN');
                $options[] = array('name' => 'open', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOOPEN');
                $options[] = array('name' => 'opacity', 'value' => '0.8', 'caption' => '_AM_WGGALLERY_OPTION_OPACITIY');
            break;
            case 'blueimpgallery':
				$gt_name = 'Blueimp Gallery';
				$gt_credits = 'Sebastian Tschan, https://blueimp.net';
				$gt_primary = $primary;
                $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                $options[] = array('name' => 'source_preview', 'value' => 'medium', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');
                $options[] = array('name' => 'slideshowtype', 'value' => 'lightbox', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE');
                $options[] = array('name' => 'slideshowSpeed', 'value'=> '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');
                $options[] = array('name' => 'transitionDuration', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION');
                $options[] = array('name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY');
                $options[] = array('name' => 'showThumbnails', 'value' => 'tru', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS');
                $options[] = array('name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');
            
            break;
            case 'viewerjs':
				$gt_name = 'ViewerJs';
				$gt_credits = 'http://chenfengyuan.com';
				$gt_primary = $primary;
                $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                $options[] = array('name' => 'source_preview', 'value' => 'medium', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');
                $options[] = array('name' => 'button_close', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE');
                $options[] = array('name' => 'navbar', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_NAVBAR');
                $options[] = array('name' => 'viewerjs_title', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');
                $options[] = array('name' => 'toolbar', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBAR');
                $options[] = array('name' => 'zoomable', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM');
                $options[] = array('name' => 'download', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD');
                $options[] = array('name' => 'fullscreen', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_FULLSCREEN');
                $options[] = array('name' => 'loop', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS');
                $options[] = array('name' => 'slideshowSpeed', 'value'=> '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');
            
            break;
            
            case 'default':
            default:
                redirect_header('gallerytypes.php?op=list', 3, 'Invalid template name:' . $template);
            break;
        }
        if(isset($gtId)) {
			$gallerytypesObj = $this->get($gtId);	
            // Set Vars
            $gallerytypesObj->setVar('gt_primary', $gt_primary);
            $gallerytypesObj->setVar('gt_name', $gt_name);
            $gallerytypesObj->setVar('gt_credits', $gt_credits);
            $gallerytypesObj->setVar('gt_template', $template);
			$gallerytypesObj->setVar('gt_options', serialize($options));
			$gallerytypesObj->setVar('gt_date', time());
            // Insert Data
            if($this->insert($gallerytypesObj)) {
                return true;
            }
        }
		return false;
	} 
}
