<?php

declare(strict_types=1);
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
 * @package        wggallery
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 */

use Xmf\Request;
use XoopsModules\Wggallery\{
    Common,
    Helper,
    Images,
    ImagesHandler,
    Utility
};
use XoopsModules\Tag;

/** Get item fields: title, content, time, link, uid, tags
 *
 * @param array $items pass-by-ref
 * @return bool true - items found | false - nothing found/created
 */
function wggallery_tag_iteminfo(&$items)
{
    if (empty($items) || !is_array($items)) {
        return false;
    }

    $itemsIds = [];
    foreach (array_keys($items) as $cat_id) {
        // Some handling here to build the link upon cat_id
        // if cat_id is not used, just skip it
        foreach (array_keys($items[$cat_id]) as $itemId) {
            // In article, the item_id is "art_id"
            $itemsIds[] = (int)$itemId;
        }
    }
    $itemsIds = array_unique($itemsIds); // remove duplicate ids

    $helper = Helper::getInstance();
    $imagesHandler = $helper->getHandler('Images');
    $criteria      = new \Criteria('img_id', '(' . implode(', ', $itemsIds) . ')', 'IN');
    $imagesObj     = $imagesHandler->getObjects($criteria, 'img_id');

    //make sure Tag module tag_parse_tag() can be found
    if (method_exists(XoopsModules\Tag\Utility::class, 'tag_parse_tag')) {
        // this will be used for Tag >= v2.35
        $parse_function = 'XoopsModules\Tag\Utility::tag_parse_tag';
    } else {
        // allows this plugin to work with Tag <= v2.34
        require_once $GLOBALS['xoops']->path('modules/tag/include/functions.php');
        $parse_function = 'tag_parse_tag';
    }

    foreach (array_keys($items) as $cat_id) {
        foreach (array_keys($items[$cat_id]) as $itemId) {
            $imgObj                = $imagesObj[$itemId];
            $items[$cat_id][$itemId] = [
                'title'   => $imgObj->getVar('img_title'),
                'uid'     => $imgObj->getVar('img_submitter'),
                'link'    => 'images.php?op=show&redir=list&amp;img_id=' . $itemId . '&amp;alb_id=' . $imgObj->getVar('img_albid'),
                'time'    => $imgObj->getVar('img_date'),
                'tags'    => $parse_function($imgObj->getVar('img_tags', 'n')), // optional
                'content' => '',
            ];
        }
    }
    unset($items_obj);

    return true;
}

/** Remove orphan tag-item links *
 * @param int $mid
 * @return bool
 */
function wggallery_tag_synchronization($mid)
{
    // Optional
    $itemHandler = Helper::getInstance()->getHandler('Images');

    /** @var \XoopsModules\Tag\LinkHandler $linkHandler */
    $linkHandler = \XoopsModules\Tag\Helper::getInstance()->getHandler('Link');

    //$mid = Request::getInt('mid');

    /* clear tag-item links */
    $sql    = "    DELETE FROM {$linkHandler->table}"
              . '    WHERE '
              . "        tag_modid = {$mid}"
              . '        AND '
              . '        ( tag_itemid NOT IN '
              . "            ( SELECT DISTINCT {$itemHandler->keyName} "
              . "                FROM {$itemHandler->table} "
              . "                WHERE {$itemHandler->table}.img_state > 0 "
              . '            ) '
              . '        )';

    $result = $linkHandler->db->queryF($sql);

    return (bool)$result;
}
