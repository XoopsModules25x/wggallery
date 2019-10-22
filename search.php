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
 * @version        $Id: 1.0 search.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;
use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';

$op    = Request::getString('op', 'initiate');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $helper->getConfig('userpager'));

$search_text = strtolower(Request::getString('search_text', ''));
$search_cats = Request::getArray('search_cats', []);
$search_subm = Request::getInt('search_subm', 0);
$search_act  = Request::getInt('search_act', 1);
$imageIdsIn  = Request::getString('imageIdsIn', '');

$GLOBALS['xoopsOption']['template_main'] = 'wggallery_search.tpl';

require_once XOOPS_ROOT_PATH . '/header.php';

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
$GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/style.css', null);
if ($helper->getConfig('ratingbars') > 0) {
    $GLOBALS['xoTheme']->addStylesheet(WGGALLERY_URL . '/assets/css/rating.css', null);
    $GLOBALS['xoopsTpl']->assign('rating', true);
    $GLOBALS['xoopsTpl']->assign('save', 'save-img' . $op);
}
$GLOBALS['xoopsTpl']->assign('show_exif', $helper->getConfig('store_exif'));

// defines only for search
define('WGGALLERY_SEARCH_NOTAPPLY', 0);
define('WGGALLERY_SEARCH_ACT_DOWNLOADS', 1);
define('WGGALLERY_SEARCH_ACT_VIEWS', 2);
define('WGGALLERY_SEARCH_ACT_RATINGS', 3);
define('WGGALLERY_SEARCH_ACT_VOTES', 4);

// **************************
// start search form section
xoops_load('XoopsFormLoader');
$form1 = new \XoopsThemeForm(_MA_WGGALLERY_SEARCH, 'form1', 'search.php', 'post', true);
$form1->setExtra('enctype="multipart/form-data"');

// search for text
$trayText = new \XoopsFormElementTray(_MA_WGGALLERY_SEARCH_TEXT, '<br>');
$descText = new \XoopsFormLabel('', _MA_WGGALLERY_SEARCH_TEXT_DESC);
$trayText->addElement($descText, false);
$trayText->addElement(new \XoopsFormText('', 'search_text', 50, 255, $search_text), false);
$form1->addElement($trayText, false);

// search for categories
$trayCats = new \XoopsFormElementTray(_MA_WGGALLERY_SEARCH_CATS, '<br>');
$descCats = new \XoopsFormLabel('', _MA_WGGALLERY_SEARCH_CATS_DESC);
$trayCats->addElement($descCats, false);
if ($helper->getConfig('use_categories')) {
    $categoriesHandler = $helper->getHandler('Categories');
    $crCategories = new \CriteriaCompo();
    $crCategories->add(new \Criteria('cat_image', 1));
    $categoriesCount = $categoriesHandler->getCount($crCategories);
    if ($categoriesCount > 0) {
        $crCategories->setSort('cat_weight ASC, cat_text');
        $crCategories->setOrder('ASC');
        $categoriesAll = $categoriesHandler->getAll($crCategories);
        $selectCategories = new \XoopsFormCheckBox('', 'search_cats', $search_cats);
        foreach (array_keys($categoriesAll) as $i) {
            $selectCategories->addOption($categoriesAll[$i]->getVar('cat_id'), $categoriesAll[$i]->getVar('cat_text'));
        }
        $trayCats->addElement($selectCategories, false);
    }
} else {
    $trayCats->addElement(new \XoopsFormHidden('search_cats', 0));
}
$form1->addElement($trayCats, false);

