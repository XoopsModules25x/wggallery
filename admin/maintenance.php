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

include __DIR__ . '/header.php';
$op    = Request::getString('op', 'list');
$albId = Request::getInt('alb_id');

// add scripts 
$GLOBALS['xoTheme']->addScript( XOOPS_URL . '/modules/wggallery/assets/js/admin.js' );

$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '/16');

$maintainance_resize_desc = str_replace(array('%mw', '%mh', '%tw', '%th'), array($wggallery->getConfig('maxwidth_medium'), $wggallery->getConfig('maxheight_medium'), $wggallery->getConfig('maxwidth_thumbs'), $wggallery->getConfig('maxheight_thumbs')), _AM_WGGALLERY_MAINTENANCE_RESIZE_DESC);

$maintainance_dui_desc = str_replace('%p', WGGALLERY_UPLOAD_IMAGE_PATH, _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC);

switch($op) {
	case 'reset_gt':
	case 'delete_reset_gt':
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $success = array();
            $errors  = array();
            if ('delete_reset_gt' === $op) {
                // delete all existing gallerytypes
                $gallerytypesAll = $gallerytypesHandler->getAll();
                foreach(array_keys($gallerytypesAll) as $i) {
                    $gallerytypeObjDel = $gallerytypesHandler->get($gallerytypesAll[$i]->getVar('gt_id'));
                    if($gallerytypesHandler->delete($gallerytypeObjDel, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $gallerytypeObjDel->getVar('gt_name');
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $gallerytypeObjDel->getVar('gt_name');
                        unset($gallerytypeObjDel);
                    } 
                }	
			}
			// create new gallerytypes if not existing
            $templates = array('none', 'lightbox2', 'justifiedgallery', 'viewerjs', 'jssor', 'lclightboxlite');
            foreach($templates as $template) {
                $gtCount = 0;
                $crGallerytypes = new CriteriaCompo();
                $crGallerytypes->add(new Criteria('gt_template', $template));
                $crGallerytypes->setLimit( 1 );
                $gtCount = $gallerytypesHandler->getCount($crGallerytypes);
                if (1 > $gtCount) {           
                    $gallerytypesObj = $gallerytypesHandler->create();
                    $gallerytypesObj->setVar('gt_name', $template);
                    $gallerytypesObj->setVar('gt_template', $template);
                    if($gallerytypesHandler->insert($gallerytypesObj)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
                    }
                }
                unset($gallerytypeObj);
                unset($crGallerytypes);
            }
			
			// reset all gallerytypes
			$count_pr = 0;
            $crGallerytypes = new CriteriaCompo();
            $crGallerytypes->add(new Criteria('gt_primary', 1));
            $gallerytypesAll = $gallerytypesHandler->getAll($crGallerytypes);
            foreach(array_keys($gallerytypesAll) as $i) {
                if($gallerytypesHandler->reset($gallerytypesAll[$i]->getVar('gt_id'), $gallerytypesAll[$i]->getVar('gt_template'), 1)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $gallerytypesAll[$i]->getVar('gt_name');
					$count_pr++;
                } else {
					$errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
				}
            }            
            unset($crGallerytypes);
            $crGallerytypes = new CriteriaCompo();
            $crGallerytypes->add(new Criteria('gt_primary', 0));
            $gallerytypesAll = $gallerytypesHandler->getAll($crGallerytypes);
            foreach(array_keys($gallerytypesAll) as $i) {
				$primary = 0;
				if ( 0 == $count_pr) {$primary = 1;}
                if($gallerytypesHandler->reset($gallerytypesAll[$i]->getVar('gt_id'), $gallerytypesAll[$i]->getVar('gt_template'), $primary)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $gallerytypesAll[$i]->getVar('gt_name');
					$count_pr++;
                } else {
					$errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $gallerytypesAll[$i]->getVar('gt_template');
				}
            }
            unset($crGallerytypes);

			$templateMain = 'wggallery_admin_maintenance.tpl';
			$err_text = '';
			if (count($errors) > 0) {
				foreach($errors as $error) {
					$err_text .= '<br>' . $error;
				}
				
				$GLOBALS['xoopsTpl']->assign('error', $err_text);
			}
			$success_text = '';
			foreach($success as $s) {
				if ('' !== $success_text) {$success_text .= '<br>';}
				$success_text .= $s;
			}
			$GLOBALS['xoopsTpl']->assign('result1', $success_text . $err_text);
			$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
			$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
		} else if('reset_gt' === $op) {
            xoops_confirm(array('ok' => 1, 'op' => 'reset_gt'), $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_GT_SURERESET);
        } else{
            xoops_confirm(array('ok' => 1, 'op' => 'delete_reset_gt'), $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE);
        }
	break;
		
    case 'reset_at':
	case 'delete_reset_at':
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $success = array();
            $errors  = array();
			if ('delete_reset_at' === $op) {
                // delete all existing albumtypes
                $albumtypesAll = $albumtypesHandler->getAll();
                foreach(array_keys($albumtypesAll) as $i) {
                    $albumtypeObjDel = $albumtypesHandler->get($albumtypesAll[$i]->getVar('gt_id'));
                    if($albumtypesHandler->delete($albumtypeObjDel, true)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $albumtypeObjDel->getVar('gt_name');
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $albumtypeObjDel->getVar('gt_name');
                    } 
					unset($albumtypeObjDel);
                }
            }
				
			// create new albumtypes if not existing
            $templates = array('default', 'simple', 'hovereffectideas', 'bcards');
            foreach($templates as $template) {
                $gtCount = 0;
                $crAlbumtypes = new CriteriaCompo();
                $crAlbumtypes->add(new Criteria('at_template', $template));
                $crAlbumtypes->setLimit( 1 );
                $gtCount = $albumtypesHandler->getCount($crAlbumtypes);
                if (1 > $gtCount) {           
                    $albumtypesObj = $albumtypesHandler->create();
                    $albumtypesObj->setVar('at_name', $template);
                    $albumtypesObj->setVar('at_template', $template);
                    if($albumtypesHandler->insert($albumtypesObj)) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
                    }
                }
                unset($albumtypesObj);
                unset($crAlbumtypes);
            }

            // reset all albumtypes
			$count_pr = 0;
            $crAlbumtypes = new CriteriaCompo();
            $crAlbumtypes->add(new Criteria('at_primary', 1));
            $albumtypesAll = $albumtypesHandler->getAll($crAlbumtypes);
            foreach(array_keys($albumtypesAll) as $i) {
                if($albumtypesHandler->reset($albumtypesAll[$i]->getVar('at_id'), $albumtypesAll[$i]->getVar('at_template'), 1)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $albumtypesAll[$i]->getVar('at_name');
					$count_pr++;
                } else {
					$errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
				}
            }
            unset($crAlbumtypes);
            $crAlbumtypes = new CriteriaCompo();
            $crAlbumtypes->add(new Criteria('at_primary', 0));
            $albumtypesAll = $albumtypesHandler->getAll($crAlbumtypes);
            foreach(array_keys($albumtypesAll) as $i) {
				$primary = 0;
				if ( 0 == $count_pr) {$primary = 1;}
                if($albumtypesHandler->reset($albumtypesAll[$i]->getVar('at_id'), $albumtypesAll[$i]->getVar('at_template'), $primary)) {
                    $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $albumtypesAll[$i]->getVar('at_name');
					$count_pr++;
                } else {
					$errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESET . $template;
				}
            }
            unset($crAlbumtypes);
			
			$templateMain = 'wggallery_admin_maintenance.tpl';
			$err_text = '';
			if (count($errors) > 0) {
				foreach($errors as $error) {
					$err_text .= '<br>' . $error;
				}
				$GLOBALS['xoopsTpl']->assign('error', $err_text);
			}
			$success_text = '';
			foreach($success as $s) {
				if ('' !== $success_text) {$success_text .= '<br>';}
				$success_text .= $s;
			}
			$GLOBALS['xoopsTpl']->assign('result2', $success_text . $err_text);
			$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
			$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
		} else if('reset_at' === $op) {
            xoops_confirm(array('ok' => 1, 'op' => 'reset_at'), $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_AT_SURERESET);
        } else{
            xoops_confirm(array('ok' => 1, 'op' => 'delete_reset_at'), $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE);
        }

	break;
	
	case 'resize_medium':
	case 'resize_thumb':
		$counter = 0;
		$errors = array();
		$crImages = new CriteriaCompo();
        $imagesCount = $imagesHandler->getCount($crImages);
		$imagesAll = $imagesHandler->getAll($crImages);
		if ('resize_medium' === $op) {
			$maxwidth = $wggallery->getConfig('maxwidth_medium');
			$maxheight = $wggallery->getConfig('maxheight_medium');
			$target = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/';
		} else {
			$maxwidth = $wggallery->getConfig('maxwidth_thumbs');
			$maxheight = $wggallery->getConfig('maxheight_thumbs');
			$target = WGGALLERY_UPLOAD_IMAGE_PATH . '/thumbs/';
		}
		if($imagesCount > 0) {
			foreach(array_keys($imagesAll) as $i) {
				$sourcefile = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $imagesAll[$i]->getVar('img_name');
				$endfile = $target . $imagesAll[$i]->getVar('img_name');
				$imageMimetype = $imagesAll[$i]->getVar('img_mimetype');
				$result = resizeImage($sourcefile, $endfile, $imageMimetype, $maxwidth, $maxheight);
				if ('copy' === $result) {
					unlink($endfile);
					copy ($sourcefile, $endfile);
					$counter++;
				} else if ($result) {
					$counter++;
                } else if ('copy' === $result) {
                    unlink($endfile);
                    copy ($sourcefile, $endfile);
                } else {
                    $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE . $imagesAll[$i]->getVar('img_name');
                }
			}	
		}
		$templateMain = 'wggallery_admin_maintenance.tpl';
		$err_text = '';
		if (count($errors) > 0) {
			foreach($errors as $error) {
				$err_text .= '<br>' . $error;
			}
			$GLOBALS['xoopsTpl']->assign('error', $err_text);
		}
        $success_text = str_replace(array('%s', '%t'), array($counter, $imagesCount), _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE);
		
		$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
		$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
		$GLOBALS['xoopsTpl']->assign('result3', $success_text . $err_text);
	
	break;
	
	case 'delete_unused_images_show':
		$unused = array();
		$errors = array();
		
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
		
		$templateMain = 'wggallery_admin_maintenance.tpl';
		$unused_text = '';
		$err_text = '';
		if (count($errors) > 0) {
			foreach($errors as $error) {
				$err_text .= '<br>' . $error;
			}
			$GLOBALS['xoopsTpl']->assign('error', $err_text);
		}
		if (count($unused) > 0) {
			foreach($unused as $image) {
				if ('' !== $unused_text) {$unused_text .= '<br>';}
				$unused_text .= $image['path'];
			}
		} else {
			$unused_text = _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE;
		}
		$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
		$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
		$GLOBALS['xoopsTpl']->assign('result4', $unused_text . $err_text);
		
	break;
	
	case 'delete_unused_images':
		if(isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
			if(!$GLOBALS['xoopsSecurity']->check()) {
				redirect_header('maintenance.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
			}
            $success = array();
            $errors  = array();
			$unused  = array();
		
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

			if (count($unused) > 0) {
				foreach($unused as $image) {
					unlink($image['path']);
					if ( file_exists ( $image['path'] )) {
						$errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_DELETE . $image['path'];
					} else {
						$success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE . $image['path'];
					}
				}
			}
			
			$templateMain = 'wggallery_admin_maintenance.tpl';
			$err_text = '';
			if (count($errors) > 0) {
				foreach($errors as $error) {
					$err_text .= '<br>' . $error;
				}
				$GLOBALS['xoopsTpl']->assign('error', $err_text);
			}
			$success_text = '';
			foreach($success as $s) {
				if ('' !== $success_text) {$success_text .= '<br>';}
				$success_text .= $s;
			}
			
			$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
			$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
			$GLOBALS['xoopsTpl']->assign('result4', $success_text . $err_text);
		} else {
			xoops_confirm(array('ok' => 1, 'op' => 'delete_unused_images'), $_SERVER['REQUEST_URI'], _AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE);
		}
	break;
    
    case 'watermark_select':
        // Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new XoopsThemeForm(_AM_WGGALLERY_MAINTENANCE_WATERMARK, 'form', 'maintenance.php', 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// Form Select Parent Album
		$albumsHandler = $wggallery->getHandler('albums');
		$wmAlbid = new XoopsFormSelect( _AM_WGGALLERY_MAINTENANCE_WATERMARK_SELECT, 'wm_albid', 0 );
		$wmAlbid->addOption('', '&nbsp;');
        $albumsAll = $albumsHandler->getAll();
        foreach(array_keys($albumsAll) as $i) {
			$albName = $albumsAll[$i]->getVar('alb_name');
			$albAlbPid = $albumsAll[$i]->getVar('alb_pid');
			if ( 0 < $albAlbPid ) {
				$albumsObj = $albumsHandler->get($albAlbPid);
				$albName .= ' (' . $albumsObj->getVar('alb_name') . ')';
			}
			$wmAlbid->addOption($albumsAll[$i]->getVar('alb_id'), $albName);
		}
		$form->addElement($wmAlbid, true);
		unset($criteria);
        // Form Select Album watermark
        $watermarksHandler = $wggallery->getHandler('watermarks');
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('wm_usage', WGGALLERY_WATERMARK_USAGENONE, '>'));
        $countWm = $watermarksHandler->getCount($criteria);
        if ( 0 < $countWm ) {
            $albWidSelect = new XoopsFormSelect( _CO_WGGALLERY_WATERMARK, 'wm_id', 0);
            $albWidSelect->addOption('', '&nbsp;');
            $criteria = new CriteriaCompo();
            $criteria->add(new Criteria('wm_usage', WGGALLERY_WATERMARK_USAGENONE, '>'));
            $albWidSelect->addOptionArray($watermarksHandler->getList($criteria));
            $form->addElement($albWidSelect, true);
        }
        unset($criteria);
        $wmTargetSelect = new XoopsFormRadio( _CO_WGGALLERY_WATERMARK_TARGET, 'wm_target', 0 );
		$wmTargetSelect->addOption(WGGALLERY_WATERMARK_TARGET_A, _CO_WGGALLERY_WATERMARK_TARGET_A);
        $wmTargetSelect->addOption(WGGALLERY_WATERMARK_TARGET_M, _CO_WGGALLERY_WATERMARK_TARGET_M);
        $wmTargetSelect->addOption(WGGALLERY_WATERMARK_TARGET_L, _CO_WGGALLERY_WATERMARK_TARGET_L);
		$form->addElement($wmTargetSelect, true);
        $form->addElement(new XoopsFormHidden('op', 'watermark_add'));
		$form->addElement(new XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        $form->display();
    break;
    
    case 'watermark_add':
        $wmAlbid  = Request::getInt('wm_albid');
        $wmId     = Request::getInt('wm_id');
        $wmTarget = Request::getInt('wm_target');
        $success  = array();
        $errors   = array();
        $crImages = new CriteriaCompo();
        $crImages->add(new Criteria('img_albid', $wmAlbid));
        $imagesCount = $imagesHandler->getCount($crImages);
        if($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll($crImages);
            foreach(array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                if ( WGGALLERY_WATERMARK_TARGET_A === $wmTarget || WGGALLERY_WATERMARK_TARGET_M === $wmTarget) {
                    $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
                    $resWm = $watermarksHandler->watermarkImage( $wmId, $imgWm, $imgWm );
                    if ( true === $resWm) {
                        $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $imgWm;
                    } else {
                        $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $imgWm . ' - ' . $resWm;
                    }
                }
                if ( WGGALLERY_WATERMARK_TARGET_A === $wmTarget || WGGALLERY_WATERMARK_TARGET_L === $wmTarget) {
                    $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/large/' . $image['img_namelarge'];
                    $resWm = $watermarksHandler->watermarkImage( $wmId, $imgWm, $imgWm );
                    if ( true === $resWm) {
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
        $err_text = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        $success_text = '<ul>';
        foreach($success as $s) {
            $success_text .= '<li>' . $s . '</li>';  
        }
        $success_text .= '</ul>';
        $GLOBALS['xoopsTpl']->assign('result5', $success_text . $err_text);
        
    break;
    
    case 'broken_imgdir_search':
        $success = array();
        $errors  = array();
        $imagesCount = $imagesHandler->getCount();
        if($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach(array_keys($imagesAll) as $i) {
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
        $err_text = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach($success as $s) {
                $success_text .= '<li>' . $s . '</li>';  
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        $GLOBALS['xoopsTpl']->assign('result6', $success_text . $err_text);
    break;
        
    case 'broken_imgdir_clean':
        $success = array();
        $errors  = array();
        $imagesCount = $imagesHandler->getCount();
        if($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach(array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                $imgWm = WGGALLERY_UPLOAD_IMAGE_PATH . '/medium/' . $image['img_name'];
                if (!file_exists($imgWm)) {
                    $imagesObj = $imagesHandler->get($image['img_id']);
                    if($imagesHandler->delete($imagesObj, true)) {
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
        $err_text = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach($success as $s) {
                $success_text .= '<li>' . $s . '</li>';  
            }
            $success_text .= '</ul>';
        } else {
            $success_text = '<ul>';
        }
        $GLOBALS['xoopsTpl']->assign('result6', $success_text . $err_text);
    break;
    
    case 'broken_imgalb_search':
        $success = array();
        $errors  = array();
        $imagesCount = $imagesHandler->getCount();
        if($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach(array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                
                $crAlbums = new CriteriaCompo();
                $crAlbums->add(new Criteria('alb_id', $image['img_albid']));
                $albumsCount = $albumsHandler->getCount($crAlbums);
                if( 0 == $albumsCount) {
                    $success[] = $image['img_name'];
                }
                unset($image);
            }
        } else {
            $errors[] = _CO_WGGALLERY_THEREARENT_IMAGES;
        }
        $templateMain = 'wggallery_admin_maintenance.tpl';
        $err_text = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach($success as $s) {
                $success_text .= '<li>' . $s . '</li>';  
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        $GLOBALS['xoopsTpl']->assign('result7', $success_text . $err_text);
    break;

    case 'broken_imgalb_clean':
        $success = array();
        $errors  = array();
        $imagesCount = $imagesHandler->getCount();
        if($imagesCount > 0) {
            $imagesAll = $imagesHandler->getAll();
            foreach(array_keys($imagesAll) as $i) {
                $image = $imagesAll[$i]->getValuesImages();
                
                $crAlbums = new CriteriaCompo();
                $crAlbums->add(new Criteria('alb_id', $image['img_albid']));
                $albumsCount = $albumsHandler->getCount($crAlbums);
                if( 0 == $albumsCount) {
                    $imagesObj = $imagesHandler->get($image['img_id']);
                    if($imagesHandler->delete($imagesObj, true)) {
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
        $err_text = '';
        if (count($errors) > 0) {
            $err_text = '<ul>';
            foreach($errors as $error) {
                $err_text .= '<li>' . $error . '</li>';
            }
            $err_text .= '</ul>';
            $GLOBALS['xoopsTpl']->assign('error', $err_text);
        }
        if (count($success) > 0) {
            $success_text = '<ul>';
            foreach($success as $s) {
                $success_text .= '<li>' . $s . '</li>';  
            }
            $success_text .= '</ul>';
        } else {
            $success_text = _AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK;
        }
        $GLOBALS['xoopsTpl']->assign('result7', $success_text . $err_text);
    break;
	
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$templateMain = 'wggallery_admin_maintenance.tpl';

        $maintainance_resize_desc = str_replace(array('%mw', '%mh', '%tw', '%th'), array($wggallery->getConfig('maxwidth_medium'), $wggallery->getConfig('maxheight_medium'), $wggallery->getConfig('maxwidth_thumbs'), $wggallery->getConfig('maxheight_thumbs')), _AM_WGGALLERY_MAINTENANCE_RESIZE_DESC);
		$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
		
		$maintainance_dui_desc = str_replace('%p', WGGALLERY_UPLOAD_IMAGE_PATH, _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC);
		$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
        
        $system_check = array();
        // system checks
        // file_uploads Bestimmt, ob Datei-Uploads per HTTP erlaubt sind
        $type = str_replace('%s', 'file_uploads', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini = ini_get('file_uploads');
        $result1 = _AM_WGGALLERY_MAINTENANCE_CHECK_UPLOADDESC1;
        $result2 = '';
        if ( 0 < $value_ini ) {
            $change = false;
            $result1 .= _YES;
            $solve = '';
        } else {
            $change = true;
            $result1 .= _NO;
            $solve = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2;
        }
        $system_check[] = ['type' => $type, 'info' => _AM_WGGALLERY_MAINTENANCE_CHECK_UPLOAD, 'result1' => $result1, 'result2' => $result2, 'change' => $change, 'solve' => $solve];
        
        // post_max_size
        $type = str_replace('%s', 'post_max_size', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini = ini_get('post_max_size');
        $value_php = return_bytes($value_ini);
        $maxsize_module = $wggallery->getConfig('maxsize');
        $result1 = str_replace(['%s', '%b'], [$value_ini, $value_php], _AM_WGGALLERY_MAINTENANCE_CHECK_MS_POSTDESC1);
        $result2 = str_replace('%s', $maxsize_module, _AM_WGGALLERY_MAINTENANCE_CHECK_MS_MODULEDESC1);
        $change = false;
        $solve = '';
        if ( $maxsize_module > $value_php ) {
            $change = true;
            $solve = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1;
        }
        $system_check[] = ['type' => $type, 'info' => _AM_WGGALLERY_MAINTENANCE_CHECK_MS_POST, 'result1' => $result1, 'result2' => $result2, 'change' => $change, 'solve' => $solve];
        

        // upload_max_filesize
        $type = str_replace('%s', 'upload_max_filesize', _AM_WGGALLERY_MAINTENANCE_CHECK_TYPE);
        $value_ini = ini_get('upload_max_filesize');
        $value_php = return_bytes($value_ini);
        $result1 = str_replace(['%s', '%b'], [$value_ini, $value_php], _AM_WGGALLERY_MAINTENANCE_CHECK_MS_UPLOADDESC1);
        $result2 = str_replace('%s', $maxsize_module, _AM_WGGALLERY_MAINTENANCE_CHECK_MS_MODULEDESC1);
        $change = false;
        $solve = '';
        if ( $maxsize_module > $value_php ) {
            $change = true;
            $solve = _AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1;
        }
        $system_check[] = ['type' => $type, 'info' => _AM_WGGALLERY_MAINTENANCE_CHECK_MS_UPLOAD, 'result1' => $result1, 'result2' => $result2, 'change' => $change, 'solve' => $solve];
        // upload_max_filesize Maximale Größe, die eine hochgeladene Datei haben darf. 
		
        $GLOBALS['xoopsTpl']->assign('system_check', $system_check);
	break;
    
}

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }

    return $val;
}

/**
 * get unused images of given directory
 * @param array  $unused 
 * @param string $directory 
 * @return boolean
 */
function getUnusedImages( &$unused, $directory ){
	// Get instance of module
	$wggallery = WggalleryHelper::getInstance();
	$imagesHandler = $wggallery->getHandler('images');
	
	if(is_dir($directory)){
		if ($handle = opendir($directory)) {
			while (false !== ($entry = readdir($handle))) {
				switch ($entry) {
					case 'blank.gif':
					case 'index.html':
					case '..':
					case '.':
					break;
					case 'delete':
					default:
						$crImages = new CriteriaCompo();
						$crImages->add(new Criteria('img_name', $entry));
						$crImages->add(new Criteria('img_namelarge', $entry), 'OR');
						$imagesCount = $imagesHandler->getCount($crImages);
						if(0 == $imagesCount) {
							$unused[] = array( 'name' => $entry, 'path' => $directory . '/' . $entry);
						}
						unset($crImages);
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

/**
 * resize image if size exceed given width/height
 * @param $sourcefile
 * @param string $endfile
 * @param $imageMimetype
 * @param int $max_width
 * @param int $max_height
 * @return string|boolean
 */
function resizeImage($sourcefile, $endfile, $imageMimetype, $max_width, $max_height){
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

		unlink($endfile);
		// Save thumbnail into a file.
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
include __DIR__ . '/footer.php';
