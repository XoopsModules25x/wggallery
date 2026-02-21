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
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 watermarks.php 1 Thu 2018-11-01 08:54:56Z XOOPS Project (www.xoops.org) $
 */
\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Watermarks
 */
class Watermarks extends \XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('wm_id', \XOBJ_DTYPE_INT);
        $this->initVar('wm_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('wm_type', \XOBJ_DTYPE_INT);
        $this->initVar('wm_position', \XOBJ_DTYPE_INT);
        $this->initVar('wm_marginlr', \XOBJ_DTYPE_INT);
        $this->initVar('wm_margintb', \XOBJ_DTYPE_INT);
        $this->initVar('wm_image', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('wm_text', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('wm_font', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('wm_fontsize', \XOBJ_DTYPE_INT);
        $this->initVar('wm_color', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('wm_usage', \XOBJ_DTYPE_INT);
        $this->initVar('wm_target', \XOBJ_DTYPE_INT);
        $this->initVar('wm_date', \XOBJ_DTYPE_INT);
        $this->initVar('wm_submitter', \XOBJ_DTYPE_INT);
    }

    /**
     * @static function &getInstance
     */
    public static function getInstance(): void
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
    public function getNewInsertedIdWatermarks(): int
    {
        return $GLOBALS['xoopsDB']->getInsertId();
    }

    /**
     * @public function getForm
     * @return \XoopsThemeForm
     */
    public function getFormWatermarks(): \XoopsThemeForm
    {
        $helper = \XoopsModules\Wggallery\Helper::getInstance();

        $action = $_SERVER['REQUEST_URI'];

        // Title
        $title = $this->isNew() ? \_CO_WGGALLERY_WATERMARK_ADD : \_CO_WGGALLERY_WATERMARK_EDIT;
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text WmName
        $form->addElement(new \XoopsFormText(\_CO_WGGALLERY_WATERMARK_NAME, 'wm_name', 50, 255, $this->getVar('wm_name')), true);
        // Form Select Watermarks
        $wmType       = $this->isNew() ? 1 : $this->getVar('wm_type');
        $wmTypeSelect = new \XoopsFormSelect(\_CO_WGGALLERY_WATERMARK_TYPE, 'wm_type', $wmType);
        $wmTypeSelect->addOption(Constants::WATERMARK_TYPETEXT, \_CO_WGGALLERY_WATERMARK_TYPETEXT);
        $wmTypeSelect->addOption(Constants::WATERMARK_TYPEIMAGE, \_CO_WGGALLERY_WATERMARK_TYPEIMAGE);
        $form->addElement($wmTypeSelect);
        // Form Text WmPosition
        $wmPosition       = $this->isNew() ? 1 : $this->getVar('wm_position');
        $wmPositionSelect = new \XoopsFormSelect(\_CO_WGGALLERY_WATERMARK_POSITION, 'wm_position', $wmPosition);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSTOPLEFT, \_CO_WGGALLERY_WATERMARK_POSTOPLEFT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSTOPRIGHT, \_CO_WGGALLERY_WATERMARK_POSTOPRIGHT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSTOPCENTER, \_CO_WGGALLERY_WATERMARK_POSTOPCENTER);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSMIDDLELEFT, \_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSMIDDLERIGHT, \_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSMIDDLECENTER, \_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSBOTTOMLEFT, \_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSBOTTOMRIGHT, \_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT);
        $wmPositionSelect->addOption(Constants::WATERMARK_POSBOTTOMCENTER, \_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER);
        $form->addElement($wmPositionSelect, true);
        // Form Text WmMargin
        $marginTray = new \XoopsFormElementTray(\_CO_WGGALLERY_WATERMARK_MARGIN, '&nbsp;');
        $wmMarginLR = $this->isNew() ? 0 : $this->getVar('wm_marginlr');
        $marginTray->addElement(new \XoopsFormText(\_CO_WGGALLERY_WATERMARK_MARGINLR, 'wm_marginlr', 10, 255, $wmMarginLR));
        $wmMarginTB = $this->isNew() ? 0 : $this->getVar('wm_margintb');
        $marginTray->addElement(new \XoopsFormText(\_CO_WGGALLERY_WATERMARK_MARGINTB, 'wm_margintb', 10, 255, $wmMarginTB));
        $form->addElement($marginTray);

        // Form Upload Image WmImage
        $getWmImage     = $this->getVar('wm_image');
        $wmImage        = $getWmImage ?: 'blank.gif';
        $imageDirectory = '/uploads/wggallery/images/watermarks';
        $imageTray      = new \XoopsFormElementTray(\_CO_WGGALLERY_WATERMARK_IMAGE, '<br>');
        $imageSelect    = new \XoopsFormSelect(\sprintf(\_CO_WGGALLERY_FORM_IMAGE_PATH, ".$imageDirectory/"), 'wm_image', $wmImage, 5);
        $imageArray     = \XoopsLists::getImgListAsArray(\XOOPS_ROOT_PATH . $imageDirectory);
        foreach ($imageArray as $image1) {
            $imageSelect->addOption($image1, $image1);
        }
        $imageSelect->setExtra("onchange='showImgSelected(\"image1\", \"wm_image\", \"" . $imageDirectory . '", "", "' . \XOOPS_URL . "\")'");
        $imageTray->addElement($imageSelect);
        $imageTray->addElement(new \XoopsFormLabel('', "<br><img src='" . \XOOPS_URL . '/' . $imageDirectory . '/' . $wmImage . "' name='image1' id='image1' alt='' style='max-width:100px'>"));
        // Form File WmImage
        $fileSelectTray = new \XoopsFormElementTray('', '<br>');
        $fileSelectTray->addElement(new \XoopsFormFile(\_CO_WGGALLERY_FORM_UPLOAD_IMAGE_WATERMARKS, 'attachedfile', $helper->getConfig('maxsize')));
        $fileSelectTray->addElement(new \XoopsFormLabel(''));
        $imageTray->addElement($fileSelectTray);
        $form->addElement($imageTray);
        // Form Text WmText
        $wmText = $this->isNew() ? '© ' : $this->getVar('wm_text');
        $form->addElement(new \XoopsFormText(\_CO_WGGALLERY_WATERMARK_TEXT, 'wm_text', 50, 255, $wmText));
        // Form Select Watermarks
        $wmfontTray   = new \XoopsFormElementTray(\_CO_WGGALLERY_WATERMARK_FONT, '&nbsp;');
        $wm_font      = $this->getVar('wm_font');
        $wmFontSelect = new \XoopsFormSelect(\_CO_WGGALLERY_WATERMARK_FONTFAMILY, 'wm_font', $wm_font);
        $wmFontSelect->addOption('');
        $rep = \WGGALLERY_UPLOAD_FONTS_PATH . '/';
        $dir = \opendir($rep);
        while ($f = \readdir($dir)) {
            if (\is_file($rep . $f) && \preg_match('/ttf/', \mb_strtolower($f))) {
                $wmFontSelect->addOption($f, mb_substr($f, 0, -4));
            }
        }
        $wmfontTray->addElement($wmFontSelect);
        // Form Text WmFontsize
        $wmFontsize       = $this->isNew() ? 12 : $this->getVar('wm_fontsize');
        $wmFontsizeSelect = new \XoopsFormSelect(\_CO_WGGALLERY_WATERMARK_FONTSIZE, 'wm_fontsize', $wmFontsize);
        for ($i = 1; $i <= 200; $i++) {
            $wmFontsizeSelect->addOption($i, $i);
        }
        $wmfontTray->addElement($wmFontsizeSelect);
        // Form Color Picker WmColor
        $wm_color      = $this->isNew() ? '#000000' : $this->getVar('wm_color');
        $wmColorPicker = new \XoopsFormColorPicker(\_CO_WGGALLERY_WATERMARK_COLOR, 'wm_color', $wm_color);
        $wmfontTray->addElement($wmColorPicker);
        $form->addElement($wmfontTray);

        // Form Select WmUsage
        $wmUsage       = $this->isNew() ? 2 : $this->getVar('wm_usage');
        $wmUsageSelect = new \XoopsFormSelect(\_CO_WGGALLERY_WATERMARK_USAGE, 'wm_usage', $wmUsage);
        $wmUsageSelect->addOption(Constants::WATERMARK_USAGENONE, \_CO_WGGALLERY_WATERMARK_USAGENONE);
        $wmUsageSelect->addOption(Constants::WATERMARK_USAGEALL, \_CO_WGGALLERY_WATERMARK_USAGEALL);
        $wmUsageSelect->addOption(Constants::WATERMARK_USAGESINGLE, \_CO_WGGALLERY_WATERMARK_USAGESINGLE);
        $form->addElement($wmUsageSelect);
        // Form Select WmTarget
        $wmTarget       = $this->isNew() ? 0 : $this->getVar('wm_target');
        $wmTargetSelect = new \XoopsFormRadio(\_CO_WGGALLERY_WATERMARK_TARGET, 'wm_target', $wmTarget);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_A, \_CO_WGGALLERY_WATERMARK_TARGET_A);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_M, \_CO_WGGALLERY_WATERMARK_TARGET_M);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_L, \_CO_WGGALLERY_WATERMARK_TARGET_L);
        $form->addElement($wmTargetSelect, true);
        // Form Text Date Select WmDate
        $wmDate = $this->isNew() ? 0 : $this->getVar('wm_date');
        $form->addElement(new \XoopsFormTextDateSelect(\_CO_WGGALLERY_DATE, 'wm_date', '', $wmDate));
        // Form Select User WmSubmitter
        $form->addElement(new \XoopsFormSelectUser(\_CO_WGGALLERY_SUBMITTER, 'wm_submitter', false, $this->getVar('wm_submitter')));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param int|null $maxDepth
     * @return array
     */
    public function getValuesWatermarks($keys = null, $format = null, int $maxDepth = null): array
    {
        $ret         = $this->getValues($keys, $format, $maxDepth);
        $ret['id']   = $this->getVar('wm_id');
        $ret['name'] = $this->getVar('wm_name');
        $ret['type'] = $this->getVar('wm_type');
        $type_text = match ($this->getVar('wm_type')) {
            Constants::WATERMARK_TYPETEXT => \_CO_WGGALLERY_WATERMARK_TYPETEXT,
            Constants::WATERMARK_TYPEIMAGE => \_CO_WGGALLERY_WATERMARK_TYPEIMAGE,
            default => "invalid value 'wm_position'",
        };
        $ret['type_text'] = $type_text;
        $ret['position']  = $this->getVar('wm_position');
        $position_text = match ($this->getVar('wm_position')) {
            Constants::WATERMARK_POSTOPLEFT => \_CO_WGGALLERY_WATERMARK_POSTOPLEFT,
            Constants::WATERMARK_POSTOPRIGHT => \_CO_WGGALLERY_WATERMARK_POSTOPRIGHT,
            Constants::WATERMARK_POSTOPCENTER => \_CO_WGGALLERY_WATERMARK_POSTOPCENTER,
            Constants::WATERMARK_POSMIDDLELEFT => \_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT,
            Constants::WATERMARK_POSMIDDLERIGHT => \_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT,
            Constants::WATERMARK_POSMIDDLECENTER => \_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER,
            Constants::WATERMARK_POSBOTTOMLEFT => \_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT,
            Constants::WATERMARK_POSBOTTOMRIGHT => \_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT,
            Constants::WATERMARK_POSBOTTOMCENTER => \_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER,
            default => "invalid value 'wm_position'",
        };
        $ret['position_text'] = $position_text;
        $ret['marginlr']      = $this->getVar('wm_marginlr');
        $ret['margintb']      = $this->getVar('wm_margintb');
        $ret['image']         = $this->getVar('wm_image');
        $ret['text']          = $this->getVar('wm_text');
        $ret['font']          = $this->getVar('wm_font');
        $ret['fontsize']      = $this->getVar('wm_fontsize');
        $ret['color']         = $this->getVar('wm_color');
        $ret['usage']         = $this->getVar('wm_usage');
        $usage_text = match ($this->getVar('wm_usage')) {
            Constants::WATERMARK_USAGESINGLE => \_CO_WGGALLERY_WATERMARK_USAGESINGLE,
            Constants::WATERMARK_USAGEALL => \_CO_WGGALLERY_WATERMARK_USAGEALL,
            Constants::WATERMARK_USAGENONE => \_CO_WGGALLERY_WATERMARK_USAGENONE,
            default => "invalid value 'wm_usage'",
        };
        $ret['usage_text'] = $usage_text;
        $ret['target']     = $this->getVar('wm_target');
        $target_text = match ($this->getVar('wm_target')) {
            Constants::WATERMARK_TARGET_A => \_CO_WGGALLERY_WATERMARK_TARGET_A,
            Constants::WATERMARK_TARGET_M => \_CO_WGGALLERY_WATERMARK_TARGET_M,
            Constants::WATERMARK_TARGET_L => \_CO_WGGALLERY_WATERMARK_TARGET_L,
            default => "invalid value 'wm_target'",
        };
        $ret['target_text'] = $target_text;
        $ret['date']        = \formatTimestamp($this->getVar('wm_date'), 's');
        $ret['submitter']   = \XoopsUser::getUnameFromId($this->getVar('wm_submitter'));

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayWatermarks(): array
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
