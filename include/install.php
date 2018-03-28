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
 * @version        $Id: 1.0 install.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
// Copy base file
$indexFile = XOOPS_UPLOAD_PATH.'/index.html';
$blankFile = XOOPS_UPLOAD_PATH.'/blank.gif';
// Making of uploads/wggallery folder
$wggallery = XOOPS_UPLOAD_PATH.'/wggallery';
if(!is_dir($wggallery)) {
	mkdir($wggallery, 0777);
	chmod($wggallery, 0777);
}
copy($indexFile, $wggallery.'/index.html');
// Making of albums uploads folder
$albums = $wggallery.'/albums';
if(!is_dir($albums)) {
	mkdir($albums, 0777);
	chmod($albums, 0777);
}
copy($indexFile, $albums.'/index.html');
// Making of images folder
$images = $wggallery.'/images';
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
// ------------------- Install Footer ------------------- //
