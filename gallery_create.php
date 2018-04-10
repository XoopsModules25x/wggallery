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
include __DIR__ . '/header.php';
$pr_gallery = $gallerytypesHandler->getPrimaryGallery();
$GLOBALS['xoopsOption']['template_main'] = 'wggallery_index_default.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'list');


switch($pr_gallery['template']) {
	case 'none':
default:
		$options = array();
        $options[] = array('name' => 'source', 'value' => 'large');
        $options[] = array('name' => 'source_preview', 'value' => 'medium');
		$options[] = array('name' => 'showThumbs', 'value' => 'true');
        // $options[] = array('name' => 'rowHeight', 'value' => 150);
		// $options[] = array('name' => 'lastRow', 'value' => 'nojustify');
		// $options[] = array('name' => 'margins', 'value' => 1);
		// $options[] = array('name' => 'border', 'value' => 0);   
		$options[] = array('name' => 'title', 'value' => 'true');  
		$options[] = array('name' => 'description', 'value' => 'true');
		// $options[] = array('name' => 'randomize', 'value' => 'false');  
		// $options[] = array('name' => 'speed', 'value' => 500); 
		// $options[] = array('name' => 'open', 'value' => 'false');
		// $options[] = array('name' => 'slideshow', 'value' => 'true'); 
		// $options[] = array('name' => 'opacity', 'value' => '0.8');  
		// $options[] = array('name' => 'slideshow_options', 'value' => ''); 	
		// $options[] = array('name' => 'colorboxstyle', 'value' => 'style1'); 		
		// $options[] = array('name' => 'transition', 'value' => 'elastic'); 
		$options[] = array('name' => 'slideshowSpeed', 'value' => 3000);    
		// $options[] = array('name' => 'slideshowAuto', 'value' => 'true');

		   


		

		$options[] = array('name' => 'autoSlide', 'value' => 'false');
		
		// $options[] = array('name' => 'transitionEffect', 'value' => 'fading');
		// $options[] = array('name' => 'transitionDuration', 'value' => '500');
		// $options[] = array('name' => 'intervalDuration', 'value' => '3000');	
		// $options[] = array('name' => 'displayList', 'value' => 'true');
		// $options[] = array('name' => 'listPosition', 'value' => 'left');
		
		// $options[] = array('name' => 'displayControls', 'value' => 'true');
		// $options[] = array('name' => 'verticalCentering', 'value' => 'true');
		// $options[] = array('name' => 'adaptiveHeight', 'value' => 'false');
		// $options[] = array('name' => 'adaptiveDuration', 'value' => '200');
			
		
		

		

		
		echo serialize($options);
		echo "<br><br><br><br>";
		

		var_dump($options); 
		
	break;

}		

// Description
wggalleryMetaDescription(_MA_WGGALLERY_IMAGES_DESC);
// $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', WGGALLERY_URL.'/images.php');
$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
include __DIR__ . '/footer.php';
