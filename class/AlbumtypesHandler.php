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
 * @version        $Id: 1.0 albumtypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler Albumtypes
 */
class AlbumtypesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wggallery_albumtypes', Albumtypes::class, 'at_id', 'at_name');
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
     * Get Count Albumtypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountAlbumtypes($start = 0, $limit = 0, $sort = 'at_id ASC, at_name', $order = 'ASC')
    {
        $crCountAlbumtypes = new \CriteriaCompo();
        $crCountAlbumtypes = $this->getAlbumtypesCriteria($crCountAlbumtypes, $start, $limit, $sort, $order);

        return parent::getCount($crCountAlbumtypes);
    }

    /**
     * Get All Albumtypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllAlbumtypes($start = 0, $limit = 0, $sort = 'at_id ASC, at_name', $order = 'ASC')
    {
        $crAllAlbumtypes = new \CriteriaCompo();
        $crAllAlbumtypes = $this->getAlbumtypesCriteria($crAllAlbumtypes, $start, $limit, $sort, $order);

        return parent::getAll($crAllAlbumtypes);
    }

    /**
     * Get Criteria Albumtypes
     * @param        $crAlbumtypes
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getAlbumtypesCriteria($crAlbumtypes, $start, $limit, $sort, $order)
    {
        $crAlbumtypes->setStart($start);
        $crAlbumtypes->setLimit($limit);
        $crAlbumtypes->setSort($sort);
        $crAlbumtypes->setOrder($order);

        return $crAlbumtypes;
    }

    /**
     * Get primary Albumtype
     * @return array
     */
    public function getPrimaryAlbum()
    {
        $albumtype    = [];
        $crAlbumtypes = new \CriteriaCompo();
        $crAlbumtypes->add(new \Criteria('at_primary', 1));
        $crAlbumtypes->setLimit(1);
        $albumtypesAll = $this->getAll($crAlbumtypes);
        foreach (array_keys($albumtypesAll) as $i) {
            $albumtype['name']     = $albumtypesAll[$i]->getVar('at_name');
            $albumtype['template'] = $albumtypesAll[$i]->getVar('at_template');
            $albumtype['options']  = $albumtypesAll[$i]->getVar('at_options', 'N');
        }

        return $albumtype;
    }

    /**
     * Get options albumtype
     * @param $atId
     * @return array
     */
    public function getAlbumtypeOptions($atId)
    {
        $albumtype             = [];
        $albumtypesObj         = $this->get($atId);
        $albumtype['name']     = $albumtypesObj->getVar('at_name');
        $albumtype['template'] = $albumtypesObj->getVar('at_template');
        $albumtype['options']  = $albumtypesObj->getVar('at_options', 'N');

        return $albumtype;
    }

    /**
     * Create Gallerytypes
     * @param $success
     * @param $errors
     */
    public function albumtypesCreateReset(&$success, &$errors)
    {
        // create new albumtypes if not existing
        $templates = ['default', 'simple', 'hovereffectideas', 'bcards'];
        foreach ($templates as $template) {
            $gtCount      = 0;
            $crAlbumtypes = new \CriteriaCompo();
            $crAlbumtypes->add(new \Criteria('at_template', $template));
            $crAlbumtypes->setLimit(1);
            $gtCount = $this->getCount($crAlbumtypes);
            if ($gtCount < 1) {
                $albumtypesObj = $this->create();
                $albumtypesObj->setVar('at_name', $template);
                $albumtypesObj->setVar('at_template', $template);
                if ($this->insert($albumtypesObj)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
                } else {
                    $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
                }
            }
            unset($albumtypesObj);
            unset($crAlbumtypes);
        }

        // reset all albumtypes
        $count_pr     = 0;
        $crAlbumtypes = new \CriteriaCompo();
        $crAlbumtypes->add(new \Criteria('at_primary', 1));
        $albumtypesAll = $this->getAll($crAlbumtypes);
        foreach (array_keys($albumtypesAll) as $i) {
            if ($this->reset($albumtypesAll[$i]->getVar('at_id'), $albumtypesAll[$i]->getVar('at_template'), 1)) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $albumtypesAll[$i]->getVar('at_name');
                $count_pr++;
            } else {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
            }
        }
        unset($crAlbumtypes);
        $crAlbumtypes = new \CriteriaCompo();
        $crAlbumtypes->add(new \Criteria('at_primary', 0));
        $albumtypesAll = $this->getAll($crAlbumtypes);
        foreach (array_keys($albumtypesAll) as $i) {
            $primary = 0;
            if (0 == $count_pr) {
                $primary = 1;
            }
            if ($this->reset($albumtypesAll[$i]->getVar('at_id'), $albumtypesAll[$i]->getVar('at_template'), $primary)) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $albumtypesAll[$i]->getVar('at_name');
                $count_pr++;
            } else {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
            }
        }
        unset($crAlbumtypes);
    }

    /**
     * Reset Albumtype
     * @param $atId
     * @param $template
     * @param $primary
     * @return bool
     */
    public function reset($atId, $template, $primary)
    {
        $options = [];
        switch ($template) {
            case 'default':
                $at_name    = 'Default album style';
                $at_credits = 'https://xoops.wedega.com';
                $options[]  = ['name' => 'number_cols_album', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB'];
                $options[]  = ['name' => 'number_cols_cat', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT'];
                $options[]  = ['name' => 'album_showsubmitter', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_SHOWSUBMITTER'];
                break;
            case 'simple':
                $at_name    = 'Simple Album';
                $at_credits = 'https://xoops.wedega.com';
                $options[]  = ['name' => 'number_cols_album', 'value' => '3', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB'];
                $options[]  = ['name' => 'number_cols_cat', 'value' => '3', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT'];
                $options[]  = ['name' => 'showTitle', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'showDesc', 'value' => '0', 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];
                break;
            case 'hovereffectideas':
                $at_name    = 'Hover Effect Ideas';
                $at_credits = 'Codrops (http://tympanus.net/codrops, http://tympanus.net/Development/HoverEffectIdeas/)';
                $options[]  = ['name' => 'number_cols_album', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB'];
                $options[]  = ['name' => 'number_cols_cat', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT'];
                $options[]  = ['name' => 'hovereffect', 'value' => 'duke', 'caption' => '_AM_WGGALLERY_OPTION_AT_HOVER'];
                break;
            case 'bcards':
                $at_name    = 'Bootstrap Cards';
                $at_credits = 'https://getbootstrap.com/';
                $options[]  = ['name' => 'number_cols_album', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB'];
                $options[]  = ['name' => 'number_cols_cat', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT'];
                $options[]  = ['name' => 'album_showsubmitter', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_SHOWSUBMITTER'];
                $options[]  = ['name' => 'showTitle', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'showDesc', 'value' => '0', 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];
                break;
            case 'none':
            default:
                redirect_header('albumtypes.php?op=list', 3, 'Invalid albumtype name:' . $template);
                break;
        }

        // define sorting
        $option_sort = '';
        foreach ($options as $option) {
            if ('' !== $option_sort) {
                $option_sort .= '|';
            }
            $option_sort .= $option['name'];
        }
        $options[] = ['name' => 'option_sort', 'value' => $option_sort];

        if (null !== $atId) {
            $albumtypesObj = $this->get($atId);
            // Set Vars
            $albumtypesObj->setVar('at_name', $at_name);
            $albumtypesObj->setVar('at_primary', $primary);
            $albumtypesObj->setVar('at_credits', $at_credits);
            $albumtypesObj->setVar('at_template', $template);
            $albumtypesObj->setVar('at_options', serialize($options));
            $albumtypesObj->setVar('at_date', time());
            if ($this->insert($albumtypesObj)) {
                return true;
            }
        }

        return false;
    }
}
