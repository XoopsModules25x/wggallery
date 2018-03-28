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
function wggallery_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    $sql = "SELECT 'img_id', 'img_name' FROM " . $xoopsDB->prefix('wggallery_images') . ' WHERE img_id != 0';
    if ( $userid != 0 ) {
        $sql .= ' AND img_submitter='.(int) ($userid);
    }
    if ( is_array($queryarray) && $count = count($queryarray) )
    {
        $sql .= " AND ((i LIKE %$queryarray[0]%)";
        for($i = 1; $i < $count; ++$i)
        {
            $sql .= " $andor ";
            $sql .= "(i LIKE %$queryarray[0]%)";
        }
        $sql .= ')';
    }
    $sql .= " ORDER BY 'img_id' DESC";
    $result = $xoopsDB->query($sql,$limit,$offset);
    $ret = array();
    $i = 0;
    while($myrow = $xoopsDB->fetchArray($result))
    {
        $ret[$i]['image'] = 'assets/icons/32/blank.gif';
        $ret[$i]['link'] = 'images.php?img_id='.$myrow['img_id'];
        $ret[$i]['title'] = $myrow['img_name'];
        ++$i;
    }
    unset($i);
}