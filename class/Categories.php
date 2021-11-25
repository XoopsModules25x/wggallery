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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Images
 */
class Categories extends \XoopsObject
{
    public string $redirOp = '';

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('cat_id', \XOBJ_DTYPE_INT);
        $this->initVar('cat_text', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_album', \XOBJ_DTYPE_INT);
        $this->initVar('cat_image', \XOBJ_DTYPE_INT);
        $this->initVar('cat_search', \XOBJ_DTYPE_INT);
        $this->initVar('cat_weight', \XOBJ_DTYPE_INT);
        $this->initVar('cat_date', \XOBJ_DTYPE_INT);
        $this->initVar('cat_submitter', \XOBJ_DTYPE_INT);
        $this->initVar('dohtml', \XOBJ_DTYPE_INT, 1, false);
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

    // /**
    //  * The new inserted $Id
    //  * @return int inserted id
    //  */
    // public function getNewInsertedIdImages()
    // {
    // $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();

    // return $newInsertedId;
    // }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategories($action = false)
    {
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_WGGALLERY_ADD_CATEGORY) : \sprintf(\_AM_WGGALLERY_EDIT_CATEGORY);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text cat_text
        $form->addElement(new \XoopsFormText(\_AM_WGGALLERY_CAT_TEXT, 'cat_text', 50, 255, $this->getVar('cat_text')));
        // Form Text Date Select cat_album
        $catAlbum = $this->isNew() ? 1 : $this->getVar('cat_album');
        $form->addElement(new \XoopsFormRadioYN(\_AM_WGGALLERY_CAT_ALBUM, 'cat_album', $catAlbum));
        // Form Text Date Select cat_image
        $catImage = $this->isNew() ? 1 : $this->getVar('cat_image');
        $form->addElement(new \XoopsFormRadioYN(\_AM_WGGALLERY_CAT_IMAGE, 'cat_image', $catImage));
        // Form Text Date Select cat_search
        $catSearch = $this->isNew() ? 1 : $this->getVar('cat_search');
        $form->addElement(new \XoopsFormRadioYN(\_AM_WGGALLERY_CAT_SEARCH, 'cat_search', $catSearch));
        // Form Text cat_weight
        $form->addElement(new \XoopsFormHidden('cat_weight', $this->getVar('cat_weight')));
        // Form Text Date Select CatDate
        $catDate = $this->isNew() ? 0 : $this->getVar('cat_date');
        $form->addElement(new \XoopsFormTextDateSelect(\_CO_WGGALLERY_DATE, 'cat_date', '', $catDate));
        // Form Select User CatSubmitter
        $form->addElement(new \XoopsFormSelectUser(\_CO_WGGALLERY_SUBMITTER, 'cat_submitter', false, $this->getVar('cat_submitter')));
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('redir_op', $this->redirOp));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param int  $maxDepth
     * @return array
     */
    public function getValuesCategories($keys = null, $format = null, $maxDepth = null)
    {
        $ret              = $this->getValues($keys, $format, $maxDepth);
        $ret['id']        = $this->getVar('cat_id');
        $ret['text']      = $this->getVar('cat_text');
        $ret['album']     = $this->getVar('cat_album');
        $ret['image']     = $this->getVar('cat_image');
        $ret['search']    = $this->getVar('cat_search');
        $ret['weight']    = $this->getVar('cat_weight');
        $ret['date']      = \formatTimestamp($this->getVar('cat_date'), 's');
        $ret['submitter'] = \XoopsUser::getUnameFromId($this->getVar('cat_submitter'));

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayCategories()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
