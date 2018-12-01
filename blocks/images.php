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
include_once XOOPS_ROOT_PATH.'/modules/wggallery/include/common.php';
// Function show block
function b_wggallery_images_show($options)
{
    include_once XOOPS_ROOT_PATH.'/modules/wggallery/class/images.php';
    //$myts = MyTextSanitizer::getInstance();
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $block       = array();
    $typeBlock       = $options[0];
    $limit           = $options[1];
    $lenghtTitle     = $options[2];
    $numb_images     = $options[3];
    // $gallery         = $options[4];
    $container       = $options[4];
	$container_width = $options[5];
	array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    // array_shift($options);

    $wggallery = WggalleryHelper::getInstance();
	$albumtypesHandler = $wggallery->getHandler('albumtypes');
	$pr_album = $albumtypesHandler->getPrimaryAlbum();

	$template = $pr_album['template'];
	// assign all album options
	$atoptions = unserialize($pr_album['options'], ['allowed_classes' => false]);
	foreach ($atoptions as $atoption) {
		$GLOBALS['xoopsTpl']->assign($atoption['name'], $atoption['value']);
	}
	
    // $GLOBALS['xoopsTpl']->assign('album_showsubmitter', $wggallery->getConfig('album_showsubmitter'));
    $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
	$GLOBALS['xoopsTpl']->assign('template', $template);
    $GLOBALS['xoopsTpl']->assign('gallery', true);
    $GLOBALS['xoopsTpl']->assign('container', true);
    $GLOBALS['xoopsTpl']->assign('numb_images', $numb_images);
    $GLOBALS['xoopsTpl']->assign('container', $container);
	$GLOBALS['xoopsTpl']->assign('container_width', $container_width);
    $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
    
    $wggallery = WggalleryHelper::getInstance();
    $imagesHandler = $wggallery->getHandler('images');
    $criteria = new CriteriaCompo();
    $album_ids = implode(',', $options);
    // echo "options;".$album_ids;
    if ( '0' !== substr($album_ids, 0, 1)) {
        $criteria->add(new Criteria('img_albid', '(' . $album_ids . ')', 'IN'));
    }
    $criteria->add(new Criteria('img_state', WGGALLERY_STATE_ONLINE_VAL));
    
	switch($typeBlock)
	{
		// For the block: images last
		case 'last':
			$criteria->setSort('img_created');
			$criteria->setOrder('DESC');
		break;
		// For the block: images new
		case 'new':
			$criteria->add(new Criteria('img_created', strtotime(date(_SHORTDATESTRING)), '>='));
			$criteria->add(new Criteria('img_created', strtotime(date(_SHORTDATESTRING))+86400, '<='));
			$criteria->setSort('img_created');
			$criteria->setOrder('ASC');
		break;
		// For the block: images hits
		case 'hits':
            $criteria->setSort('img_hits');
            $criteria->setOrder('DESC');
        break;
		// For the block: images random
		case 'random':
			$criteria->setSort('RAND()');
		break;
	}
    $criteria->setLimit($limit);
    $imagesAll = $imagesHandler->getAll($criteria);
	unset($criteria);
    $counter = 0;
    foreach(array_keys($imagesAll) as $i)
    {
        $block[$i] = $imagesAll[$i]->getValuesImages();
        if ( 0 < $lenghtTitle && $lenghtTitle < strlen($block[$i]['name'])) {
            $block[$i]['name_limited'] = substr($block[$i]['name'], 0, $lenghtTitle) . '...';
        }
		//set indicator for line break
        $counter++;
        if (1 === $counter) {
            $block[$i]['newrow'] = true;
        }
        if ($numb_images == $counter) {
            $block[$i]['linebreak'] = true;
            $counter = 0;
        }
    }
    // add linebreak to last album item
    $block[$i]['linebreak'] = true;
	// var_dump($block);
    $GLOBALS['xoopsTpl']->assign('images_list', $block);
    return $block;
}

// Function edit block
function b_wggallery_images_edit($options)
{
    // include_once XOOPS_ROOT_PATH.'/modules/wggallery/class/images.php';
    $wggallery = WggalleryHelper::getInstance();
    $albumsHandler = $wggallery->getHandler('albums');
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $form  = _MB_WGGALLERY_IMAGES_DISPLAYLIST;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
    $form .= _MB_WGGALLERY_TITLE_LENGTH." : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br><br>";
    $form .= _MB_WGGALLERY_NUMB_ALBUMS.": <select name='options[3]' size='4'>";
    $form .= "<option value='1' " . (1 === intval($options[3]) ? "selected='selected'" : '') . '>1</option>';
    $form .= "<option value='2' " . (2 === intval($options[3]) ? "selected='selected'" : '') . '>2</option>';
    $form .= "<option value='3' " . (3 === intval($options[3]) ? "selected='selected'" : '') . '>3</option>';
    $form .= "<option value='4' " . (4 === intval($options[3]) ? "selected='selected'" : '') . '>4</option>';
    $form .= "<option value='6' " . (6 === intval($options[3]) ? "selected='selected'" : '') . '>6</option>';
    $form .= '</select><br>';
    // $form .= _MB_WGGALLERY_SHOW.": <select name='options[4]' size='2'>";
    // $form .= "<option value='0' " . (0 == $options[4] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_INDEX . '</option>';
    // $form .= "<option value='1' " . (1 == $options[4] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_GALLERY . '</option>';
    // $form .= '</select><br>';
    $form .= _MB_WGGALLERY_TYPE.": <select name='options[4]' size='2'>";
    $form .= "<option value='0' " . (0 === intval($options[4]) ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_TYPE_BLOCK . '</option>';
    $form .= "<option value='1' " . (1 === intval($options[4]) ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_TYPE_CONTAINER . '</option>';
    $form .= '</select>&nbsp;';
	$form .= _MB_WGGALLERY_TYPE_CONTAINER_WIDTH." : <input type='text' name='options[5]' size='5' maxlength='255' value='" . $options[5] . "' /><br>";
    // $form .= _MB_WGGALLERY_STYLE.": <select name='options[6]' size='3'>";
    // $form .= "<option value='0' " . (0 == $options[6] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_STYLE_DEFAULT . '</option>';
    // $form .= "<option value='1' " . (1 == $options[6] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_STYLE_SLIDER . '</option>';
    // $form .= '</select><br>';
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    // var_dump($options);
    $criteria = new CriteriaCompo();
    $criteria->add(new Criteria('alb_id', 0, '!='));
    $criteria->setSort('alb_id');
    $criteria->setOrder('ASC');
    $albumsAll = $albumsHandler->getAll($criteria);
    unset($criteria);
    $form .= _MB_WGGALLERY_ALBUMS_TO_DISPLAY."<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (in_array(0, $options) === false ? '' : "selected='selected'") . '>' . _MB_WGGALLERY_ALL_ALBUMS . '</option>';
    foreach (array_keys($albumsAll) as $i) {
        $alb_id = $albumsAll[$i]->getVar('alb_id');
        $form .= "<option value='" . $alb_id . "' " . (in_array($alb_id, $options) === false || in_array(0, $options) === true ? '' : "selected='selected'") . '>' . $albumsAll[$i]->getVar('alb_name') . '</option>';
    }
    $form .= '</select>';
    return $form;
}