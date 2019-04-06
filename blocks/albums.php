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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:50Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require_once XOOPS_ROOT_PATH . '/modules/wggallery/include/common.php';
// Function show block
/**
 * @param $options
 * @return array
 */
function b_wggallery_albums_show($options)
{
    $block        = [];
    $typeBlock    = $options[0];
    $bnbAlbums    = $options[1];
    $bshowTitle   = $options[2];
    $blenghtTitle = $options[3];
    $bshowDesc    = $options[4];
    $blenghtDesc  = $options[5];
    $bnbAlbumsRow = $options[6];
    $bgallery     = $options[7];
    $bAlbumType   = $options[8];

    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper = \XoopsModules\Wggallery\Helper::getInstance();

    // assign block options
    $GLOBALS['xoopsTpl']->assign('ba_showTitle', $bshowTitle);
    $GLOBALS['xoopsTpl']->assign('ba_showDesc', $bshowDesc);
    $GLOBALS['xoopsTpl']->assign('bnbAlbumsRow', $bnbAlbumsRow);

    $albumtypesHandler   = $helper->getHandler('Albumtypes');
    $gallerytypesHandler = $helper->getHandler('Gallerytypes');
    if (0 === (int)$bAlbumType) {
        $useAlbumType = $albumtypesHandler->getPrimaryAlbum();
    } else {
        $useAlbumType = $albumtypesHandler->getAlbumtypeOptions($bAlbumType);
    }

    $template = $useAlbumType['template'];
    // assign all album options
    $atoptions = unserialize($useAlbumType['options'], ['allowed_classes' => false]);
    foreach ($atoptions as $atoption) {
        $GLOBALS['xoopsTpl']->assign($atoption['name'], $atoption['value']);
    }

    $GLOBALS['xoopsTpl']->assign('ba_template', $template);
    // assign gallery options
    $GLOBALS['xoopsTpl']->assign('ba_gallery_target', $helper->getConfig('gallery_target'));
    $pr_gallery = $gallerytypesHandler->getPrimaryGallery();
    $GLOBALS['xoopsTpl']->assign('ba_gallery', 'none' !== $pr_gallery['template'] && 1 === (int)$bgallery);

    $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
    $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

    $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/blocks/blocks.css', null);
    switch ($template) {
        case 'hovereffectideas':
            $GLOBALS['xoopsTpl']->assign('number_cols_album', $bnbAlbumsRow);
            $GLOBALS['xoopsTpl']->assign('inblock', '_block');
            $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/albumtypes/hovereffectideas/style.css', null);
            $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/albumtypes/hovereffectideas/fonts/font-awesome-4.2.0/css/font-awesome.min.css', null);
            break;
        case 'simple':
            $GLOBALS['xoopsTpl']->assign('number_cols_album', $bnbAlbumsRow);
            $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/albumtypes/simple/style.css', null);
            break;
        case 'bcards':
            $GLOBALS['xoopsTpl']->assign('number_cols_album', $bnbAlbumsRow);
            $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/albumtypes/bcards/style.css', null);
            break;
        case 'default':
        default:
            $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/albumtypes/default/albums_default.css', null);
            break;
    }

    //    $helper        = Wggallery\Helper::getInstance();
    $albumsHandler = $helper->getHandler('Albums');
    $criteria      = new \CriteriaCompo();
    $album_ids     = implode(',', $options);
    if ('0' !== mb_substr($album_ids, 0, 1)) {
        $criteria->add(new \Criteria('alb_id', '(' . $album_ids . ')', 'IN'));
    }
    $criteria->add(new \Criteria('alb_state', Constants::STATE_ONLINE_VAL));
    switch ($typeBlock) {
        // For the block: albums recent
        case 'recent':
            $criteria->add(new \Criteria('alb_date', strtotime(date(_SHORTDATESTRING)), '>='));
            $criteria->add(new \Criteria('alb_date', strtotime(date(_SHORTDATESTRING)) + 86400, '<='));
            $criteria->setSort('alb_date');
            $criteria->setOrder('DESC');
            break;
        /*
        // For the block: albums hits
        case 'hits':
            $criteria->setSort('alb_hits');
            $criteria->setOrder('DESC');
        break;
        */ // For the block: albums random
        case 'random':
            $criteria->setSort('RAND()');
            break;
        case 'default':
        default:
            $criteria->setSort('alb_date');
            $criteria->setOrder('DESC');
            break;
    }
    $albumsCount = $albumsHandler->getCount($criteria);

    $criteria->setLimit($bnbAlbums);
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    $GLOBALS['xoopsTpl']->assign('albums_count', count($albumsAll));
    if (count($albumsAll) < $albumsCount) {
        $GLOBALS['xoopsTpl']->assign('show_more_albums', true);
    }

    $counter = 0;
    foreach (array_keys($albumsAll) as $i) {
        $block[$i] = $albumsAll[$i]->getValuesAlbums();
        if ($bshowTitle > 0 && $blenghtTitle > 0 && $blenghtTitle < mb_strlen($block[$i]['name'])) {
            $block[$i]['name_limited'] = mb_substr($block[$i]['name'], 0, $blenghtTitle) . '...';
        }
        if ($bshowDesc > 0 && $blenghtDesc > 0 && $blenghtDesc < mb_strlen($block[$i]['desc'])) {
            $block[$i]['desc_limited'] = mb_substr($block[$i]['desc'], 0, $blenghtDesc) . '...';
        }
        //set indicator for line break
        $counter++;
        if (1 === $counter) {
            $block[$i]['newrow'] = true;
        }
        if ($bnbAlbumsRow === $counter) {
            $block[$i]['linebreak'] = true;
            $counter                = 0;
        }
    }
    // add linebreak to last album item
    $block[$i]['linebreak'] = true;

    $GLOBALS['xoopsTpl']->assign('balbums_list', $block);

    return $block;
}

