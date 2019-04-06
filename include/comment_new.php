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
 * @version        $Id: 1.0 comment_new.php 1 Mon 2018-03-19 10:04:54Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/../../../mainfile.php';
include_once XOOPS_ROOT_PATH.'/modules/wggallery/class/images.php';
$com_itemid = isset($_REQUEST['com_itemid']) ? (int) ($_REQUEST['com_itemid']) : 0;
if ($com_itemid > 0) {
    $imagesHandler = xoops_getModuleHandler('images', 'wggallery');
    $images = $imageshandler->get($com_itemid);
    $com_replytitle = $images->getVar('img_name');
    include XOOPS_ROOT_PATH.'/include/comment_new.php';
}