// search for submitter of album or image
$userHandler = xoops_gethandler('user');
$sql = 'SELECT alb_submitter FROM ' . $xoopsDB->prefix('wggallery_albums') . ' GROUP BY alb_submitter';
$result = $GLOBALS['xoopsDB']->query($sql) or die ("MySQL-Error: " . mysqli_error());       
while($row = $GLOBALS['xoopsDB']->fetchrow($result)) {
    $subm_search[$row[0]]['uid'] = $row[0];
    $user = $userHandler->get($row[0]);
    $username = $user->getVar('name');
    if ('' === $username) {
        $username = $user->getVar('uname');
    }
    $subm_search[$row[0]]['name'] = $username;
}
$sql = 'SELECT img_submitter FROM ' . $xoopsDB->prefix('wggallery_images') . ' GROUP BY img_submitter';
$result       = $GLOBALS['xoopsDB']->query($sql) or die ("MySQL-Error: " . mysqli_error());       
while($row = $GLOBALS['xoopsDB']->fetchrow($result)) {
    $subm_search[$row[0]]['uid'] = $row[0];
    $user = $userHandler->get($row[0]);
    $username = $user->getVar('name');
    if ('' === $username) {
        $username = $user->getVar('uname');
    }
    $subm_search[$row[0]]['name'] = $username;
}  
// Form Select users
$traySubmitter = new \XoopsFormElementTray(_MA_WGGALLERY_SEARCH_SUBM, '<br>');
$descSelect = new \XoopsFormLabel('', _MA_WGGALLERY_SEARCH_SUBM_DESC);
$traySubmitter->addElement($descSelect, false);
$submSelect = new \XoopsFormSelect('', 'search_subm', $search_subm);
$submSelect->addOption(0, ' ');
foreach ($subm_search as $subm) {
    $submSelect->addOption($subm['uid'], $subm['name']);
}
$traySubmitter->addElement($submSelect, false);
$form1->addElement($traySubmitter, false);

// To Save
$form1->addElement(new \XoopsFormHidden('op', 'exec_search'));
$form1->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

$GLOBALS['xoopsTpl']->assign('form1', $form1->render());

// form for searching for user activities
$form2 = new \XoopsThemeForm(_MA_WGGALLERY_SEARCH_ACT, 'form', 'search.php', 'post', true);
$form2->setExtra('enctype="multipart/form-data"');

$activitySelect = new \XoopsFormRadio(_MA_WGGALLERY_SEARCH_ACT, 'search_act', $search_act);
$activitySelect->addOption(WGGALLERY_SEARCH_ACT_DOWNLOADS, _MA_WGGALLERY_SEARCH_ACT_DOWNLOADS);
$activitySelect->addOption(WGGALLERY_SEARCH_ACT_VIEWS, _MA_WGGALLERY_SEARCH_ACT_VIEWS);
if ($helper->getConfig('ratingbars')) {
    $activitySelect->addOption(WGGALLERY_SEARCH_ACT_RATINGS, _MA_WGGALLERY_SEARCH_ACT_RATINGS);
    $activitySelect->addOption(WGGALLERY_SEARCH_ACT_VOTES, _MA_WGGALLERY_SEARCH_ACT_VOTES);
}
$form2->addElement($activitySelect);
     
// To Save
$form2->addElement(new \XoopsFormHidden('op', 'exec_search_act'));
$form2->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));

$GLOBALS['xoopsTpl']->assign('form2', $form2->render());
// end search form section
// **************************

