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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */
include_once XOOPS_ROOT_PATH . '/modules/wggallery/include/common.php';
// Function show block
function b_wggallery_albums_show($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/wggallery/class/albums.php';
    $myts = MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $block         = array();
    $typeBlock     = $options[0];
    $limit         = $options[1];
    $lenghtTitle   = $options[2];
    $wggallery     = WggalleryHelper::getInstance();
    $albumsHandler = $wggallery->getHandler('albums');
    $criteria      = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    switch ($typeBlock) {
        // For the block: albums last
        case 'last':
            $criteria->add(new Criteria('alb_display', 1));
            $criteria->setSort('alb_created');
            $criteria->setOrder('DESC');
            break;
        // For the block: albums new
        case 'new':
            $criteria->add(new Criteria('alb_display', 1));
            $criteria->add(new Criteria('alb_created', strtotime(date(_SHORTDATESTRING)), '>='));
            $criteria->add(new Criteria('alb_created', strtotime(date(_SHORTDATESTRING)) + 86400, '<='));
            $criteria->setSort('alb_created');
            $criteria->setOrder('ASC');
            break;
        // For the block: albums hits
        case 'hits':
            $criteria->setSort('alb_hits');
            $criteria->setOrder('DESC');
            break;
        // For the block: albums top
        case 'top':
            $criteria->setSort('alb_top');
            $criteria->setOrder('ASC');
            break;
        // For the block: albums random
        case 'random':
            $criteria->add(new Criteria('alb_display', 1));
            $criteria->setSort('RAND()');
            break;
    }
    $criteria->setLimit($limit);
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    foreach (array_keys($albumsAll) as $i) {
        $block[$i]['pid']       = $albumsAll[$i]->getVar('alb_pid');
        $block[$i]['name']      = $myts->htmlSpecialChars($albumsAll[$i]->getVar('alb_name'));
        $block[$i]['weight']    = $myts->htmlSpecialChars($albumsAll[$i]->getVar('alb_weight'));
        $block[$i]['image']     = $albumsAll[$i]->getVar('alb_image');
        $block[$i]['imgid']     = $albumsAll[$i]->getVar('alb_imgid');
        $block[$i]['state']     = $albumsAll[$i]->getVar('alb_state');
        $block[$i]['date']      = formatTimeStamp($albumsAll[$i]->getVar('alb_date'));
        $block[$i]['submitter'] = XoopsUser::getUnameFromId($albumsAll[$i]->getVar('alb_submitter'));
    }
    return $block;
}

// Function edit block
function b_wggallery_albums_edit($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/wggallery/class/albums.php';
    $wggallery     = WggalleryHelper::getInstance();
    $albumsHandler = $wggallery->getHandler('albums');
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $form = _MB_WGGALLERY_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
    $form .= _MB_WGGALLERY_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('alb_id', 0, '!='));
    $criteria->setSort('alb_id');
    $criteria->setOrder('ASC');
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    $form .= _MB_WGGALLERY_ALBUMS_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (in_array(0, $options) === false ? '' : "selected='selected'") . '>' . _MB_WGGALLERY_ALL_ALBUMS . '</option>';
    foreach (array_keys($albumsAll) as $i) {
        $alb_id = $albumsAll[$i]->getVar('alb_id');
        $form   .= "<option value='" . $alb_id . "' " . (in_array($alb_id, $options) === false ? '' : "selected='selected'") . '>' . $albumsAll[$i]->getVar('alb_name') . '</option>';
    }
    $form .= '</select>';
    return $form;
}
