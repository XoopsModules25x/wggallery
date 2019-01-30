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
 * @version        $Id: 1.0 gallerytypes.php 1 Sat 2018-03-31 11:31:09Z XOOPS Project (www.xoops.org) $
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Handler Gallerytypes
 */
class GallerytypesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'wggallery_gallerytypes', Gallerytypes::class, 'gt_id', 'gt_name');
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
     * @param int        $i field id
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
     * Get Count Gallerytypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountGallerytypes($start = 0, $limit = 0, $sort = 'gt_id ASC, gt_name', $order = 'ASC')
    {
        $crCountGallerytypes = new \CriteriaCompo();
        $crCountGallerytypes = $this->getGallerytypesCriteria($crCountGallerytypes, $start, $limit, $sort, $order);

        return parent::getCount($crCountGallerytypes);
    }

    /**
     * Get All Gallerytypes in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllGallerytypes($start = 0, $limit = 0, $sort = 'gt_id ASC, gt_name', $order = 'ASC')
    {
        $crAllGallerytypes = new \CriteriaCompo();
        $crAllGallerytypes = $this->getGallerytypesCriteria($crAllGallerytypes, $start, $limit, $sort, $order);

        return parent::getAll($crAllGallerytypes);
    }

    /**
     * Get Criteria Gallerytypes
     * @param        $crGallerytypes
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getGallerytypesCriteria($crGallerytypes, $start, $limit, $sort, $order)
    {
        $crGallerytypes->setStart($start);
        $crGallerytypes->setLimit($limit);
        $crGallerytypes->setSort($sort);
        $crGallerytypes->setOrder($order);

        return $crGallerytypes;
    }

    /**
     * Get primary Gallerytype
     * @return array
     */
    public function getPrimaryGallery()
    {
        $gallerytype    = [];
        $crGallerytypes = new \CriteriaCompo();
        $crGallerytypes->add(new \Criteria('gt_primary', 1));
        $crGallerytypes->setLimit(1);
        $gallerytypesAll = $this->getAll($crGallerytypes);
        foreach (array_keys($gallerytypesAll) as $i) {
            $gallerytype['name']     = $gallerytypesAll[$i]->getVar('gt_name');
            $gallerytype['template'] = $gallerytypesAll[$i]->getVar('gt_template');
            $gallerytype['options']  = $gallerytypesAll[$i]->getVar('gt_options', 'N');
        }

        return $gallerytype;
    }

    /**
     * Create Gallerytypes
     * @param $success
     * @param $errors
     * @return void
     */
    public function gallerytypesCreateReset(&$success, &$errors)
    {
        // create new gallerytypes if not existing
        $templates = ['none', 'lightbox2', 'justifiedgallery', 'viewerjs', 'jssor', 'lclightboxlite'];
        foreach ($templates as $template) {
            $gtCount        = 0;
            $crGallerytypes = new \CriteriaCompo();
            $crGallerytypes->add(new \Criteria('gt_template', $template));
            $crGallerytypes->setLimit(1);
            $gtCount = $this->getCount($crGallerytypes);
            if ($gtCount < 1) {
                $gallerytypesObj = $this->create();
                $gallerytypesObj->setVar('gt_name', $template);
                $gallerytypesObj->setVar('gt_template', $template);
                if ($this->insert($gallerytypesObj)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
                } else {
                    $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
                }
            }
            unset($gallerytypeObj);
            unset($crGallerytypes);
        }

        // reset all gallerytypes
        $count_pr       = 0;
        $crGallerytypes = new \CriteriaCompo();
        $crGallerytypes->add(new \Criteria('gt_primary', 1));
        $gallerytypesAll = $this->getAll($crGallerytypes);
        foreach (array_keys($gallerytypesAll) as $i) {
            if ($this->reset($gallerytypesAll[$i]->getVar('gt_id'), $gallerytypesAll[$i]->getVar('gt_template'), 1)) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $gallerytypesAll[$i]->getVar('gt_name');
                $count_pr++;
            } else {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
            }
        }
        unset($crGallerytypes);
        $crGallerytypes = new \CriteriaCompo();
        $crGallerytypes->add(new \Criteria('gt_primary', 0));
        $gallerytypesAll = $this->getAll($crGallerytypes);
        foreach (array_keys($gallerytypesAll) as $i) {
            $primary = 0;
            if (0 == $count_pr) {
                $primary = 1;
            }
            if ($this->reset($gallerytypesAll[$i]->getVar('gt_id'), $gallerytypesAll[$i]->getVar('gt_template'), $primary)) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $gallerytypesAll[$i]->getVar('gt_name');
                $count_pr++;
            } else {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $gallerytypesAll[$i]->getVar('gt_template');
            }
        }
        unset($crGallerytypes);
    }

    /**
     * Reset Gallerytype
     * @param int $gtId
     * @param     $template
     * @param     $primary
     * @return boolean
     */
    public function reset($gtId, $template, $primary)
    {
        $options = [];
        switch ($template) {
            case 'none':
                $gt_name    = 'none';
                $gt_credits = '';
                break;
            case 'lclightboxlite':
                $gt_name    = 'LC Lightbox LITE';
                $gt_credits = 'https://lcweb.it/<br>https://github.com/LCweb-ita/LC-Lightbox-LITE';
                $options[]  = ['name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
                $options[]  = ['name' => 'source_preview', 'value' => 'thumb', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW'];
                $options[]  = ['name' => 'lcl_maxwidth', 'value' => '93', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH'];
                $options[]  = ['name' => 'lcl_maxheight', 'value' => '93', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH'];
                $options[]  = ['name' => 'lcl_backgroundcolor', 'value' => '#cccccc', 'caption' => '_AM_WGGALLERY_OPTION_GT_BACKGROUND'];
                $options[]  = ['name' => 'opacity', 'value' => '0.8', 'caption' => '_AM_WGGALLERY_OPTION_OPACITIY'];
                $options[]  = ['name' => 'lcl_backgroundheight', 'value' => '75vh', 'caption' => '_AM_WGGALLERY_OPTION_GT_BACKHEIGHT'];
                $options[]  = ['name' => 'lcl_borderwidth', 'value' => '2', 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERWIDTH'];
                $options[]  = ['name' => 'lcl_bordercolor', 'value' => '#cccccc', 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERCOLOR'];
                $options[]  = ['name' => 'lcl_borderpadding', 'value' => '5', 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERPADDING'];
                $options[]  = ['name' => 'lcl_borderradius', 'value' => '5', 'caption' => '_AM_WGGALLERY_OPTION_GT_BORDERRADIUS'];
                $options[]  = ['name' => 'lcl_shadow', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHADOW'];
                $options[]  = ['name' => 'lcl_dataposition', 'value' => 'over', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION'];
                $options[]  = ['name' => 'lcl_cmdposition', 'value' => 'inner', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION'];
                $options[]  = ['name' => 'lcl_skin', 'value' => 'light', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSKIN'];
                $options[]  = ['name' => 'lcl_navbtnpos', 'value' => 'normal', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS'];
                $options[]  = ['name' => 'lcl_slideshow', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW'];
                $options[]  = ['name' => 'lcl_counter', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLCOUNTER'];
                $options[]  = ['name' => 'lcl_progressbar', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR'];
                $options[]  = ['name' => 'lcl_socials', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLSOCIALS'];
                $options[]  = ['name' => 'lcl_download', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD'];
                $options[]  = ['name' => 'lcl_txttogglecmd', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT'];
                $options[]  = ['name' => 'lcl_fullscreen', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN'];
                $options[]  = ['name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'showDescr', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];
                $options[]  = ['name' => 'showSubmitter', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWSUBMITTER'];
                $options[]  = ['name' => 'lcl_carousel', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
                $options[]  = ['name' => 'speedOpen', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN'];
                $options[]  = ['name' => 'transitionDuration', 'value' => '200', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION'];
                $options[]  = ['name' => 'lcl_animationtime', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_ANIMTIME'];
                $options[]  = ['name' => 'slideshowSpeed', 'value' => '5000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
                $options[]  = ['name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY'];
                $options[]  = ['name' => 'lcl_rclickprevent', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLRCLICK'];
                $options[]  = ['name' => 'showThumbnails', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS'];
                $options[]  = ['name' => 'thumbsWidth', 'value' => '100', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH'];
                $options[]  = ['name' => 'thumbsHeight', 'value' => '100', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH'];
                $options[]  = ['name' => 'lcl_fsimgbehavior', 'value' => 'smart', 'caption' => '_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR'];

                break;
            case 'jssor':
                $gt_name    = 'Jssor';
                $gt_credits = 'https://www.jssor.com<br>https://www.jssor.com/development/index.html';
                $options[]  = ['name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
                $options[]  = ['name' => 'jssor_arrows', 'value' => 'arrow-051', 'caption' => '_AM_WGGALLERY_OPTION_GT_ARROWS'];
                $options[]  = ['name' => 'jssor_bullets', 'value' => 'none', 'caption' => '_AM_WGGALLERY_OPTION_GT_BULLETS'];
                $options[]  = ['name' => 'jssor_thumbnails', 'value' => 'thumbnail-051', 'caption' => '_AM_WGGALLERY_OPTION_GT_THUMBNAILS'];
                $options[]  = ['name' => 'jssor_thumborient', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_ORIENTATION'];
                $options[]  = ['name' => 'jssor_loadings', 'value' => 'loading-003-oval', 'caption' => '_AM_WGGALLERY_OPTION_GT_LOADINGS'];
                $options[]  = ['name' => 'jssor_autoplay', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
                $options[]  = ['name' => 'slideshowSpeed', 'value' => '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
                $options[]  = ['name' => 'transitionDuration', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION'];
                $options[]  = ['name' => 'jssor_fillmode', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_FILLMODE'];
                $options[]  = ['name' => 'jssor_transition', 'value' => '{$Duration:800,$Opacity:2}', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT'];
                $options[]  = ['name' => 'jssor_transitionorder', 'value' => '0', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSORDER'];
                $options[]  = ['name' => 'jssor_slidertype', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDERTYPE'];
                $options[]  = ['name' => 'jssor_maxwidth', 'value' => '900', 'caption' => '_AM_WGGALLERY_OPTION_GT_MAXWIDTH'];
                $options[]  = ['name' => 'jssor_maxheight', 'value' => '600', 'caption' => '_AM_WGGALLERY_OPTION_GT_MAXHEIGHT'];
                break;
            case 'lightbox2':
                $gt_name    = 'Lightbox2';
                $gt_credits = 'https://lokeshdhakar.com';
                $options[]  = ['name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
                $options[]  = ['name' => 'source_preview', 'value' => 'thumb', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW'];
                $options[]  = ['name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'showDescr', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWDESCR'];
                $options[]  = ['name' => 'showAlbumlabel', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWLABEL'];
                $options[]  = ['name' => 'slideshowSpeed', 'value' => '1000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
                $options[]  = ['name' => 'speedOpen', 'value' => '600', 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN'];
                $options[]  = ['name' => 'indexImage', 'value' => 'fixedHeight', 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMG'];
                $options[]  = ['name' => 'indexImageheight', 'value' => '200', 'caption' => '_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT'];
                break;
            case 'justifiedgallery':
                $gt_name    = 'Justified Gallery with Colorbox';
                $gt_credits = 'http://miromannino.com/';
                $options[]  = ['name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
                $options[]  = ['name' => 'source_preview', 'value' => 'thumb', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW'];
                $options[]  = ['name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'rowHeight', 'value' => '150', 'caption' => '_AM_WGGALLERY_OPTION_GT_ROWHEIGHT'];
                $options[]  = ['name' => 'lastRow', 'value' => 'nojustify', 'caption' => '_AM_WGGALLERY_OPTION_GT_LASTROW'];
                $options[]  = ['name' => 'margins', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_MARGINS'];
                $options[]  = ['name' => 'outerborder', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_OUTERBORDER'];
                $options[]  = ['name' => 'randomize', 'value' => 'false', 'caption' => '_AM_WGGALLERY_OPTION_GT_RANDOMIZE'];
                $options[]  = ['name' => 'slideshow', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOW'];
                $options[]  = ['name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY'];
                $options[]  = ['name' => 'transition', 'value' => 'elastic', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSEFFECT'];
                $options[]  = ['name' => 'slideshowSpeed', 'value' => '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
                $options[]  = ['name' => 'speedOpen', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_SPEEDOPEN'];
                $options[]  = ['name' => 'open', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOOPEN'];
                $options[]  = ['name' => 'colorboxstyle', 'value' => 'style1', 'caption' => '_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE'];
                $options[]  = ['name' => 'opacity', 'value' => '0.8', 'caption' => '_AM_WGGALLERY_OPTION_OPACITIY'];
                break;
            /*             case 'blueimpgallery':
                            $gt_name = 'Blueimp Gallery';
                            $gt_credits = 'Sebastian Tschan, https://blueimp.net';
                            $gt_primary = $primary;
                            $options[] = array('name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE');
                            $options[] = array('name' => 'source_preview', 'value' => 'thumb', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW');
                            $options[] = array('name' => 'slideshowtype', 'value' => 'lightbox', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE');
                            $options[] = array('name' => 'slideshowSpeed', 'value'=> '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED');
                            $options[] = array('name' => 'transitionDuration', 'value' => '500', 'caption' => '_AM_WGGALLERY_OPTION_GT_TRANSDURATION');
                            $options[] = array('name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY');
                            $options[] = array('name' => 'showThumbnails', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS');
                            $options[] = array('name' => 'showTitle', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE');
                        break; */
            case 'viewerjs':
                $gt_name    = 'ViewerJs';
                $gt_credits = 'http://chenfengyuan.com';
                $options[]  = ['name' => 'source', 'value' => 'large', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE'];
                $options[]  = ['name' => 'source_preview', 'value' => 'thumb', 'caption' => '_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW'];
                $options[]  = ['name' => 'button_close', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE'];
                $options[]  = ['name' => 'navbar', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_NAVBAR'];
                $options[]  = ['name' => 'viewerjs_title', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_SHOWTITLE'];
                $options[]  = ['name' => 'toolbar', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBAR'];
                $options[]  = ['name' => 'zoomable', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM'];
                $options[]  = ['name' => 'download', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD'];
                $options[]  = ['name' => 'fullscreen', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_FULLSCREEN'];
                $options[]  = ['name' => 'loop', 'value' => '1', 'caption' => '_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS'];
                $options[]  = ['name' => 'slideshowSpeed', 'value' => '3000', 'caption' => '_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED'];
                $options[]  = ['name' => 'open', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOOPEN'];
                $options[]  = ['name' => 'slideshowAuto', 'value' => 'true', 'caption' => '_AM_WGGALLERY_OPTION_GT_AUTOPLAY'];
                break;
            case 'default':
            default:
                redirect_header('gallerytypes.php?op=list', 3, 'Invalid template name:' . $template);
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

        if (null !== $gtId) {
            $gallerytypesObj = $this->get($gtId);
            // Set Vars
            $gallerytypesObj->setVar('gt_primary', $primary);
            $gallerytypesObj->setVar('gt_name', $gt_name);
            $gallerytypesObj->setVar('gt_credits', $gt_credits);
            $gallerytypesObj->setVar('gt_template', $template);
            $gallerytypesObj->setVar('gt_options', serialize($options));
            $gallerytypesObj->setVar('gt_date', time());
            // Insert Data
            if ($this->insert($gallerytypesObj)) {
                return true;
            }
        }

        return false;
    }
}
