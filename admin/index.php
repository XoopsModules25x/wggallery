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
 * @version        $Id: 1.0 index.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery\Common;

require __DIR__ . '/header.php';
// Count elements
$countAlbums       = $albumsHandler->getCount();
$countImages       = $imagesHandler->getCount();
$countGallerytypes = $gallerytypesHandler->getCount();
if (0 == $countGallerytypes) {
    $success = [];
    $errors  = [];
    $gallerytypesHandler->gallerytypesCreateReset($success, $errors);
    $countGallerytypes = $gallerytypesHandler->getCount();
}
$countAlbumtypes = $albumtypesHandler->getCount();
if (0 == $countAlbumtypes) {
    $success = [];
    $errors  = [];
    $albumtypesHandler->albumtypesCreateReset($success, $errors);
    $countAlbumtypes = $albumtypesHandler->getCount();
}
$countWatermarks = $watermarksHandler->getCount();
$countCategories = $categoriesHandler->getCount();
// Template Index
$templateMain = 'wggallery_admin_index.tpl';
// InfoBox Statistics
$adminObject->addInfoBox(_AM_WGGALLERY_STATISTICS);
// Info elements
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_ALBUMS . '</label>', $countAlbums));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_IMAGES . '</label>', $countImages));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_GALLERYTYPES . '</label>', $countGallerytypes));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_ALBUMTYPES . '</label>', $countAlbumtypes));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_WATERMARKS . '</label>', $countWatermarks));
$adminObject->addInfoBoxLine(sprintf('<label>' . _AM_WGGALLERY_THEREARE_CATEGORIES . '</label>', $countCategories));
// Upload Folders
$folder = [
    WGGALLERY_UPLOAD_PATH,
    WGGALLERY_UPLOAD_PATH . '/images/',
    WGGALLERY_UPLOAD_PATH . '/images/albums/',
    WGGALLERY_UPLOAD_PATH . '/images/original/',
    WGGALLERY_UPLOAD_PATH . '/images/large/',
    WGGALLERY_UPLOAD_PATH . '/images/medium/',
    WGGALLERY_UPLOAD_PATH . '/images/thumbs/',
    WGGALLERY_UPLOAD_PATH . '/images/watermarks/',
];

//------ check Upload Folders ---------------

$adminObject->addConfigBoxLine('');
$redirectFile = $_SERVER['SCRIPT_NAME'];

foreach (array_keys($folder) as $i) {
    $adminObject->addConfigBoxLine(Common\DirectoryChecker::getDirectoryStatus($folder[$i], 0777, $redirectFile));
}
//---------------------------



// display Navigation
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('index.php'));

//------------- Test Data ----------------------------
if ($helper->getConfig('displaySampleButton')) {
    xoops_loadLanguage('admin/modulesadmin', 'system');
    require dirname(__DIR__) . '/testdata/index.php';
    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=load', 'add');
    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA'), '__DIR__ . /../../testdata/index.php?op=save', 'add');
    //    $adminObject->addItemButton(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA'), '__DIR__ . /../../testdata/index.php?op=exportschema', 'add');
    $adminObject->displayButton('left', '');
}

//------------- End Test Data ----------------------------
// display Index
$GLOBALS['xoopsTpl']->assign('index', $adminObject->displayIndex());
require __DIR__ . '/footer.php';
