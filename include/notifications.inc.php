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
 * @version        $Id: 1.0 notifications.inc.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
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
    //
    if (empty($xoopsModule) || $xoopsModule->getVar('dirname') != 'wggallery')
    {
        $moduleHandler = xoops_getHandler('module');
        $module = $moduleHandler->getByDirname('wggallery');
        $configHandler = xoops_getHandler('config');
        $config =& $configHandler->getConfigsByCat(0, $module->getVar('mid'));
    } else {
        $module =& $xoopsModule;
        $config =& $xoopsModuleConfig;
    }
    //
    switch($category) {
        case 'global':
            $item['name'] = '';
            $item['url'] = '';
            return $item;
        break;
        case 'category':
            // Assume we have a valid category id
            $sql = 'SELECT img_name FROM ' . $xoopsDB->prefix('wggallery_images') . ' WHERE img_id = '. $item_id;
            $result = $xoopsDB->query($sql); // TODO: error check
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['img_name'];
            $item['url'] = WGGALLERY_URL . '/images.php?img_id=' . $item_id;
            return $item;
        break;
        case 'image':
            // Assume we have a valid link id
            $sql = 'SELECT img_id, img_name FROM '.$xoopsDB->prefix('wggallery_images') . ' WHERE img_id = ' . $item_id;
            $result = $xoopsDB->query($sql); // TODO: error check
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['img_name'];
			$item['url'] = WGGALLERY_URL . '/single.php?cid=' . $result_array['cid'] . '&amp;img_id=' . $item_id;
			return $item;
        break;
    }
    return null;
}