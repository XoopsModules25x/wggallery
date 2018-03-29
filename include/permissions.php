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
 /**
 * get perms for current user for given album
 *
 * @param string $albId      string to transform
 * @return int
 */
function permGetUserAlbum($albId) {

    return 1;
}

function permEditAlbum($albId) {

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

function permCreateAlbum() {
    
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

 