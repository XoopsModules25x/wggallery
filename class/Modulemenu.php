<?php

namespace XoopsModules\Wggallery;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project https://xoops.org/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author       Goffy - XOOPS Development Team
 */
//\defined('\XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Modulemenu
 */
class Modulemenu
{

    /** function to create an array for XOOPS main menu
     *
     * @return array
     */
    public function getMenuitemsDefault()
    {

        $moduleDirName = \basename(\dirname(__DIR__));
        $pathname      = \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/';

        require_once $pathname . 'include/common.php';
        $helper = \XoopsModules\Wggallery\Helper::getInstance();
        //load necessary language files from this module
        $helper->loadLanguage('modinfo');
        $helper->loadLanguage('common');

        $permissionsHandler = $helper->getHandler('Permissions');

        $items = [];
        $items[] = [
            'name' => \_MI_WGGALLERY_SMNAME1,
            'url'  => 'index.php',
        ];
        if ($permissionsHandler->permGlobalSubmit() > 0) {
            $items[] = [
                'name' => \_MI_WGGALLERY_SMNAME2,
                'url'  => 'albums.php',
            ];
            $items[] = [
                'name' => \_MI_WGGALLERY_SMNAME5,
                'url'  => 'images.php?op=manage',
            ];
            $items[] = [
                'name' => \_MI_WGGALLERY_SMNAME3,
                'url'  => 'albums.php?op=new',
            ];
            $uploaderType = (int)$helper->getConfig('uploader_type');
            if (2 === $uploaderType || 3 === $uploaderType || 4 === $uploaderType) {
                $items[] = [
                    'name' => \_MI_WGGALLERY_SMNAME7,
                    'url'  => 'upload_single.php',
                ];
            }
            if (1 === $uploaderType || 3 === $uploaderType || 4 === $uploaderType) {
                $items[] = [
                    'name' => \_MI_WGGALLERY_SMNAME4,
                    'url'  => 'upload.php',
                ];
            }
        }
        $items[] = [
            'name' => \_MI_WGGALLERY_SMNAME6,
            'url'  => 'search.php',
        ];

        return $items;
    }


    /** function to create a list of sublinks
     *
     * @return array
     */
    public function getMenuitemsSbadmin5()
    {
        $moduleDirName = \basename(\dirname(__DIR__));
        $pathname      = \XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/';
        $urlModule     = \XOOPS_URL . '/modules/' . $moduleDirName . '/';

        require_once $pathname . 'include/common.php';
        $helper = \XoopsModules\Wggallery\Helper::getInstance();

        //load necessary language files from this module
/*        $helper->loadLanguage('common');
        $helper->loadLanguage('main');*/
        $helper->loadLanguage('modinfo');

        // start creation of link list as array
        $permissionsHandler = $helper->getHandler('Permissions');

        $requestUri = $_SERVER['REQUEST_URI'];
        /*read navbar items related to perms of current user*/
        $items = [];
        $items[] = [
            'highlight' => \strpos($requestUri, $moduleDirName . '/index.php') > 0,
            'url' => $urlModule . 'index.php',
            'icon' => '<i class="fa fa-tachometer fa-fw fa-lg"></i>',
            'name' => \_MI_WGGALLERY_SMNAME1,
            'sublinks' => []
        ];

        if ($permissionsHandler->permGlobalSubmit() > 0) {
            $items[] = [
                'highlight' => \strpos($requestUri, $moduleDirName . '/albums.php') > 0 && 0 === (int)\strpos($requestUri, $moduleDirName . '/albums.php?op='),
                'url' => $urlModule . 'albums.php',
                'icon' => '<i class="fa fa-images fa-fw fa-lg"></i>',
                'name' => \_MI_WGGALLERY_SMNAME2,
                'sublinks' => []
            ];
            $items[] = [
                'highlight' => \strpos($requestUri, $moduleDirName . '/images.php') > 0,
                'url' => $urlModule . 'images.php?op=manage',
                'icon' => '<i class="fa fa-image fa-fw fa-lg"></i>',
                'name' => \_MI_WGGALLERY_SMNAME5,
                'sublinks' => []
            ];
            $items[] = [
                'highlight' => \strpos($requestUri, $moduleDirName . '/albums.php?op=new') > 0,
                'url' => $urlModule . 'albums.php?op=new',
                'icon' => '<i class="fa fa-images fa-fw fa-lg"></i>',
                'name' => \_MI_WGGALLERY_SMNAME3,
                'sublinks' => []
            ];
            $uploaderType = (int)$helper->getConfig('uploader_type');
            if (2 === $uploaderType || 3 === $uploaderType || 4 === $uploaderType) {
                $items[] = [
                    'highlight' => \strpos($requestUri, $moduleDirName . '/upload_single.php') > 0,
                    'url' => $urlModule . 'upload_single.php',
                    'icon' => '<i class="fa fa-upload fa-fw fa-lg"></i>',
                    'name' => \_MI_WGGALLERY_SMNAME7,
                    'sublinks' => []
                ];
            }
            if (1 === $uploaderType || 3 === $uploaderType || 4 === $uploaderType) {
                $items[] = [
                    'highlight' => \strpos($requestUri, $moduleDirName . '/upload.php') > 0,
                    'url' => $urlModule . 'upload.php',
                    'icon' => '<i class="fa fa-upload fa-fw fa-lg"></i>',
                    'name' => \_MI_WGGALLERY_SMNAME4,
                    'sublinks' => []
                ];
            }
        }
        $items[] = [
            'highlight' => \strpos($requestUri, $moduleDirName . '/search.php') > 0,
            'url' => $urlModule . 'search.php',
            'icon' => '<i class="fa fa-search fa-fw fa-lg"></i>',
            'name' => \_MI_WGGALLERY_SMNAME6,
            'sublinks' => []
        ];

        return $items;
    }


}
