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

include __DIR__ . '/header.php';
include_once XOOPS_ROOT_PATH .'/modules/wggallery/include/imagehandler.php';
echo WGGALLERY_UPLOAD_IMAGE_PATH;
$images = [];
$counter = 0;
$crImages = new CriteriaCompo();
$crImages->add(new Criteria('img_albid', 2));
$crImages->setSort('img_weight');
$crImages->setOrder('ASC');
$crImages->setStart( 0 );
$crImages->setLimit( 6 );
$imagesAll = $imagesHandler->getAll($crImages);
foreach(array_keys($imagesAll) as $i) {
    $counter++;
    $images[$counter] = $imagesAll[$i]->getValuesImages();
}


// funktioniert
$tmp = imagecreatetruecolor(400, 300);

// get the color red
$imgBg  = imagecolorallocate($tmp,255,0,0);

// fill entire image (quickly)
imagefilledrectangle($tmp,0,0,400,300,$imgBg);


$final = 'imagefinal4.jpg';
imagejpeg($tmp, $final);
imagedestroy($tmp);

for ($i = 1; $i <= 4; $i++) {
    ResizeAndCrop( WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $images[$i]['img_name'], $images[$i]['img_mimetype'], 'imgTemp' . $i . '.jpg', 199, 149);
}
for ($i = 1; $i <= 4; $i++) {
    MergeImage('imgTemp' . $i . '.jpg', $final, $i, 4);
    unlink ( 'imgTemp' . $i . '.jpg' );
} 

$tmp = imagecreatetruecolor(400, 300);
$final2 = 'imagefinal6.jpg';
imagejpeg($tmp, $final2);
imagedestroy($tmp);

for ($i = 1; $i <= 6; $i++) {
    ResizeAndCrop( WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $images[$i]['img_name'], $images[$i]['img_mimetype'], 'imgTemp' . $i . '.jpg', 133, 149);
}
for ($i = 1; $i <= 6; $i++) {
    MergeImage('imgTemp' . $i . '.jpg', $final2, $i, 6);
    unlink ( 'imgTemp' . $i . '.jpg' );
}

 

$templateMain = 'wggallery_admin_images.tpl';



include __DIR__ . '/footer.php';
