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
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;
use XoopsModules\Wggallery\Helper;

require_once XOOPS_ROOT_PATH . '/modules/wggallery/include/common.php';
// Function show block
/**
 * @param $options
 * @return array
 */
function b_wggallery_images_show($options)
{
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper = \XoopsModules\Wggallery\Helper::getInstance();

    //$myts = \MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $block        = [];
    $typeBlock    = $options[0];
    $bnbImages    = $options[1];
    $bshowTitle   = $options[2];
    $blenghtTitle = $options[3];
    $bshowDesc    = $options[4];
    $blenghtDesc  = $options[5];
    $nbImagesRow  = $options[6];

    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    $albumsHandler = $helper->getHandler('Albums');

    $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
    $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
    $GLOBALS['xoopsTpl']->assign('bi_nbImagesRow', $nbImagesRow);
    $GLOBALS['xoopsTpl']->assign('bi_showTitle', $bshowTitle);
    $GLOBALS['xoopsTpl']->assign('bi_showDesc', $bshowDesc);

    $imagesHandler = $helper->getHandler('Images');
    $criteria      = new \CriteriaCompo();
    $album_ids     = implode(',', $options);
    // echo "options;".$album_ids;
    if (0 !== mb_strpos($album_ids, '0')) {
        $criteria->add(new \Criteria('img_albid', '(' . $album_ids . ')', 'IN'));
    }
    $criteria->add(new \Criteria('img_state', Constants::STATE_ONLINE_VAL));

    switch ($typeBlock) {
        // For the block: images new
        case 'recent':
            $criteria->add(new Criteria('img_date', strtotime(date(_SHORTDATESTRING)), '>='));
            $criteria->add(new Criteria('img_date', strtotime(date(_SHORTDATESTRING)) + 86400, '<='));
            $criteria->setSort('img_date');
            $criteria->setOrder('DESC');
            break;
        // For the block: images hits
        // case 'hits':
        // $criteria->setSort('img_hits');
        // $criteria->setOrder('DESC');
        // break;
        // For the block: images random
        case 'random':
            $criteria->setSort('RAND()');
            break;
        case 'default':
        default:
            $criteria->setSort('img_date');
            $criteria->setOrder('DESC');
            break;
    }
    $criteria->setLimit($bnbImages);
    $imagesAll = $imagesHandler->getAll($criteria);
    unset($criteria);
    $counter = 0;
    foreach (array_keys($imagesAll) as $i) {
        $block[$i] = $imagesAll[$i]->getValuesImages();
        if ($bshowTitle > 0 && $blenghtTitle > 0 && $blenghtTitle < mb_strlen($block[$i]['title'])) {
            $block[$i]['title_limited'] = mb_substr($block[$i]['title'], 0, $blenghtTitle) . '...';
        }
        if ($bshowDesc > 0 && $blenghtDesc > 0 && $blenghtDesc < mb_strlen($block[$i]['desc'])) {
            $block[$i]['desc_limited'] = mb_substr($block[$i]['desc'], 0, $blenghtDesc) . '...';
        }
        $albumsObj           = $albumsHandler->get($block[$i]['albid']);
        $block[$i]['albpid'] = $albumsObj->getVar('alb_pid');
    }
    // var_dump($block);
    $GLOBALS['xoopsTpl']->assign('images_list', $block);

    return $block;
}

// Function edit block
/**
 * @param $options
 * @return string
 */
function b_wggallery_images_edit($options)
{
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper        = \XoopsModules\Wggallery\Helper::getInstance();
    $albumsHandler = $helper->getHandler('Albums');
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);

    $form = _MB_WGGALLERY_BLOCKTYPE . ": <select name='options[0]' size='3'>";
    $form .= "<option value='default' " . ('default' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_DEFAULT . '</option>';
    $form .= "<option value='recent' " . ('recent' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_RECENT . '</option>';
    $form .= "<option value='random' " . ('random' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_RANDOM . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_IMAGES_DISPLAYLIST . "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "'>&nbsp;<br>";
    $form .= _MB_WGGALLERY_TITLE_SHOW . ": <select name='options[2]' size='2'>";
    $form .= "<option value='0' " . (0 === (int)$options[2] ? "selected='selected'" : '') . '>' . _NO . '</option>';
    $form .= "<option value='1' " . (1 === (int)$options[2] ? "selected='selected'" : '') . '>' . _YES . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_TITLE_LENGTH . " : <input type='text' name='options[3]' size='5' maxlength='255' value='" . $options[3] . "'><br>";
    $form .= _MB_WGGALLERY_DESC_SHOW . ": <select name='options[4]' size='2'>";
    $form .= "<option value='0' " . (0 === (int)$options[4] ? "selected='selected'" : '') . '>' . _NO . '</option>';
    $form .= "<option value='1' " . (1 === (int)$options[4] ? "selected='selected'" : '') . '>' . _YES . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_DESC_LENGTH . " : <input type='text' name='options[5]' size='5' maxlength='255' value='" . $options[5] . "'><br>";
    $form .= _MB_WGGALLERY_NUMB_IMAGES . ": <select name='options[6]' size='5'>";
    $form .= "<option value='1' " . (1 === (int)$options[6] ? "selected='selected'" : '') . '>1</option>';
    $form .= "<option value='2' " . (2 === (int)$options[6] ? "selected='selected'" : '') . '>2</option>';
    $form .= "<option value='3' " . (3 === (int)$options[6] ? "selected='selected'" : '') . '>3</option>';
    $form .= "<option value='4' " . (4 === (int)$options[6] ? "selected='selected'" : '') . '>4</option>';
    $form .= "<option value='6' " . (6 === (int)$options[6] ? "selected='selected'" : '') . '>6</option>';
    $form .= '</select><br>';

    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('alb_id', 0, '!='));
    $criteria->setSort('alb_id');
    $criteria->setOrder('ASC');
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    $form .= _MB_WGGALLERY_ALBUMS_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (in_array(0, $options, false) ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_ALL_ALBUMS . '</option>';
    foreach (array_keys($albumsAll) as $i) {
        $alb_id = $albumsAll[$i]->getVar('alb_id');
        $form   .= "<option value='" . $alb_id . "' " . (in_array($alb_id, $options, false) && false === in_array(0, $options, false) ? "selected='selected'" : '') . '>' . $albumsAll[$i]->getVar('alb_name') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
