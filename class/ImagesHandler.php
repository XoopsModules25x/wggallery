<?php

namespace XoopsModules\Wggallery;

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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

\defined('\XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Handler Images
 */
class ImagesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * @var int
     */
    private $permUseralbum = 0;
    /**
     * @var int
     */
    private $albumId = 0;
    /**
     * @var int
     */
    private $imageId = 0;
    /**
     * @var string
     */
    private $imageOrigName = null;
    /**
     * @var string
     */
    private $imageName = null;
    /**
     * @var string
     */
    private $imageNameLarge = null;
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
    private $imageNameOrig = null;
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
     * @var string
     */
    private $exifData = null;
    /**
     * @var string
     */
    private $imageTags = null;
    /**
     * @var string
     */
    private $imageTitle = null;
    /**
     * @var string
     */
    private $imageDesc = null;


    /**
     * Constructor
     *
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wggallery_images', Images::class, 'img_id', 'img_name');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int   $i field id
     * @param array $fields
     * @return mixed reference to the {@link Get} object
     */
    public function get($i = null, $fields = null)
    {
        return parent::get($i, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Images in the database
     * @param int    $albId
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountImages($albId = 0, $start = 0, $limit = 0, $sort = 'img_id ASC, img_name', $order = 'ASC')
    {
        $crCountImages = new \CriteriaCompo();
        $crCountImages = $this->getImagesCriteria($crCountImages, $albId, $start, $limit, $sort, $order);

        return parent::getCount($crCountImages);
    }

    /**
     * Get All Images in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllImages($start = 0, $limit = 0, $sort = 'img_id ASC, img_name', $order = 'ASC')
    {
        $crAllImages = new \CriteriaCompo();
        $crAllImages = $this->getImagesCriteria($crAllImages, 0, $start, $limit, $sort, $order);

        return parent::getAll($crAllImages);
    }

    /**
     * Get Criteria Images
     * @param        $crImages
     * @param        $albId
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getImagesCriteria($crImages, $albId, $start, $limit, $sort, $order)
    {
        if ($albId > 0) {
            $crImages->add(new \Criteria('img_albid', $albId));
        }
        $crImages->setStart($start);
        $crImages->setLimit($limit);
        $crImages->setSort($sort);
        $crImages->setOrder($order);

        return $crImages;
    }

    /**
     * delete all copies of a specific image
     * @param $imageName
     * @param $imageNameLarge
     * @return bool
     */
    public function unlinkImages($imageName, $imageNameLarge)
    {
        \unlink(\WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge);
        if (\file_exists(\WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge)) {
            return false;
        }
        \unlink(\WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName);
        if (\file_exists(\WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName)) {
            return false;
        }
        \unlink(\WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName);
        if (\file_exists(\WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName)) {
            return false;
        }

        return true;
    }

    /**
     * extract data from exif as tags
     * @param  $exifs
     * @param  $exif_tags
     * @return string or null
     */
    public function exifExtractTags($exifs, $exif_tags)
    {
        $ret = '';

        if (\is_object($exifs) || \is_array($exifs)) {
            foreach ($exifs as $key => $value) {
                if (\in_array($key, $exif_tags)) {
                    if (\is_array($value)) {
                        foreach ($value as $skey => $svalue) {
                            $ret .= '#' . $svalue;
                        }
                    } else {
                        $ret .= '#' . $value;
                    }
                }
            }
        } else {
            return null;
        }

        return $ret;
    }

    /**
     * encode and decode with json in order to get proper values
     * @param  $file
     * @param  $encode
     * @return string or array
     */
    public function exifRead($file, $encoded = true)
    {
        $exif = \exif_read_data($file);
        $ret  = \json_encode($exif, JSON_INVALID_UTF8_IGNORE);
        if ($encoded) {
            return $ret;
        }
        return \json_decode($ret);
    }

    /**
     * @public function getForm
     * @param $albId
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormSingleUpload($albId, $action = false)
    {
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(\_CO_WGGALLERY_IMAGE_ADD, 'formSingleUpload', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Text imgTitle
        $form->addElement(new \XoopsFormText(\_CO_WGGALLERY_IMAGE_TITLE, 'img_title', 50, 255, ''));
        // Form Text imgDesc
        $form->addElement(new \XoopsFormText(\_CO_WGGALLERY_IMAGE_DESC, 'img_desc', 50, 255, ''));
        // Form Image imgName
        $imageTray = new \XoopsFormElementTray(\_CO_WGGALLERY_FORM_UPLOAD, '<br>');
        // Form Image imgName: Upload new image
        $maxsize = $helper->getConfig('maxsize');
        $imageTray->addElement(new \XoopsFormFile('', 'img_name', $maxsize), true);
        $imageTray->addElement(new \XoopsFormLabel(_IMGMAXSIZE, ($maxsize / 1048576) . ' '  . \_CO_WGGALLERY_MB));
        $imageTray->addElement(new \XoopsFormLabel(_IMGMAXWIDTH, $helper->getConfig('maxwidth') . ' px'));
        $imageTray->addElement(new \XoopsFormLabel(_IMGMAXHEIGHT, $helper->getConfig('maxheight') . ' px'));
        $form->addElement($imageTray);
        // To Save
        $form->addElement(new \XoopsFormHidden('alb_id', $albId));
        $form->addElement(new \XoopsFormHidden('op', 'uploadSingle'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * @public function to handle upload single file
     * @param $imgName
     * @param $imgTitle
     * @param $imgDesc
     * @param $imageMimetype
     * @param $imageSize
     * @param $albId
     * @return bool|array
     */
    public function handleSingleUpload($imgName, $imgTitle, $imgDesc, $imageMimetype, $imageSize, $albId)
    {
        require_once \XOOPS_ROOT_PATH . '/modules/wggallery/header.php';
        $helper             = \XoopsModules\Wggallery\Helper::getInstance();
        $albumsHandler      = $helper->getHandler('Albums');
        $permissionsHandler = $helper->getHandler('Permissions');
        $watermarksHandler  = $helper->getHandler('Watermarks');

        $helper           = \XoopsModules\Wggallery\Helper::getInstance();
        $this->pathUpload = \WGGALLERY_UPLOAD_IMAGE_PATH;

        if (Constants::PERM_SUBMITAPPR === $permissionsHandler->permGlobalSubmit()) {
            $this->permUseralbum = Constants::STATE_APPROVAL_VAL;
        } else {
            $this->permUseralbum = Constants::STATE_ONLINE_VAL;
        }

        $this->imageNameLarge = $imgName;
        $this->imagePath      = $this->pathUpload . '/large/' . $this->imageNameLarge;
        $pathParts            = \pathinfo($this->imagePath);
        $this->albumId        = $albId;
        $this->imageTitle     = $imgTitle;
        $this->imageDesc      = $imgDesc;
        $this->imageName      = $this->imageTitle . '_img' . uniqid('', true) . '.' . \mb_strtolower($pathParts['extension']);
        $this->imageNicename  = $imgName;
        $this->imageNameOrig  = $this->imageTitle . '_imgo' . uniqid('', true) . '.' . \mb_strtolower($pathParts['extension']);
        $this->imageMimetype  = $imageMimetype;
        $this->imageSize      = $imageSize;

        if ($helper->getConfig('store_original')) {
            $imgPathSaveOrig = $this->pathUpload . '/original/' . $this->imageNameOrig;
            \copy($this->imagePath, $imgPathSaveOrig);
        }

        $exif = '';
        if ($helper->getConfig('store_exif')) {
            // read exif from original image
            $this->exifData = $this->exifRead($this->imagePath);
        }
        if ('none' !== $helper->getConfig('exif_tags')) {
            if ('' == $exif) {
                // read exif from original image
                $exif = $this->exifRead($this->imagePath, false);
            }
            $this->imageTags = $this->exifExtractTags($exif, $helper->getConfig('exif_tags'));
        }

        // resize large image
        $imgHandler                = new Wggallery\Resizer();
        $imgHandler->sourceFile    = $this->imagePath;
        $imgHandler->endFile       = $this->imagePath;
        $imgHandler->imageMimetype = $this->imageMimetype;
        $imgHandler->maxWidth      = $helper->getConfig('maxwidth_large');
        $imgHandler->maxHeight     = $helper->getConfig('maxheight_large');
        $ret                       = $imgHandler->resizeImage();
        if (false === $ret) {
            return ['error' => \sprintf(\_MA_WGGALLERY_FAILSAVEIMG_LARGE, $this->imageNicename)];
        }

        $ret = $this->handleImageDB();
        if (!$ret) {
            return [
                'error' => \sprintf(_FAILSAVEIMG, $this->imageNicename),
            ];
        }

        // load watermark settings
        $albumObj  = $albumsHandler->get($this->albumId);
        $wmId      = $albumObj->getVar('alb_wmid');
        $wmTargetM = false;
        $wmTargetL = false;
        if ($wmId > 0) {
            $watermarksObj = $watermarksHandler->get($wmId);
            $wmTarget      = $watermarksObj->getVar('wm_target');
            if (Constants::WATERMARK_TARGET_A === $wmTarget || Constants::WATERMARK_TARGET_M === $wmTarget) {
                $wmTargetM = true;
            }
            if (Constants::WATERMARK_TARGET_A === $wmTarget || Constants::WATERMARK_TARGET_L === $wmTarget) {
                $wmTargetL = true;
            }
        }

        // create medium image
        $imgHandler                = new Wggallery\Resizer();
        $imgHandler->sourceFile    = $this->imagePath;
        $imgHandler->endFile       = $this->pathUpload . '/medium/' . $this->imageName;
        $imgHandler->imageMimetype = $this->imageMimetype;
        $imgHandler->maxWidth      = $helper->getConfig('maxwidth_medium');
        $imgHandler->maxHeight     = $helper->getConfig('maxheight_medium');
        $ret                       = $imgHandler->resizeImage();
        if (false === $ret) {
            return ['error' => \sprintf(\_MA_WGGALLERY_FAILSAVEIMG_MEDIUM, $this->imageNicename)];
        }
        if ('copy' === $ret) {
            \copy($this->imagePath, $this->pathUpload . '/medium/' . $this->imageName);
        }

        // create thumb
        $imgHandler->sourceFile    = $this->imagePath;
        $imgHandler->endFile       = $this->pathUpload . '/thumbs/' . $this->imageName;
        $imgHandler->imageMimetype = $this->imageMimetype;
        $imgHandler->maxWidth      = $helper->getConfig('maxwidth_thumbs');
        $imgHandler->maxHeight     = $helper->getConfig('maxheight_thumbs');
        $ret                       = $imgHandler->resizeImage();
        if (false === $ret) {
            return ['error' => \sprintf(\_MA_WGGALLERY_FAILSAVEIMG_THUMBS, $this->imageNicename)];
        }
        if ('copy' === $ret) {
            \copy($this->imagePath, $this->pathUpload . '/thumbs/' . $this->imageName);
        }

        // add watermark to large image
        if ($wmTargetL) {
            $imgWm = $this->imagePath;
            $resWm = $watermarksHandler->watermarkImage($wmId, $imgWm, $imgWm);
            if (true !== $resWm) {
                return ['error' => \sprintf(\_MA_WGGALLERY_FAILSAVEWM_LARGE, $this->imageNicename, $resWm)];
            }
        }
        // add watermark to medium image
        if ($wmTargetM) {
            $imgWm = $this->pathUpload . '/medium/' . $this->imageName;
            $resWm = $watermarksHandler->watermarkImage($wmId, $imgWm, $imgWm);
            if (true !== $resWm) {
                return ['error' => \sprintf(\_MA_WGGALLERY_FAILSAVEWM_MEDIUM, $this->imageNicename, $resWm)];
            }
        }
        // send notifications
        $tags                = [];
        $tags['IMAGE_NAME']  = $this->imageNicename;
        $tags['IMAGE_URL']   = \XOOPS_URL . '/modules/wggallery/images.php?op=show&img_id=' . $this->imageId . '&amp;alb_id=' . $this->albumId;
        $tags['ALBUM_URL']   = \XOOPS_URL . '/modules/wggallery/albums.php?op=show&alb_id=' . $this->albumId;
        $notificationHandler = \xoops_getHandler('notification');
        $mid                 = \XoopsModules\Wggallery\Helper::getMid();
        if (Constants::STATE_APPROVAL_VAL === $this->permUseralbum) {
            $notificationHandler->triggerEvent('global', 0, 'image_approve', $tags, [], $mid);
        } else {
            $notificationHandler->triggerEvent('global', 0, 'image_new_all', $tags, [], $mid);
            $notificationHandler->triggerEvent('albums', $this->albumId, 'image_new', $tags, [], $mid);
        }

        return true;
    }

    /**
     * @return bool
     */
    private function handleImageDB()
    {
        require_once \XOOPS_ROOT_PATH . '/modules/wggallery/header.php';

        global $xoopsUser;

        $this->getImageDim();

        $imagesObj     = $this->create();
        // Set Vars
        $imagesObj->setVar('img_title', $this->imageTitle);
        $imagesObj->setVar('img_desc', $this->imageDesc);
        $imagesObj->setVar('img_name', $this->imageName);
        $imagesObj->setVar('img_namelarge', $this->imageNameLarge);
        $imagesObj->setVar('img_nameorig', $this->imageNameOrig);
        $imagesObj->setVar('img_mimetype', $this->imageMimetype);
        $imagesObj->setVar('img_size', $this->imageSize);
        $imagesObj->setVar('img_resx', $this->imageWidth);
        $imagesObj->setVar('img_resy', $this->imageHeight);
        $imagesObj->setVar('img_albid', $this->albumId);
        $imagesObj->setVar('img_state', $this->permUseralbum);
        $imagesObj->setVar('img_exif', $this->exifData);
        $imagesObj->setVar('img_tags', $this->imageTags);
        $imagesObj->setVar('img_date', \time());
        $imagesObj->setVar('img_submitter', $xoopsUser->id());
        $imagesObj->setVar('img_ip', $_SERVER['REMOTE_ADDR']);
        // Insert Data
        if ($this->insert($imagesObj)) {
            $this->imageId = $this->getInsertId();

            return true;
        }

        return false;
    }

    /**
     * @return bool|string
     */
    private function getImageDim()
    {
        switch ($this->imageMimetype) {
            case 'image/png':
                $img = \imagecreatefrompng($this->imagePath);
                break;
            case 'image/jpeg':
                $img = \imagecreatefromjpeg($this->imagePath);
                if (!$img) {
                    $img = \imagecreatefromstring(file_get_contents($this->imagePath));
                }
                break;
            case 'image/gif':
                $img = \imagecreatefromgif($this->imagePath);
                break;
            default:
                $this->imageWidth  = 0;
                $this->imageHeight = 0;

                return 'Unsupported format';
        }
        $this->imageWidth  = \imagesx($img);
        $this->imageHeight = \imagesy($img);

        \imagedestroy($img);

        return true;
    }

    /**
     * @public function getForm
     * @param array $files
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormBatchUpload($files, $action = false)
    {
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(\_AM_WGGALLERY_BATCH_FORM, 'formBatchUpload', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        // Form Table Albums
        $albumsHandler      = $helper->getHandler('Albums');
        $permissionsHandler = $helper->getHandler('Permissions');
        $crAlbums           = new \CriteriaCompo();
        $crAlbums->add(new \Criteria('alb_iscoll', 0));
        $crAlbums->setSort('alb_weight ASC, alb_date');
        $crAlbums->setOrder('DESC');
        // Form Select Albums
        $albIdSelect = new \XoopsFormSelect(\_CO_WGGALLERY_ALBUM_SELECT, 'alb_id', 0);
        $albIdSelect->addOption(0, '&nbsp;');
        $albumsAll = $albumsHandler->getAll($crAlbums);

        foreach (\array_keys($albumsAll) as $i) {
            if ($permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'))) {
                $albName = $albumsAll[$i]->getVar('alb_name');
                $albPid  = $albumsAll[$i]->getVar('alb_pid');
                if ($albPid > 0) {
                    $albumsObj = $albumsHandler->get($albPid);
                    if (\is_object($albumsObj)) {
                        $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                    } else {
                        $albName .= ' (' . \_CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                    }
                }
                $albIdSelect->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
            }
        }
        $form->addElement($albIdSelect, true);
        unset($crAlbums);

        $uploadTray = [];
        foreach ($files as $key => $file) {
            $imgUrl = \WGGALLERY_UPLOAD_BATCH_URL . '/' . $file['name'];
            $preview = '<img src="' . $imgUrl . '" alt="' . $file['name'] . '" title="' . $file['name'] . '" >';
            $uploadTray[$key] = new \XoopsFormElementTray($preview, '<br>');
            // Form Text imgTitle
            $uploadTray[$key]->addElement(new \XoopsFormLabel(\_CO_WGGALLERY_IMAGE_NAME, $file['name']));
            $uploadTray[$key]->addElement(new \XoopsFormText(\_CO_WGGALLERY_IMAGE_TITLE, "img_title[$key]", 50, 255, $file['name']));
            $uploadTray[$key]->addElement(new \XoopsFormTextArea(\_CO_WGGALLERY_IMAGE_DESC, "img_desc[$key]", '', 3, 1));
            $uploadTray[$key]->addElement(new \XoopsFormHidden("img_name[$key]", $file['name']));
            $uploadTray[$key]->addElement(new \XoopsFormHidden("img_mimetype[$key]", $file['mimetype']));
            $uploadTray[$key]->addElement(new \XoopsFormHidden("img_size[$key]", $file['size']));
            $uploadTray[$key]->addElement(new \XoopsFormHidden("img_path[$key]", \WGGALLERY_UPLOAD_BATCH_PATH . '/' . $file['name']));
            $form->addElement($uploadTray[$key]);
        }
        // To Save
        $form->addElement(new \XoopsFormHidden('filesCount', \count($files)));
        $form->addElement(new \XoopsFormHidden('op', 'uploadBatch'));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }
}
