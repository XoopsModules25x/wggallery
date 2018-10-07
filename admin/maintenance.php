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
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 albums.php 1 Mon 2018-03-19 10:04:49Z XOOPS Project (www.xoops.org) $
 */
  
use Xmf\Request;

include __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request alb_id
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
            $errors = array();
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
			$gallerytypesObj = $gallerytypesHandler->create();
			$template = 'none';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
			$template = 'lightbox2';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
			$template = 'justifiedgallery';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
/* 			$template = 'blueimpgallery';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj); */
			$template = 'viewerjs';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
			$template = 'jssor';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
			$template = 'lclightboxlite';
			$gallerytypesObj->setVar('gt_name', $template);
			$gallerytypesObj->setVar('gt_template', $template);
			if($gallerytypesHandler->insert($gallerytypesObj) && 'delete_reset_gt' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_gt' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($gallerytypeObj);
			
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
				$err_text = '';
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
            $errors = array();
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
			$albumtypesObj = $albumtypesHandler->create();
			$template = 'default';
			$albumtypesObj->setVar('at_name', $template);
			$albumtypesObj->setVar('at_template', $template);
            if($albumtypesHandler->insert($albumtypesObj) && 'delete_reset_at' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_at' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($albumtypeObj);
            // create new albumtypes if not existing
			$albumtypesObj = $albumtypesHandler->create();
			$template = 'simple';
			$albumtypesObj->setVar('at_name', $template);
			$albumtypesObj->setVar('at_template', $template);
            if($albumtypesHandler->insert($albumtypesObj) && 'delete_reset_at' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE . $template;
            } else if('delete_reset_at' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($albumtypeObj);
            // create new albumtypes if not existing
			$albumtypesObj = $albumtypesHandler->create();
			$template = 'hovereffectideas';
			$albumtypesObj->setVar('at_name', $template);
			$albumtypesObj->setVar('at_template', $template);
            if($albumtypesHandler->insert($albumtypesObj) && 'delete_reset_at' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $template;
            } else if('delete_reset_at' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($albumtypeObj);
            // create new albumtypes if not existing
			$albumtypesObj = $albumtypesHandler->create();
			$template = 'bcards';
			$albumtypesObj->setVar('at_name', $template);
			$albumtypesObj->setVar('at_template', $template);
            if($albumtypesHandler->insert($albumtypesObj) && 'delete_reset_at' === $op) {
                $success[] = _AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET . $template;
            } else if('delete_reset_at' === $op) {
                $errors[] = _AM_WGGALLERY_MAINTENANCE_ERROR_CREATE . $template;
            }
			unset($albumtypeObj);
            
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
				$err_text = '';
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
			$err_text = '';
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
			$err_text = '';
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
            $errors = array();
			$unused = array();
		
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
				$err_text = '';
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
	
	case 'list':
	default:
		// Define Stylesheet
		$GLOBALS['xoTheme']->addStylesheet( $style, null );
		$templateMain = 'wggallery_admin_maintenance.tpl';

        $maintainance_resize_desc = str_replace(array('%mw', '%mh', '%tw', '%th'), array($wggallery->getConfig('maxwidth_medium'), $wggallery->getConfig('maxheight_medium'), $wggallery->getConfig('maxwidth_thumbs'), $wggallery->getConfig('maxheight_thumbs')), _AM_WGGALLERY_MAINTENANCE_RESIZE_DESC);
		$GLOBALS['xoopsTpl']->assign('maintainance_resize_desc', $maintainance_resize_desc);
		
		$maintainance_dui_desc = str_replace('%p', WGGALLERY_UPLOAD_IMAGE_PATH, _AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC);
		$GLOBALS['xoopsTpl']->assign('maintainance_dui_desc', $maintainance_dui_desc);
		
	break;
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
