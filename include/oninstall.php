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
 * @version        $Id: 1.0 install.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */

use XoopsModules\Wggallery;
use XoopsModules\Wggallery\Common;

/**
 * @return bool
 */
function xoops_module_pre_install_wggallery(\XoopsModule $module)
{
    require dirname(__DIR__) . '/preloads/autoloader.php';
    /** @var Wggallery\Utility $utility */
    $utility = new Wggallery\Utility();

    //check for minimum XOOPS version
    $xoopsSuccess = $utility::checkVerXoops($module);

    // check for minimum PHP version
    $phpSuccess = $utility::checkVerPhp($module);

    if (false !== $xoopsSuccess && false !== $phpSuccess) {
        $moduleTables = &$module->getInfo('tables');
        foreach ($moduleTables as $table) {
            $GLOBALS['xoopsDB']->queryF('DROP TABLE IF EXISTS ' . $GLOBALS['xoopsDB']->prefix($table) . ';');
        }
    }

    return $xoopsSuccess && $phpSuccess;
}

/**
 * @return bool|string
 */
function xoops_module_install_wggallery(\XoopsModule $module)
{
    require dirname(__DIR__) . '/preloads/autoloader.php';

    /** @var Wggallery\Helper $helper */ 
    /** @var Wggallery\Utility $utility */
    /** @var Common\Configurator $configurator */
    $helper       = Wggallery\Helper::getInstance();
    $utility      = new Wggallery\Utility();
    $configurator = new Common\Configurator();

    // Load language files
    $helper->loadLanguage('admin');
    $helper->loadLanguage('modinfo');
    $helper->loadLanguage('common');

    //  ---  CREATE FOLDERS ---------------
    if ($configurator->uploadFolders && is_array($configurator->uploadFolders)) {
        //    foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
        foreach (array_keys($configurator->uploadFolders) as $i) {
            $utility::createFolder($configurator->uploadFolders[$i]);
        }
    }

    //  ---  COPY blank.gif FILES ---------------
    if ($configurator->copyBlankFiles && is_array($configurator->copyBlankFiles)) {
        $file = dirname(__DIR__) . '/assets/images/blank.gif';
        foreach (array_keys($configurator->copyBlankFiles) as $i) {
            $dest = $configurator->copyBlankFiles[$i] . '/blank.gif';
            $utility::copyFile($file, $dest);
        }
    }

    /*
        //  ---  COPY test folder files ---------------
        if ($configurator->copyTestFolders && is_array($configurator->copyTestFolders)) {
            //        $file =  dirname(__DIR__) . '/testdata/images/';
            foreach (array_keys($configurator->copyTestFolders) as $i) {
                $src  = $configurator->copyTestFolders[$i][0];
                $dest = $configurator->copyTestFolders[$i][1];
                $utility::rcopy($src, $dest);
            }
        } */

    // copy noimage.png
    $source = XOOPS_ROOT_PATH . '/modules/wggallery/assets/images/noimage.png';
    $target = XOOPS_UPLOAD_PATH . '/wggallery/images/albums';
    copy($source, $target . '/noimage.png');

    // copy watermark logo
    $source = XOOPS_ROOT_PATH . '/modules/wggallery/assets/images/wedega_logo.png';
    $target = XOOPS_UPLOAD_PATH . '/wggallery/images/watermarks';
    copy($source, $target . '/wedega_logo.png');

    // installing watermark fonts
    $target = XOOPS_UPLOAD_PATH . '/wggallery/fonts';
    $rep    = XOOPS_ROOT_PATH . '/modules/wggallery/assets/fonts/';
    $dir    = opendir($rep);
    while ($f = readdir($dir)) {
        if (is_file($rep . $f)) {
            if (preg_match('/.*ttf/', mb_strtolower($f))) {
                copy($rep . $f, $target . '/' . $f);
            }
        }
    }

    return true;
}
