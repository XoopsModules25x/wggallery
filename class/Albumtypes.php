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
 * @version        $Id: 1.0 albumtypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Albumtypes
 */
class Albumtypes extends \XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('at_id', XOBJ_DTYPE_INT);
        $this->initVar('at_primary', XOBJ_DTYPE_INT);
        $this->initVar('at_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('at_desc', XOBJ_DTYPE_TXTAREA);
        $this->initVar('at_credits', XOBJ_DTYPE_TXTBOX);
        $this->initVar('at_template', XOBJ_DTYPE_TXTBOX);
        $this->initVar('at_options', XOBJ_DTYPE_TXTAREA);
        $this->initVar('at_date', XOBJ_DTYPE_INT);
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
    public function getNewInsertedIdAlbumtypes()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();

        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormAlbumtypes($action = false)
    {
        //$helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? sprintf(_AM_WGGALLERY_ALBUMTYPE_ADD) : sprintf(_AM_WGGALLERY_ALBUMTYPE_EDIT);
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text GtPrimary
        $gtCat = $this->isNew() ? 0 : $this->getVar('at_primary');
        $form->addElement(new \XoopsFormRadioYN(_AM_WGGALLERY_GT_AT_PRIMARY, 'at_primary', $gtCat), true);
        // Form Text GtName
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_NAME, 'at_name', 50, 255, $this->getVar('at_name')), true);
        // Form Text Area GtDesc
        $form->addElement(new \XoopsFormTextArea(_AM_WGGALLERY_ALBUMTYPE_DESC, 'at_desc', $this->getVar('at_desc', 'e'), 4, 47));
        // Form Text GtCredits
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_CREDITS, 'at_credits', 50, 255, $this->getVar('at_credits')));
        // Form Text GtTemplate
        $form->addElement(new \XoopsFormText(_AM_WGGALLERY_GT_AT_TEMPLATE, 'at_template', 50, 255, $this->getVar('at_template')));
        // Form Text Area GtOption
        $form->addElement(new \XoopsFormTextArea(_AM_WGGALLERY_GT_AT_OPTIONS, 'at_options', $this->getVar('at_options'), 4, 47));
        // Form Text Date Select GtDate
        $gtDate = $this->isNew() ? 0 : $this->getVar('at_date');
        $form->addElement(new \XoopsFormTextDateSelect(_AM_WGGALLERY_GT_AT_DATE, 'at_date', '', $gtDate));
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
    public function getFormAlbumtypeOptions($action = false)
    {
        //$helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (false === $action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_AM_WGGALLERY_OPTION_AT_SET, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        $tpl_options = $this->getVar('at_options', 'N');
        $options     = unserialize($tpl_options, ['allowed_classes' => false]);

        foreach ($options as $option) {
            // echo '<br>name'.$option['name'];
            switch ($option['name']) {
                case 'hovereffect':
                    $hovereffect = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_AT_HOVER, 'hovereffect', $option['value']);
                    $hovereffect->addOption('none', _CO_WGGALLERY_NONE);
                    $hovereffect->addOption('lily', 'Lily');
                    $hovereffect->addOption('sadie', 'Sadie');
                    $hovereffect->addOption('honey', 'Honey');
                    $hovereffect->addOption('layla', 'Layla');
                    $hovereffect->addOption('zoe', 'Zoe');
                    $hovereffect->addOption('oscar', 'Oscar');
                    $hovereffect->addOption('marley', 'Marley');
                    $hovereffect->addOption('ruby', 'Ruby');
                    $hovereffect->addOption('roxy', 'Roxy');
                    $hovereffect->addOption('bubba', 'Bubba');
                    $hovereffect->addOption('romeo', 'Romeo');
                    $hovereffect->addOption('dexter', 'Dexter');
                    $hovereffect->addOption('sarah', 'Sarah');
                    $hovereffect->addOption('chico', 'Chico');
                    $hovereffect->addOption('milo', 'Milo');
                    $hovereffect->addOption('julia', 'Julia');
                    $hovereffect->addOption('goliath', 'Goliath');
                    $hovereffect->addOption('hera', 'Hera');
                    $hovereffect->addOption('winston', 'Winston');
                    $hovereffect->addOption('selena', 'Selena');
                    $hovereffect->addOption('terry', 'Terry');
                    $hovereffect->addOption('phoebe', 'Phoebe');
                    $hovereffect->addOption('apollo', 'Apollo');
                    $hovereffect->addOption('kira', 'Kira');
                    $hovereffect->addOption('steve', 'Steve');
                    $hovereffect->addOption('moses', 'Moses');
                    $hovereffect->addOption('jazz', 'Jazz');
                    $hovereffect->addOption('ming', 'Ming');
                    $hovereffect->addOption('lexi', 'Lexi');
                    $hovereffect->addOption('duke', 'Duke');

                    $form->addElement($hovereffect);
                    break;
                case 'number_cols_album':
                    $number_cols_album = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB, 'number_cols_album', $option['value']);
                    $number_cols_album->addOption(1, 1);
                    $number_cols_album->addOption(2, 2);
                    $number_cols_album->addOption(3, 3);
                    $number_cols_album->addOption(4, 4);
                    $number_cols_album->addOption(6, 6);
                    $form->addElement($number_cols_album);
                    break;
                case 'number_cols_cat':
                    $number_cols_cat = new \XoopsFormSelect(_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT, 'number_cols_cat', $option['value']);
                    $number_cols_cat->addOption(1, 1);
                    $number_cols_cat->addOption(2, 2);
                    $number_cols_cat->addOption(3, 3);
                    $number_cols_cat->addOption(4, 4);
                    $number_cols_cat->addOption(6, 6);
                    $form->addElement($number_cols_cat);
                    break;
                case 'showTitle':
                    $form->addElement(new \XoopsFormRadioYN(_AM_WGGALLERY_OPTION_SHOWTITLE, 'showTitle', $option['value']));
                    break;
                case 'showDesc':
                    $form->addElement(new \XoopsFormRadioYN(_AM_WGGALLERY_OPTION_SHOWDESCR, 'showDesc', $option['value']));
                    break;
                case 'album_showsubmitter':
                    $form->addElement(new \XoopsFormRadioYN(_AM_WGGALLERY_OPTION_SHOWSUBMITTER, 'album_showsubmitter', $option['value']));
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
        $form->addElement(new \XoopsFormHidden('at_id', $this->getVar('at_id')));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param null     $keys
     * @param null     $format
     * @param int|null $maxDepth
     * @return array
     */
    public function getValuesAlbumtypes($keys = null, $format = null, $maxDepth = null)
    {
        // $helper = \XoopsModules\Wggallery\Helper::getInstance();
        $ret             = $this->getValues($keys, $format, $maxDepth);
        $ret['id']       = $this->getVar('at_id');
        $ret['primary']  = $this->getVar('at_primary');
        $ret['name']     = $this->getVar('at_name');
        $ret['desc']     = $this->getVar('at_desc');
        $ret['credits']  = $this->getVar('at_credits');
        $ret['template'] = $this->getVar('at_template');
        $ret['options']  = $this->getVar('at_options');
        $at_options      = $this->getVar('at_options', 'N');
        $options_text    = '';
        if ('' !== $at_options) {
            $options      = unserialize($at_options, ['allowed_classes' => false]);
            $options_text = '<ul>';
            foreach ($options as $option) {
                if ('option_sort' !== $option['name']) {
                    $options_text .= '<li>';
                    if ('' == $option['caption']) {
                        $options_text .= '"' . $option['name'] . '"';
                    } else {
                        $options_text .= constant($option['caption']);
                    }
                    $options_text .= ': ' . $option['value'] . '</li>';
                }
            }
            $options_text .= '</ul>';
        }
        $ret['options_text'] = $options_text;
        $ret['date']         = formatTimestamp($this->getVar('at_date'), 's');

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayAlbumtypes()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
