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
 * @version        $Id: 1.0 gallerytypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Gallerytypes
 */
class Gallerytypes extends \XoopsObject
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
    public function getNewInsertedIdGallerytypes()
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormGallerytypes($action = false)
    {
        //$helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? sprintf(_AM_WGGALLERY_GALLERYTYPE_ADD) : sprintf(_AM_WGGALLERY_GALLERYTYPE_EDIT);
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text GtPrimary
        $gtCat = $this->isNew() ? 0 : $this->getVar('gt_primary');
        $form->addElement(new \XoopsFormRadioYN(_AM_WGGALLERY_GT_AT_PRIMARY, 'gt_primary', $gtCat), true);
        // Form Text GtName
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_NAME, 'gt_name', 50, 255, $this->getVar('gt_name')), true);
        // Form Text GtCredits
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_CREDITS, 'gt_credits', 50, 255, $this->getVar('gt_credits')));
        // Form Text GtTemplate
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_TEMPLATE, 'gt_template', 50, 255, $this->getVar('gt_template')));
        // Form Text Area GtOption
        $form->addElement(new \XoopsFormTextArea(_AM_WGGALLERY_GT_AT_OPTIONS, 'gt_options', $this->getVar('gt_options'), 4, 47));
        // Form Text Date Select GtDate
        $gtDate = $this->isNew() ? 0 : $this->getVar('gt_date');
        $form->addElement(new \XoopsFormTextDateSelect(_AM_WGGALLERY_GT_AT_DATE, 'gt_date', '', $gtDate));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormGallerytypeOptions($action = false)
    {
        //$helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_AM_WGGALLERY_OPTION_GT_SET, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text GtPrimary

        $tpl_options = $this->getVar('gt_options', 'N');
        $options     = unserialize($tpl_options, ['allowed_classes' => false]);
        // get options for trays
        foreach ($options as $option) {
            switch ($option['name']) {
                case 'jssor_thumborient':
                    $jssor_thumborient = $option['value'];
                    break;
                case 'indexImageheight':
                    $indexImageheight = $option['value'];
                    break;
                case 'jssor_transitionorder':
                    $jssor_transitionorder = $option['value'];
                    break;
                case 'lcl_bordercolor': //for lcl_borderwidth
                    $lcl_bordercolor = $option['value'];
                    break;
                case 'lcl_borderpadding': //for lcl_borderwidth
                    $lcl_borderpadding = $option['value'];
                    break;
                case 'lcl_borderradius': //for lcl_borderwidth
                    $lcl_borderradius = $option['value'];
                    break;
            }
        }
        foreach ($options as $option) {
            // echo '<br>name'.$option['name'];
            switch ($option['name']) {
                case 'source':
                    $source = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_SOURCE_DESC . '</span>', 'source', $option['value']);
                    $source->addOption('medium', _AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM);
                    $source->addOption('large', _AM_WGGALLERY_OPTION_GT_SOURCE_LARGE);
                    $form->addElement($source);
                    break;
                case 'source_preview':
                    $source_preview = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW, 'source_preview', $option['value']);
                    $source_preview->addOption('medium', _AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM);
                    $source_preview->addOption('thumb', _AM_WGGALLERY_OPTION_GT_SOURCE_THUMB);
                    $form->addElement($source_preview);
                    break;
                case 'jssor_arrows':
                    $arrows = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ARROWS, 'jssor_arrows', $option['value']);
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
                    $bullets = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BULLETS . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_BULLETS_DESC . '</span>', 'jssor_bullets', $option['value']);
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
                    $thumbnails       = new \XoopsFormElementTray(_AM_WGGALLERY_OPTION_GT_THUMBNAILS, '&nbsp;');
                    $thumbnailsSelect = new \XoopsFormSelect('', 'jssor_thumbnails', $option['value']);
                    $thumbnailsSelect->addOption('none', _NONE);
                    $thumbnailsSelect->addOption('thumbnail-051');
                    $thumbnailsSelect->addOption('thumbnail-052');
                    $thumbnailsSelect->addOption('thumbnail-061');
                    $thumbnailsSelect->addOption('thumbnail-062');
                    $thumbnailsSelect->addOption('thumbnail-091');
                    $thumbnailsSelect->addOption('thumbnail-092');
                    $thumbnailsSelect->addOption('thumbnail-101');
                    $thumbnailsSelect->addOption('thumbnail-111');
                    $thumbnailsSelect->addOption('thumbnail-121');
                    $thumbnails->addElement($thumbnailsSelect);
                    $orientation = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ORIENTATION, 'jssor_thumborient', $jssor_thumborient);
                    $orientation->addOption('1', _AM_WGGALLERY_OPTION_GT_ORIENTATION_H);
                    $orientation->addOption('2', _AM_WGGALLERY_OPTION_GT_ORIENTATION_V);
                    $thumbnails->addElement($orientation);
                    $form->addElement($thumbnails);
                    break;
                case 'jssor_thumborient':
                    // hide it, this is used under jssor_thumbnails
                    break;
                case 'jssor_loadings':
                    $loadings = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LOADINGS, 'jssor_loadings', $option['value']);
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
                    $jssor_autoplay = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS, 'jssor_autoplay', $option['value']);
                    $jssor_autoplay->addOption('0', _NONE);
                    $jssor_autoplay->addOption('1', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_1);
                    $jssor_autoplay->addOption('2', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_2);
                    $jssor_autoplay->addOption('4', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_4);
                    $jssor_autoplay->addOption('8', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_8);
                    $jssor_autoplay->addOption('12', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_12);
                    $form->addElement($jssor_autoplay);
                    break;
                case 'jssor_fillmode':
                    $jssor_fillmode = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_FILLMODE, 'jssor_fillmode', $option['value']);
                    $jssor_fillmode->addOption('0', _AM_WGGALLERY_OPTION_GT_FILLMODE_0);
                    $jssor_fillmode->addOption('1', _AM_WGGALLERY_OPTION_GT_FILLMODE_1);
                    $jssor_fillmode->addOption('2', _AM_WGGALLERY_OPTION_GT_FILLMODE_2);
                    $jssor_fillmode->addOption('4', _AM_WGGALLERY_OPTION_GT_FILLMODE_4);
                    $jssor_fillmode->addOption('5', _AM_WGGALLERY_OPTION_GT_FILLMODE_5);
                    $form->addElement($jssor_fillmode);
                    break;
                case 'jssor_slidertype':
                    $jssor_slidertype = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDERTYPE, 'jssor_slidertype', $option['value']);
                    $jssor_slidertype->addOption(WGGALLERY_OPTION_GT_SLIDERTYPE_1_VAL, _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_1);
                    $jssor_slidertype->addOption(WGGALLERY_OPTION_GT_SLIDERTYPE_2_VAL, _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2);
                    // $jssor_slidertype->addOption(WGGALLERY_OPTION_GT_SLIDERTYPE_3_VAL, _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_3);
                    $form->addElement($jssor_slidertype);
                    break;
                case 'jssor_maxwidth':
                    $form->addElement(new \XoopsFormText(_AM_WGGALLERY_OPTION_GT_MAXWIDTH . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_MAXWIDTH_DESC . '</span>', 'jssor_maxwidth', 50, 255, $option['value']));
                    break;
                case 'jssor_maxheight':
                    $form->addElement(new \XoopsFormText(_AM_WGGALLERY_OPTION_GT_MAXHEIGHT . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_MAXHEIGHT_DESC . '</span>', 'jssor_maxheight', 50, 255, $option['value']));
                    break;
                case 'jssor_transition':
                    $optionValue      = explode('|', $option['value']);
                    $transitions      = new \XoopsFormElementTray(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, '&nbsp;');
                    $jssor_transition = new \XoopsFormSelect('', 'jssor_transition', $optionValue, 5, true);
                    $jssor_transition->addOption('{$Duration:800,$Opacity:2}', 'Fade');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in L');
                    $jssor_transition->addOption('{$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in R');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in T');
                    $jssor_transition->addOption('{$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in B');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in LR');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in LR Chess');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in TB');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in TB Chess');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade in Corners');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out L');
                    $jssor_transition->addOption('{$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out R');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out T');
                    $jssor_transition->addOption('{$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out B');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out LR');
                    $jssor_transition->addOption('{$Duration:800,y:-0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out LR Chess');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out TB');
                    $jssor_transition->addOption('{$Duration:800,x:-0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out TB Chess');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade out Corners');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in L');
                    $jssor_transition->addOption('{$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in R');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in T');
                    $jssor_transition->addOption('{$Duration:800,y:-0.3,$During:{$Top:[0.3,0.7]},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in B');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Cols:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in LR');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Cols:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in LR Chess');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Rows:2,$During:{$Top:[0.3,0.7]},$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in TB');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Rows:2,$During:{$Left:[0.3,0.7]},$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in TB Chess');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly in Corners');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out L');
                    $jssor_transition->addOption('{$Duration:800,x:-0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out R');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out T');
                    $jssor_transition->addOption('{$Duration:800,y:-0.3,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out B');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out LR');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Cols:2,$SlideOut:true,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out LR Chess');
                    $jssor_transition->addOption('{$Duration:800,y:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:12},$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out TB');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,$Rows:2,$SlideOut:true,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}', 'Fade Fly out TB Chess');
                    $jssor_transition->addOption('{$Duration:800,x:0.3,y:0.3,$Cols:2,$Rows:2,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true}',
                                                 'Fade Fly out Corners');
                    $jssor_transition->addOption('{$Duration:800,$Delay:20,$Clip:3,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade Clip in H');
                    $jssor_transition->addOption('{$Duration:800,$Delay:20,$Clip:12,$Assembly:260,$Easing:{$Clip:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade Clip in V');
                    $jssor_transition->addOption('{$Duration:800,$Delay:20,$Clip:3,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade Clip out H');
                    $jssor_transition->addOption('{$Duration:800,$Delay:20,$Clip:12,$SlideOut:true,$Assembly:260,$Easing:{$Clip:$Jease$.$OutCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Fade Clip out V');
                    $jssor_transition->addOption('{$Duration:600,$Delay:20,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Opacity:2}', 'Fade Stairs');
                    $jssor_transition->addOption('{$Duration:600,$Delay:60,$Cols:8,$Rows:4,$Opacity:2}', 'Fade Random');
                    $jssor_transition->addOption('{$Duration:600,$Delay:20,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Opacity:2}', 'Fade Swirl');
                    $jssor_transition->addOption('{$Duration:600,$Delay:20,$Cols:8,$Rows:4,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Opacity:2}', 'Fade ZigZag');
                    $jssor_transition->addOption('---------- Twins Transitions ----------');
                    $jssor_transition->addOption('{$Duration:700,$Opacity:2,$Brother:{$Duration:700,$Opacity:2}}', 'Fade Twins');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:1,$Rotate:0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Brother:{$Duration:800,$Zoom:11,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Shift:200}}', 'Rotate away');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:1,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Brother:{$Duration:800,$Zoom:11,$Rotate:0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Shift:200}}', 'Rotate away acw');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Rotate:0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Brother:{$Duration:800,$Zoom:1,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Shift:200}}', 'Rotate back');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Brother:{$Duration:800,$Zoom:1,$Rotate:0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$Swing},$Opacity:2,$Shift:200}}', 'Rotate back acw');
                    $jssor_transition->addOption('{$Duration:800,x:0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InCubic},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:800,x:-0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InCubic},$Opacity:2,$ZIndex:-10}}', 'Switch');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Rotate:1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Brother:{$Duration:800,$Zoom:11,$Rotate:-1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Shift:400}}',
                                                 'Rotate Relay');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Rotate:-1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Brother:{$Duration:800,$Zoom:11,$Rotate:1,$Easing:{$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:1},$ZIndex:-10,$Shift:400}}',
                                                 'Rotate Relay acw');
                    $jssor_transition->addOption('{$Duration:1200,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InOutCubic},$Opacity:2,$Brother:{$Duration:1200,$Opacity:2}}', 'Doors');
                    $jssor_transition->addOption('{$Duration:1200,$Opacity:2,$Brother:{$Duration:1200,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InOutCubic},$Opacity:2}}', 'Doors close');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.3,y:0.5,$Zoom:1,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4],$Zoom:[0.6,0.4]},$Easing:{$Left:$Jease$.$InSine,$Top:$Jease$.$InSine,$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$InSine},$Opacity:2,$Brother:{$Duration:600,$Zoom:11,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$InSine},$Opacity:2}}',
                                                 'Rotate in+ out-');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.6,y:1,$Zoom:11,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4],$Zoom:[0.6,0.4]},$Easing:{$Left:$Jease$.$InSine,$Top:$Jease$.$InSine,$Rotate:$Jease$.$InSine,$Zoom:$Jease$.$InSine},$Opacity:2,$Brother:{$Duration:600,$Zoom:1,$Rotate:-0.5,$Easing:{$Rotate:$Jease$.$InCubic,$Zoom:$Jease$.$InSine},$Opacity:2}}',
                                                 'Rotate in- ou+');
                    $jssor_transition->addOption('{$Duration:600,x:0.3,$During:{$Left:[0.6,0.4]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:600,x:-0.3,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}}', 'Fly Twins');
                    $jssor_transition->addOption('{$Duration:1000,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1000,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}}',
                                                 'Chess Replace TB');
                    $jssor_transition->addOption('{$Duration:1000,y:-1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:1000,y:1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}}',
                                                 'Chess Replace LR');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Brother:{$Duration:600,$Zoom:1.5,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Shift:-100}}', 'Zoom back');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:1.9,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Brother:{$Duration:600,$Zoom:11,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Shift:-100}}', 'Zoom away');
                    $jssor_transition->addOption('{$Duration:800,$Zoom:11,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Brother:{$Duration:600,$Zoom:11,$Easing:{$Zoom:$Jease$.$InOutExpo},$Opacity:2,$Shift:-100}}', 'Zoom return');
                    $jssor_transition->addOption('{$Duration:800,y:1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:800,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}}', 'Shift TB');
                    $jssor_transition->addOption('{$Duration:800,x:1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:800,x:-1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}}', 'Shift LR');
                    $jssor_transition->addOption('{$Duration:800,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:800,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-100}}', 'Return TB');
                    $jssor_transition->addOption('{$Duration:800,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:800,x:1,$Delay:40,$Cols:6,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$ZIndex:-10,$Shift:-60}}',
                                                 'Return LR');
                    $jssor_transition->addOption('{$Duration:800,x:0.25,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:800,x:-0.1,y:-0.7,$Rotate:0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}}',
                                                 'Rotate Axis up');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.1,y:-0.7,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:1000,x:0.2,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}}',
                                                 'Rotate Axis down');
                    $jssor_transition->addOption('{$Duration:800,x:-0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:800,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Round:{$Top:0.5},$Shift:-200}}',
                                                 'Extrude Replace');
                    $jssor_transition->addOption('{$Duration:800,x:0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:800,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Round:{$Top:0.5},$Shift:-200}}',
                                                 'Extrude Return');
                    $jssor_transition->addOption('---------- Rotate Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,x:-1,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}',
                                                 'Rotate VDouble+ in');
                    $jssor_transition->addOption('{$Duration:1200,x:2,y:1,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate HDouble+ in');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.5,y:1,$Rows:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate VDouble- in');
                    $jssor_transition->addOption('{$Duration:1200,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate HDouble- in');
                    $jssor_transition->addOption('{$Duration:1000,x:-1,y:2,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.85}}',
                                                 'Rotate VDouble+ out');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:2,$Cols:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}}',
                                                 'Rotate HDouble+ out');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.5,y:1,$Rows:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate VDouble- out');
                    $jssor_transition->addOption('{$Duration:1000,x:0.5,y:0.3,$Cols:2,$Zoom:1,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate HDouble- out');
                    $jssor_transition->addOption('{$Duration:1200,x:-4,y:2,$Rows:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate VFork+ in');
                    $jssor_transition->addOption('{$Duration:1200,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.8}}',
                                                 'Rotate HFork+ in');
                    $jssor_transition->addOption('{$Duration:1000,x:-3,y:1,$Rows:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:28},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.7}}',
                                                 'Rotate VFork+ out');
                    $jssor_transition->addOption('{$Duration:1000,x:1,y:2,$Cols:2,$Zoom:11,$Rotate:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:19},$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InExpo},$Opacity:2,$Round:{$Rotate:0.8}}',
                                                 'Rotate HFork+ out');
                    $jssor_transition->addOption('{$Duration:1200,$Zoom:11,$Rotate:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in');
                    $jssor_transition->addOption('{$Duration:1200,x:4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in L');
                    $jssor_transition->addOption('{$Duration:1200,x:-4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in R');
                    $jssor_transition->addOption('{$Duration:1200,y:4,$Zoom:11,$Rotate:1,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in T');
                    $jssor_transition->addOption('{$Duration:1200,y:-4,$Zoom:11,$Rotate:1,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in B');
                    $jssor_transition->addOption('{$Duration:1200,x:4,y:4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in TL');
                    $jssor_transition->addOption('{$Duration:1200,x:-4,y:4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in TR');
                    $jssor_transition->addOption('{$Duration:1200,x:4,y:-4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in BL');
                    $jssor_transition->addOption('{$Duration:1200,x:-4,y:-4,$Zoom:11,$Rotate:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.7}}', 'Rotate Zoom+ in BR');
                    $jssor_transition->addOption('{$Duration:1000,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InQuint,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out');
                    $jssor_transition->addOption('{$Duration:1000,x:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out L');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out R');
                    $jssor_transition->addOption('{$Duration:1000,y:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out T');
                    $jssor_transition->addOption('{$Duration:1000,y:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out B');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out TL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out TR');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out BL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:-4,$Zoom:11,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InQuint,$Top:$Jease$.$InQuint,$Zoom:$Jease$.$InQuart,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuint},$Opacity:2,$Round:{$Rotate:0.8}}', 'Rotate Zoom+ out BR');
                    $jssor_transition->addOption('{$Duration:1200,$Zoom:1,$Rotate:1,$During:{$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:{$Zoom:$Jease$.$Swing,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$Swing},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in L');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in R');
                    $jssor_transition->addOption('{$Duration:1200,y:0.6,$Zoom:1,$Rotate:1,$During:{$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in T');
                    $jssor_transition->addOption('{$Duration:1200,y:-0.6,$Zoom:1,$Rotate:1,$During:{$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in B');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,y:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in TL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,y:0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in TR');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,y:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in BL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,y:-0.6,$Zoom:1,$Rotate:1,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Zoom:[0.2,0.8],$Rotate:[0.2,0.8]},$Easing:$Jease$.$Swing,$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- in BR');
                    $jssor_transition->addOption('{$Duration:1000,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Opacity:$Jease$.$Linear},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out');
                    $jssor_transition->addOption('{$Duration:1000,x:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out L');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out R');
                    $jssor_transition->addOption('{$Duration:1000,y:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out T');
                    $jssor_transition->addOption('{$Duration:1000,y:-0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out B');
                    $jssor_transition->addOption('{$Duration:1000,x:0.5,y:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out TL');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.5,y:0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out TR');
                    $jssor_transition->addOption('{$Duration:1000,x:0.5,y:-0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out BL');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.5,y:-0.5,$Zoom:1,$Rotate:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InCubic},$Opacity:2,$Round:{$Rotate:0.5}}', 'Rotate Zoom- out BR');
                    $jssor_transition->addOption('---------- Zoom Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,y:2,$Rows:2,$Zoom:11,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom VDouble+ in');
                    $jssor_transition->addOption('{$Duration:1200,x:4,$Cols:2,$Zoom:11,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom HDouble+ in');
                    $jssor_transition->addOption('{$Duration:1200,y:1,$Rows:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom VDouble- in');
                    $jssor_transition->addOption('{$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom HDouble- in');
                    $jssor_transition->addOption('{$Duration:1200,y:2,$Rows:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom VDouble+ out');
                    $jssor_transition->addOption('{$Duration:1200,x:4,$Cols:2,$Zoom:11,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom HDouble+ out');
                    $jssor_transition->addOption('{$Duration:1200,y:1,$Rows:2,$Zoom:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Row:15},$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom VDouble- out');
                    $jssor_transition->addOption('{$Duration:1200,x:0.5,$Cols:2,$Zoom:1,$SlideOut:true,$Assembly:2049,$ChessMode:{$Column:15},$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom HDouble- out');
                    $jssor_transition->addOption('{$Duration:1000,$Zoom:11,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in');
                    $jssor_transition->addOption('{$Duration:1000,x:4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in L');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2,$Round:{$Top:2.5}}', 'Zoom+ in R');
                    $jssor_transition->addOption('{$Duration:1000,y:4,$Zoom:11,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in T');
                    $jssor_transition->addOption('{$Duration:1000,y:-4,$Zoom:11,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in B');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in TL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in TR');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:-4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in BL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:-4,$Zoom:11,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom+ in BR');
                    $jssor_transition->addOption('{$Duration:1000,$Zoom:11,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out');
                    $jssor_transition->addOption('{$Duration:1000,x:4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out L');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out R');
                    $jssor_transition->addOption('{$Duration:1000,y:4,$Zoom:11,$SlideOut:true,$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out T');
                    $jssor_transition->addOption('{$Duration:1000,y:-4,$Zoom:11,$SlideOut:true,$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out B');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out TL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out TR');
                    $jssor_transition->addOption('{$Duration:1000,x:4,y:-4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out BL');
                    $jssor_transition->addOption('{$Duration:1000,x:-4,y:-4,$Zoom:11,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom+ out BR');
                    $jssor_transition->addOption('{$Duration:1200,$Zoom:1,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in L');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in R');
                    $jssor_transition->addOption('{$Duration:1200,y:0.6,$Zoom:1,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in T');
                    $jssor_transition->addOption('{$Duration:1200,y:-0.6,$Zoom:1,$Easing:{$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in B');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,y:0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in TL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,y:0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in TR');
                    $jssor_transition->addOption('{$Duration:1200,x:0.6,y:-0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in BL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.6,y:-0.6,$Zoom:1,$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Zoom- in BR');
                    $jssor_transition->addOption('{$Duration:1000,$Zoom:1,$SlideOut:true,$Easing:{$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out');
                    $jssor_transition->addOption('{$Duration:1000,x:1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out L');
                    $jssor_transition->addOption('{$Duration:1000,x:-1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out R');
                    $jssor_transition->addOption('{$Duration:1000,y:1,$Zoom:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out T');
                    $jssor_transition->addOption('{$Duration:1000,y:-1,$Zoom:1,$SlideOut:true,$Easing:{$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out B');
                    $jssor_transition->addOption('{$Duration:1000,x:1,y:1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out TL');
                    $jssor_transition->addOption('{$Duration:1000,x:-1,y:1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out TR');
                    $jssor_transition->addOption('{$Duration:1000,x:1,y:-1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out BL');
                    $jssor_transition->addOption('{$Duration:1000,x:-1,y:-1,$Zoom:1,$SlideOut:true,$Easing:{$Left:$Jease$.$InExpo,$Top:$Jease$.$InExpo,$Zoom:$Jease$.$InExpo,$Opacity:$Jease$.$Linear},$Opacity:2}', 'Zoom- out BR');
                    $jssor_transition->addOption('---------- Collapse Transitions ----------');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2049,$Easing:$Jease$.$OutQuad}', 'Collapse Stairs');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Easing:$Jease$.$OutQuad}', 'Collapse Swirl');
                    $jssor_transition->addOption('{$Duration:500,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Easing:$Jease$.$OutQuad}', 'Collapse Rectangle Cross');
                    $jssor_transition->addOption('{$Duration:500,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Easing:$Jease$.$OutQuad}', 'Collapse Rectangle');
                    $jssor_transition->addOption('{$Duration:500,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCross,$Easing:$Jease$.$OutQuad}', 'Collapse Cross');
                    $jssor_transition->addOption('{$Duration:500,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:2049}', 'Collapse Circle');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Easing:$Jease$.$OutQuad}', 'Collapse ZigZag');
                    $jssor_transition->addOption('{$Duration:500,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$SlideOut:true,$Easing:$Jease$.$OutQuad}', 'Collapse Random');
                    $jssor_transition->addOption('---------- Expand Transitions ----------');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand Stairs');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand Swirl');
                    $jssor_transition->addOption('{$Duration:500,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand Rectangle Cross');
                    $jssor_transition->addOption('{$Duration:500,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand Rectangle');
                    $jssor_transition->addOption('{$Duration:500,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationCross,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand Cross');
                    $jssor_transition->addOption('{$Duration:500,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Clip:$Jease$.$InSine}}', 'Expand ZigZag');
                    $jssor_transition->addOption('{$Duration:500,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$Easing:$Jease$.$InSine}', 'Expand Random');
                    $jssor_transition->addOption('---------- Float Transitions ----------');
                    $jssor_transition->addOption('{$Duration:500,x:-1,$Delay:40,$Cols:10,$Rows:5,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float Right Random');
                    $jssor_transition->addOption('{$Duration:500,y:1,$Delay:40,$Cols:10,$Rows:5,$SlideOut:true,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float up Random');
                    $jssor_transition->addOption('{$Duration:500,x:1,y:-1,$Delay:40,$Cols:10,$Rows:5,$SlideOut:true,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float up Random with Chess');
                    $jssor_transition->addOption('{$Duration:600,x:-1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:513,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float Right ZigZag');
                    $jssor_transition->addOption('{$Duration:600,y:1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:264,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float up ZigZag');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:-1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:1028,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}',
                                                 'Float up ZigZag with Chess');
                    $jssor_transition->addOption('{$Duration:600,x:-1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:513,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float Right Swirl');
                    $jssor_transition->addOption('{$Duration:600,y:1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2049,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Float up Swirl');
                    $jssor_transition->addOption('{$Duration:600,x:1,y:1,$Delay:12,$Cols:10,$Rows:5,$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:513,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}',
                                                 'Float up Swirl with Chess');
                    $jssor_transition->addOption('---------- Fly Transitions ----------');
                    $jssor_transition->addOption('{$Duration:500,x:1,$Delay:40,$Cols:10,$Rows:5,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly Right Random');
                    $jssor_transition->addOption('{$Duration:500,y:-1,$Delay:40,$Cols:10,$Rows:5,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly up Random');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:40,$Cols:10,$Rows:5,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly up Random with Chess');
                    $jssor_transition->addOption('{$Duration:600,x:1,$Delay:12,$Cols:10,$Rows:5,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:514,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly Right ZigZag');
                    $jssor_transition->addOption('{$Duration:600,y:-1,$Delay:12,$Cols:10,$Rows:5,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly up ZigZag');
                    $jssor_transition->addOption('{$Duration:600,x:1,y:1,$Delay:12,$Cols:10,$Rows:5,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}',
                                                 'Fly up ZigZag with Chess');
                    $jssor_transition->addOption('{$Duration:600,x:1,$Delay:12,$Cols:10,$Rows:5,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:513,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly Right Swirl');
                    $jssor_transition->addOption('{$Duration:600,y:-1,$Delay:12,$Cols:10,$Rows:5,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2049,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Fly up Swirl');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:-1,$Delay:12,$Cols:10,$Rows:5,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:513,$ChessMode:{$Column:3,$Row:12},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}',
                                                 'Fly up Swirl with Chess');
                    $jssor_transition->addOption('---------- Stripe Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1600,y:-1,$Delay:40,$Cols:24,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Easing:$Jease$.$OutJump,$Round:{$Top:1.5}}', 'Dominoes Stripe');
                    $jssor_transition->addOption('{$Duration:1000,x:-0.2,$Delay:20,$Cols:16,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}}',
                                                 'Extrude out Stripe');
                    $jssor_transition->addOption('{$Duration:1000,x:0.2,$Delay:20,$Cols:16,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5}}', 'Extrude in Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Delay:50,$Rows:7,$Clip:4,$Formation:$JssorSlideshowFormations$.$FormationStraight}', 'Horizontal Blind Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Delay:50,$Cols:10,$Clip:2,$Formation:$JssorSlideshowFormations$.$FormationStraight}', 'Vertical Blind Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Rows:6,$Clip:4}', 'Horizontal Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Cols:8,$Clip:1}', 'Vertical Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Rows:6,$Clip:4,$Move:true}', 'Horizontal Moving Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Cols:8,$Clip:1,$Move:true}', 'Vertical Moving Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Delay:40,$Rows:10,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2,$Assembly:260}', 'Horizontal Fade Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Delay:40,$Rows:10,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2}', 'Horizontal Fade Stripe Reverse');
                    $jssor_transition->addOption('{$Duration:400,$Delay:40,$Cols:16,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2,$Assembly:260}', 'Vertical Fade Stripe');
                    $jssor_transition->addOption('{$Duration:400,$Delay:40,$Cols:16,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2}', 'Vertical Fade Stripe Reverse');
                    $jssor_transition->addOption('{$Duration:600,x:1,$Delay:50,$Rows:8,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:513,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Horizontal Fly Stripe');
                    $jssor_transition->addOption('{$Duration:600,y:1,$Delay:50,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:513,$Easing:{$Top:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}', 'Vertical Fly Stripe');
                    $jssor_transition->addOption('{$Duration:600,x:-1,$Rows:10,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Row:3},$Easing:$Jease$.$InCubic}', 'Horizontal Chess Stripe');
                    $jssor_transition->addOption('{$Duration:600,y:-1,$Cols:12,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$Easing:$Jease$.$InCubic}', 'Vertical Chess Stripe');
                    $jssor_transition->addOption('{$Duration:600,$Delay:40,$Rows:10,$Opacity:2}', 'Horizontal Random Fade Stripe');
                    $jssor_transition->addOption('{$Duration:600,$Delay:40,$Cols:16,$Opacity:2}', 'Vertical Random Fade Stripe');
                    $jssor_transition->addOption('{$Duration:600,$Delay:40,$Rows:10,$Clip:8,$Move:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:264,$Easing:$Jease$.$InBounce}', 'Horizontal Bounce Stripe');
                    $jssor_transition->addOption('{$Duration:600,$Delay:40,$Cols:16,$Clip:1,$Move:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:264,$Easing:$Jease$.$InBounce}', 'Vertical Bounce Stripe');
                    $jssor_transition->addOption('---------- Parabola Transitions ----------');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:264,$Easing:{$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola Swirl in');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:264,$Easing:{$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola Swirl out');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$ChessMode:{$Row:3},$Easing:{$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola ZigZag in');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$ChessMode:{$Row:3},$Easing:{$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola ZigZag out');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InQuart,$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola Stairs in');
                    $jssor_transition->addOption('{$Duration:600,x:-1,y:1,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InQuart,$Top:$Jease$.$InQuart,$Opacity:$Jease$.$Linear}}', 'Parabola Stairs out');
                    $jssor_transition->addOption('---------- Swing Inside Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:16,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside in Stairs');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside in ZigZag');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside in Swirl');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}', 'Swing Inside in Random');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:3,$Row:3},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside in Random Chess');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside out ZigZag');
                    $jssor_transition->addOption('{$Duration:1200,x:0.2,y:-0.1,$Delay:12,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:1.3,$Top:2.5}}',
                                                 'Swing Inside out Swirl');
                    $jssor_transition->addOption('---------- Dodge Dance Inside Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside in Stairs');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside in Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside in ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside in Random');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside in Random Chess');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.1,0.9],$Top:[0.1,0.9]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside out Stairs');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.1,0.9],$Top:[0.1,0.9]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside out Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.1,0.9],$Top:[0.1,0.9]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside out ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside out Random');
                    $jssor_transition->addOption('{$Duration:1500,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Dance Inside out Random Chess');
                    $jssor_transition->addOption('---------- Dodge Pet Inside Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside in Stairs');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside in Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside in ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$Linear},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside in Random');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$Linear},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside in Random Chess');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside out Stairs');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside out Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$OutQuad},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside out ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$Linear},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside out Random');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InWave,$Top:$Jease$.$InWave,$Clip:$Jease$.$Linear},$Round:{$Left:0.8,$Top:2.5}}',
                                                 'Dodge Pet Inside out Random Chess');
                    $jssor_transition->addOption('---------- Dodge Inside Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out Stairs');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out Swirl');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out ZigZag');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out Random');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:40,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$SlideOut:true,$Assembly:260,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out Random Chess');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in Stairs');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in Swirl');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in ZigZag');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Assembly:260,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in Random');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:80,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8]},$Assembly:260,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Clip:$Jease$.$Swing},$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in Random Chess');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:0.3,$Delay:60,$Zoom:1,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in TL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.3,y:0.3,$Delay:60,$Zoom:1,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in TR');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:60,$Zoom:1,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in BL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.3,y:-0.3,$Delay:60,$Zoom:1,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside in BR');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:0.3,$Delay:60,$Zoom:1,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out TL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.3,y:0.3,$Delay:60,$Zoom:1,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out TR');
                    $jssor_transition->addOption('{$Duration:1200,x:0.3,y:-0.3,$Delay:60,$Zoom:1,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out BL');
                    $jssor_transition->addOption('{$Duration:1200,x:-0.3,y:-0.3,$Delay:60,$Zoom:1,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Left:$Jease$.$InJump,$Top:$Jease$.$InJump,$Opacity:$Jease$.$Linear,$Zoom:$Jease$.$Swing},$Opacity:2,$Round:{$Left:0.8,$Top:0.8}}',
                                                 'Dodge Inside out BR');
                    $jssor_transition->addOption('---------- Flutter Inside Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,x:1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Clip:$Jease$.$InOutQuad},$Round:{$Top:0.8}}',
                                                 'Flutter Inside in');
                    $jssor_transition->addOption('{$Duration:1200,x:1,y:0.2,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$Jease$.$InOutSine,$Top:$Jease$.$OutWave,$Clip:$Jease$.$InOutQuad},$Round:{$Top:1.3}}',
                                                 'Flutter Inside in Wind');
                    $jssor_transition->addOption('{$Duration:1200,x:1,y:0.2,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$Jease$.$InOutSine,$Top:$Jease$.$OutWave,$Clip:$Jease$.$InOutQuad},$Round:{$Top:1.3}}',
                                                 'Flutter Inside in Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:0.2,y:-0.1,$Delay:150,$Cols:12,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:2}}',
                                                 'Flutter Inside in Column');
                    $jssor_transition->addOption('{$Duration:1200,x:1,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Clip:$Jease$.$InOutQuad},$Round:{$Top:0.8}}',
                                                 'Flutter Inside out');
                    $jssor_transition->addOption('{$Duration:1200,x:1,y:0.2,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$Jease$.$InOutSine,$Top:$Jease$.$OutWave,$Clip:$Jease$.$InOutQuad},$Round:{$Top:1.3}}',
                                                 'Flutter Inside out Wind');
                    $jssor_transition->addOption('{$Duration:1200,x:1,y:0.2,$Delay:20,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$Jease$.$InOutSine,$Top:$Jease$.$OutWave,$Clip:$Jease$.$InOutQuad},$Round:{$Top:1.3}}',
                                                 'Flutter Inside out Swirl');
                    $jssor_transition->addOption('{$Duration:1800,x:0.2,y:-0.1,$Delay:150,$Cols:12,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:2}}',
                                                 'Flutter Inside out Column');
                    $jssor_transition->addOption('---------- Compound Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1200,y:-1,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Top:[0.5,0.5],$Clip:[0,0.5]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$ScaleClip:0.5}', 'Clip &amp; Chess in');
                    $jssor_transition->addOption('{$Duration:1200,y:-1,$Cols:10,$Rows:5,$Opacity:2,$Clip:15,$During:{$Top:[0.5,0.5],$Clip:[0,0.5]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:12},$ScaleClip:0.5}', 'Clip &amp; Chess out');
                    $jssor_transition->addOption('{$Duration:1200,x:-1,y:-1,$Cols:6,$Rows:6,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Clip:[0,0.2]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Clip:$Jease$.$Swing},$ScaleClip:0.5}',
                                                 'Clip &amp; Oblique Chess in');
                    $jssor_transition->addOption('{$Duration:1200,x:-1,y:-1,$Cols:6,$Rows:6,$Opacity:2,$Clip:15,$During:{$Left:[0.2,0.8],$Top:[0.2,0.8],$Clip:[0,0.2]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$ChessMode:{$Column:15,$Row:15},$Easing:{$Left:$Jease$.$InCubic,$Top:$Jease$.$InCubic,$Clip:$Jease$.$Swing},$ScaleClip:0.5}',
                                                 'Clip &amp; Oblique Chess out');
                    $jssor_transition->addOption('{$Duration:4000,x:-1,y:0.45,$Delay:80,$Cols:12,$Opacity:2,$Clip:15,$During:{$Left:[0.35,0.65],$Top:[0.35,0.65],$Clip:[0,0.15]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:2049,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Clip:$Jease$.$OutQuad},$ScaleClip:0.7,$Round:{$Top:4}}',
                                                 'Clip &amp; Wave in');
                    $jssor_transition->addOption('{$Duration:4000,x:-1,y:0.45,$Delay:80,$Cols:12,$Opacity:2,$Clip:15,$During:{$Left:[0.35,0.65],$Top:[0.35,0.65],$Clip:[0,0.15]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:2049,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Clip:$Jease$.$OutQuad},$ScaleClip:0.7,$Round:{$Top:4}}',
                                                 'Clip &amp; Wave out');
                    $jssor_transition->addOption('{$Duration:4000,x:-1,y:0.7,$Delay:80,$Cols:12,$Opacity:2,$Clip:11,$Move:true,$During:{$Left:[0.35,0.65],$Top:[0.35,0.65],$Clip:[0,0.1]},$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:2049,$Easing:{$Left:$Jease$.$OutQuad,$Top:$Jease$.$OutJump,$Clip:$Jease$.$OutQuad},$ScaleClip:0.7,$Round:{$Top:4}}',
                                                 'Clip &amp; Jump in');
                    $jssor_transition->addOption('{$Duration:4000,x:-1,y:0.7,$Delay:80,$Cols:12,$Opacity:2,$Clip:11,$Move:true,$During:{$Left:[0.35,0.65],$Top:[0.35,0.65],$Clip:[0,0.1]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:2049,$Easing:{$Left:$Jease$.$OutQuad,$Top:$Jease$.$OutJump,$Clip:$Jease$.$OutQuad},$ScaleClip:0.7,$Round:{$Top:4}}',
                                                 'Clip &amp; Jump out');
                    $jssor_transition->addOption('---------- Wave out Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,y:-0.5,$Delay:60,$Cols:16,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave out');
                    $jssor_transition->addOption('{$Duration:1200,y:-0.5,$Delay:30,$Cols:15,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:{$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave out Eagle');
                    $jssor_transition->addOption('{$Duration:1200,x:-1,y:0.5,$Delay:30,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out Rectangle');
                    $jssor_transition->addOption('{$Duration:1500,x:1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out Circle');
                    $jssor_transition->addOption('{$Duration:1500,x:1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCross,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out Cross');
                    $jssor_transition->addOption('{$Duration:1500,x:1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave out Rectangle Cross');
                    $jssor_transition->addOption('---------- Wave in Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,y:-0.5,$Delay:60,$Cols:12,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Easing:{$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave in');
                    $jssor_transition->addOption('{$Duration:1200,y:-0.5,$Delay:30,$Cols:15,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Easing:{$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave in Eagle');
                    $jssor_transition->addOption('{$Duration:1200,x:-1,y:0.5,$Delay:30,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave in Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave in ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave in Rectangle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave in Circle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationCross,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}', 'Wave in Cross');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:60,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InWave,$Opacity:$Jease$.$Linear},$Round:{$Top:1.5}}',
                                                 'Wave in Rectangle Cross');
                    $jssor_transition->addOption('---------- Jump out Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:100,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:513,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}', 'Jump out Straight');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:100,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}', 'Jump out Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:100,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}', 'Jump out ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:800,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}',
                                                 'Jump out Rectangle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:100,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}', 'Jump out Circle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:0.5,$Delay:100,$Cols:10,$Rows:5,$Opacity:2,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Assembly:260,$Easing:{$Left:$Jease$.$Linear,$Top:$Jease$.$OutJump},$Round:{$Top:1.5}}',
                                                 'Jump out Rectangle Cross');
                    $jssor_transition->addOption('---------- Jump in Transitions ----------');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:513,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in Straight');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in Swirl');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationZigZag,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in ZigZag');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:800,$Cols:10,$Rows:5,$Opacity:2,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationRectangle,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in Rectangle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationCircle,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in Circle');
                    $jssor_transition->addOption('{$Duration:1500,x:-1,y:-0.5,$Delay:50,$Cols:10,$Rows:5,$Opacity:2,$Formation:$JssorSlideshowFormations$.$FormationRectangleCross,$Assembly:260,$Easing:{$Left:$Jease$.$Swing,$Top:$Jease$.$InJump},$Round:{$Top:1.5}}', 'Jump in Rectangle Cross');
                    $jssor_transition->addOption('---------- Stone Transitions ----------');
                    $jssor_transition->addOption('{$Duration:500,y:1,$Opacity:2,$Easing:$Jease$.$InQuad}', 'Slide Down');
                    $jssor_transition->addOption('{$Duration:400,x:1,$Opacity:2,$Easing:$Jease$.$InQuad}', 'Slide Right');
                    $jssor_transition->addOption('{$Duration:1000,y:1,$Opacity:2,$Easing:$Jease$.$InBounce}', 'Bounce Down');
                    $jssor_transition->addOption('{$Duration:1000,x:1,$Opacity:2,$Easing:$Jease$.$InBounce}', 'Bounce Right');
                    $transitions->addElement($jssor_transition, true);

                    $jssor_transitionorder = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TRANSORDER, 'jssor_transitionorder', $jssor_transitionorder);
                    $jssor_transitionorder->addOption('0', _AM_WGGALLERY_OPTION_GT_TRANSORDER_RANDOM);
                    $jssor_transitionorder->addOption('1', _AM_WGGALLERY_OPTION_GT_TRANSORDER_INORDER);
                    $transitions->addElement($jssor_transitionorder);
                    $form->addElement($transitions);
                    break;
                case 'jssor_transitionorder':
                    // hide it, this is used under jssor_transition
                    break;
                case 'showThumbs':
                    $showThumbs = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS, 'showThumbs', $option['value']);
                    $showThumbs->addOption('true', _AM_WGGALLERY_OPTION_GT_SHOWTHUMBS);
                    $showThumbs->addOption('false', _AM_WGGALLERY_OPTION_GT_SHOWDOTS);
                    $form->addElement($showThumbs);
                    break;
                case 'showTitle':
                    $showTitle = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_SHOWTITLE, 'showTitle', $option['value']);
                    $showTitle->addOption('true', _YES);
                    $showTitle->addOption('false', _NO);
                    $form->addElement($showTitle);
                    break;
                case 'showDescr':
                    $showDescr = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_SHOWDESCR, 'showDescr', $option['value']);
                    $showDescr->addOption('true', _YES);
                    $showDescr->addOption('false', _NO);
                    $form->addElement($showDescr);
                    break;
                case 'viewerjs_title':
                    $viewerjs_title = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_SHOWTITLE, 'viewerjs_title', $option['value']);
                    $viewerjs_title->addOption(0, _NO);
                    $viewerjs_title->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
                    $viewerjs_title->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $viewerjs_title->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $viewerjs_title->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
                    $form->addElement($viewerjs_title);
                    break;
                case 'showAlbumlabel':
                    $showAlbumlabel = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWLABEL, 'showAlbumlabel', $option['value']);
                    $showAlbumlabel->addOption('true', _YES);
                    $showAlbumlabel->addOption('false', _NO);
                    $form->addElement($showAlbumlabel);
                    break;
                case 'slideshowAuto':
                    $slideshowAuto = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOPLAY . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_PLAYOPTION_DESC . '</span>', 'slideshowAuto', $option['value']);
                    $slideshowAuto->addOption('true', _YES);
                    $slideshowAuto->addOption('false', _NO);
                    $form->addElement($slideshowAuto);
                    break;
                case 'slideshowSpeed':
                    $slideshowSpeed = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC . '</span>', 'slideshowSpeed', $option['value']);
                    for ($i = 5; $i <= 70; $i += 5) {
                        $slideshowSpeed->addOption($i . '00', $i . '00');
                    }
                    $form->addElement($slideshowSpeed);
                    break;
                case 'slideshow':
                    $randomize = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SLIDESHOW, 'slideshow', $option['value']);
                    $randomize->addOption('true', _YES);
                    $randomize->addOption('false', _NO);
                    $form->addElement($randomize);
                    break;
                case 'colorboxstyle':
                    $colorboxstyle = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE, 'colorboxstyle', $option['value']);
                    $colorboxstyle->addOption('style1', 'style1');
                    $colorboxstyle->addOption('style2', 'style2');
                    $colorboxstyle->addOption('style3', 'style3');
                    $colorboxstyle->addOption('style4', 'style4');
                    $colorboxstyle->addOption('style5', 'style5');
                    $form->addElement($colorboxstyle);
                    break;
                case 'transition':
                    $transition = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, 'transition', $option['value']);
                    $transition->addOption('elastic', 'elastic');
                    $transition->addOption('fade', 'fade');
                    $transition->addOption('none', 'none');
                    $form->addElement($transition);
                    break;
                case 'speedOpen':
                    $speedOpen = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SPEEDOPEN, 'speedOpen', $option['value']);
                    for ($i = 1; $i <= 10; $i++) {
                        $speedOpen->addOption($i . '00', $i . '00');
                    }
                    $form->addElement($speedOpen);
                    break;
                case 'lcl_animationtime':
                    $animtime = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ANIMTIME . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_ANIMTIME_DESC . '</span>', 'lcl_animationtime', $option['value']);
                    for ($i = 1; $i <= 10; $i++) {
                        $animtime->addOption($i . '00', $i . '00');
                    }
                    $form->addElement($animtime);
                    break;
                case 'lcl_counter':
                    $lcl_counter = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLCOUNTER, 'lcl_counter', $option['value']);
                    $lcl_counter->addOption('true', _YES);
                    $lcl_counter->addOption('false', _NO);
                    $form->addElement($lcl_counter);
                    break;
                case 'lcl_fullscreen':
                    $lcl_fullscreen = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN, 'lcl_fullscreen', $option['value']);
                    $lcl_fullscreen->addOption('true', _YES);
                    $lcl_fullscreen->addOption('false', _NO);
                    $form->addElement($lcl_fullscreen);
                    break;
                case 'lcl_progressbar':
                    $lcl_progressbar = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR, 'lcl_progressbar', $option['value']);
                    $lcl_progressbar->addOption('true', _YES);
                    $lcl_progressbar->addOption('false', _NO);
                    $form->addElement($lcl_progressbar);
                    break;
                case 'lcl_carousel':
                    $lcl_carousel = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS, 'lcl_carousel', $option['value']);
                    $lcl_carousel->addOption('true', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_1);
                    $lcl_carousel->addOption('false', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_2);
                    $form->addElement($lcl_carousel);
                    break;
                case 'lcl_slideshow':
                    $lcl_slideshow = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW, 'lcl_slideshow', $option['value']);
                    $lcl_slideshow->addOption('true', _YES);
                    $lcl_slideshow->addOption('false', _NO);
                    $form->addElement($lcl_slideshow);
                    break;
                case 'lcl_maxwidth':
                    $lcl_maxwidth = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH, 'lcl_maxwidth', $option['value']);
                    for ($i = 50; $i <= 100; $i++) {
                        $lcl_maxwidth->addOption($i, $i);
                    }
                    $form->addElement($lcl_maxwidth);
                    break;
                case 'lcl_maxheight':
                    $lcl_maxheight = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH, 'lcl_maxheight', $option['value']);
                    for ($i = 50; $i <= 100; $i++) {
                        $lcl_maxheight->addOption($i, $i);
                    }
                    $form->addElement($lcl_maxheight);
                    break;
                case 'lcl_backgroundcolor':
                    $form->addElement(new \XoopsFormColorPicker(_AM_WGGALLERY_OPTION_GT_BACKGROUND, 'lcl_backgroundcolor', $option['value']));
                    break;
                case 'lcl_backgroundheight':
                    $lcl_backgroundheight = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BACKHEIGHT, 'lcl_backgroundheight', $option['value']);
                    for ($i = 50; $i <= 100; $i += 5) {
                        $lcl_backgroundheight->addOption($i . 'vh', $i . 'vh');
                    }
                    $form->addElement($lcl_backgroundheight);
                    break;
                case 'lcl_borderwidth':
                    $lcl_border      = new \XoopsFormElementTray(_AM_WGGALLERY_OPTION_GT_BORDER, '&nbsp;');
                    $lcl_borderwidth = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BORDERWIDTH, 'lcl_borderwidth', $option['value']);
                    for ($i = 0; $i <= 10; $i++) {
                        $lcl_borderwidth->addOption($i, $i);
                    }
                    $lcl_border->addElement($lcl_borderwidth);
                    $lcl_bordercolor = new \XoopsFormColorPicker(_AM_WGGALLERY_OPTION_GT_BORDERCOLOR, 'lcl_bordercolor', $lcl_bordercolor);
                    $lcl_border->addElement($lcl_bordercolor);
                    $lcl_borderpadding = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BORDERPADDING, 'lcl_borderpadding', $lcl_borderpadding);
                    for ($i = 0; $i <= 10; $i++) {
                        $lcl_borderpadding->addOption($i, $i);
                    }
                    $lcl_border->addElement($lcl_borderpadding);
                    $lcl_borderradius = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_BORDERRADIUS, 'lcl_borderradius', $lcl_borderradius);
                    for ($i = 0; $i <= 10; $i++) {
                        $lcl_borderradius->addOption($i, $i);
                    }
                    $lcl_border->addElement($lcl_borderradius);
                    $form->addElement($lcl_border);
                    break;
                case 'lcl_bordercolor':
                case 'lcl_borderpadding':
                case 'lcl_borderradius':
                    // hide this, used under lcl_borderwidth
                    break;
                case 'lcl_shadow':
                    $lcl_shadow = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHADOW, 'lcl_shadow', $option['value']);
                    $lcl_shadow->addOption('true', _YES);
                    $lcl_shadow->addOption('false', _NO);
                    $form->addElement($lcl_shadow);
                    break;
                case 'lcl_dataposition':
                    $lcl_dataposition = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_DESC . '</span>', 'lcl_dataposition', $option['value']);
                    $lcl_dataposition->addOption('under', _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_UNDER);
                    $lcl_dataposition->addOption('over', _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER);
                    $lcl_dataposition->addOption('lside', _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_LSIDE);
                    $lcl_dataposition->addOption('rside', _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_RSIDE);
                    $form->addElement($lcl_dataposition);
                    break;
                case 'lcl_skin':
                    $lcl_skin = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLSKIN, 'lcl_skin', $option['value']);
                    $lcl_skin->addOption('minimal');
                    $lcl_skin->addOption('light');
                    $lcl_skin->addOption('dark');
                    $form->addElement($lcl_skin);
                    break;
                case 'lcl_cmdposition':
                    $lcl_cmdposition = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_DESC . '</span>', 'lcl_cmdposition', $option['value']);
                    $lcl_cmdposition->addOption('inner', _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_INNER);
                    $lcl_cmdposition->addOption('outer', _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER);
                    $form->addElement($lcl_cmdposition);
                    break;
                case 'showSubmitter':
                    $showSubmitter = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_SHOWSUBMITTER, 'showSubmitter', $option['value']);
                    $showSubmitter->addOption('true', _YES);
                    $showSubmitter->addOption('false', _NO);
                    $form->addElement($showSubmitter);
                    break;
                case 'lcl_txttogglecmd':
                    $lcl_txttogglecmd = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT, 'lcl_txttogglecmd', $option['value']);
                    $lcl_txttogglecmd->addOption('true', _YES);
                    $lcl_txttogglecmd->addOption('false', _NO);
                    $form->addElement($lcl_txttogglecmd);
                    break;
                case 'lcl_socials':
                    $lcl_socials = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLSOCIALS, 'lcl_socials', $option['value']);
                    $lcl_socials->addOption('true', _YES);
                    $lcl_socials->addOption('false', _NO);
                    $form->addElement($lcl_socials);
                    break;
                case 'lcl_download':
                    $lcl_download = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD, 'lcl_download', $option['value']);
                    $lcl_download->addOption('true', _YES);
                    $lcl_download->addOption('false', _NO);
                    $form->addElement($lcl_download);
                    break;
                case 'lcl_navbtnpos':
                    $lcl_navbtnpos = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS, 'lcl_navbtnpos', $option['value']);
                    $lcl_navbtnpos->addOption('normal', _AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_N);
                    $lcl_navbtnpos->addOption('middle', _AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_M);
                    $form->addElement($lcl_navbtnpos);
                    break;
                case 'lcl_fsimgbehavior':
                    $lcl_fsimgbehavior = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR, 'lcl_fsimgbehavior', $option['value']);
                    $lcl_fsimgbehavior->addOption('fit', _AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FIT);
                    $lcl_fsimgbehavior->addOption('fill', _AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FILL);
                    $lcl_fsimgbehavior->addOption('smart', _AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_SMART);
                    $form->addElement($lcl_fsimgbehavior);
                    break;
                case 'lcl_rclickprevent':
                    $lcl_rclickprevent = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LCLRCLICK, 'lcl_rclickprevent', $option['value']);
                    $lcl_rclickprevent->addOption('true', _YES);
                    $lcl_rclickprevent->addOption('false', _NO);
                    $form->addElement($lcl_rclickprevent);
                    break;
                case 'open':
                    $open = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_AUTOOPEN, 'open', $option['value']);
                    $open->addOption('true', _YES);
                    $open->addOption('false', _NO);
                    $form->addElement($open);
                    break;
                case 'opacity':
                    $opacity = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_OPACITIY, 'opacity', $option['value']);
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
                    $slideshowtype = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE, 'slideshowtype', $option['value']);
                    $slideshowtype->addOption('lightbox');
                    $slideshowtype->addOption('inline');
                    $form->addElement($slideshowtype);
                    break;
                case 'button_close':
                    $button_close = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE, 'button_close', $option['value']);
                    $button_close->addOption('true', _YES);
                    $button_close->addOption('false', _NO);
                    $form->addElement($button_close);
                    break;
                case 'navbar':
                    $navbar = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_NAVBAR, 'navbar', $option['value']);
                    $navbar->addOption(0, _NO);
                    $navbar->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
                    $navbar->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $navbar->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $navbar->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
                    $form->addElement($navbar);
                    break;
                case 'toolbar':
                    $toolbar = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TOOLBAR, 'toolbar', $option['value']);
                    $toolbar->addOption(0, _NO);
                    $toolbar->addOption(1, _AM_WGGALLERY_OPTION_GT_SHOW_1);
                    $toolbar->addOption(2, _AM_WGGALLERY_OPTION_GT_SHOW_2);
                    $toolbar->addOption(3, _AM_WGGALLERY_OPTION_GT_SHOW_3);
                    $toolbar->addOption(4, _AM_WGGALLERY_OPTION_GT_SHOW_4);
                    $form->addElement($toolbar);
                    break;
                case 'download':
                    $download = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD, 'download', $option['value']);
                    $download->addOption('true', _YES);
                    $download->addOption('false', _NO);
                    $form->addElement($download);
                    break;
                case 'zoomable':
                    $zoomable = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM, 'zoomable', $option['value']);
                    $zoomable->addOption('true', _YES);
                    $zoomable->addOption('false', _NO);
                    $form->addElement($zoomable);
                    break;
                case 'fullscreen':
                    $fullscreen = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_FULLSCREEN, 'fullscreen', $option['value']);
                    $fullscreen->addOption('true', _YES);
                    $fullscreen->addOption('false', _NO);
                    $form->addElement($fullscreen);
                    break;
                case 'transitionDuration':
                    $dtrans = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSDURATION . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC . '</span>', 'transitionDuration', $option['value']);
                    for ($i = 1; $i <= 20; $i++) {
                        $dtrans->addOption($i . '00', $i . '00');
                    }
                    $form->addElement($dtrans);
                    break;
                case 'loop':
                    $loop = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS, 'loop', $option['value']);
                    $loop->addOption('1', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_1);
                    $loop->addOption('2', _AM_WGGALLERY_OPTION_GT_PLAYOPTION_2);
                    $form->addElement($loop);
                    break;
                case 'showThumbnails':
                    $showThumbnails = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS, 'showThumbnails', $option['value']);
                    $showThumbnails->addOption('true', _YES);
                    $showThumbnails->addOption('false', _NO);
                    $form->addElement($showThumbnails);
                    break;
                case 'thumbsWidth':
                    $thumbsWidth = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH, 'thumbsWidth', $option['value']);
                    for ($i = 1; $i <= 30; $i++) {
                        $thumbsWidth->addOption($i . '0', $i . '0');
                    }
                    $form->addElement($thumbsWidth);
                    break;
                case 'thumbsHeight':
                    $thumbsHeight = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH, 'thumbsHeight', $option['value']);
                    for ($i = 1; $i <= 30; $i++) {
                        $thumbsHeight->addOption($i . '0', $i . '0');
                    }
                    $form->addElement($thumbsHeight);
                    break;
                case 'indexImage':
                    $indexImage  = new \XoopsFormElementTray(_AM_WGGALLERY_OPTION_GT_INDEXIMG, '&nbsp;');
                    $indexImage1 = new \XoopsFormSelect('', 'indexImage', $option['value']);
                    $indexImage1->addOption('none', _NONE);
                    $indexImage1->addOption('fixedHeight', 'fixedHeight');
                    $indexImage1->addOption('squareSize', 'squareSize');
                    $indexImage1->addOption('simpleContainer', 'simpleContainer');
                    $indexImage->addElement($indexImage1);
                    $indexImage2 = new \XoopsFormText(_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT, 'indexImageheight', 50, 255, $indexImageheight);
                    $indexImage->addElement($indexImage2);
                    $form->addElement($indexImage);
                    break;
                case 'indexImageheight':
                    // hide it, this is used under indexImage
                    break;
                case 'transitionEffect':
                    $transitionEffect = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_TRANSEFFECT, 'transitionEffect', $option['value']);
                    $transitionEffect->addOption('fading', 'fading');
                    $transitionEffect->addOption('sliding', 'sliding');
                    $form->addElement($transitionEffect);
                    break;
                case 'rowHeight':
                    $rowHeight = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_ROWHEIGHT, 'rowHeight', $option['value']);
                    for ($i = 10; $i <= 50; $i++) {
                        $rowHeight->addOption($i . '0', $i . '0');
                    }
                    $form->addElement($rowHeight);
                    break;
                case 'lastRow':
                    $lastRow = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_LASTROW . '<br><span style="font-size:80%">' . _AM_WGGALLERY_OPTION_GT_LASTROW_DESC . '</span>', 'lastRow', $option['value']);
                    $lastRow->addOption('justify', _YES);
                    $lastRow->addOption('nojustify', _NO);
                    $form->addElement($lastRow);
                    break;
                case 'margins':
                    $margins = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_MARGINS, 'margins', $option['value']);
                    for ($i = 1; $i <= 30; $i++) {
                        $margins->addOption($i, $i);
                    }
                    $form->addElement($margins);
                    break;
                case 'outerborder':
                    $outerborder = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_GT_OUTERBORDER, 'outerborder', $option['value']);
                    for ($i = 1; $i <= 100; $i++) {
                        $outerborder->addOption($i, $i);
                    }
                    $form->addElement($outerborder);
                    break;
                case 'randomize':
                    $randomize = new \XoopsFormRadio(_AM_WGGALLERY_OPTION_GT_RANDOMIZE, 'randomize', $option['value']);
                    $randomize->addOption('true', _YES);
                    $randomize->addOption('false', _NO);
                    $form->addElement($randomize);
                    break;
                case 'option_sort':
                    // $form->addElement(new \XoopsFormText('option_sort', 'option_sort',  100, 255, $option['value']));
                    $form->addElement(new \XoopsFormHidden('option_sort', $option['value']));
                    break;
                case 'default':
                default:
                    $default = new \XoopsFormRadio($option['name'], $option['name'], $option['value']);
                    $default->addOption('none', _AM_WGGALLERY_NONE);
                    $form->addElement($default);
                    break;
            }
        }
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'saveoptions'));
        $form->addElement(new \XoopsFormHidden('gt_id', $this->getVar('gt_id')));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param bool $admin
     * @return array
     */
    public function getValuesGallerytypes($admin = false)
    {
        // $helper = \XoopsModules\Wggallery\Helper::getInstance();
        $ret             = $this->getValues();
        $ret['id']       = $this->getVar('gt_id');
        $ret['primary']  = $this->getVar('gt_primary');
        $ret['name']     = $this->getVar('gt_name');
        $ret['credits']  = $this->getVar('gt_credits', 'show');
        $ret['template'] = $this->getVar('gt_template');
        $ret['options']  = $this->getVar('gt_options');
        if ($admin) {
            $gt_options = $this->getVar('gt_options', 'N');
            if ('' !== $gt_options) {
                $options      = unserialize($gt_options, ['allowed_classes' => false]);
                $options_text = '<ul>';
                foreach ($options as $option) {
                    if ('option_sort' !== $option['name']) {
                        $options_text .= '<li>';
                        if ('' == $option['caption']) {
                            $options_text .= '"' . $option['name'] . '"';
                        } else {
                            $options_text .= constant($option['caption']);
                        }
                        $optionValue = $option['value'];
                        if (mb_strlen($optionValue) > 20) {
                            $optionValue = mb_substr($optionValue, 0, 17) . '...';
                        }
                        $options_text .= ': ' . $optionValue . '</li>';
                    }
                }
                $options_text .= '</ul>';
            }
            $ret['options_text'] = $options_text;
        }
        $ret['date'] = formatTimestamp($this->getVar('gt_date'), 's');

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayGallerytypes()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
