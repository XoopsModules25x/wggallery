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
 * @version        $Id: 1.0 helper.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */

/**
 * Class Helper
 */
class Helper extends \Xmf\Module\Helper
{
    public $debug;

    /**
     * @internal param $debug
     * @param bool $debug
     */
    public function __construct($debug = false)
    {
        $this->debug   = $debug;
        $moduleDirName = basename(dirname(__DIR__));
        parent::__construct($moduleDirName);
    }

    /**
     * @param bool $debug
     *
     * @return \XoopsModules\Wggallery\Helper
     */
    public static function getInstance($debug = false)
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($debug);
        }

        return $instance;
    }

    /**
     * @return string
     */
    public function getDirname()
    {
        return $this->dirname;
    }

    /**
     * Get an Object Handler
     *
     * @param string $name name of handler to load
     *
     * @return bool|\XoopsObjectHandler|\XoopsPersistableObjectHandler
     */
    public function getHandler($name)
    {
        $ret   = false;
        $db    = \XoopsDatabaseFactory::getDatabaseConnection();
        $class = '\\XoopsModules\\' . ucfirst(mb_strtolower(basename(dirname(__DIR__)))) . '\\' . $name . 'Handler';
        $ret   = new $class($db);

        return $ret;
    }

    /**
     * @function getStateText
     * @param string $state
     * @return string text for state
     */
    public function getStateText($state)
    {
        switch ($state) {
            case Constants::WGGALLERY_STATE_ONLINE_VAL:
                return _CO_WGGALLERY_STATE_ONLINE;
                break;
            case Constants::WGGALLERY_STATE_APPROVAL_VAL:
                return _CO_WGGALLERY_STATE_APPROVAL;
                break;
            case Constants::WGGALLERY_STATE_OFFLINE_VAL:
            default:
                return _CO_WGGALLERY_STATE_OFFLINE;
                break;
        }
    }

    /**
     * @public function getForm for delete
     * @param array  $arrParams
     * @param string $title
     * @param string $text
     * @param string $descr
     * @return XoopsThemeForm
     */
    public function getFormDelete($arrParams, $title, $text, $descr = '')
    {
        $helper = Wggallery\Helper::getInstance();
        $action = $_SERVER['REQUEST_URI'];

        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_CO_WGGALLERY_FORM_DELETE_SURE, 'xoopsform-delete', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text AlbName
        $label = new \XoopsFormLabel($title, $text);
        if ('' !== $descr) {
            $label->setDescription($descr);
        }
        $form->addElement($label);
        foreach ($arrParams as $key => $param) {
            $form->addElement(new \XoopsFormHidden($key, $param));
        }
        // To Save
        $btnTray = new \XoopsFormElementTray('', '&nbsp;');
        $btnTray->addElement(new \XoopsFormButton('', 'cancel', _CANCEL, 'submit'));
        $btnTray->addElement(new \XoopsFormButton('', 'submit', _DELETE, 'submit'));
        $form->addElement($btnTray);

        return $form;
    }
}
