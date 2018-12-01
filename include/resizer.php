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
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */

/**
 * resize image if size exceed given width/height
 * @param string $endfile 
 * @param int    $max_width 
 * @param int    $max_height 
 * @return string|boolean
 */

 function resizeImage($sourcefile, $endfile, $max_width, $max_height, $imageMimetype){
    // check file extension
    switch($imageMimetype){
        case'image/png':
            $img = imagecreatefrompng($sourcefile);

        break;
        case'image/jpeg':
            $img = imagecreatefromjpeg($sourcefile);
        break;
        case'image/gif':
            $img = imagecreatefromgif($sourcefile);
        break;
        default:
            return 'Unsupported format';
    }

    $width = imagesx( $img );
    $height = imagesy( $img );
    
    if ( $width > $max_width || $height > $max_height) {
        // recalc image size based on max_width/max_height
        if ($width > $height) {
            if($width < $max_width){
                $new_width = $width;
            } else {
                $new_width = $max_width;
                $divisor = $width / $new_width;
                $new_height = floor( $height / $divisor);
            }
        } else if($height < $max_height){
            $new_height = $height;
        } else {
            $new_height =  $max_height;
            $divisor = $height / $new_height;
            $new_width = floor( $width / $divisor );
        }

        // Create a new temporary image.
        $tmpimg = imagecreatetruecolor( $new_width, $new_height );
        imagealphablending($tmpimg, false);
        imagesavealpha($tmpimg, true);

        // Copy and resize old image into new image.
        imagecopyresampled( $tmpimg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        //compressing the file
        switch($imageMimetype){
            case'image/png':
                imagepng($tmpimg, $endfile, 0);
            break;
            case'image/jpeg':
                imagejpeg($tmpimg, $endfile, 100);
            break;
            case'image/gif':
                imagegif($tmpimg, $endfile);
            break;
        }
                    
        // release the memory
        imagedestroy($tmpimg);
    } else {
        return 'copy';
    }
    imagedestroy($img);
    return true;
}

