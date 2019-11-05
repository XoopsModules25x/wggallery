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
 * @min_xoops      2.5.10
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 xoops_version.php 1 Mon 2018-03-19 07:47:33Z XOOPS Project (www.xoops.org) $
 */
$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion = [
    'version'             => '1.14',
    'module_status'       => 'RC1',
    'release_date'        => '2019/11/01',
    'name'                => _MI_WGGALLERY_NAME,
    'description'         => _MI_WGGALLERY_DESC,
    'author'              => 'Wedega',
    'author_mail'         => 'webmaster@wedega.com',
    'author_website_url'  => 'https://wedega.com',
    'author_website_name' => 'Wedega - Webdesign Gabor',
    'credits'             => 'XOOPS Project (www.xoops.org)',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'http://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => XOOPS_URL . '/modules/wggallery/docs/release_info file',
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . '/modules/wggallery/docs/install.txt',
    'min_php'             => '7.0',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.1',
    'min_db'              => ['mysql' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => basename(__DIR__),
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops.wedega.com',
    'demo_site_name'      => 'Wedega XOOPS Demo Site',
    'support_url'         => 'https://xoops.wedega.com',
    'support_name'        => 'Wedega - Webdesign Gabor',
    'module_website_url'  => 'https://xoops.wedega.com',
    'module_website_name' => 'Wedega XOOPS Demo Site',
    'release'             => '01/11/2019',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'albums',
        $moduleDirName . '_' . 'albumtypes',
        $moduleDirName . '_' . 'categories',
        $moduleDirName . '_' . 'gallerytypes',
        $moduleDirName . '_' . 'images',
        $moduleDirName . '_' . 'ratings',
        $moduleDirName . '_' . 'watermarks',
    ],
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin
    ['file' => 'wggallery_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_albums.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_images.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_gallerytypes.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_albumtypes.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_watermarks.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_maintenance.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_import.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'wggallery_admin_categories.tpl', 'description' => '', 'type' => 'admin'],
    // User
    ['file' => 'wggallery_header.tpl', 'description' => ''],
    ['file' => 'wggallery_index_default.tpl', 'description' => ''],
    ['file' => 'wggallery_index_hovereffectideas.tpl', 'description' => ''],
    ['file' => 'wggallery_index_simple.tpl', 'description' => ''],
    ['file' => 'wggallery_index_bcards.tpl', 'description' => ''],
    ['file' => 'wggallery_albums_default.tpl', 'description' => ''],
    ['file' => 'wggallery_album_images.tpl', 'description' => ''],
    ['file' => 'wggallery_albumitem_1.tpl', 'description' => ''],
    ['file' => 'wggallery_albumitem_2.tpl', 'description' => ''],
    ['file' => 'wggallery_albumitem_hovereffectideas.tpl', 'description' => ''],
    ['file' => 'wggallery_albumitem_simple.tpl', 'description' => ''],
    ['file' => 'wggallery_albumitem_bcards.tpl', 'description' => ''],
    ['file' => 'wggallery_categoryitem_1.tpl', 'description' => ''],
    ['file' => 'wggallery_categoryitem_2.tpl', 'description' => ''],
    ['file' => 'wggallery_categoryitem_hovereffectideas.tpl', 'description' => ''],
    ['file' => 'wggallery_categoryitem_simple.tpl', 'description' => ''],
    ['file' => 'wggallery_categoryitem_bcards.tpl', 'description' => ''],

    ['file' => 'wggallery_images_default.tpl', 'description' => ''],
    ['file' => 'wggallery_imageitem_2.tpl', 'description' => ''],
    ['file' => 'wggallery_images_manage.tpl', 'description' => ''],

    ['file' => 'wggallery_gallery_jssor.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_jssor_arrows.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_jssor_bullets.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_jssor_thumbnails.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_jssor_loadings.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_viewerjs.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_blueimpgallery.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_justifiedgallery.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_lightbox2.tpl', 'description' => ''],
    ['file' => 'wggallery_gallery_lclightboxlite.tpl', 'description' => ''],
    // Blocks
    // array('file' => 'wggallery_block_albums_default.tpl', 'description' => 'blocks'),
    // array('file' => 'wggallery_block_albums_full.tpl', 'description' => ''),
    // array('file' => 'wggallery_block_albums_slider.tpl', 'description' => ''),
    // array('file' => 'wggallery_block_images_default.tpl', 'description' => ''),

    ['file' => 'wggallery_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'wggallery_rating_img.tpl', 'description' => ''],
    ['file' => 'wggallery_rss.tpl', 'description' => ''],
    ['file' => 'wggallery_search.tpl', 'description' => ''],
    ['file' => 'wggallery_trigger_uploads.tpl', 'description' => ''],
    ['file' => 'wggallery_upload.tpl', 'description' => ''],
    ['file' => 'wggallery_footer.tpl', 'description' => ''],
];

// ------------------- Search ------------------- //
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'wggallery_search';
// ------------------- Comments ------------------- //
$modversion['hasComments']             = 1;
$modversion['comments']['pageName']    = 'images.php';
$modversion['comments']['itemName']    = 'img_id';
$modversion['comments']['extraParams'] = ['alb_id'];

// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'wggalleryCommentsApprove';
$modversion['comments']['callback']['update']  = 'wggalleryCommentsUpdate';
// ------------------- Submenu ------------------- //

$currdirname = isset($GLOBALS['xoopsModule']) && is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';

if ($moduleDirName == $currdirname) {
    $subcount                             = 1;
    $pathname                             = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
    $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME1;
    $modversion['sub'][$subcount]['url']  = 'index.php';
    require_once $pathname . '/include/common.php';
    /** @var \XoopsModules\Wggallery\Helper $helper */
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    $helper->loadLanguage('common');
    $permissionsHandler = $helper->getHandler('Permissions');
    if ($permissionsHandler->permGlobalSubmit() > 0) {
        $subcount++;
        $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME2;
        $modversion['sub'][$subcount]['url']  = 'albums.php';
        $subcount++;
        $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME5;
        $modversion['sub'][$subcount]['url']  = 'images.php?op=manage';
        $subcount++;
        $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME3;
        $modversion['sub'][$subcount]['url']  = 'albums.php?op=new';
        $subcount++;
        $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME4;
        $modversion['sub'][$subcount]['url']  = 'upload.php';
    }
    $subcount++;
    $modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME6;
    $modversion['sub'][$subcount]['url']  = 'search.php';
}
// ------------------- Blocks ------------------- //

// Albums default block
$modversion['blocks'][] = [
    'file'        => 'albums.php',
    'name'        => _MI_WGGALLERY_ALBUMS_BLOCK,
    'description' => _MI_WGGALLERY_ALBUMS_BLOCK_DESC,
    'show_func'   => 'b_wggallery_albums_show',
    'edit_func'   => 'b_wggallery_albums_edit',
    'template'    => $moduleDirName . '_block_albums_default.tpl',
    'options'     => 'default|4|0|20|0|20|1|1|0|0',
];
// Images
$modversion['blocks'][] = [
    'file'        => 'images.php',
    'name'        => _MI_WGGALLERY_IMAGES_BLOCK,
    'description' => _MI_WGGALLERY_IMAGES_BLOCK_DESC,
    'show_func'   => 'b_wggallery_images_show',
    'edit_func'   => 'b_wggallery_images_edit',
    'template'    => $moduleDirName . '_block_images_default.tpl',
    'options'     => 'default|5|0|20|0|20|1|0',
];

// ------------------- Config ------------------- //
// group header
$modversion['config'][] = [
    'name'        => 'group_upload',
    'title'       => '_MI_WGGALLERY_GROUP_UPLOAD',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];

// Uploads : maxsize of image
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = wggalleryReturnBytes(ini_get('post_max_size'));
$iniUploadMaxFileSize = wggalleryReturnBytes(ini_get('upload_max_filesize'));
$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);
if ($maxSize > 10000 * 1048576) {
    $increment = 500;
}
if ($maxSize <= 10000 * 1048576) {
    $increment = 200;
}
if ($maxSize <= 5000 * 1048576) {
    $increment = 100;
}
if ($maxSize <= 2500 * 1048576) {
    $increment = 50;
}
if ($maxSize <= 1000 * 1048576) {
    $increment = 20;
}
if ($maxSize <= 500 * 1048576) {
    $increment = 10;
}
if ($maxSize <= 100 * 1048576) {
    $increment = 2;
}
if ($maxSize <= 50 * 1048576) {
    $increment = 1;
}
if ($maxSize <= 25 * 1048576) {
    $increment = 0.5;
}
$optionMaxsize = [];
$i             = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_WGGALLERY_SIZE_MB] = $i * 1048576;
    $i                                               += $increment;
}
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => '_MI_WGGALLERY_MAXSIZE',
    'description' => '_MI_WGGALLERY_MAXSIZE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 10485760,
    'options'     => $optionMaxsize,
];

// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'fileext',
    'title'       => '_MI_WGGALLERY_FILEEXT',
    'description' => '_MI_WGGALLERY_FILEEXT_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['gif' => 'image/gif', 'jpeg, jpg, jpe' => 'image/jpeg', 'png' => 'image/png'],
];

// Uploads : max width of images for upload
$modversion['config'][] = [
    'name'        => 'maxwidth',
    'title'       => '_MI_WGGALLERY_MAXWIDTH',
    'description' => '_MI_WGGALLERY_MAXWIDTH_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 8000,
];

// Uploads : max height of images for upload
$modversion['config'][] = [
    'name'        => 'maxheight',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 8000,
];

// store original images
$modversion['config'][] = [
    'name'        => 'store_original',
    'title'       => '_MI_WGGALLERY_STORE_ORIGINAL',
    'description' => '_MI_WGGALLERY_STORE_ORIGINAL_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// group header
$modversion['config'][] = [
    'name'        => 'group_image',
    'title'       => '_MI_WGGALLERY_GROUP_IMAGE',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];
// Uploads : max width for large images
$modversion['config'][] = [
    'name'        => 'maxwidth_large',
    'title'       => '_MI_WGGALLERY_MAXWIDTH_LARGE',
    'description' => '_MI_WGGALLERY_MAXWIDTH_LARGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 2000,
];

// Uploads : max height for large images
$modversion['config'][] = [
    'name'        => 'maxheight_large',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT_LARGE',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 2000,
];

// Uploads : max width for medium images
$modversion['config'][] = [
    'name'        => 'maxwidth_medium',
    'title'       => '_MI_WGGALLERY_MAXWIDTH_MEDIUM',
    'description' => '_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 1000,
];

// Uploads : max height for medium images
$modversion['config'][] = [
    'name'        => 'maxheight_medium',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT_MEDIUM',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 1000,
];

// Uploads : max width for thumbs
$modversion['config'][] = [
    'name'        => 'maxwidth_thumbs',
    'title'       => '_MI_WGGALLERY_MAXWIDTH_THUMBS',
    'description' => '_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 100,
];

// Uploads : max height for thumbs
$modversion['config'][] = [
    'name'        => 'maxheight_thumbs',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT_THUMBS',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 100,
];

// Uploads : max width for album images
$modversion['config'][] = [
    'name'        => 'maxwidth_albimage',
    'title'       => '_MI_WGGALLERY_MAXWIDTH_ALBIMAGE',
    'description' => '_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 800,
];

// Uploads : max height for album images
$modversion['config'][] = [
    'name'        => 'maxheight_albimage',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 600,
];

// Exif : Store exif
$modversion['config'][] = [
    'name'        => 'store_exif',
    'title'       => '_MI_WGGALLERY_STOREEXIF',
    'description' => '_MI_WGGALLERY_STOREEXIF_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// group header
$modversion['config'][] = [
    'name'        => 'group_display',
    'title'       => '_MI_WGGALLERY_GROUP_DISPLAY',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];

// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '_MI_WGGALLERY_ADMIN_PAGER',
    'description' => '_MI_WGGALLERY_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '_MI_WGGALLERY_USER_PAGER',
    'description' => '_MI_WGGALLERY_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];

// target for gallery page
$modversion['config'][] = [
    'name'        => 'gallery_target',
    'title'       => '_MI_WGGALLERY_GALLERY_TARGET',
    'description' => '_MI_WGGALLERY_GALLERY_TARGET_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => '_self',
    'options'     => ['_MI_WGGALLERY_LINK_TARGET_SELF' => '_self', '_MI_WGGALLERY_LINK_TARGET_BLANK' => '_blank'],
];

// target for show single image
$modversion['config'][] = [
    'name'        => 'image_target',
    'title'       => '_MI_WGGALLERY_IMAGE_TARGET',
    'description' => '_MI_WGGALLERY_IMAGE_TARGET_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => '_self',
    'options'     => ['_MI_WGGALLERY_LINK_TARGET_SELF' => '_self', '_MI_WGGALLERY_LINK_TARGET_BLANK' => '_blank', '_MI_WGGALLERY_LINK_TARGET_MODAL' => '_modal', '_MI_WGGALLERY_LINK_TARGET_MODALINFO' => '_modalinfo'],
];

// Panel by
$modversion['config'][] = [
    'name'        => 'panel_type',
    'title'       => '_MI_WGGALLERY_PANEL_TYPE',
    'description' => '_MI_WGGALLERY_PANEL_TYPE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'default',
    'options'     => ['default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger'],
];

// Show breadcrumb
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '_MI_WGGALLERY_SHOWBCRUMBS',
    'description' => '_MI_WGGALLERY_SHOWBCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// Show module name
$modversion['config'][] = [
    'name'        => 'show_bcrumb_mname',
    'title'       => '_MI_WGGALLERY_SHOWBCRUMBS_MNAME',
    'description' => '_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// Show copyright
$modversion['config'][] = [
    'name'        => 'show_copyright',
    'title'       => '_MI_WGGALLERY_SHOWCOPYRIGHT',
    'description' => '_MI_WGGALLERY_SHOWCOPYRIGHT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Make button text visible?
 */
$modversion['config'][] = [
    'name'        => 'displayButtonText',
    'title'       => '_MI_WGGALLERY_SHOWBUTTONTEXT',
    'description' => '_MI_WGGALLERY_SHOWBUTTONTEXT_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// use categories for images/albums
$modversion['config'][] = [
    'name'        => 'use_categories',
    'title'       => '_MI_WGGALLERY_USE_CATS',
    'description' => '_MI_WGGALLERY_USE_CATS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// use tags for images/albums
$modversion['config'][] = [
    'name'        => 'use_tags',
    'title'       => '_MI_WGGALLERY_USE_TAGS',
    'description' => '_MI_WGGALLERY_USE_TAGS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// Exif : display exif infos
// the value must be exactly the exif name (case sensitive)
$modversion['config'][] = [
    'name'        => 'exif_types',
    'title'       => '_MI_WGGALLERY_EXIFTYPES',
    'description' => '_MI_WGGALLERY_EXIFTYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['FileName', 'FileDateTime', 'FileSize', 'MimeType', 'Make', 'Model', 'ExposureTime', 'FocalLength', 'DateTimeOriginal', 'ISOSpeedRatings', 'UndefinedTag:0xA433', 'UndefinedTag:0xA434'],
    'options'     => [
        '_CO_WGGALLERY_EXIF_ALL'          => 'all',
        '_CO_WGGALLERY_EXIF_FILENAME'     => 'FileName',
        '_CO_WGGALLERY_EXIF_FILEDATETIME' => 'FileDateTime',
        '_CO_WGGALLERY_EXIF_FILESIZE'     => 'FileSize',
        '_CO_WGGALLERY_EXIF_MIMETYPE'     => 'MimeType',
        '_CO_WGGALLERY_EXIF_CAMERA'       => 'Make',
        '_CO_WGGALLERY_EXIF_MODEL'        => 'Model',
        '_CO_WGGALLERY_EXIF_EXPTIME'      => 'ExposureTime',
        '_CO_WGGALLERY_EXIF_FOCALLENGTH'  => 'FocalLength',
        '_CO_WGGALLERY_EXIF_DATETIMEORIG' => 'DateTimeOriginal',
        '_CO_WGGALLERY_EXIF_ISO'          => 'ISOSpeedRatings',
        '_CO_WGGALLERY_EXIF_LENSMAKE'     => 'UndefinedTag:0xA433',
        '_CO_WGGALLERY_EXIF_LENSMODEL'    => 'UndefinedTag:0xA434',
    ],
];

// Rating bar
$modversion['config'][] = [
    'name'        => 'ratingbars',
    'title'       => '_MI_WGGALLERY_RATINGBARS',
    'description' => '_MI_WGGALLERY_RATINGBARS_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 0,
    'options'     => ['_MI_WGGALLERY_RATING_NONE' => 0, '_MI_WGGALLERY_RATING_5STARS' => 1, '_MI_WGGALLERY_RATING_10STARS' => 2, '_MI_WGGALLERY_RATING_LIKES' => 3, '_MI_WGGALLERY_RATING_10NUM' => 4],
];

$group_handler    = xoops_getHandler('group');
$group_arr        = $group_handler->getObjects();
$ratingbar_groups = [];
foreach (array_keys($group_arr) as $i) {
    $ratingbar_groups[$group_arr[$i]->getVar('name')] = $group_arr[$i]->getVar('groupid');
}
$modversion['config'][] = [
    'name'        => 'ratingbar_groups',
    'title'       => '_MI_WGGALLERY_RATINGBAR_GROUPS',
    'description' => '_MI_WGGALLERY_RATINGBAR_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['1'],
    'options'     => $ratingbar_groups,
];

/**
 * Make Sample button visible?
 */
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

/**
 * Show Developer Tools?
 */
/* $modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
]; */

// group header
$modversion['config'][] = [
    'name'        => 'group_misc',
    'title'       => '_MI_WGGALLERY_GROUP_MISC',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'even',
    'category'    => 'group_header',
];

// Editor desc
xoops_load('xoopseditorhandler');
$editorHandlerDesc      = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor',
    'title'       => '_MI_WGGALLERY_EDITOR',
    'description' => '_MI_WGGALLERY_EDITOR_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandlerDesc->getList()),
];

// Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '_MI_WGGALLERY_KEYWORDS',
    'description' => '_MI_WGGALLERY_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'wggallery, albums, images',
];

// jquery
$modversion['config'][] = [
    'name'        => 'addjquery',
    'title'       => '_MI_WGGALLERY_ADDJQUERY',
    'description' => '_MI_WGGALLERY_ADDJQUERY_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '_CO_WGGALLERY_MAINTAINEDBY',
    'description' => '_CO_WGGALLERY_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.wedega.com',
];

// ------------------- Notifications ------------------- //
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'wggallery_notify_iteminfo';
// Global Notify
$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => _MI_WGGALLERY_GLOBAL_NOTIFY,
    'description'    => '',
    'subscribe_from' => ['index.php', 'albums.php', 'images.php'],
];
$modversion['notification']['category'][] = [
    'name'           => 'albums',
    'title'          => _MI_WGGALLERY_ALBUMS_NOTIFY,
    'description'    => '',
    'subscribe_from' => ['albums.php', 'images.php'],
    'item_name'      => 'alb_id',
    'allow_bookmark' => 1,
];
// $modversion['notification']['category'][] = [
// 'name' => 'images',
// 'title' => _MI_WGGALLERY_IMAGES_NOTIFY,
// 'description' => '',
// 'subscribe_from' => ['index.php', 'albums.php', 'images.php'],
// 'item_name' => 'img_id',
// 'allow_bookmark' => 1,
// ];
// GLOBAL Events Notify Album New
$modversion['notification']['event'][] = [
    'name'          => 'album_new_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_new_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_SUBJECT,
];
// GLOBAL Events Notify about each modification of albums
$modversion['notification']['event'][] = [
    'name'          => 'album_modify_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_modify_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_SUBJECT,
];
// GLOBAL Events Notify Album Approved
$modversion['notification']['event'][] = [
    'name'          => 'album_approve_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_approve_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_SUBJECT,
];
// GLOBAL Events Notify about each deleting of albums
$modversion['notification']['event'][] = [
    'name'          => 'album_delete_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_delete_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_SUBJECT,
];
// GLOBAL Events Notify Album New
$modversion['notification']['event'][] = [
    'name'          => 'image_new_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_img_new_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_SUBJECT,
];
// GLOBAL Events Notify Album New
$modversion['notification']['event'][] = [
    'name'          => 'image_delete_all',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY,
    'caption'       => _MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_img_new_notify',
    'mail_subject'  => _MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_SUBJECT,
];
// Album Events Notify about modification own albums
$modversion['notification']['event'][] = [
    'name'          => 'album_modify',
    'category'      => 'albums',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY,
    'caption'       => _MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_modify_notify',
    'mail_subject'  => _MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_SUBJECT,
];
// Album Events Notify about deleting this albums
$modversion['notification']['event'][] = [
    'name'          => 'album_delete',
    'category'      => 'albums',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY,
    'caption'       => _MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_alb_delete_notify',
    'mail_subject'  => _MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_SUBJECT,
];
// Album Events Image new Notify
$modversion['notification']['event'][] = [
    'name'          => 'image_new',
    'category'      => 'albums',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY,
    'caption'       => _MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_img_new_notify',
    'mail_subject'  => _MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_SUBJECT,
];
// Album Events Image approve Notify
$modversion['notification']['event'][] = [
    'name'          => 'image_approve',
    'category'      => 'albums',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY,
    'caption'       => _MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_img_approve_notify',
    'mail_subject'  => _MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_SUBJECT,
];
// Album Events Image deleted Notify
$modversion['notification']['event'][] = [
    'name'          => 'image_delete',
    'category'      => 'albums',
    'admin_only'    => 0,
    'title'         => _MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY,
    'caption'       => _MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_img_delete_notify',
    'mail_subject'  => _MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_SUBJECT,
];
