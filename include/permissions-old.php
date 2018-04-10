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
 * @version        $Id: 1.0 permissions.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */

 /***************Permissions***************/

function permGlobalApprove($albId) {
    
    global $xoopsUser;
    
    if ( isset($xoopsUser) && is_object($xoopsUser) ) {
        if ($xoopsUser->isAdmin()) {
            return true;
        } else {
            // must be adopted to perm per user
            $uid = $xoopsUser->id;
            return true;
        }
    }   
    return false;
}


function permGlobalSubmit() {

    global $xoopsUser;
    
    if ( isset($xoopsUser) && is_object($xoopsUser) ) {
        if ($xoopsUser->isAdmin()) {
            return true;
        } else {
            // must be adopted to perm per user
            $uid = $xoopsUser->id;
            return true;
        }
    }   
    return false;
}

function permAlbumEdit($albId) {

    global $xoopsUser;
    
    if ( isset($xoopsUser) && is_object($xoopsUser) ) {
        if ($xoopsUser->isAdmin()) {
            return true;
        } else {
            // must be adopted to perm per user
            $uid = $xoopsUser->id;
            return true;
        }
    }   
    return false; 
}

 /**
 * get perms for current user to view album
 *
 * @param string $albId      string to transform
 * @return int
 */
function permAlbumView($albId) {
    
    global $xoopsUser;
    
    if ( isset($xoopsUser) && is_object($xoopsUser) ) {
        if ($xoopsUser->isAdmin()) {
            return true;
        } else {
			$gperm_handler = xoops_getHandler('groupperm');
			$mid = $xoopsModule->mid();
			$member_handler = xoops_getHandler('member');
			$currentuid = (is_object($xoopsUser) && isset($xoopsUser)) ? $xoopsUser->uid(): 0;
			if ($currentuid == 0) {
				$my_group_ids = array(XOOPS_GROUP_ANONYMOUS);
			} else {
				$my_group_ids = $member_handler->getGroupsByUser( $currentuid ) ;
			}
			return $gperm_handler->checkRight( 'wggallery_view', $albId, $my_group_ids, $mid  ) ;
        }
    }   
    return false;
}

function permAlbumDownload($albId) {
    
    global $xoopsUser, $xoopsModule;
    
    if ( isset($xoopsUser) && is_object($xoopsUser) ) {
        if ($xoopsUser->isAdmin()) {
            return 1; 
        } else {
            // must be adopted to perm per user
            $uid = $xoopsUser->id;
            return 1;
        }
    }
	
		  
	
    return false;
}
 