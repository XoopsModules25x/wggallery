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

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class Object Images
 */
class Images extends \XoopsObject
{
    public $redirOp = '';

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('img_id', XOBJ_DTYPE_INT);
        $this->initVar('img_title', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_desc', XOBJ_DTYPE_TXTAREA);
        $this->initVar('img_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_namelarge', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_nameorig', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_mimetype', XOBJ_DTYPE_TXTBOX);
        $this->initVar('img_size', XOBJ_DTYPE_INT);
        $this->initVar('img_resx', XOBJ_DTYPE_INT);
        $this->initVar('img_resy', XOBJ_DTYPE_INT);
        $this->initVar('img_downloads', XOBJ_DTYPE_INT);
        $this->initVar('img_ratinglikes', XOBJ_DTYPE_INT);
        $this->initVar('img_votes', XOBJ_DTYPE_INT);
        $this->initVar('img_views', XOBJ_DTYPE_INT);
        $this->initVar('img_weight', XOBJ_DTYPE_INT);
        $this->initVar('img_albid', XOBJ_DTYPE_INT);
        $this->initVar('img_state', XOBJ_DTYPE_INT);
        $this->initVar('img_cats', XOBJ_DTYPE_TXTAREA);
        $this->initVar('img_tags', XOBJ_DTYPE_TXTAREA);
        $this->initVar('img_exif', XOBJ_DTYPE_TXTAREA);
        $this->initVar('img_date', XOBJ_DTYPE_INT);
        $this->initVar('img_submitter', XOBJ_DTYPE_INT);
        $this->initVar('img_ip', XOBJ_DTYPE_TXTAREA);
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
    }

    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }

    /**
     * The new inserted $Id
     * @return int inserted id
     */
    public function getNewInsertedIdImages()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();

        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $adminarea
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormImages($adminarea = false, $action = false)
    {
        /** @var \XoopsModules\Wggallery\Helper $helper */
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        // Title
        $title = $this->isNew() ? sprintf(_CO_WGGALLERY_IMAGE_ADD) : sprintf(_CO_WGGALLERY_IMAGE_EDIT);
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        $form->addElement(new \XoopsFormLabel('', "<img src='" . XOOPS_URL . '/uploads/wggallery/images/medium/' . $this->getVar('img_name') . "' name='" . $this->getVar('img_name') . "' id='imagepreview' alt='" . $this->getVar('img_name') . "' style='max-width:100%'>"));
        // Form Text ImgTitle
        $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_TITLE, 'img_title', 50, 255, $this->getVar('img_title')));
        // Form editor ImgDesc
        $editorConfigs           = [];
        $editorConfigs['name']   = 'img_desc';
        $editorConfigs['value']  = $this->getVar('img_desc', 'e');
        $editorConfigs['rows']   = 5;
        $editorConfigs['cols']   = 40;
        $editorConfigs['width']  = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $helper->getConfig('editor');
        $form->addElement(new \XoopsFormEditor(_CO_WGGALLERY_IMAGE_DESC, 'img_desc', $editorConfigs));
        $imgMimetype = $this->isNew() ? '0' : $this->getVar('img_mimetype');
        $imgSize     = $this->isNew() ? '0' : $this->getVar('img_size');
        $imgResx     = $this->isNew() ? '0' : $this->getVar('img_resx');
        $imgResy     = $this->isNew() ? '0' : $this->getVar('img_resy');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_NAME, 'img_name', 50, 255, $this->getVar('img_name')), true);
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_NAMELARGE, 'img_namelarge', 50, 255, $this->getVar('img_namelarge')), true);
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_NAMEORIG, 'img_nameorig', 50, 255, $this->getVar('img_nameorig')), true);
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_MIMETYPE, 'img_mimetype', 20, 150, $imgMimetype));
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_SIZE, 'img_size', 20, 150, $imgSize));
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_RESX, 'img_resx', 20, 150, $imgResx));
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_RESY, 'img_resy', 20, 150, $imgResy));
        } else {
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_NAME, $this->getVar('img_name')));
            //$form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_NAMELARGE, $this->getVar('img_namelarge')));
            //$form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_NAMEORIG, $this->getVar('img_nameorig')));
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_MIMETYPE, $imgMimetype));
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_SIZE, $imgSize));
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_RESX, $imgResx));
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_RESY, $imgResy));
            $form->addElement(new \XoopsFormHidden('img_name', $this->getVar('img_name')));
            $form->addElement(new \XoopsFormHidden('img_namelarge', $this->getVar('img_namelarge')));
            $form->addElement(new \XoopsFormHidden('img_nameorig', $this->getVar('img_nameorig')));
            $form->addElement(new \XoopsFormHidden('img_mimetype', $imgMimetype));
            $form->addElement(new \XoopsFormHidden('img_size', $imgSize));
            $form->addElement(new \XoopsFormHidden('img_resx', $imgResx));
            $form->addElement(new \XoopsFormHidden('img_resy', $imgResy));
        }

        // Form Text ImgDownloads
        $imgDownloads = $this->isNew() ? '0' : $this->getVar('img_downloads');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_DOWNLOADS, 'img_downloads', 20, 150, $imgDownloads));
        } else {
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_DOWNLOADS, $imgDownloads));
            $form->addElement(new \XoopsFormHidden('img_downloads', $imgDownloads));
        }

        // Form Text ImgRatinglikes
        // Form Text ImgVotes
        $imgRatinglikes = $this->isNew() ? '0' : $this->getVar('img_ratinglikes');
        $imgVotes       = $this->isNew() ? '0' : $this->getVar('img_votes');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_RATINGLIKES, 'img_ratinglikes', 20, 150, $imgRatinglikes));
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_VOTES, 'img_votes', 20, 150, $imgVotes));
        } else {
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_RATINGLIKES, $imgRatinglikes));
            $form->addElement(new \XoopsFormHidden('img_ratinglikes', $imgRatinglikes));
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_VOTES, $imgVotes));
            $form->addElement(new \XoopsFormHidden('img_votes', $imgVotes));
        }
        // Form Text ImgViews
        $imgViews = $this->isNew() ? '0' : $this->getVar('img_views');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_VIEWS, 'img_views', 20, 150, $imgViews));
        } else {
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_VIEWS, $imgViews));
            $form->addElement(new \XoopsFormHidden('img_views', $imgViews));
        }
        // Form Text ImgWeight
        $imgWeight = $this->isNew() ? '0' : $this->getVar('img_weight');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_WEIGHT, 'img_weight', 20, 150, $imgWeight));
        } else {
            $form->addElement(new \XoopsFormHidden('img_weight', $imgWeight));
        }
        // Form Table albums
        $imgAlbidSelect = new \XoopsFormSelect(_CO_WGGALLERY_IMAGE_ALBID, 'img_albid', $this->getVar('img_albid'));
        $albumsHandler      = $helper->getHandler('Albums');
        $permissionsHandler = $helper->getHandler('Permissions');
        $crAlbums = new \CriteriaCompo();
        $crAlbums->add(new \Criteria('alb_iscoll', 0));
        $crAlbums->setSort('alb_weight ASC, alb_date');
        $crAlbums->setOrder('DESC');
        $albumsAll = $albumsHandler->getAll($crAlbums);

        foreach (array_keys($albumsAll) as $i) {
            if ($permissionsHandler->permAlbumEdit($albumsAll[$i]->getVar('alb_id'), $albumsAll[$i]->getVar('alb_submitter'))) {
                $albId   = $albumsAll[$i]->getVar('alb_id');
                $albName = $albumsAll[$i]->getVar('alb_name');
                $albPid  = $albumsAll[$i]->getVar('alb_pid');
                if ($albPid > 0) {
                    $albumsObj = $albumsHandler->get($albPid);
                    if (is_object($albumsObj)) {
                        $albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
                    } else {
                        $albName .= ' (' . _CO_WGGALLERY_FORM_ERROR_ALBPID . ')';
                    }
                }
                $imgAlbidSelect->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
            }
        }
        $form->addElement($imgAlbidSelect, true);

        // Images handler
        $imagesHandler = $helper->getHandler('Images');
        // Form Select Images
        $imgStateSelect = new \XoopsFormSelect(_CO_WGGALLERY_IMAGE_STATE, 'img_state', $this->getVar('img_state'));
        $imgStateSelect->addOption(Constants::STATE_OFFLINE_VAL, _CO_WGGALLERY_STATE_OFFLINE);
        $imgStateSelect->addOption(Constants::STATE_ONLINE_VAL, _CO_WGGALLERY_STATE_ONLINE);
        $imgStateSelect->addOption(Constants::STATE_APPROVAL_VAL, _CO_WGGALLERY_STATE_APPROVAL);
        $form->addElement($imgStateSelect, true);

        // Form Text Select AlbCats
        $imgCats = $this->isNew() ? '' : unserialize($this->getVar('img_cats'));
        if ($helper->getConfig('use_categories')) {
            $categoriesHandler = $helper->getHandler('Categories');
            $crCategories      = new \CriteriaCompo();
            $crCategories->add(new \Criteria('cat_image', 1));
            $categoriesCount = $categoriesHandler->getCount($crCategories);
            if ($categoriesCount > 0) {
                $crCategories->setSort('cat_weight ASC, cat_text');
                $crCategories->setOrder('ASC');
                $categoriesAll    = $categoriesHandler->getAll($crCategories);
                $selectCategories = new \XoopsFormCheckBox(_CO_WGGALLERY_CATS_SELECT, 'img_cats', $imgCats);
                foreach (array_keys($categoriesAll) as $i) {
                    $selectCategories->addOption($categoriesAll[$i]->getVar('cat_id'), $categoriesAll[$i]->getVar('cat_text'));
                }
                $form->addElement($selectCategories, false);
            }
        } else {
            $form->addElement(new \XoopsFormHidden('img_cats', $imgCats));
        }
        // Form Text AlbTags
        if ($helper->getConfig('use_tags')) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_TAGS_ENTER, 'img_tags', 50, 255, $this->getVar('img_tags')), false);
        } else {
            $form->addElement(new \XoopsFormHidden('img_tags', $this->getVar('img_tags')));
        }

        $img_exif = $this->getVar('img_exif');
        if ($adminarea) {
            // Form editor ImgExif
            $editorConfigs           = [];
            $editorConfigs['name']   = 'img_exif';
            $editorConfigs['value']  = $img_exif;
            $editorConfigs['rows']   = 10;
            $editorConfigs['cols']   = 40;
            $editorConfigs['width']  = '100%';
            $editorConfigs['height'] = '400px';
            $editorConfigs['editor'] = 'dhtml';
            $form->addElement(new \XoopsFormEditor(_CO_WGGALLERY_IMAGE_EXIF, 'img_exif', $editorConfigs));
        }

        // Form Text ImgIp
        $imgIp = $this->getVar('img_ip');
        if ($adminarea) {
            $form->addElement(new \XoopsFormText(_CO_WGGALLERY_IMAGE_IP, 'img_ip', 20, 150, $imgIp));
        } else {
            $form->addElement(new \XoopsFormLabel(_CO_WGGALLERY_IMAGE_IP, $imgIp));
            $form->addElement(new \XoopsFormHidden('img_ip', $imgIp));
        }
        // Form Text Date Select ImgDate
        $imgDate = $this->isNew() ? 0 : $this->getVar('img_date');
        $form->addElement(new \XoopsFormTextDateSelect(_CO_WGGALLERY_DATE, 'img_date', '', $imgDate));
        // Form Select User ImgSubmitter
        $form->addElement(new \XoopsFormSelectUser(_CO_WGGALLERY_SUBMITTER, 'img_submitter', false, $this->getVar('img_submitter')));

        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('redir_op', $this->redirOp));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param int  $maxDepth
     * @return array
     */
    public function getValuesImages($keys = null, $format = null, $maxDepth = null)
    {
        $helper             = \XoopsModules\Wggallery\Helper::getInstance();
        $ret                = $this->getValues($keys, $format, $maxDepth);
        $ret['id']          = $this->getVar('img_id');
        $ret['title']       = $this->getVar('img_title');
        $ret['desc']        = $this->getVar('img_desc', 'n');
        $ret['name']        = $this->getVar('img_name');
        $ret['namelarge']   = $this->getVar('img_namelarge');
        $ret['nameorig']    = $this->getVar('img_nameorig');
        $ret['mimetype']    = $this->getVar('img_mimetype');
        $ret['size']        = $this->getVar('img_size');
        $ret['resx']        = $this->getVar('img_resx');
        $ret['resy']        = $this->getVar('img_resy');
        $ret['downloads']   = $this->getVar('img_downloads');
        $ret['ratinglikes'] = $this->getVar('img_ratinglikes');
        $ret['votes']       = $this->getVar('img_votes');
        $ret['views']       = $this->getVar('img_views');
        $ret['weight']      = $this->getVar('img_weight');
        $ret['albid']       = $this->getVar('img_albid');
        //$albums             = $helper->getHandler('Albums');
        // $albumsObj = $albums->get($this->getVar('img_albid'));
        // if (isset($albumsObj) && is_object($albumsObj)) {
        // $ret['alb_name'] = $albumsObj->getVar('alb_name');
        // }
        $ret['state']      = $this->getVar('img_state');
        $ret['state_text'] = $helper->getStateText($this->getVar('img_state'));
        $ret['date']       = formatTimestamp($this->getVar('img_date'), 's');
        $ret['submitter']  = \XoopsUser::getUnameFromId($this->getVar('img_submitter'));
        $ret['ip']         = $this->getVar('img_ip');
        $exif_text         = '';
        $exif_short        = '';
        $exif              = $this->getVar('img_exif');
        $ret['exifs']      = [];
        if ($helper->getConfig('store_exif') && '' !== $exif) {
            $exifs = json_decode($exif, true);
            if (is_array($exifs)) {
                $exif_types = $helper->getConfig('exif_types');
                foreach ($exifs as $key => $value) {
                    if (in_array('all', $exif_types) || in_array($key, $exif_types)) {
                        $ret['exifs'][preg_replace('/[^a-zA-Z0-9]/', '', $key)] = $value;
                        if (is_array($value)) {
                            $exif_text .= $key . ': <br>';
                            foreach ($value as $skey => $svalue) {
                                $exif_text .= ' - ' . $skey . ': ' . $svalue . '<br>';
                            }
                        } else {
                            $newvalue = $value;
                            switch ($key) {
                                case 'Make':
                                    $exif_text .= _CO_WGGALLERY_EXIF_CAMERA;
                                    break;
                                case 'Model':
                                    $exif_text .= _CO_WGGALLERY_EXIF_MODEL;
                                    break;
                                case 'ExposureTime':
                                    $exif_text .= _CO_WGGALLERY_EXIF_EXPTIME;
                                    break;
                                case 'FocalLength':
                                    $exif_text .= _CO_WGGALLERY_EXIF_FOCALLENGTH;
                                    break;
                                case 'DateTimeOriginal':
                                    $exif_text .= _CO_WGGALLERY_EXIF_DATETIMEORIG;
                                    $newvalue  = formatTimestamp($value);
                                    break;
                                case 'ISOSpeedRatings':
                                    $exif_text .= _CO_WGGALLERY_EXIF_ISO;
                                    break;
                                case 'FileName':
                                    $exif_text .= _CO_WGGALLERY_EXIF_FILENAME;
                                    break;
                                case 'FileDateTime':
                                    $exif_text .= _CO_WGGALLERY_EXIF_FILEDATETIME;
                                    $newvalue  = formatTimestamp($value);
                                    break;
                                case 'FileSize':
                                    $exif_text .= _CO_WGGALLERY_EXIF_FILESIZE;
                                    break;
                                case 'MimeType':
                                    $exif_text .= _CO_WGGALLERY_EXIF_MIMETYPE;
                                    break;
                                case 'UndefinedTag:0xA434':
                                    $exif_text .= _CO_WGGALLERY_EXIF_LENSMODEL;
                                    break;
                                case 'UndefinedTag:0xA433':
                                    $exif_text .= _CO_WGGALLERY_EXIF_LENSMAKE;
                                    break;
                                case 'default':
                                default:
                                    $exif_text .= $key;
                                    break;
                            }
                            $exif_text .= ': ' . $newvalue . '<br>';
                        }
                    }
                }
            } else {
                $exif_text = 'Unexpected error json_decode:' . ($this->getVar('img_exif'));
            }
            if (mb_strlen($exif_text) > 500) {
                $exif_short = mb_substr($exif_text, 0, 500) . '...';
            } else {
                $exif_short = $exif_text;
            }
        }
        $ret['exif']       = $exif_text;
        $ret['exif_short'] = $exif_short;
        $ret['large']      = WGGALLERY_UPLOAD_IMAGES_URL . '/large/' . $this->getVar('img_namelarge');
        $ret['medium']     = WGGALLERY_UPLOAD_IMAGES_URL . '/medium/' . $this->getVar('img_name');
        $ret['thumb']      = WGGALLERY_UPLOAD_IMAGES_URL . '/thumbs/' . $this->getVar('img_name');
        $ret['cats']       = $this->getVar('alb_cats');
        $imgCats           = unserialize($this->getVar('img_cats'));
        $ret['cats_list']  = $helper->getHandler('Categories')->getCatsList($imgCats);
        $ret['tags']       = $this->getVar('img_tags');

        if ($helper->getConfig('com_rule') > 0) {
            $ret['com_show'] = 1;
            // count comments
            $commentHandler = xoops_getHandler('comment');
            $criteria       = new \CriteriaCompo();
            $criteria->add(new \Criteria('com_itemid', $this->getVar('img_id')));
            $criteria->add(new \Criteria('com_status', '0', '>'));
            $criteria->setSort('com_created');
            $criteria->setOrder('DESC');
            $com_count        = $commentHandler->getCount($criteria);
            $ret['com_count'] = $com_count;
            if (1 == $com_count) {
                $ret['com_count_text'] = $com_count . ' ' . _CO_WGGALLERY_COMMENT;
            } else {
                $ret['com_count_text'] = $com_count . ' ' . _CO_WGGALLERY_COMMENTS;
            }
        }

        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayImages()
    {
        $ret  = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }

        return $ret;
    }
}
