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
 * @param mixed $itemId
 * @param mixed $commentCount
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 comment_functions.php 1 Mon 2018-03-19 10:04:54Z XOOPS Project (www.xoops.org) $
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wggallery
 */

/**
 * CommentsUpdate
 *
 * @param  $itemId
 * @param  $commentCount
 * @return bool
 */
function wggalleryCommentsUpdate($itemId, $commentCount)
{
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    if (!$helper->getHandler('Images')->updateAll('comments', (int)$commentCount, new \Criteria('lid', (int)$itemId))) {
        return false;
    }

    return true;
}

/**
 * CommentsApprove
 *
 * @param string $comment
 */
function wggalleryCommentsApprove($comment)
{
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    // send notifications
    $imgId               = $comment->getVar('com_itemid');
    $imageObj            = $helper->getHandler('Images')->get($imgId);
    $albId               = $imageObj->getVar('img_albid');
    $tags                = [];
    $tags['IMAGE_NAME']  = $imageObj->getVar('img_name');
    $tags['IMAGE_URL']   = \XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/images.php?op=show&img_id=' . $imgId . '&amp;alb_id=' . $albId;
    $tags['ALBUM_URL']   = \XOOPS_URL . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/images.php?op=list&alb_id=' . $albId;
    $notificationHandler = \xoops_getHandler('notification');
    $notificationHandler->triggerEvent('global', 0, 'image_comment_all', $tags, [], $comment->getVar('com_modid'));
    $notificationHandler->triggerEvent('albums', $albId, 'image_comment_alb', $tags);
    $notificationHandler->triggerEvent('images', $imgId, 'image_comment', $tags);

}
