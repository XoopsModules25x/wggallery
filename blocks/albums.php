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
include_once XOOPS_ROOT_PATH.'/modules/wggallery/include/common.php';
// Function show block
function b_wggallery_albums_show($options)
{
    include_once XOOPS_ROOT_PATH.'/modules/wggallery/class/albums.php';
    $myts = MyTextSanitizer::getInstance();
    $block           = array();
    $typeBlock       = $options[0];
    $limit           = $options[1];
    $lenghtTitle     = $options[2];
    $numb_albums     = $options[3];
    $gallery         = $options[4];
    $container       = $options[5];
	$container_width = $options[6];
	array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);
    array_shift($options);

    $wggallery = WggalleryHelper::getInstance();
	$albumtypesHandler = $wggallery->getHandler('albumtypes');
	$pr_album = $albumtypesHandler->getPrimaryAlbum();

	$template = $pr_album['template'];
	// assign all album options
	$atoptions = unserialize($pr_album['options']);
	foreach ($atoptions as $atoption) {
		$GLOBALS['xoopsTpl']->assign($atoption['name'], $atoption['value']);
	}
	
    // $GLOBALS['xoopsTpl']->assign('album_showsubmitter', $wggallery->getConfig('album_showsubmitter'));
    $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');
	$GLOBALS['xoopsTpl']->assign('template', $template);
    $GLOBALS['xoopsTpl']->assign('gallery', true);
    $GLOBALS['xoopsTpl']->assign('container', true);
    $GLOBALS['xoopsTpl']->assign('numb_albums', $numb_albums);
    $GLOBALS['xoopsTpl']->assign('container', $container);
	$GLOBALS['xoopsTpl']->assign('container_width', $container_width);
    $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
    switch ($template) { 
        case 'hovereffectideas':
			$GLOBALS['xoopsTpl']->assign('number_cols_album', $numb_albums);
			$GLOBALS['xoopsTpl']->assign('inblock', '_block');
			$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/albumtypes/hovereffectideas/style.css', null );
			$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/albumtypes/hovereffectideas/font-awesome-4.2.0/css/font-awesome.min.css', null );
        break;
		case 'simple':
			$GLOBALS['xoopsTpl']->assign('number_cols_album', $numb_albums);
			$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/albumtypes/simple/style.css' , null );
		break;
        case 'bcards':
			$GLOBALS['xoopsTpl']->assign('number_cols_album', $numb_albums);
			$GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/albumtypes/bcards/style.css' , null );
		break;
        case 'default':
        default:
            $GLOBALS['xoTheme']->addStylesheet( WGGALLERY_URL . '/assets/albumtypes/default/albums_default.css', null );
            
        break;
    }

    
    $wggallery = WggalleryHelper::getInstance();
    $albumsHandler = $wggallery->getHandler('albums');
    $criteria = new CriteriaCompo();
    $album_ids = implode(",", $options);
    if ( '0' !== substr($album_ids, 0, 1)) {
        $criteria->add(new Criteria('alb_id', '(' . $album_ids . ')', 'IN'));
    }
    $criteria->add(new Criteria('alb_state', WGGALLERY_STATE_ONLINE_VAL));
	switch($typeBlock)
	{
		// For the block: albums last
		case 'last':
			$criteria->setSort('alb_date');
			$criteria->setOrder('DESC');
		break;
		// For the block: albums new
		case 'new':
			$criteria->add(new Criteria('alb_date', strtotime(date(_SHORTDATESTRING)), '>='));
			$criteria->add(new Criteria('alb_date', strtotime(date(_SHORTDATESTRING))+86400, '<='));
			$criteria->setSort('alb_date');
			$criteria->setOrder('ASC');
		break;
        /*
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
        */
		// For the block: albums random
		case 'random':
			$criteria->setSort('RAND()');
		break;
        case 'default':
        default:
			$criteria->setSort('alb_weight ASC, alb_date');
			$criteria->setOrder('DESC');
		break;
	}
    $albumsCount = $albumsHandler->getCount($criteria);
    
    $criteria->setLimit($limit);
    $albumsAll = $albumsHandler->getAll($criteria);
	unset($criteria);
    $GLOBALS['xoopsTpl']->assign('albums_count', count($albumsAll));
    if ( count($albumsAll) < $albumsCount ) {
        $GLOBALS['xoopsTpl']->assign('show_more_albums', true);
    }
    $GLOBALS['xoopsTpl']->assign('show_more_albums', true);
	
	$counter = 0;
    foreach(array_keys($albumsAll) as $i)
    {
        $block[$i] = $albumsAll[$i]->getValuesAlbums();
        if ( 0 < $lenghtTitle && $lenghtTitle < strlen($block[$i]['name'])) {
            $block[$i]['name_limited'] = substr($block[$i]['name'], 0, $lenghtTitle) . '...';
        }
		//set indicator for line break
        $counter++;
        if (1 === $counter) {
            $block[$i]['newrow'] = true;
        }
        if ($numb_albums == $counter) {
            $block[$i]['linebreak'] = true;
            $counter = 0;
        }
    }
	// add linebreak to last album item
    $block[$i]['linebreak'] = true;
	// var_dump($block);
    $GLOBALS['xoopsTpl']->assign('albums_list', $block);
    return $block;
}

// Function edit block
function b_wggallery_albums_edit($options)
{
    include_once XOOPS_ROOT_PATH.'/modules/wggallery/class/albums.php';
    $wggallery = WggalleryHelper::getInstance();
    $albumsHandler = $wggallery->getHandler('albums');
    $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
    $form  = "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= _MB_WGGALLERY_ALBUMS_DISPLAYLIST;
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' />&nbsp;<br>";
    $form .= _MB_WGGALLERY_TITLE_LENGTH." : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' /><br>";
    $form .= _MB_WGGALLERY_NUMB_ALBUMS.": <select name='options[3]' size='4'>";
    $form .= "<option value='1' " . (1 == $options[3] ? "selected='selected'" : '') . '>1</option>';
    $form .= "<option value='2' " . (2 == $options[3] ? "selected='selected'" : '') . '>2</option>';
    $form .= "<option value='3' " . (3 == $options[3] ? "selected='selected'" : '') . '>3</option>';
    $form .= "<option value='4' " . (4 == $options[3] ? "selected='selected'" : '') . '>4</option>';
    $form .= "<option value='6' " . (6 == $options[3] ? "selected='selected'" : '') . '>6</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_SHOW.": <select name='options[4]' size='2'>";
    $form .= "<option value='0' " . (0 == $options[4] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_INDEX . '</option>';
    $form .= "<option value='1' " . (1 == $options[4] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_SHOW_GALLERY . '</option>';
    $form .= '</select><br>';
    $form .= _MB_WGGALLERY_TYPE.": <select name='options[5]' size='2'>";
    $form .= "<option value='0' " . (0 == $options[5] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_TYPE_BLOCK . '</option>';
    $form .= "<option value='1' " . (1 == $options[5] ? "selected='selected'" : '') . '>' . _MB_WGGALLERY_TYPE_CONTAINER . '</option>';
    $form .= '</select>&nbsp;';
	$form .= _MB_WGGALLERY_TYPE_CONTAINER_WIDTH." : <input type='text' name='options[6]' size='5' maxlength='255' value='" . $options[6] . "' /><br>";
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