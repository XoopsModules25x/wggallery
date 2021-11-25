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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 watermarks.php 1 Thu 2018-11-01 08:54:56Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;
use XoopsModules\Wggallery\Constants;

require __DIR__ . '/header.php';

$op   = Request::getString('op', 'list');
$wmId = Request::getInt('wm_id');
if (_CANCEL === Request::getString('cancel', 'none')) {
    $op = 'list';
}

$GLOBALS['xoTheme']->addScript(\XOOPS_URL . '/modules/wggallery/assets/js/admin.js');

$GLOBALS['xoopsTpl']->assign('wggallery_upload_url', \WGGALLERY_UPLOAD_URL);
$GLOBALS['xoopsTpl']->assign('wggallery_upload_fonts_path', \WGGALLERY_UPLOAD_FONTS_PATH);

switch ($op) {
    case 'list':
    default:
        $start        = Request::getInt('start');
        $limit        = Request::getInt('limit', $helper->getConfig('adminpager'));
        $templateMain = 'wggallery_admin_watermarks.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('watermarks.php'));
        $adminObject->addItemButton(\_CO_WGGALLERY_WATERMARK_ADD, 'watermarks.php?op=new');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $watermarksCount = $watermarksHandler->getCountWatermarks();
        $watermarksAll   = $watermarksHandler->getAllWatermarks($start, $limit);
        $GLOBALS['xoopsTpl']->assign('watermarks_count', $watermarksCount);
        $GLOBALS['xoopsTpl']->assign('wggallery_url', \WGGALLERY_URL);

        // Table view watermarks
        if ($watermarksCount > 0) {
            foreach (\array_keys($watermarksAll) as $i) {
                $watermark = $watermarksAll[$i]->getValuesWatermarks();
                $GLOBALS['xoopsTpl']->append('watermarks_list', $watermark);
                unset($watermark);
            }
            // Display Navigation
            if ($watermarksCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($watermarksCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav());
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_WGGALLERY_THEREARENT_WATERMARKS);
        }

        break;
    case 'new':
        $templateMain = 'wggallery_admin_watermarks.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('watermarks.php'));
        $adminObject->addItemButton(\_AM_WGGALLERY_WATERMARKS_LIST, 'watermarks.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $watermarksObj = $watermarksHandler->create();
        $form          = $watermarksObj->getFormWatermarks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'save':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('watermarks.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (isset($wmId)) {
            $watermarksObj = $watermarksHandler->get($wmId);
        } else {
            $watermarksObj = $watermarksHandler->create();
        }
        // Set Vars
        $wm_name = Request::getString('wm_name', 'missing_wm_name');
        $watermarksObj->setVar('wm_name', $wm_name);
        $watermarksObj->setVar('wm_type', Request::getInt('wm_type', Constants::WATERMARK_TYPETEXT));
        $watermarksObj->setVar('wm_position', Request::getInt('wm_position'));
        $watermarksObj->setVar('wm_marginlr', Request::getInt('wm_marginlr'));
        $watermarksObj->setVar('wm_margintb', Request::getInt('wm_margintb'));
        // Set Var wm_image
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $fileName       = $_FILES['attachedfile']['name'];
        $uploaderErrors = '';
        $uploader       = new \XoopsMediaUploader(\WGGALLERY_UPLOAD_IMAGE_PATH . '/watermarks/', $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $fileName);
            $imgName   = \str_replace(' ', '', $wm_name) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if (!$uploader->upload()) {
                $uploaderErrors = $uploader->getErrors();
            } else {
                $watermarksObj->setVar('wm_image', $uploader->getSavedFileName());
                $watermarksObj->setVar('wm_type', Constants::WATERMARK_TYPEIMAGE);
            }
        } else {
            if ($fileName > '') {
                $uploaderErrors = $uploader->getErrors();
            }
            $watermarksObj->setVar('wm_image', Request::getString('wm_image', 'blank.gif'));
        }
        $watermarksObj->setVar('wm_text', Request::getString('wm_text'));
        $watermarksObj->setVar('wm_font', Request::getString('wm_font'));
        $watermarksObj->setVar('wm_fontsize', Request::getInt('wm_fontsize'));
        $watermarksObj->setVar('wm_color', Request::getString('wm_color'));
        $wm_usage = Request::getInt('wm_usage');
        $watermarksObj->setVar('wm_usage', $wm_usage);
        if (Constants::WATERMARK_USAGEALL == $wm_usage) {
            // one specific watermark should be used for all
            if ($watermarksHandler->getCount() > 0) {
                // reset all other watermarks to usage none
                $sql = 'UPDATE `' . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks') . '` SET `wm_usage` = ' . Constants::WATERMARK_USAGENONE . ';';
                if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
                    \redirect_header('watermarks.php?op=list', 2, \_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1);
                }
            }
            if ($albumsHandler->getCount() > 0) {
                // reset all albums to use this watermark
                $sql = 'UPDATE `' . $GLOBALS['xoopsDB']->prefix('wggallery_albums') . '` SET `alb_wmid` = ' . $wmId . ';';
                if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
                    \redirect_header('watermarks.php?op=list', 2, \_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2);
                }
            }
        }
        if (Constants::WATERMARK_USAGESINGLE == $wm_usage) {
            // this watermark must be defined always in each single case
            // if there is a watermark with "usage for all" it must be reset to "single use"
            $sql = 'UPDATE `' . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks') . '` SET `wm_usage` = ' . Constants::WATERMARK_USAGESINGLE . ' WHERE `wm_usage` = ' . Constants::WATERMARK_USAGEALL . ';';
            if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
                \redirect_header('watermarks.php?op=list', 2, \_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1);
            }
        }
        $watermarksObj->setVar('wm_target', Request::getInt('wm_target'));

        $watermarkDate = date_create_from_format(_SHORTDATESTRING, $_POST['wm_date']);
        $watermarksObj->setVar('wm_date', $watermarkDate->getTimestamp());
        $watermarksObj->setVar('wm_submitter', Request::getInt('wm_submitter'));
        // Insert Data
        if ($watermarksHandler->insert($watermarksObj)) {
            $newWmId = $watermarksHandler->getInsertId();
            $wmId    = $wmId > 0 ? $wmId : $newWmId;
            if ($albumsHandler->getCount() > 0) {
                // reset all albums when watermark isn't in use anymore
                $sql = 'UPDATE `'
                       . $GLOBALS['xoopsDB']->prefix('wggallery_albums')
                       . '` INNER JOIN '
                       . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks')
                       . ' ON '
                       . $GLOBALS['xoopsDB']->prefix('wggallery_albums')
                       . '.alb_wmid = '
                       . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks')
                       . '.wm_id SET '
                       . $GLOBALS['xoopsDB']->prefix('wggallery_albums')
                       . '.alb_wmid = 0 WHERE ((('
                       . $GLOBALS['xoopsDB']->prefix('wggallery_watermarks')
                       . '.wm_usage)='
                       . Constants::WATERMARK_USAGENONE
                       . '));';
                if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
                    \redirect_header('watermarks.php?op=list', 2, \_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2);
                }
            }
            // create example image
            $imgTest = 'wmtest' . $wmId . '.jpg';
            \unlink(\WGGALLERY_UPLOAD_IMAGE_PATH . '/watermarks-test/' . $imgTest);
            $watermarksHandler->watermarkImage($wmId, \WGGALLERY_IMAGE_PATH . '/wmtest.jpg', \WGGALLERY_UPLOAD_IMAGE_PATH . '/watermarks-test/' . $imgTest);

            if ('' !== $uploaderErrors) {
                \redirect_header('watermarks.php?op=edit&wm_id=' . $wmId, 4, $uploaderErrors);
            } else {
                \redirect_header('watermarks.php?op=list', 2, \_CO_WGGALLERY_FORM_OK);
            }
        }
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $watermarksObj->getHtmlErrors());
        $form = $watermarksObj->getFormWatermarks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

        break;
    case 'edit':
        $templateMain = 'wggallery_admin_watermarks.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('watermarks.php'));
        $adminObject->addItemButton(\_CO_WGGALLERY_WATERMARK_ADD, 'watermarks.php?op=new');
        $adminObject->addItemButton(\_AM_WGGALLERY_WATERMARKS_LIST, 'watermarks.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $watermarksObj = $watermarksHandler->get($wmId);
        $form          = $watermarksObj->getFormWatermarks();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        // load test image
        $imgTest = 'wmtest' . $wmId . '.jpg';
        $GLOBALS['xoopsTpl']->assign('imgTest', $imgTest);
        break;
    case 'delete':
        $watermarksObj = $watermarksHandler->get($wmId);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('watermarks.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($watermarksHandler->delete($watermarksObj)) {
                \redirect_header('watermarks.php', 3, \_CO_WGGALLERY_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $watermarksObj->getHtmlErrors());
            }
        } else {
            xoops_confirm(['ok' => 1, 'wm_id' => $wmId, 'op' => 'delete'], $_SERVER['REQUEST_URI'], \sprintf(\_CO_WGGALLERY_FORM_SURE_DELETE, $watermarksObj->getVar('wm_name')));
        }

        break;
}
require __DIR__ . '/footer.php';
