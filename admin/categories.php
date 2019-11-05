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
 * @version        $Id: 1.0 categories.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;
use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
// Request img_id
$catId = Request::getInt('cat_id');

$templateMain = 'wggallery_admin_categories.tpl';
$GLOBALS['xoopsTpl']->assign('wggallery_icon_url_16', WGGALLERY_ICONS_URL . '16/');

switch ($op) {
    case 'list':
    default:
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/jquery-ui.min.js');
        $GLOBALS['xoTheme']->addScript(WGGALLERY_URL . '/assets/js/sortable-categories.js');
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $start = Request::getInt('start', 0);
        $limit = Request::getInt('limit', $helper->getConfig('adminpager'));
        $adminObject->addItemButton(_AM_WGGALLERY_ADD_CATEGORY, 'categories.php?op=new', 'add');

        $crCategories = new \CriteriaCompo();
        $categoriesCount = $categoriesHandler->getCount($crCategories);
        $crCategories->setStart($start);
        $crCategories->setLimit($limit);
        $crCategories->setSort('cat_weight ASC, cat_id');
        $crCategories->setOrder('ASC');
        $categoriesAll = $categoriesHandler->getAll($crCategories);
        $GLOBALS['xoopsTpl']->assign('categories_count', $categoriesCount);
        $GLOBALS['xoopsTpl']->assign('wggallery_url', WGGALLERY_URL);
        $GLOBALS['xoopsTpl']->assign('wggallery_upload_url', WGGALLERY_UPLOAD_URL);
        // Table view categories
        if ($categoriesCount > 0) {
            foreach (array_keys($categoriesAll) as $i) {
                $category = $categoriesAll[$i]->getValuesCategories();
                $GLOBALS['xoopsTpl']->append('categories_list', $category);
                unset($category);
            }
            // Display Navigation
            if ($categoriesCount > $limit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($categoriesCount, $limit, $start, 'start', 'op=list&amp;limit=' . $limit . '&amp;alb_id=' . $catId);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', _AM_WGGALLERY_THEREARENT_CATEGORIES);
        }
        
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        break;
    case 'new':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_CATEGORIES_LIST, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoriesHandler->create();
        $form      = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('categories.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($catId)) {
            $categoriesObj = $categoriesHandler->get($catId);
        } else {
            $categoriesObj = $categoriesHandler->create();
        }
        // Set Vars
        $categoriesObj->setVar('cat_text', $_POST['cat_text']);
        $categoriesObj->setVar('cat_album', $_POST['cat_album']);
        $categoriesObj->setVar('cat_image', $_POST['cat_image']);
        $categoriesObj->setVar('cat_search', $_POST['cat_search']);
        $categoriesObj->setVar('cat_weight', $_POST['cat_weight']);
        $catDate = date_create_from_format(_SHORTDATESTRING, $_POST['cat_date']);
        $categoriesObj->setVar('cat_date', $catDate->getTimestamp());
        $categoriesObj->setVar('cat_submitter', isset($_POST['cat_submitter']) ? $_POST['cat_submitter'] : 0);
        // Insert Data
        if ($categoriesHandler->insert($categoriesObj)) {
            redirect_header('categories.php?op=list', 2, _CO_WGGALLERY_FORM_OK);
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(_AM_WGGALLERY_ADD_CATEGORY, 'categories.php?op=new', 'add');
        $adminObject->addItemButton(_AM_WGGALLERY_CATEGORIES_LIST, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoriesHandler->get($catId);
        $form      = $categoriesObj->getFormCategories(true);
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'change':
        if (isset($catId)) {
            $categoriesObj = $categoriesHandler->get($catId);
            // Set Vars
            $categoriesObj->setVar('cat_' . Request::getString('field'), Request::getInt('state'));
            // Insert Data
            if ($categoriesHandler->insert($categoriesObj)) {
                redirect_header('categories.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit . '&amp;alb_id=' . $catId, 2, _CO_WGGALLERY_FORM_OK);
            } else {
                redirect_header('categories.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit . '&amp;alb_id=' . $catId, 2, _AM_WGGALLERY_CAT_ERROR_CHANGE);
            }
            // Get Form
            $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        }
        break;
    case 'delete':
        $categoriesObj = $categoriesHandler->get($catId);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('categories.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $cat_text = $categoriesObj->getVar('cat_text');
            if ($categoriesHandler->delete($categoriesObj)) {
                redirect_header('categories.php?alb_id=' . $catId, 3, _CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'op' => 'delete', 'cat_id' => $catId], $_SERVER['REQUEST_URI'], sprintf(_CO_WGGALLERY_FORM_SURE_DELETE, $categoriesObj->getVar('cat_text')));
        }

        break;
    case 'order':
        $corder = $_POST['corder'];
        for ($i = 0, $iMax = count($corder); $i < $iMax; $i++) {
            $categoriesObj = $categoriesHandler->get($corder[$i]);
            $categoriesObj->setVar('cat_weight', $i + 1);
            $categoriesHandler->insert($categoriesObj);
        }
        break;
}
require __DIR__ . '/footer.php';
