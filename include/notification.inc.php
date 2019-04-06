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
 * @param mixed $category
 * @param mixed $item_id
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 notifications.inc.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 */

/**
 * comment callback functions
 *
 * @param $category
 * @param $item_id
 * @return array item|null
 */
function wggallery_notify_iteminfo($category, $item_id)
{
    global $xoopsModule, $xoopsModuleConfig, $xoopsDB;

    if (empty($xoopsModule) || 'wggallery' !== $xoopsModule->getVar('dirname')) {
        $moduleHandler = xoops_getHandler('module');
        $module        = $moduleHandler->getByDirname('wggallery');
        $configHandler = xoops_getHandler('config');
        $config        = $configHandler->getConfigsByCat(0, $module->getVar('mid'));
    } else {
        $module = &$xoopsModule;
        $config = $xoopsModuleConfig;
    }

    switch ($category) {
        case 'global':
            // $item['name'] = '';
            // $item['url'] = '';
            // return $item;
            // Assume we have a valid album id
            $sql          = 'SELECT alb_name FROM ' . $xoopsDB->prefix('wggallery_albums') . ' WHERE alb_id = ' . $item_id;
            $result       = $xoopsDB->query($sql); // TODO: error check
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['alb_name'];
            $item['url']  = WGGALLERY_URL . '/albums.php?alb_id=' . $item_id;

            return $item;
            break;
        case 'albums':
            // Assume we have a valid album id
            $sql          = 'SELECT alb_name FROM ' . $xoopsDB->prefix('wggallery_albums') . ' WHERE alb_id = ' . $item_id;
            $result       = $xoopsDB->query($sql); // TODO: error check
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['alb_name'];
            $item['url']  = WGGALLERY_URL . '/albums.php?alb_id=' . $item_id;

            return $item;
            break;
        case 'image':
            // Assume we have a valid image id
            $sql          = 'SELECT img_name FROM ' . $xoopsDB->prefix('wggallery_images') . ' WHERE img_id = ' . $item_id;
            $result       = $xoopsDB->query($sql); // TODO: error check
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['img_name'];
            $item['url']  = WGGALLERY_URL . '/images.php?op=show&amp;img_id=' . $item_id . '&amp;alb_id=' . $result_array['img_albid'];

            return $item;
            break;
    }

    return null;
}