// Function edit block
/**
 * @param $options
 * @return string
 */
function b_wggallery_albums_edit($options)
{
    $helper        = Wggallery\Helper::getInstance();
    $albumsHandler = $helper->getHandler('Albums');
    $criteria      = new \CriteriaCompo();
    // $criteria->add(new \Criteria('alb_id', 0, '!='));
    $criteria->setSort('alb_id');
    $criteria->setOrder('ASC');
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    $albumtypesHandler = $helper->getHandler('Albumtypes');
    $albumtypesAll     = $albumtypesHandler->getAll();
    unset($criteria);

    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);

    $form = _MB_WGGALLERY_BLOCKTYPE . ": <select name='options[0]' size='3'>";
    $form .= "<option value='default' " . ('default' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_DEFAULT . '</option>';
    $form .= "<option value='recent' " . ('recent' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_RECENT . '</option>';
    $form .= "<option value='random' " . ('random' === $options[0] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_BLOCKTYPE_RANDOM . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_ALBUMS_DISPLAYLIST;
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "'>&nbsp;<br>";
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
    $form .= _MB_WGGALLERY_NUMB_ALBUMS . ": <select name='options[6]' size='5'>";
    $form .= "<option value='1' " . (1 === (int)$options[6] ? "selected='selected'" : '') . '>1</option>';
    $form .= "<option value='2' " . (2 === (int)$options[6] ? "selected='selected'" : '') . '>2</option>';
    $form .= "<option value='3' " . (3 === (int)$options[6] ? "selected='selected'" : '') . '>3</option>';
    $form .= "<option value='4' " . (4 === (int)$options[6] ? "selected='selected'" : '') . '>4</option>';
    $form .= "<option value='6' " . (6 === (int)$options[6] ? "selected='selected'" : '') . '>6</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_SHOW . ": <select name='options[7]' size='2'>";
    $form .= "<option value='0' " . (0 === (int)$options[7] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_INDEX . '</option>';
    $form .= "<option value='1' " . (1 === (int)$options[7] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_GALLERY . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_ALBUMTYPES . ": <select name='options[8]' size='2'>";
    $form .= "<option value='0' " . (0 === (int)$options[8] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_ALBUMTYPES_PRIMARY . '</option>';
    foreach (array_keys($albumtypesAll) as $i) {
        $at_id = $albumtypesAll[$i]->getVar('at_id');
        $form  .= "<option value='" . $at_id . "' " . ($at_id == $options[8] ? "selected='selected'" : '') . '>' . str_replace('%s', $albumtypesAll[$i]->getVar('at_name'), _MB_WGGALLERY_ALBUMTYPES_OTHER) . '</option>';
    }
    $form .= '</select><br>';
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    $form .= _MB_WGGALLERY_ALBUMS_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (in_array(0, $options, false) ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_ALL_ALBUMS . '</option>';
    foreach (array_keys($albumsAll) as $i) {
        $alb_id = $albumsAll[$i]->getVar('alb_id');
        $form   .= "<option value='" . $alb_id . "' " . (in_array($alb_id, $options, false) && false === in_array(0, $options, false) ? "selected='selected'" : '') . '>' . $albumsAll[$i]->getVar('alb_name') . '</option>';
    }

    $form .= '</select>';

    return $form;
}
