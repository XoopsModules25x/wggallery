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
 * @license        GPL 3.0 or later
 * @package        wggallery
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         TDM XOOPS - Email:<info@email.com> - Website:<http://xoops.org>
 * @version        $Id: 1.0 rate.php 13070 Wed 2016-12-14 22:22:38Z XOOPS Development Team $
 */

use Xmf\Request;
use XoopsModules\Wggallery\Constants;

include __DIR__ . '/header.php';
$op     = Request::getString('op', 'default');

switch ($op) {
    case 'save-imglist':
    case 'save-imgshow':
        // Security Check
        if ($GLOBALS['xoopsSecurity']->check()) {
            redirect_header('index.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }

        $itemid = Request::getInt('img_id', 0);
        $rating = Request::getInt('rating', 0);
        $source = Request::getInt('source', 0); //source 2 = album rating TODO

        // Checking permissions
        $rate_allowed = false;
        $groups = (isset($GLOBALS['xoopsUser']) && is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
        foreach ($groups as $group) {
            if (XOOPS_GROUP_ADMIN == $group || in_array($group, $helper->getConfig('ratingbar_groups'))) {
                $rate_allowed = true;
                break;
            }
        }

        if (!$rate_allowed) {
            redirect_header(WGGALLERY_URL . '/index.php?img_id=' . $itemid . '#item' . $itemid, 2, _MA_WGGALLERY_RATING_NOPERM);
        }

        $redir = $_SERVER['HTTP_REFERER'];
        if ($op === 'save-imglist') {
            $redir = $_SERVER['HTTP_REFERER'] . '#imglist_' . $itemid;
        }

        if (Constants::RATING_5STARS === (int)$helper->getConfig('ratingbars')) {
            if ($rating > 5 || $rating < 1) {
                redirect_header($redir, 2, _MA_WGGALLERY_RATING_VOTE_BAD);
                exit();
            }
        } else if (Constants::RATING_10STARS === (int)$helper->getConfig('ratingbars')) {
            if ($rating > 10 || $rating < 1) {
                redirect_header($redir, 2, _MA_WGGALLERY_RATING_VOTE_BAD);
                exit();
            }
        } else {
            if ($rating > 1 || $rating < -1) {
                redirect_header($redir, 2, _MA_WGGALLERY_RATING_VOTE_BAD);
                exit();
            }
        }

        $itemrating = $ratingsHandler->getItemRating($itemid, 1);

        if ($itemrating['voted']) {
            // redirect_header($redir, 2, _MA_WGGALLERY_RATING_VOTE_ALREADY);
            $ratingsObj = $ratingsHandler->get($itemrating['id']);
        } else {
            $ratingsObj = $ratingsHandler->create();
        }
        $ratingsObj->setVar('rate_source', $source);
        $ratingsObj->setVar('rate_itemid', $itemid);
        $ratingsObj->setVar('rate_value', $rating);
        $ratingsObj->setVar('rate_uid', $itemrating['uid']);
        $ratingsObj->setVar('rate_ip', $itemrating['ip']);
        $ratingsObj->setVar('rate_date', time());
        // Insert Data
        if ($ratingsHandler->insert($ratingsObj)) {
            // update table wggallery_images
            $nb_ratings     = 0;
            $avg_rate_value = 0;
            $ratingObjs     = $helper->getHandler('ratings')->getObjects();
            $count          = count($ratingObjs);
            $current_rating = 0;
            foreach ($ratingObjs as $ratingObj) {
                $current_rating += $ratingObj->getVar('rate_value');
            }
            unset($ratingObj);
            if ($count > 0) {
                $avg_rate_value = number_format($current_rating / $count, 2);
            }
            
            $imagesObj = $imagesHandler->get($itemid);
            // Set Vars
            $imagesObj->setVar('img_ratinglikes', $avg_rate_value);
            $imagesObj->setVar('img_votes', $count);
            // Insert Data
            $imagesHandler->insert($imagesObj);
            unset($imagesObj);
            redirect_header($redir, 2, _MA_WGGALLERY_RATING_VOTE_THANKS);
        }
        echo '<br>error:' . $ratingsObj->getHtmlErrors();

        break;

    case 'default':
    default:
        echo _MA_WGGALLERY_RATING_VOTE_BAD . ' (invalid parameter)';
        break;
}
