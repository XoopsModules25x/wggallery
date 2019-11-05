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
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;

defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler Images
 */
class ImagesHandler extends \XoopsPersistableObjectHandler
{
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
        unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge);
        if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imageNameLarge)) {
            return false;
        }
        unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName);
        if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $imageName)) {
            return false;
        }
        unlink(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName);
        if (file_exists(WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/' . $imageName)) {
            return false;
        }

        return true;
    }
}
