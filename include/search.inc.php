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
 * @version        $Id: 1.0 search.inc.php 1 Mon 2018-03-19 10:04:54Z XOOPS Project (www.xoops.org) $
 */

/**
 * search callback functions
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 */
 
use XoopsModules\Wggallery;

/**
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array
 */
function wggallery_search($queryarray, $andor, $limit, $offset, $userid)
{
    
    $ret    = [];
    $helper        = \XoopsModules\Wggallery\Helper::getInstance();
    $imagesHandler = $helper->getHandler('Images');
    $albumsHandler = $helper->getHandler('Albums');
    include_once 'common.php';

    // search in images table
    if(is_array($queryarray)) {
        $count = count($queryarray);
    }
    if (is_array($queryarray) && $count > 0) {
        $criteriaKeywords = new CriteriaCompo();
        $elementCount     = count($queryarray);
        for ($i = 0; $i < $elementCount; ++$i) {
            $criteriaKeyword = new CriteriaCompo();
            $criteriaKeyword->add(new Criteria('img_title', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $criteriaKeyword->add(new Criteria('img_desc', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $criteriaKeyword->add(new Criteria('img_name', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $criteriaKeywords->add($criteriaKeyword, $andor);
            unset($criteriaKeyword);
        }
    }
    if ($userid && is_array($userid)) {
        $userid       = array_map('intval', $userid);
        $criteriaUser = new CriteriaCompo();
        $criteriaUser->add(new Criteria('img_submitter', '(' . implode(',', $userid) . ')', 'IN'), 'OR');
    } elseif (is_numeric($userid) && $userid > 0) {
        $criteriaUser = new CriteriaCompo();
        $criteriaUser->add(new Criteria('img_submitter', $userid), 'OR');
    }
    
    $critSearch = new CriteriaCompo();
    if (!empty($criteriaUser)) {
        $critSearch->add($criteriaUser, 'AND');
    }
    if (!empty($criteriaKeywords)) {
        $critSearch->add($criteriaKeywords, 'AND');
    }
    $critSearch->setLimit($limit);
    $critSearch->setStart($offset);
    $critSearch->setSort('img_date');
    $critSearch->setOrder('DESC');
    $imagesAll = $imagesHandler->getAll($critSearch);
    foreach (array_keys($imagesAll) as $i) {
        $images[$i] = $imagesAll[$i]->getValuesImages();
        $ret[] = ['image' => 'assets/icons/16/images.png',
                  'link' => 'images.php?op=show&amp;img_id=' . $images[$i]['img_id'] . '&amp;alb_id=' . $images[$i]['img_albid'],
                  'title' => $images[$i]['img_title']
                 ];
    }
    unset($imagesAll);
    unset($critSearch);
    unset($criteriaKeywords);

    // search in albums table
    if (is_array($queryarray) && $count > 0) {
        $criteriaKeywords = new CriteriaCompo();
        $elementCount     = count($queryarray);
        for ($i = 0; $i < $elementCount; ++$i) {
            $criteriaKeyword = new CriteriaCompo();
            $criteriaKeyword->add(new Criteria('alb_name', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $criteriaKeyword->add(new Criteria('alb_desc', '%' . $queryarray[$i] . '%', 'LIKE'), 'OR');
            $criteriaKeywords->add($criteriaKeyword, $andor);
            unset($criteriaKeyword);
        }
    }
    if ($userid && is_array($userid)) {
        $userid       = array_map('intval', $userid);
        $criteriaUser = new CriteriaCompo();
        $criteriaUser->add(new Criteria('alb_submitter', '(' . implode(',', $userid) . ')', 'IN'), 'OR');
    } elseif (is_numeric($userid) && $userid > 0) {
        $criteriaUser = new CriteriaCompo();
        $criteriaUser->add(new Criteria('alb_submitter', $userid), 'OR');
    }
    
    $critSearch = new CriteriaCompo();
    if (!empty($criteriaUser)) {
        $critSearch->add($criteriaUser, 'AND');
    }
    if (!empty($criteriaKeywords)) {
        $critSearch->add($criteriaKeywords, 'AND');
    }
    $critSearch->setLimit($limit);
    $critSearch->setStart($offset);
    $critSearch->setSort('alb_date');
    $critSearch->setOrder('DESC');
    $albumsAll = $albumsHandler->getAll($critSearch);
    foreach (array_keys($albumsAll) as $i) {
        $ret[] = ['image' => 'assets/icons/16/albums.png',
                  'link' => 'albums.php?op=show&amp;alb_id=' . $albumsAll[$i]->getVar('alb_id'),
                  'title' => $albumsAll[$i]->getVar('alb_name')
                 ];
    }
    unset($albumsAll);
    
    return $ret;

}
