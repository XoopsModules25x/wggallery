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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */
include_once XOOPS_ROOT_PATH . '/modules/wggallery/include/common.php';
// Function show block
function b_wggallery_images_show($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/wggallery/class/images.php';
    $myts = MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $block         = array();
    $typeBlock     = $options[0];
    $limit         = $options[1];
    $lenghtTitle   = $options[2];
    $wggallery     = WggalleryHelper::getInstance();
    $imagesHandler = $wggallery->getHandler('images');
    $criteria      = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    switch ($typeBlock) {
        // For the block: images last
        case 'last':
            $criteria->add(new Criteria('img_display', 1));
            $criteria->setSort('img_created');
            $criteria->setOrder('DESC');
            break;
        // For the block: images new
        case 'new':
            $criteria->add(new Criteria('img_display', 1));
            $criteria->add(new Criteria('img_created', strtotime(date(_SHORTDATESTRING)), '>='));
            $criteria->add(new Criteria('img_created', strtotime(date(_SHORTDATESTRING)) + 86400, '<='));
            $criteria->setSort('img_created');
            $criteria->setOrder('ASC');
            break;
        // For the block: images hits
        case 'hits':
            $criteria->setSort('img_hits');
            $criteria->setOrder('DESC');
            break;
        // For the block: images top
        case 'top':
            $criteria->setSort('img_top');
            $criteria->setOrder('ASC');
            break;
        // For the block: images random
        case 'random':
            $criteria->add(new Criteria('img_display', 1));
            $criteria->setSort('RAND()');
            break;
    }
    $criteria->setLimit($limit);
    $imagesAll = $imagesHandler->getAll($criteria);
    unset($criteria);
    foreach (array_keys($imagesAll) as $i) {
        $block[$i]['title']       = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_title'));
        $block[$i]['desc']        = strip_tags($imagesAll[$i]->getVar('img_desc'));
        $block[$i]['name']        = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_name'));
        $block[$i]['mimetype']    = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_mimetype'));
        $block[$i]['size']        = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_size'));
        $block[$i]['resx']        = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_resx'));
        $block[$i]['resy']        = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_resy'));
        $block[$i]['downloads']   = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_downloads'));
        $block[$i]['ratinglikes'] = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_ratinglikes'));
        $block[$i]['votes']       = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_votes'));
        $block[$i]['weight']      = $myts->htmlSpecialChars($imagesAll[$i]->getVar('img_weight'));
        $block[$i]['albid']       = $imagesAll[$i]->getVar('img_albid');
        $block[$i]['state']       = $imagesAll[$i]->getVar('img_state');
        $block[$i]['submitter']   = XoopsUser::getUnameFromId($imagesAll[$i]->getVar('img_submitter'));
    }
    return $block;
}

// Function edit block
function b_wggallery_images_edit($options)
{
    include_once XOOPS_ROOT_PATH . '/modules/wggallery/class/images.php';
    $wggallery     = WggalleryHelper::getInstance();
    $imagesHandler = $wggallery->getHandler('images');
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $form = _MB_WGGALLERY_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
    $form .= _MB_WGGALLERY_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('img_id', 0, '!='));
    $criteria->setSort('img_id');
    $criteria->setOrder('ASC');
    $imagesAll = $imagesHandler->getAll($criteria);
    unset($criteria);
    $form .= _MB_WGGALLERY_IMAGES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (in_array(0, $options) === false ? '' : "selected='selected'") . '>' . _MB_WGGALLERY_ALL_IMAGES . '</option>';
    foreach (array_keys($imagesAll) as $i) {
        $img_id = $imagesAll[$i]->getVar('img_id');
        $form   .= "<option value='" . $img_id . "' " . (in_array($img_id, $options) === false ? '' : "selected='selected'") . '>' . $imagesAll[$i]->getVar('img_name') . '</option>';
    }
    $form .= '</select>';
    return $form;
}
