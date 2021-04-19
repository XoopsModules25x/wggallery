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
 * @version        $Id: 1.0 permissions.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Handler Permissions
 */
class PermissionsHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        // parent::__construct($db, 'wggallery_permissions', Permissions::class, 'gt_id', 'gt_name');
    }

    /**
     * function to check global permissions
     *
     * @return int
     */
    public function permGlobalSubmit()
    {
        global $xoopsUser;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return Constants::PERM_SUBMITALL;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid              = \XoopsModules\Wggallery\Helper::getMid();
        $memberHandler    = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        if ($grouppermHandler->checkRight('wggallery_global', '4', $my_group_ids, $mid)) {
            return Constants::PERM_SUBMITALL;
        }
        if ($grouppermHandler->checkRight('wggallery_global', '8', $my_group_ids, $mid)) {
            return Constants::PERM_SUBMITOWN;
        }
        if ($grouppermHandler->checkRight('wggallery_global', '16', $my_group_ids, $mid)) {
            return Constants::PERM_SUBMITAPPR;
        }

        return Constants::PERM_SUBMITNONE;
    }

    /**
     * function to check permission to use album collections
     * @return bool
     */
    public function permGlobalUseCollections()
    {
        global $xoopsUser;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid              = \XoopsModules\Wggallery\Helper::getMid();
        $memberHandler    = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }
        if ($grouppermHandler->checkRight('wggallery_global', '2', $my_group_ids, $mid)) {
            return true;
        }

        return false;
    }

    /**
     * @param int $albId
     * @param int $albSubmitter
     * @return bool
     */
    public function permAlbumEdit($albId = 0, $albSubmitter = 0)
    {
        global $xoopsUser;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $right = $this->permGlobalSubmit();
        if (Constants::PERM_SUBMITNONE === $right) {
            return false;
        }
        if (Constants::PERM_SUBMITALL === $right) {
            return true;
        }
        if (0 === $albId && (Constants::PERM_SUBMITOWN === $right || Constants::PERM_SUBMITAPPR === $right)) {
            return true;
        }
        if ($albSubmitter == $currentuid) {
            return true;
        }

        return false;
    }

    /**
     * get perms for current user to view album
     *
     * @param string $albId string to transform
     * @return int
     */
    public function permAlbumView($albId)
    {
        global $xoopsUser, $xoopsModule;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return true;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid              = $xoopsModule->mid();
        $memberHandler    = \xoops_getHandler('member');
        if (0 === $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        return $grouppermHandler->checkRight('wggallery_view', $albId, $my_group_ids, $mid);
    }

    /**
     * @param $albId
     * @return int
     */
    public function permAlbumDownload($albId)
    {
        global $xoopsUser, $xoopsModule;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return 1;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler  = \xoops_getHandler('groupperm');
        $mid           = $xoopsModule->mid();
        $memberHandler = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        return $grouppermHandler->checkRight('wggallery_dlfullalb', $albId, $my_group_ids, $mid);
    }

    /**
     * @param $albId
     * @return int
     */
    public function permImageDownloadLarge($albId)
    {
        global $xoopsUser, $xoopsModule;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return 1;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid              = $xoopsModule->mid();
        $memberHandler    = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        return $grouppermHandler->checkRight('wggallery_dlimage_large', $albId, $my_group_ids, $mid);
    }

    /**
     * @param $albId
     * @return int
     */
    public function permImageDownloadMedium($albId)
    {
        global $xoopsUser, $xoopsModule;

        $currentuid = 0;
        if (isset($xoopsUser) && \is_object($xoopsUser)) {
            if ($xoopsUser->isAdmin()) {
                return 1;
            }
            $currentuid = $xoopsUser->uid();
        }
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid              = $xoopsModule->mid();
        $memberHandler    = \xoops_getHandler('member');
        if (0 == $currentuid) {
            $my_group_ids = [\XOOPS_GROUP_ANONYMOUS];
        } else {
            $my_group_ids = $memberHandler->getGroupsByUser($currentuid);
        }

        return $grouppermHandler->checkRight('wggallery_dlimage_medium', $albId, $my_group_ids, $mid);
    }
}
