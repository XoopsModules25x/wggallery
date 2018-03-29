<?php

/**
 * SystemFineImUploadHandler class to work with ajaxfineupload.php endpoint
 * to facilitate uploads for the system image manager
 *
 * Do not use or reference this directly from your client-side code.
 * Instead, this should be required via the endpoint.php or endpoint-cors.php
 * file(s).
 *
 * @license   MIT License (MIT)
 * @copyright Copyright (c) 2015-present, Widen Enterprises, Inc.
 * @link      https://github.com/FineUploader/php-traditional-server
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2015-present, Widen Enterprises, Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

class WggalleryFineImpUploadHandler extends SystemFineUploadHandler
{
    /**
     * @var int
     */
    private $permUseralbum = 0;
    /**
     * @var int
     */
    private $imageId = 0;
    /**
     * @var string
     */
    private $imageName = null;
    /**
     * @var string
     */
    private $imageNicename = null;
    /**
     * @var string
     */
    private $imagePath = null;
    /**
     * @var string
     */
    private $imageOrigname = null;
    /**
     * @var string
     */
    private $imageMimetype = null;
    /**
     * @var int
     */
    private $imageSize = 0;
    /**
     * @var int
     */
    private $imageWidth = 0;
    /**
     * @var int
     */
    private $imageHeight = 0;
    /**
     * @var string
     */
    private $pathUpload = null;

    /**
     * XoopsFineImUploadHandler constructor.
     * @param stdClass $claims claims passed in JWT header
     */
    public function __construct(\stdClass $claims)
    {
        parent::__construct($claims);
        $this->allowedMimeTypes  = array('image/gif', 'image/jpeg', 'image/png');
        $this->allowedExtensions = array('gif', 'jpeg', 'jpg', 'png');
    }

    protected function storeUploadedFile($target, $mimeType, $uid)
    {
        include XOOPS_ROOT_PATH . '/modules/wggallery/header.php';
        include XOOPS_ROOT_PATH . '/modules/wggallery/include/permissions.php';
        $this->pathUpload = WGGALLERY_UPLOAD_IMAGE_PATH;

        $this->permUseralbum = permGetUserAlbum($this->claims->cat);

        $pathParts = pathinfo($this->getName());

        $this->imageName     = uniqid('img') . '.' . strtolower($pathParts['extension']);
        $this->imageNicename = str_replace(array('_', '-'), ' ', $pathParts['filename']);
        $this->imagePath     = $this->pathUpload . '/large/' . $this->imageName;

        if (false === move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $this->imagePath)) {
            return false;
        }

        $this->imageOrigname = $_FILES[$this->inputName]['name'];
        $this->imageMimetype = $_FILES[$this->inputName]['type'];
        $this->imageSize     = $_FILES[$this->inputName]['size'];

        $ret = $this->handleImgLarge();
        if (false === $ret) {
            return array(
                'error' => sprintf(_FAILSAVEIMG, $this->imageNicename)
            );
        }
        // create medium image
        $ret = $this->resizeImage($this->pathUpload . '/medium/' . $this->imageName, 300, 300);
        ;
        if (false === $ret) {
            return array('error' => sprintf(_MA_WGGALLERY_FAILSAVEIMG_MEDIUM, $this->imageNicename));
        }
        if ('copy' === $ret) {
            copy($this->pathUpload . '/large/' . $this->imageName, $this->pathUpload . '/medium/' . $this->imageName);
        }
        // create thumb
        $ret = $this->resizeImage($this->pathUpload . '/thumbs/' . $this->imageName, 100, 100);
        ;
        if (false === $ret) {
            return array('error' => sprintf(_MA_WGGALLERY_FAILSAVEIMG_THUMBS, $this->imageNicename));
        }
        if ('copy' === $ret) {
            copy($this->pathUpload . '/large/' . $this->imageName, $this->pathUpload . '/thums/' . $this->imageName);
        }
        return array('success' => true, "uuid" => $uuid);
    }

    private function handleImgLarge()
    {
        include XOOPS_ROOT_PATH . '/modules/wggallery/header.php';
        global $xoopsUser;

        $this->getImageDim();

        $imagesObj = $imagesHandler->create();
        // Set Vars
        $imagesObj->setVar('img_title', $this->imageNicename);
        $imagesObj->setVar('img_desc', '');
        $imagesObj->setVar('img_name', $this->imageName);
        $imagesObj->setVar('img_origname', $this->imageOrigname);
        $imagesObj->setVar('img_mimetype', $this->imageMimetype);
        $imagesObj->setVar('img_size', $this->imageSize);
        $imagesObj->setVar('img_resx', $this->imageWidth);
        $imagesObj->setVar('img_resy', $this->imageHeight);
        $imagesObj->setVar('img_albid', $this->claims->cat);
        $imagesObj->setVar('img_state', $this->permUseralbum);
        $imagesObj->setVar('img_date', time());
        $imagesObj->setVar('img_submitter', $xoopsUser->id());
        $imagesObj->setVar('img_ip', '-');
        // Insert Data
        if ($imagesHandler->insert($imagesObj)) {
            $this->imageId = $imagesHandler->getInsertId;
            return true;
        }
        return false;
    }

    private function handleImgMedium()
    {
        return $this->resizeImage($this->pathUpload . '/medium/' . $this->imageName, 100, 100);
    }

    private function handleImgThumbs()
    {
    }

    private function getImageDim()
    {
        switch ($this->imageMimetype) {
            case'image/png':
                $img = imagecreatefrompng($this->imagePath);
                break;
            case'image/jpeg':
                $img = imagecreatefromjpeg($this->imagePath);
                break;
            case'image/gif':
                $img = imagecreatefromgif($this->imagePath);
                break;
            default:
                $this->imageWidth  = 0;
                $this->imageHeight = 0;
                return 'Unsupported format';
        }
        $this->imageWidth  = imagesx($img);
        $this->imageHeight = imagesy($img);

        imagedestroy($img);

        return true;
    }

    /**
     * resize image if size exceed given width/height
     * @param string $endfile
     * @param int    $max_width
     * @param int    $max_height
     * @return string|void
     */
    private function resizeImage($endfile, $max_width, $max_height)
    {
        // check file extension
        switch ($this->imageMimetype) {
            case'image/png':
                $img = imagecreatefrompng($this->imagePath);

                break;
            case'image/jpeg':
                $img = imagecreatefromjpeg($this->imagePath);
                break;
            case'image/gif':
                $img = imagecreatefromgif($this->imagePath);
                break;
            default:
                return 'Unsupported format';
        }

        $width  = imagesx($img);
        $height = imagesy($img);

        if ($width > $max_width || $height > $max_height) {
            // recalc image size based on max_width/max_height
            if ($width > $height) {
                if ($width < $max_width) {
                    $new_width = $width;
                } else {
                    $new_width  = $max_width;
                    $divisor    = $width / $new_width;
                    $new_height = floor($height / $divisor);
                }
            } else {
                if ($height < $max_height) {
                    $new_height = $height;
                } else {
                    $new_height = $max_height;
                    $divisor    = $height / $new_height;
                    $new_width  = floor($width / $divisor);
                }
            }

            // Create a new temporary image.
            $tmpimg = imagecreatetruecolor($new_width, $new_height);
            imagealphablending($tmpimg, false);
            imagesavealpha($tmpimg, true);

            // Copy and resize old image into new image.
            imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            // Save thumbnail into a file.
            //compressing the file
            switch ($this->imageMimetype) {
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
}
