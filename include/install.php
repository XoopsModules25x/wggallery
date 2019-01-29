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
 * @version        $Id: 1.0 install.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
// Copy base file
$indexFile    = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile    = XOOPS_UPLOAD_PATH.'/blank.gif';
$noimage      = XOOPS_ROOT_PATH.'/modules/wggallery/assets/images/noimage.png';
$imgwatermark = XOOPS_ROOT_PATH.'/modules/wggallery/assets/images/wedega_logo.png';
// Making of uploads/wggallery folder
$helper = XOOPS_UPLOAD_PATH.'/wggallery';
if(!is_dir($helper)) {
	mkdir($helper, 0777);
	chmod($helper, 0777);
}
copy($indexFile, $helper.'/index.html');
// Making of images folder
$images = $helper.'/images';
if(!is_dir($images)) {
	mkdir($images, 0777);
	chmod($images, 0777);
}
copy($indexFile, $images.'/index.html');
copy($blankFile, $images.'/blank.gif');
// Making of album images folder
$specimage = $images.'/albums';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
copy($noimage, $specimage.'/noimage.png');
// Making of large images folder
$specimage = $images.'/large';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
// Making of medium images folder
$specimage = $images.'/medium';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
// Making of thumbs images folder
$specimage = $images.'/thumbs';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
// Making of temp images folder
$specimage = $images.'/temp';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
// Making of watermark images folder
$imgwatermark = XOOPS_ROOT_PATH.'/modules/wggallery/assets/images/wedega_logo.png';
$specimage = $images.'/watermarks';
if(!is_dir($specimage)) {
	mkdir($specimage, 0777);
	chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
copy($blankFile, $specimage.'/blank.gif');
copy($imgwatermark, $specimage.'/wedega_logo.png');
// create folder watermarks-test in uploads
$specimage    = XOOPS_UPLOAD_PATH.'/wggallery/images/watermarks-test';
if(!is_dir($specimage)) {
    mkdir($specimage, 0777);
    chmod($specimage, 0777);
}
copy($indexFile, $specimage.'/index.html');
// installing watermark fonts
$specfonts = XOOPS_UPLOAD_PATH.'/wggallery/fonts';
if(!is_dir($specfonts)) {
    mkdir($specfonts, 0777);
    chmod($specfonts, 0777);
}
copy($indexFile, $specfonts.'/index.html');

$rep = XOOPS_ROOT_PATH . '/modules/wggallery/assets/fonts/';
$dir = opendir($rep);
while ($f = readdir($dir)) {
    if (is_file($rep . $f)) {
        if (preg_match('/.*ttf/', strtolower($f))) {
            copy($rep.$f, $specfonts.'/'.$f);
        }
    }
}
    
// ------------------- Install Footer ------------------- //
