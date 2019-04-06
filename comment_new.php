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
 * Module: Tdmdownloads
 *
 * @category        Module
 * @package         tdmdownloads
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            https://xoops.org/
 * @since           1.0.0
 */

use Xmf\Request;

require dirname(dirname(__DIR__)) . '/mainfile.php';
$com_itemid = Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    /** @var \XoopsPersistableObjectHandler $imagesHandler */
    $imagesHandler = $helper->getHandler('Images');

    $itemObj        = $imagesHandler->get($com_itemid);
    $com_replytitle = $itemObj->getVar('img_title');
    require XOOPS_ROOT_PATH . '/include/comment_new.php';
}
