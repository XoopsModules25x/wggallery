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

use Xmf\Request;
use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
//require_once XOOPS_ROOT_PATH . '/modules/wggallery/include/imagehandler.php';

$op    = Request::getString('op', 'list');
$albId = Request::getInt('alb_id');

// add scripts
$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/modules/wggallery/assets/js/admin.js');

$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

$maintainance_resize_desc = str_replace(['%mw', '%mh', '%tw', '%th'], [$helper->getConfig('maxwidth_medium'), $helper->getConfig('maxheight_medium'), $helper->getConfig('maxwidth_thumbs'), $helper->getConfig('maxheight_thumbs')], _AM_WGGALLERY_MAINTENANCE_RESIZE_DESC);

$maintainance_dui_desc = str_replace('%p', WGGALLERY_UPLOAD_IMAGE_PATH, _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC);

switch ($op) {
    case 'reset_gt':
    case 'delete_reset_gt':
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $success = [];
            $errors  = [];
            if ('delete_reset_gt' === $op) {
                // delete all existing gallerytypes
                $gallerytypesAll = $gallerytypesHandler->getAll();
                foreach (array_keys($gallerytypesAll) as $i) {
                    $gallerytypeObjDel = $gallerytypesHandler->get($gallerytypesAll[$i]->getVar('gt_id'));
                    if ($gallerytypesHandler->delete($gallerytypeObjDel, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $gallerytypeObjDel->getVar('gt_name');
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $gallerytypeObjDel->getVar('gt_name');
                        unset($gallerytypeObjDel);
                    }
                }
            }

            $gallerytypesHandler->gallerytypesCreateReset($success, $errors);

            $templateMain = 'wggallery_admin_maintenance.tpl';
            $err_text     = '';
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $err_text .= '<br>' . $error;
                }

                $GLOBALS['xoopsTpl']->assign('error', $err_text);
            }
            $success_text = '';
            foreach ($success as $s) {
                if ('' !== $success_text) {
                    $success_text .= '<br>';
                }
                $success_text .= $s;
            }
            $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
            // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
            // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
            $GLOBALS['xoopsTpl']->assign('show_gt', true);
            $GLOBALS['xoopsTpl']->assign('show_result', true);
        } elseif ('reset_gt' === $op) {
            xoops_confirm(['ok' => 1, 'op' => 'reset_gt'], $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_GT_SURERESET);
        } else {
            xoops_confirm(['ok' => 1, 'op' => 'delete_reset_gt'], $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE);
        }
        break;
    case 'reset_at':
    case 'delete_reset_at':
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $success = [];
            $errors  = [];
            if ('delete_reset_at' === $op) {
                // delete all existing albumtypes
                $albumtypesAll = $albumtypesHandler->getAll();
                foreach (array_keys($albumtypesAll) as $i) {
                    $albumtypeObjDel = $albumtypesHandler->get($albumtypesAll[$i]->getVar('gt_id'));
                    if ($albumtypesHandler->delete($albumtypeObjDel, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $albumtypeObjDel->getVar('gt_name');
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $albumtypeObjDel->getVar('gt_name');
                    }
                    unset($albumtypeObjDel);
                }
            }

            $albumtypesHandler->albumtypesCreateReset($success, $errors);

            $templateMain = 'wggallery_admin_maintenance.tpl';
            $err_text     = '';
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $err_text .= '<br>' . $error;
                }
                $GLOBALS['xoopsTpl']->assign('error', $err_text);
            }
            $success_text = '';
            foreach ($success as $s) {
                if ('' !== $success_text) {
                    $success_text .= '<br>';
                }
                $success_text .= $s;
            }
            $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
            // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
            // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
            $GLOBALS['xoopsTpl']->assign('show_at', true);
            $GLOBALS['xoopsTpl']->assign('show_result', true);
        } elseif ('reset_at' === $op) {
            xoops_confirm(['ok' => 1, 'op' => 'reset_at'], $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_AT_SURERESET);
        } else {
            xoops_confirm(['ok' => 1, 'op' => 'delete_reset_at'], $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE);
        }

        break;
    case 'resize_album_select':
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_AM_WGGALLERY_MAINTENANCE_RESIZE, 'form_resize', 'maintenance.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Select Parent Album
        $albumsHandler = $helper->getHandler('Albums');
        $rAlbid        = new \XoopsFormSelect(_AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT, 'resize_albid', 0);
        $rAlbid->addOption('', '&nbsp;');
        $albumsAll = $albumsHandler->getAll();
        foreach (array_keys($albumsAll) as $i) {
            $albName   = $albumsAll[$i]->getVar('alb_name');
            $albAlbPid = $albumsAll[$i]->getVar('alb_pid');
            if ($albAlbPid > 0) {
                $albumsObj = $albumsHandler->get($albAlbPid);
                $albName   .= ' (' . $albumsObj->getVar('alb_name') . ')';
            }
            $rAlbid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
        }
        $form->addElement($rAlbid, true);
        unset($criteria);
        $rTargetSelect = new \XoopsFormRadio(_AM_WGGALLERY_MAINTENANCE_RESIZE_SELECT, 'resize_target', 0);
        $rTargetSelect->addOption(Constants::IMAGE_ALL, _CO_WGGALLERY_IMAGE_ALL);
        $rTargetSelect->addOption(Constants::IMAGE_THUMB, _CO_WGGALLERY_IMAGE_THUMB);
        $rTargetSelect->addOption(Constants::IMAGE_MEDIUM, _CO_WGGALLERY_IMAGE_MEDIUM);
        $form->addElement($rTargetSelect, true);
        $form->addElement(new \XoopsFormHidden('op', 'resize_album'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        $form->display();
        break;
    case 'resize_album':
    case 'resize_medium':
    case 'resize_thumb':
        $counter       = 0;
        $success       = 0;
        $errors        = [];
        $resize_thumb  = 0;
        $resize_medium = 0;
        $resize_target = Request::getInt('resize_target');
        $resize_albid  = Request::getInt('resize_albid', 0);

        if ('resize_thumb' === $op) {
            $resize_thumb = 1;
        }
        if ('resize_medium' === $op) {
            $resize_medium = 1;
        }
        if ('resize_album' === $op) {
            if (Constants::IMAGE_ALL === $resize_target || Constants::IMAGE_THUMB === $resize_target) {
                $resize_thumb = 1;
            }
            if (Constants::IMAGE_ALL === $resize_target || Constants::IMAGE_MEDIUM === $resize_target) {
                $resize_medium = 1;
            }
        }
        $crImages = new \CriteriaCompo();
        if ($resize_albid > 0) {
            $crImages->add(new \Criteria('img_albid', $resize_albid));
        }
        $imagesCount = $imagesHandler->getCount($crImages);
        $imagesAll   = $imagesHandler->getAll($crImages);
        if ($imagesCount > 0) {
            foreach (array_keys($imagesAll) as $i) {
                $sourcefile = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imagesAll[$i]->getVar('img_namelarge');
                if (1 === $resize_medium) {
                    $counter++;
                    $maxwidth      = $helper->getConfig('maxwidth_medium');
                    $maxheight     = $helper->getConfig('maxheight_medium');
                    $target        = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/';
                    $endfile       = $target . $imagesAll[$i]->getVar('img_name');
                    $imageMimetype = $imagesAll[$i]->getVar('img_mimetype');
                    unlink($endfile);

                    $imgHandler                = new Wggallery\Resizer();
                    $imgHandler->sourceFile    = $sourcefile;
                    $imgHandler->endFile       = $endfile;
                    $imgHandler->imageMimetype = $imageMimetype;
                    $imgHandler->maxWidth      = $maxwidth;
                    $imgHandler->maxHeight     = $maxheight;
                    $result                    = $imgHandler->resizeImage();
                    if ('copy' === $result) {
                        unlink($endfile);
                        copy($sourcefile, $endfile);
                        $success++;
                    } elseif ($result) {
                        $success++;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE . $imagesAll[$i]->getVar('img_name');
                    }
                }
                if (1 === $resize_thumb) {
                    $counter++;
                    $maxwidth      = $helper->getConfig('maxwidth_thumbs');
                    $maxheight     = $helper->getConfig('maxheight_thumbs');
                    $target        = WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/';
                    $endfile       = $target . $imagesAll[$i]->getVar('img_name');
                    $imageMimetype = $imagesAll[$i]->getVar('img_mimetype');
                    unlink($endfile);

                    $imgHandler                = new Wggallery\Resizer();
                    $imgHandler->sourceFile    = $sourcefile;
                    $imgHandler->endFile       = $endfile;
                    $imgHandler->imageMimetype = $imageMimetype;
                    $imgHandler->maxWidth      = $maxwidth;
                    $imgHandler->maxHeight     = $maxheight;
                    $result                    = $imgHandler->resizeImage();
                    if ('copy' === $result) {
                        unlink($endfile);
                        copy($sourcefile, $endfile);
                        $success++;
                    } elseif ($result) {
                        $success++;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE . $imagesAll[$i]->getVar('img_name');
                    }
                }
            }
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $err_text .= '<br>' . $error;
            }
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        $success_text = str_replace(['%s', '%t'], [$success, $counter], _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE);

        $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_resize', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'delete_unused_images_show':
        $unused = [];
        $errors = [];

        $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/large';
        if (false === getUnusedImages($unused, $directory)) {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
        }
        $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium';
        if (false === getUnusedImages($unused, $directory)) {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
        }
        $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs';
        if (false === getUnusedImages($unused, $directory)) {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
        }
        $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/albums';
        if (false === getUnusedImages($unused, $directory)) {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
        }
        $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/temp';
        if (false === getUnusedImages($unused, $directory)) {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
        }

        $templateMain = 'wggallery_admin_maintenance.tpl';
        $unused_text  = '';
        $err_text     = '';
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $err_text .= '<br>' . $error;
            }
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($unused) > 0) {
            foreach ($unused as $image) {
                if ('' !== $unused_text) {
                    $unused_text .= '<br>';
                }
                $unused_text .= $image['path'];
            }
        } else {
            $unused_text = _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE;
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $unused_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_unnused', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'delete_unused_images':
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $success = [];
            $errors  = [];
            $unused  = [];

            $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/large';
            if (false === getUnusedImages($unused, $directory)) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
            }
            $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium';
            if (false === getUnusedImages($unused, $directory)) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
            }
            $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs';
            if (false === getUnusedImages($unused, $directory)) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
            }
            $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/albums';
            if (false === getUnusedImages($unused, $directory)) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
            }
            $directory = WGGALLERY_UPLOAD_IMAGE_PATH . '/temp';
            if (false === getUnusedImages($unused, $directory)) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_READDIR . $directory;
            }

            if (count($unused) > 0) {
                foreach ($unused as $image) {
                    unlink($image['path']);
                    if (file_exists($image['path'])) {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $image['path'];
                    } else {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $image['path'];
                    }
                }
            }

            $templateMain = 'wggallery_admin_maintenance.tpl';
            $err_text     = '';
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $err_text .= '<br>' . $error;
                }
                $GLOBALS['xoopsTpl']->assign('error', $err_text);
            }
            $success_text = '';
            foreach ($success as $s) {
                if ('' !== $success_text) {
                    $success_text .= '<br>';
                }
                $success_text .= $s;
            }

            // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
            $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
            $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
            $GLOBALS['xoopsTpl']->assign('show_unnused', true);
            $GLOBALS['xoopsTpl']->assign('show_result', true);
        } else {
            xoops_confirm(['ok' => 1, 'op' => 'delete_unused_images'], $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE);
        }
        break;
    case 'invalid_images_search':
        $success = [];
        $errors  = [];

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_name', ''));
        $imagesCount = $imagesHandler->getCount($crImages);
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll($crImages);
            foreach (array_keys($imagesAll) as $i) {
                $image     = $imagesAll[$i]->getValuesImages();
                $success[] = _AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG . $image['id'];
                unset($image);
            }
        } else {
            $errors[] = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }

        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $err_text .= '<br>' . $error;
            }
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        $success_text = '';
        foreach ($success as $s) {
            if ('' !== $success_text) {
                $success_text .= '<br>';
            }
            $success_text .= $s;
        }

        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_invalid', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'invalid_images_clean':
        $success = [];
        $errors  = [];

        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_name', '')); //TODO have to be checked in case of invalid items
        $imagesCount = $imagesHandler->getCount($crImages);
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll($crImages);
            foreach (array_keys($imagesAll) as $i) {
                $image     = $imagesAll[$i]->getValuesImages();
                $imagesObj = $imagesHandler->get($image['img_id']);
                if ($imagesHandler->delete($imagesObj, true)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . ': ' . _AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG . $image['id'];
                } else {
                    $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . ': ' . _AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG . $image['id'];
                }
                unset($imagesObj);
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }

        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $err_text .= '<br>' . $error;
            }
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        $success_text = '';
        foreach ($success as $s) {
            if ('' !== $success_text) {
                $success_text .= '<br>';
            }
            $success_text .= $s;
        }

        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_invalid', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'watermark_select':
        // Get Theme Form
        xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm(_AM_WGGALLERY_MAINTENANCE_WATERMARK, 'form', 'maintenance.php', 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        // Form Select Parent Album
        $albumsHandler = $helper->getHandler('Albums');
        $wmAlbid       = new \XoopsFormSelect(_AM_WGGALLERY_MAINTENANCE_ALBUM_SELECT, 'wm_albid', 0);
        $wmAlbid->addOption('', '&nbsp;');
        $albumsAll = $albumsHandler->getAll();
        foreach (array_keys($albumsAll) as $i) {
            $albName   = $albumsAll[$i]->getVar('alb_name');
            $albAlbPid = $albumsAll[$i]->getVar('alb_pid');
            if ($albAlbPid > 0) {
                $albumsObj = $albumsHandler->get($albAlbPid);
                $albName   .= ' (' . $albumsObj->getVar('alb_name') . ')';
            }
            $wmAlbid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
        }
        $form->addElement($wmAlbid, true);
        unset($criteria);
        // Form Select Album watermark
        $watermarksHandler = $helper->getHandler('Watermarks');
        $albWidSelect      = new \XoopsFormSelect(_CO_WGGALLERY_WATERMARK, 'wm_id', 0);
        $albWidSelect->addOption('', '&nbsp;');
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('wm_usage', Constants::WATERMARK_USAGENONE, '>'));
        $countWm = $watermarksHandler->getCount($criteria);
        if ($countWm > 0) {
            $albWidSelect->addOptionArray($watermarksHandler->getList($criteria));
        }
        $form->addElement($albWidSelect, true);
        unset($criteria);
        $wmTargetSelect = new \XoopsFormRadio(_CO_WGGALLERY_WATERMARK_TARGET, 'wm_target', 0);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_A, _CO_WGGALLERY_WATERMARK_TARGET_A);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_M, _CO_WGGALLERY_WATERMARK_TARGET_M);
        $wmTargetSelect->addOption(Constants::WATERMARK_TARGET_L, _CO_WGGALLERY_WATERMARK_TARGET_L);
        $form->addElement($wmTargetSelect, true);
        $form->addElement(new \XoopsFormHidden('op', 'watermark_add'));
        $form->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        $form->display();
        break;
    case 'watermark_add':
        $wmAlbid  = Request::getInt('wm_albid');
        $wmId     = Request::getInt('wm_id');
        $wmTarget = Request::getInt('wm_target');
        $success  = [];
        $errors   = [];
        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_albid', $wmAlbid));
        $imagesCount = $imagesHandler->getCount($crImages);
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll($crImages);
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                if (Constants::WATERMARK_TARGET_A === $wmTarget || Constants::WATERMARK_TARGET_M === $wmTarget) {
                    $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
                    $resWm = $watermarksHandler->watermarkImage($wmId, $imgWm, $imgWm);
                    if (true === $resWm) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $imgWm;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $imgWm . ' - ' . $resWm;
                    }
                }
                if (Constants::WATERMARK_TARGET_A === $wmTarget || Constants::WATERMARK_TARGET_L === $wmTarget) {
                    $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
                    $resWm = $watermarksHandler->watermarkImage($wmId, $imgWm, $imgWm);
                    if (true === $resWm) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $imgWm;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $imgWm . ' - ' . $resWm;
                    }
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        $success_text = '<ul>';
        foreach ($success as $s) {
            $success_text .= '<li>' . $s . '</li>';
        }
        $success_text .= '</ul>';
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);

        break;
    case 'broken_imgdir_search':
        $success     = [];
        $errors      = [];
        $imagesCount = $imagesHandler->getCount();
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
                if (!file_exists($imgWm)) {
                    $success[] = $imgWm;
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach ($success as $s) {
                $success_text .= '<li>' . $s . '</li>';
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_imgdir', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'broken_imgdir_clean':
        $success     = [];
        $errors      = [];
        $imagesCount = $imagesHandler->getCount();
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
                if (!file_exists($imgWm)) {
                    $imagesObj = $imagesHandler->get($image['img_id']);
                    if ($imagesHandler->delete($imagesObj, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $image['img_name'];
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $image['img_name'];
                    }
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach ($success as $s) {
                $success_text .= '<li>' . $s . '</li>';
            }
            $success_text .= '</ul>';
        } else {
            $success_text = '<ul>';
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_imgdir', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'broken_imgalb_search':
        $success     = [];
        $errors      = [];
        $imagesCount = $imagesHandler->getCount();
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();

                $crAlbums = new \CriteriaCompo();
                $crAlbums->add(new \Criteria('alb_id', $image['img_albid']));
                $albumsCount = $albumsHandler->getCount($crAlbums);
                if (0 == $albumsCount) {
                    $success[] = $image['img_name'];
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach ($success as $s) {
                $success_text .= '<li>' . $s . '</li>';
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_immgalb', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'broken_imgalb_clean':
        $success     = [];
        $errors      = [];
        $imagesCount = $imagesHandler->getCount();
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();

                $crAlbums = new \CriteriaCompo();
                $crAlbums->add(new \Criteria('alb_id', $image['img_albid']));
                $albumsCount = $albumsHandler->getCount($crAlbums);
                if (0 == $albumsCount) {
                    $imagesObj = $imagesHandler->get($image['img_id']);
                    if ($imagesHandler->delete($imagesObj, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $image['img_name'];
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $image['img_name'];
                    }
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach ($success as $s) {
                $success_text .= '<li>' . $s . '</li>';
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_immgalb', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'read_exif':
    case 'read_exifall':
        $success     = [];
        $errors      = [];
        $imagesCount = $imagesHandler->getCount();
        if ($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach (array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                if (('read_exif' === $op && '' == $image['img_exif']) || 'read_exifall' === $op) {
                    $imagesObj = $imagesHandler->get($image['img_id']);
                    $imgLarge  = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
                    $imgExif   = exif_read_data($imgLarge);
                    $imagesObj->setVar('img_exif', serialize($imgExif));
                    if ($imagesHandler->insert($imagesObj, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS . ': ' . $image['img_id'];
                    } else {
                        $errors[] = AM_WGGALLERY_MAINTENANCE_READ_EXIF_ERROR . ': ' . $image['img_id'];
                    }
                    unset($imagesObj);
                }
                unset($image);
            }
            // } else {
            // $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text     = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach ($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach ($success as $s) {
                $success_text .= '<li>' . $s . '</li>';
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS;
        }
        // $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
        // $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        $GLOBALS['xoopsTpl']->assign('result', $success_text . $err_text);
        $GLOBALS['xoopsTpl']->assign('show_exif', true);
        $GLOBALS['xoopsTpl']->assign('show_result', true);
        break;
    case 'system_check':
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wggallery_admin_maintenance.tpl';

        $system_check = [];
        // system checks
        // file_uploads Bestimmt, ob Datei-Uploads per HTTP erlaubt sind
        $type         = str_replace('%s', 'file_uploads', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_fu_ini = ini_get('file_uploads');
        $result1      = _AM_WGGALLERY_MAINTENANCE_CHECK_FU_DESC;
        $result2      = '';
        if ($value_fu_ini > 0) {
            $change  = false;
            $result1 .= _YES;
            $solve   = '';
        } else {
            $change  = true;
            $result1 .= _NO;
            $solve   = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2;
        }
        $system_check[] = ['type' => $type, 'info1' => _AM_WGGALLERY_MAINTENANCE_CHECK_FU_INFO, 'result1' => $result1, 'change' => $change, 'solve' => $solve];

        // post_max_size
        $type           = str_replace('%s', 'post_max_size', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini      = ini_get('post_max_size');
        $value_pms_php  = returnCleanBytes($value_ini);
        $maxsize_module = $helper->getConfig('maxsize');
        $result1        = str_replace(['%s', '%b'], [$value_ini, $value_pms_php], _AM_WGGALLERY_MAINTENANCE_CHECK_PMS_DESC);
        $result2        = str_replace('%s', $maxsize_module, _AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC);
        $change         = false;
        $solve          = '';
        if ($maxsize_module > $value_pms_php) {
            $change = true;
            $solve  = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1;
        }
        $system_check[] = ['type' => $type, 'info1' => _AM_WGGALLERY_MAINTENANCE_CHECK_PMS_INFO, 'result1' => $result1, 'result2' => $result2, 'change' => $change, 'solve' => $solve];

        // upload_max_filesize
        $type          = str_replace('%s', 'upload_max_filesize', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini     = ini_get('upload_max_filesize');
        $value_umf_php = returnCleanBytes($value_ini);
        $result1       = str_replace(['%s', '%b'], [$value_ini, $value_umf_php], _AM_WGGALLERY_MAINTENANCE_CHECK_UMF_DESC);
        $result2       = str_replace('%s', $maxsize_module, _AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC);
        $change        = false;
        $solve         = '';
        if ($maxsize_module > $value_umf_php) {
            $change = true;
            $solve  = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1;
        }
        $system_check[] = ['type' => $type, 'info1' => _AM_WGGALLERY_MAINTENANCE_CHECK_UMF_INFO, 'result1' => $result1, 'result2' => $result2, 'change' => $change, 'solve' => $solve];

        // memory_limit
        $type         = str_replace('%s', 'memory_limit', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini    = ini_get('memory_limit');
        $value_ml_php = returnCleanBytes($value_ini);
        $result1      = str_replace(['%s', '%b'], [$value_ini, $value_ml_php], _AM_WGGALLERY_MAINTENANCE_CHECK_ML_DESC);
        $result2      = '';
        $change       = false;
        $solve        = '';
        if ($value_pms_php > $value_ml_php || $value_umf_php > $value_ml_php) {
            $change = true;
            $solve  = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR3;
        }
        $system_check[] = ['type' => $type, 'info1' => _AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO1, 'info2' => _AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO2, 'result1' => $result1, 'change' => $change, 'solve' => $solve];

        $GLOBALS['xoopsTpl']->assign('system_check', $system_check);

        break;
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'wggallery_admin_maintenance.tpl';

        $maintainance_resize_desc = str_replace(['%mw', '%mh', '%tw', '%th'], [$helper->getConfig('maxwidth_medium'), $helper->getConfig('maxheight_medium'), $helper->getConfig('maxwidth_thumbs'), $helper->getConfig('maxheight_thumbs')], _AM_WGGALLERY_MAINTENANCE_RESIZE_DESC);
        $GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);

        $maintainance_dui_desc = str_replace('%p', WGGALLERY_UPLOAD_IMAGE_PATH, _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC);
        $GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);

        $GLOBALS['xoopsTpl']->assign('show_check', true);
        $GLOBALS['xoopsTpl']->assign('show_gt', true);
        $GLOBALS['xoopsTpl']->assign('show_at', true);
        $GLOBALS['xoopsTpl']->assign('show_resize', true);
        // $GLOBALS['xoopsTpl']->assign('show_invalid', true);
        $GLOBALS['xoopsTpl']->assign('show_unnused', true);
        $GLOBALS['xoopsTpl']->assign('show_imgdir', true);
        $GLOBALS['xoopsTpl']->assign('show_immgalb', true);
        $GLOBALS['xoopsTpl']->assign('show_wm', true);
        $GLOBALS['xoopsTpl']->assign('show_exif', true);

        break;
}

/**
 * @param $val
 * @return float|int
 */
function returnCleanBytes($val)
{
    switch (mb_substr($val, -1)) {
        case 'K':
        case 'k':
            return (int)$val * 1024;
        case 'M':
        case 'm':
            return (int)$val * 1048576;
        case 'G':
        case 'g':
            return (int)$val * 1073741824;
        default:
            return $val;
    }
}

/**
 * get unused images of given directory
 * @param array  $unused
 * @param string $directory
 * @return bool
 */
function getUnusedImages(&$unused, $directory)
{
    // Get instance of module
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper        = \XoopsModules\Wggallery\Helper::getInstance();
    $imagesHandler = $helper->getHandler('Images');
    $albumsHandler = $helper->getHandler('Albums');

    if (is_dir($directory)) {
        if ($handle = opendir($directory)) {
            while (false !== ($entry = readdir($handle))) {
                switch ($entry) {
                    case 'blank.gif':
                    case 'index.html':
                    case 'noimage.png':
                    case '..':
                    case '.':
                        break;
                    case 'default':
                    default:
                        if (WGGALLERY_UPLOAD_IMAGE_PATH . '/temp' === $directory) {
                            $unused[] = ['name' => $entry, 'path' => $directory . '/' . $entry];
                        } else {
                            $crImages = new \CriteriaCompo();
                            $crImages->add(new \Criteria('img_name', $entry));
                            $crImages->add(new \Criteria('img_namelarge', $entry), 'OR');
                            $imagesCount = $imagesHandler->getCount($crImages);
                            $crAlbums    = new \CriteriaCompo();
                            $crAlbums->add(new \Criteria('alb_image', $entry));
                            $imagesCount += $albumsHandler->getCount($crAlbums);
                            if (0 == $imagesCount) {
                                $unused[] = ['name' => $entry, 'path' => $directory . '/' . $entry];
                            }
                            unset($crImages);
                            unset($crAlbums);
                        }
                        break;
                }
            }
            closedir($handle);
        } else {
            return false;
        }
    } else {
        return false;
    }

    return true;
}

require __DIR__ . '/footer.php';