switch ($op) {
    case 'exec_search':
    case 'exec_search_act':
        
        if ('' === $imageIdsIn) {
            // search wasnt done till now
            // check that minimum one search option is used
            if ('' === $search_text && count($search_cats) == 0 && 0 === $search_subm && 'exec_search' === $op ) {
                redirect_header('search.php', 3, _MA_WGGALLERY_SEARCH_ERROR_NO_FILTER);
            }
            
            $album_ids      = [];
            $album_ids_view = [];
            $image_ids      = [];

            // search in table wggallery_albums
            $crAlbums = new \CriteriaCompo();
            $crAlbums->add(new \Criteria('alb_state', Constants::STATE_ONLINE_VAL));
            // TODO: filter permission to see
            $albumsCount = $albumsHandler->getCount($crAlbums);
            if ($albumsCount > 0) {
                $albumsAll = $albumsHandler->getAll($crAlbums);
                foreach (array_keys($albumsAll) as $i) {
                    $albId =$albumsAll[$i]->getVar('alb_id');
                    $permView = $permissionsHandler->permAlbumView($albId);
                    if ($permView) {
                        $album_ids_view[] = $albId ;
                        if ('' !== $search_text) {
                            $pos = strpos(strtolower($albumsAll[$i]->getVar('alb_name')), $search_text);
                            if ($pos !== false) {
                                $album_ids[] = $albId;
                                //echo "<br>$albId: alb_name ".$albumsAll[$i]->getVar('alb_name')." contains " . $search_text;
                            }
                            $pos = strpos(strtolower($albumsAll[$i]->getVar('alb_desc')), $search_text);
                            if ($pos !== false) {
                                $album_ids[] = $albId;
                                //echo "<br>$albId: alb_desc ".$albumsAll[$i]->getVar('alb_desc')." contains " . $search_text;
                            }
                            $pos = strpos(strtolower($albumsAll[$i]->getVar('alb_tags')), $search_text);
                            if ($pos !== false) {
                                $album_ids[] = $albId;
                                //echo "<br>$albId: alb_tags ".$albumsAll[$i]->getVar('alb_tags')." contains " . $search_text;
                            }
                        }
                        if ($albumsAll[$i]->getVar('alb_submitter') === $search_subm) {
                            $album_ids[] = $albId;
                            //echo "<br>$albId: alb_submitter = " . $search_subm;
                        }
                        if ($albumsAll[$i]->getVar('alb_cats') != '') {
                            $alb_cats = unserialize($albumsAll[$i]->getVar('alb_cats'));
                            foreach($search_cats as $cat) {
                                if (in_array($cat, $alb_cats)) {
                                    $album_ids[] = $albId;
                                    //echo "<br>$albId: cat $cat is in alb_cats = ";
                                }
                            }
                        }
                    }
                }
                //echo "<br>count(album_ids):".count($album_ids);
                if (count($album_ids) > 0) {
                    $img_albids = implode(",",$album_ids);
                    $sql = 'SELECT img_id FROM ' . $xoopsDB->prefix('wggallery_images') . ' WHERE (`img_albid` IN (' . $img_albids . '))';
                    $result = $GLOBALS['xoopsDB']->query($sql) or die ("MySQL-Error: " . mysqli_error());       
                    while($row = $GLOBALS['xoopsDB']->fetchrow($result)) {
                        $image_ids[] = $row[0];
                    }
                }
            }
            unset($crAlbums);
            unset($i);
            
            // search in table wggallery_images
            $crImages = new \CriteriaCompo();
            $crImages->add(new \Criteria('img_state', Constants::STATE_ONLINE_VAL));
            $imagesCount = $imagesHandler->getCount($crImages);
            if ($imagesCount > 0) {
                $imagesAll = $imagesHandler->getAll($crImages);
                foreach (array_keys($imagesAll) as $i) {
                    if ('' !== $search_text) {
                        $pos = strpos(strtolower($imagesAll[$i]->getVar('img_title')), $search_text);
                        if ($pos !== false) {
                            $image_ids[] = $imagesAll[$i]->getVar('img_id');
                            //echo "<br>img_title ".$imagesAll[$i]->getVar('img_title')." contains " . $search_text;
                        }
                        $pos = strpos(strtolower($imagesAll[$i]->getVar('img_name')), $search_text);
                        if ($pos !== false) {
                            $image_ids[] = $imagesAll[$i]->getVar('img_id');
                            //echo "<br>img_name ".$imagesAll[$i]->getVar('img_name')." contains " . $search_text;
                        }
                        $pos = strpos(strtolower($imagesAll[$i]->getVar('img_desc')), $search_text);
                        if ($pos !== false) {
                            $image_ids[] = $imagesAll[$i]->getVar('img_id');
                            //echo "<br>img_desc ".$imagesAll[$i]->getVar('img_desc')." contains " . $search_text;
                        }
                        $pos = strpos(strtolower($imagesAll[$i]->getVar('img_tags')), $search_text);
                        if ($pos !== false) {
                            $image_ids[] = $imagesAll[$i]->getVar('img_id');
                            //echo "<br>img_tags ".$imagesAll[$i]->getVar('img_tags')." contains " . $search_text;
                        }
                    }
                    if ($imagesAll[$i]->getVar('img_submitter') === $search_subm) {
                        $image_ids[] = $imagesAll[$i]->getVar('img_id');
                        //echo "<br>img_submitter = " . $search_subm;
                    }
                    if ($imagesAll[$i]->getVar('img_cats') != '') {
                        $img_cats = unserialize($imagesAll[$i]->getVar('img_cats'));
                        foreach($search_cats as $cat) {
                            if (in_array($cat, $img_cats)) {
                                $image_ids[] = $imagesAll[$i]->getVar('img_id');
                                //echo "<br>cat $cat is in img_cats = ";
                            }
                        }
                    }
                }
            }
            unset($crImages);
            unset($i);
            
            $imageIdsIn = implode(",",array_unique($image_ids));
        }
        
        //echo "<br>imageIdsIn: $imageIdsIn";
        
        // get list of images
        $crImages = new \CriteriaCompo();
        $crImages->add(new \Criteria('img_state', Constants::STATE_ONLINE_VAL));
        if ('exec_search' == $op) {
            $crImages->add(new \Criteria('img_id', '(' . $imageIdsIn . ')', 'IN'));
        }
        if ('exec_search_act' == $op) {
            switch ($search_act) {
                case WGGALLERY_SEARCH_ACT_DOWNLOADS:
                    $crImages->setSort('img_downloads');
                    $crImages->setOrder('DESC');
                break;
                case WGGALLERY_SEARCH_ACT_VIEWS:
                    $crImages->setSort('img_views');
                    $crImages->setOrder('DESC');
                case WGGALLERY_SEARCH_ACT_RATINGS:
                    $crImages->setSort('img_ratinglikes');
                    $crImages->setOrder('DESC');
                break;
                case WGGALLERY_SEARCH_ACT_VOTES:
                    $crImages->setSort('img_votes');
                    $crImages->setOrder('DESC');
                break;
                case 'default':
                default:
                    // should never happens
                    redirect_header('search.php', 3, 'invalid parameter');
                break;
            }
        }
        $imagesCount = $imagesHandler->getCount($crImages);
        $crImages->setStart($start);
        $crImages->setLimit($limit);
        $imagesAll = $imagesHandler->getAll($crImages);
        if ($imagesCount > 0) {
            $images = [];
            // Get All Images
            foreach (array_keys($imagesAll) as $i) {
                $images[$i] = $imagesAll[$i]->getValuesImages();
                //check permissions

            }
            $GLOBALS['xoopsTpl']->assign('images', $images);
            unset($images);
            // Display Navigation
            if ($imagesCount > $limit && 'exec_search' == $op) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($imagesCount, $limit, $start, 'start', 'op=exec_search&amp;limit=' .  $limit . '&amp;imageIdsIn=' . $imageIdsIn);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }        
        }
        $GLOBALS['xoopsTpl']->assign('showlist', true);
        $GLOBALS['xoopsTpl']->assign('start', $start);
        $GLOBALS['xoopsTpl']->assign('limit', $limit);
        $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
        $GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '16/');
        $GLOBALS['xoopsTpl']->assign('show_breadcrumbs', $helper->getConfig('show_breadcrumbs'));
        $GLOBALS['xoopsTpl']->assign('displayButtonText', $helper->getConfig('displayButtonText'));
        $GLOBALS['xoopsTpl']->assign('use_tags', $helper->getConfig('use_tags'));
        $GLOBALS['xoopsTpl']->assign('use_categories', $helper->getConfig('use_categories'));
        break;

    case 'intiate':
    default:
        
        
        break;
}

require __DIR__ . '/footer.php';
