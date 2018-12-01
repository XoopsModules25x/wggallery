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
 * @version        $Id: 1.0 permissions.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object WggalleryPermissions
 */
class WggalleryPermissions extends XoopsObject
{
	/**
	 * Constructor 
	 *
	 * @param null
	 */
	public function __construct()
	{
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
}
/**
 * Class Object Handler WggalleryPermissions
 */
class WggalleryPermissionsHandler extends XoopsPersistableObjectHandler
{
	/**
	 * Constructor 
	 *
	 * @param null|XoopsDatabase $db
	 */
	public function __construct(XoopsDatabase $db)
	{
		// parent::__construct($db, 'wggallery_permissions', 'wggallerypermissions', 'gt_id', 'gt_name');
	}

	public function permGlobalApprove() {
		
		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return true;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_global', '4', $my_group_ids, $mid  ) ;
	}

	public function permGlobalSubmitAll() {

		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return true;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_global', '8', $my_group_ids, $mid  ) ;
	}

	public function permGlobalSubmit() {

		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return true;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_global', '16', $my_group_ids, $mid  ) ;
	}

	public function permAlbumEdit($submitterId = 0) {

		global $xoopsUser;

		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return true;
			}
			$currentuid = $xoopsUser->uid();
		}
		if ($this->permGlobalSubmitAll()) {
			return true;
		}
        return $this->permGlobalSubmit() && $currentuid == $submitterId;
	}

	 /**
	 * get perms for current user to view album
	 *
	 * @param string $albId      string to transform
	 * @return int
	 */
	public function permAlbumView($albId) {
		
		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return true;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_view', $albId, $my_group_ids, $mid  ) ;
	}

    
    
	public function permAlbumDownload($albId) {

		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return 1;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_dlfullalb', $albId, $my_group_ids, $mid  );
	}
    
    public function permImageDownload($albId) {

		global $xoopsUser, $xoopsModule;
		
		$currentuid = 0;
		if ( isset($xoopsUser) && is_object($xoopsUser) ) {
			if ($xoopsUser->isAdmin()) {
				return 1;
			}
			$currentuid = $xoopsUser->uid();
		}
		$gperm_handler = xoops_getHandler('groupperm');
		$mid = $xoopsModule->mid();
		$member_handler = xoops_getHandler('member');
		if ($currentuid == 0) {
			$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
		} else {
			$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
		}
		return $gperm_handler->checkRight( 'wggallery_dlimage', $albId, $my_group_ids, $mid  );
	}
}
