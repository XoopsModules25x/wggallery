<?php

namespace XoopsModules\Wggallery\Common;

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

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

/**
 * Class FineimpuploadHandler
 * @package XoopsModules\Wggallery
 */
class FineimpuploadHandler extends \SystemFineUploadHandler
{
    /**
     * @var int
     */
    private int $permUseralbum = 0;
    /**
     * @var int
     */
    private int $imageId = 0;
    /**
     * @var string
     */
    private ?string $imageOrigName = null;
    /**
     * @var string
     */
    private ?string $imageName = null;
    /**
     * @var string
     */
    private ?string $imageNameLarge = null;
    /**
     * @var string
     */
    private ?string $imageNicename = null;
    /**
     * @var string
     */
    private ?string $imagePath = null;
    /**
     * @var string
     */
    private ?string $imageNameOrig = null;
    /**
     * @var string
     */
    private ?string $imageMimetype = null;
    /**
     * @var int
     */
    private int $imageSize = 0;
    /**
     * @var int
     */
    private int $imageWidth = 0;
    /**
     * @var int
     */
    private int $imageHeight = 0;
    /**
     * @var string
     */
    private ?string $pathUpload = null;
    /**
     * @var string
     */
    private ?string $exifData = null;
    /**
     * @var string
     */
    private ?string $imageTags = null;

    /**
     * XoopsFineImUploadHandler constructor.
     * @param \stdClass $claims claims passed in JWT header
     */
    public function __construct(\stdClass $claims)
    {
        parent::__construct($claims);
        $this->allowedMimeTypes  = ['image/gif', 'image/jpeg', 'image/png'];
        $this->allowedExtensions = ['gif', 'jpeg', 'jpg', 'png'];
    }

    /**
     * @param $target
     * @param $mimeType
     * @param $uid
     * @return array|bool
     * @throws \Exception
     */
    protected function storeUploadedFile($target, $mimeType, $uid): bool|array
    {
        require_once \XOOPS_ROOT_PATH . '/modules/wggallery/header.php';
        $helper           = \XoopsModules\Wggallery\Helper::getInstance();
        $imagesHandler    = $helper->getHandler('Images');
        $this->pathUpload = \WGGALLERY_UPLOAD_IMAGE_PATH;
        $imageNameOpt     = (int)$helper->getConfig('image_name');

        $pathParts       = \pathinfo($this->getName());
        $this->imageName = $pathParts['filename'];
        $fileExtension   = \mb_strtolower($pathParts['extension']);

        $this->imageNameLarge = \str_replace('.', '_', uniqid('imgl', true));
        $imageTitle           = $this->imageNameLarge;
        $this->imageNameLarge .= '.' . $fileExtension;
        $this->imagePath      = $this->pathUpload . '/large/' . $this->imageNameLarge;
        $this->imageMimetype  = $_FILES[$this->inputName]['type'];
        $this->imageSize      = $_FILES[$this->inputName]['size'];

        if (!move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $this->imagePath)) {
            return false;
        }

        if (Constants::IMAGENAME_ORIGINAL === $imageNameOpt) {
            // if original name should be used then replace imageTitle by original name
            $imageTitle = preg_replace('/[^a-zA-Z0-9]/', '_', $this->imageName);
        }
        $ret = $imagesHandler->handleSingleUpload($this->imageNameLarge, $imageTitle, '', $this->imageMimetype, $this->imageSize, $this->claims->cat);
        $uuid = '';// \bin2hex(random_bytes(16));
        if ($ret) {
            return ['success' => true, 'uuid' => $uuid];
        }
        return $ret;
    }
}
