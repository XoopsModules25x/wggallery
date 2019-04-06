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
 * @version        $Id: 1.0 helper.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */


class WggalleryHelper
{
    /**
     * @var string
     */
    private $dirname = null;
    /**
     * @var string
     */
    private $module = null;
    /**
     * @var string
     */
    private $handler = null;
    /**
     * @var string
     */
    private $config = null;
    /**
     * @var string
     */
    private $debug = null;
    /**
     * @var array
     */
    private $debugArray = array();
    /**
    *  @protected function constructor class
    *  @param mixed $debug
    */
    public function __construct($debug)
    {
        $this->debug = $debug;
        $this->dirname =  basename(dirname(__DIR__));
    }
    /**
    *  @static function getInstance
    *  @param mixed $debug
    *  @return WggalleryHelper
    */
    public static function getInstance($debug = false)
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self($debug);
        }
        return $instance;
    }
    /**
    *  @static function getModule
    *  @param null
    *  @return string
    */
    public function &getModule()
    {
        if ($this->module === null) {
            $this->initModule();
        }
        return $this->module;
    }

    /**
     * @static function getConfig
     * @param string $name
     * @param bool $first
     * @return string
     */
    public function getConfig($name = null, $first = false)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        if (!$name) {
            $this->addLog('Getting all config');
            return $this->config;
        }
        if (!isset($this->config[$name])) {
            $this->addLog("ERROR :: CONFIG '{$name}' does not exist");
            return null;
        }
		if (is_array($this->config[$name])) {
            $this->addLog("Getting config '{$name}' : " . serialize($this->config[$name]));
			if ($first) {
				return $this->config[$name][0];
			} else {
				return $this->config[$name];
			}
        } else {
            $this->addLog("Getting config '{$name}' : " . $this->config[$name]);
			return $this->config[$name];
        }
    }
    /**
    *  @static function setConfig
    *  @param string $name
    *  @param mixed $value
    *  @return mixed
    */
    public function setConfig($name = null, $value = null)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        $this->config[$name] = $value;
        $this->addLog("Setting config '{$name}' : " . $this->config[$name]);
        return $this->config[$name];
    }
    /**
    *  @static function getHandler
    *  @param string $name
    *  @return mixed
    */
    public function getHandler($name)
    {
        if (!isset($this->handler[$name . 'Handler'])) {
            $this->initHandler($name);
        }
        $this->addLog("Getting handler '{$name}'");
        return $this->handler[$name . 'Handler'];
    }
    /**
    *  @static function initModule
    *  @param null
    */
    public function initModule()
    {
        global $xoopsModule;
        if (isset($xoopsModule) && is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $this->dirname) {
            $this->module = $xoopsModule;
        } else {
            $hModule = xoops_getHandler('module');
            $this->module = $hModule->getByDirname($this->dirname);
        }
        $this->addLog('INIT MODULE');
    }
    /**
    *  @static function initConfig
    *  @param null
    */
    public function initConfig()
    {
        $this->addLog('INIT CONFIG');
        $hModConfig = xoops_getHandler('config');
        $this->config = $hModConfig->getConfigsByCat(0, $this->getModule()->getVar('mid'));
    }
    /**
    *  @static function initHandler
    *  @param string $name
    */
    public function initHandler($name)
    {
        $this->addLog('INIT ' . $name . ' HANDLER');
        $this->handler[$name . 'Handler'] = xoops_getModuleHandler($name, $this->dirname);
    }
    /**
    *  @static function addLog
    *  @param string $log
    */
    public function addLog($log)
    {
        if ($this->debug && is_object($GLOBALS['xoopsLogger'])) {
            $GLOBALS['xoopsLogger']->addExtra($this->module->name(), $log);
        }
    }
	
	/**
    *  @function getStateText
    *  @param string $state
	*  @return string text for state
    */
    public function getStateText($state)
    {
        switch ($state) {
			case WGGALLERY_STATE_ONLINE_VAL:
				return _CO_WGGALLERY_STATE_ONLINE;
			break;
			case WGGALLERY_STATE_APPROVAL_VAL:
				return _CO_WGGALLERY_STATE_APPROVAL;
			break;
			case WGGALLERY_STATE_OFFLINE_VAL:
			default:
				return _CO_WGGALLERY_STATE_OFFLINE;
			break;  
        }
    }
    
    /**
     * @public function getForm for delete
     * @param array $arrParams
     * @param string $title
     * @param string $text
     * @param string $descr
     * @return XoopsThemeForm
     */
	public function getFormDelete($arrParams, $title = '', $text, $descr = '')
	{
		//$wggallery = WggalleryHelper::getInstance();
		$action = $_SERVER['REQUEST_URI'];

		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm(_CO_WGGALLERY_FORM_DELETE_SURE, 'xoopsform-delete', $action, 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Text AlbName
		$label = new XoopsFormLabel( $title, $text );
		if ('' !== $descr) {
			$label->setDescription($descr);
		}
		$form->addElement($label);
		foreach ($arrParams as $key => $param) {
			$form->addElement(new XoopsFormHidden($key, $param));
		}
		// To Save
		$btnTray = new XoopsFormElementTray('', '&nbsp;' );
		$btnTray->addElement(new XoopsFormButton('',  'cancel',_CANCEL, 'submit'));
		$btnTray->addElement(new XoopsFormButton('',  'submit',_DELETE, 'submit'));
		$form->addElement($btnTray);

		return $form;
	}
}