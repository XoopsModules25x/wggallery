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
 * @version        $Id: 1.0 xoops_version.php 1 Mon 2018-03-19 07:47:33Z XOOPS Project (www.xoops.org) $
 */

// 

$moduleDirName = basename(__DIR__);

// ------------------- Informations ------------------- //
$modversion = [
    'name'                => _MI_WGGALLERY_NAME,
    'version'             => 1.09,
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
    'release_date'        => '2018/12/4',
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . '/modules/wggallery/docs/install.txt',
    'min_php'             => '7.0',
    'min_xoops'           => '2.5.9',
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
    'release'             => '01/01/2018',
    'module_status'       => 'Beta 1',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUpdate'            => 'include/update.php',

    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'albums',
        $moduleDirName . '_' . 'images',
        $moduleDirName . '_' . 'gallerytypes',
        $moduleDirName . '_' . 'albumtypes',
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
    ['file' => 'wggallery_rate.tpl', 'description' => ''],
    ['file' => 'wggallery_rss.tpl', 'description' => ''],
    ['file' => 'wggallery_search.tpl', 'description' => ''],
    ['file' => 'wggallery_single.tpl', 'description' => ''],
    ['file' => 'wggallery_submit.tpl', 'description' => ''],
    ['file' => 'wggallery_trigger_uploads.tpl', 'description' => ''],
    ['file' => 'wggallery_upload.tpl', 'description' => ''],
    ['file' => 'wggallery_footer.tpl', 'description' => ''],
];

// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'wggallery_search';
// ------------------- Comments ------------------- //
$modversion['comments']['pageName'] = 'comments.php';
$modversion['comments']['itemName'] = 'com_id';
// Comment callback functions
$modversion['comments']['callbackFile'] = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'wggalleryCommentsApprove';
$modversion['comments']['callback']['update'] = 'wggalleryCommentsUpdate';
// ------------------- Submenu ------------------- //

$currdirname = isset($GLOBALS['xoopsModule']) && is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';

if ($moduleDirName == $currdirname) {
    $subcount = 1;
    $pathname = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
    include_once $pathname . '/include/common.php';
    $helper = \XoopsModules\Wggallery\Helper::getInstance();
    $helper->loadLanguage('common');
    $permissionsHandler = $helper->getHandler('Permissions');
	
	if (0 < $permissionsHandler->permGlobalSubmit()) {
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME1;
		$modversion['sub'][$subcount]['url'] = 'index.php';
		$subcount++;
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME2;
		$modversion['sub'][$subcount]['url'] = 'albums.php';
		$subcount++;
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME3;
		$modversion['sub'][$subcount]['url'] = 'albums.php?op=new';
		$subcount++;
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME4;
		$modversion['sub'][$subcount]['url'] = 'upload.php';
	}
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
    'options'     => 'default|4|0|20|0|20|1|1|0|0'    
];
// Images
$modversion['blocks'][] = [
    'file'        => 'images.php',
    'name'        => _MI_WGGALLERY_IMAGES_BLOCK,
    'description' => _MI_WGGALLERY_IMAGES_BLOCK_DESC,
    'show_func'   => 'b_wggallery_images_show',
    'edit_func'   => 'b_wggallery_images_edit',
	'template'    => $moduleDirName . '_block_images_default.tpl',
    'options'     => 'default|5|0|20|0|20|1|0'    
];

// ------------------- Config ------------------- //

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
// Uploads : maxsize of image

$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => '_MI_WGGALLERY_MAXSIZE',
    'description' => '_MI_WGGALLERY_MAXSIZE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 3145728,
    'options'     => [
        '0.5 MB' => 524288,
'1 MB' => 1048576,
'1.5 MB' => 1572864,
'2 MB' => 2097152,
'2.5 MB' => 2621440,
'3 MB' => 3145728,
'3.5 MB' => 3670016,
'4 MB' => 4194304,
'4.5 MB' => 4718592,
'5 MB' => 5242880,
'6.5 MB' => 6815744,
'7 MB' => 7340032,
'7.5 MB' => 7864320,
'8 MB' => 8388608,
'8.5 MB' => 8912896,
'9 MB' => 9437184,
'9.5 MB' => 9961472,
        '10 MB'  => 10485760
    ],
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
    'default'     => 4000,
];

// Uploads : max height of images for upload
$modversion['config'][] = [
    'name'        => 'maxheight',
    'title'       => '_MI_WGGALLERY_MAXHEIGHT',
    'description' => '_MI_WGGALLERY_MAXHEIGHT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 4000,
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
    'options'     => ['_MI_WGGALLERY_GALLERY_TARGET_SELF' => '_self', '_MI_WGGALLERY_GALLERY_TARGET_BLANK' => '_blank'],
];
// Bookmarks
$modversion['config'][] = [
    'name'        => 'addjquery',
    'title'       => '_MI_WGGALLERY_ADDJQUERY',
    'description' => '_MI_WGGALLERY_ADDJQUERY_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// Store exif 
$modversion['config'][] = [
    'name'        => 'store_exif',
    'title'       => '_MI_WGGALLERY_STOREEXIF',
    'description' => '_MI_WGGALLERY_STOREEXIF_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
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

// Maintained by
$modversion['config'][] = [
    'name'        => 'maintainedby',
    'title'       => '_CO_WGGALLERY_MAINTAINEDBY',
    'description' => '_CO_WGGALLERY_MAINTAINEDBY_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'https://xoops.wedega.com',
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


// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_WGGALLERY_SHOW_SAMPLE_BUTTON',
    'description' => 'CO_WGGALLERY_SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
// ------------------- Notifications ------------------- //
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'wggallery_notify_iteminfo';
// Global Notify
$modversion['notification']['category'][] = [
    'name' => 'global',
    'title' => _MI_WGGALLERY_GLOBAL_NOTIFY,
    'description' => '',
    'subscribe_from' => ['index.php', 'albums.php', 'images.php'],
];
$modversion['notification']['category'][] = [
    'name' => 'albums',
    'title' => _MI_WGGALLERY_ALBUMS_NOTIFY,
    'description' => '',
    'subscribe_from' => ['index.php', 'albums.php'],
    'item_name' => 'alb_id',
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
$modversion['notification']['event'][]= [
	'name' => 'album_new',
	'category' => 'global',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_DESC,
	'mail_template' => 'global_alb_new_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_SUBJECT
];
// GLOBAL Events Notify Album New
$modversion['notification']['event'][]= [
	'name' => 'album_new',
	'category' => 'albums',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_DESC,
	'mail_template' => 'global_alb_new_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_ALB_NEW_NOTIFY_SUBJECT
];

// GLOBAL Events Notify Album Modified
$modversion['notification']['event'][]= [
	'name' => 'album_modify',
	'category' => 'global',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_DESC,
	'mail_template' => 'global_alb_modify_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_ALB_MODIFY_NOTIFY_SUBJECT
];
// GLOBAL Events Notify Album Approved
$modversion['notification']['event'][]= [
	'name' => 'album_approve',
	'category' => 'albums',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_DESC,
	'mail_template' => 'global_alb_approve_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_ALB_APPROVE_NOTIFY_SUBJECT
];
// GLOBAL Events Notify Album deleted
$modversion['notification']['event'][]= [
	'name' => 'album_delete',
	'category' => 'albums',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_DESC,
	'mail_template' => 'global_alb_delete_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_ALB_DELETE_NOTIFY_SUBJECT
];
// GLOBAL Events Image Notify
$modversion['notification']['event'][]= [
	'name' => 'image_new',
	'category' => 'images',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_DESC,
	'mail_template' => 'global_img_new_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_IMG_NEW_NOTIFY_SUBJECT
];
// GLOBAL Events Image Notify
$modversion['notification']['event'][]= [
	'name' => 'image_approve',
	'category' => 'images',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_DESC,
	'mail_template' => 'global_img_approve_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_IMG_APPROVE_NOTIFY_SUBJECT
];
// GLOBAL Events Image Notify
$modversion['notification']['event'][]= [
	'name' => 'image_delete',
	'category' => 'images',
	'admin_only' => 0,
	'title' => _MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY,
	'caption' => _MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_CAPTION,
	'description' => _MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_DESC,
	'mail_template' => 'global_img_delete_notify',
	'mail_subject' => _MI_WGGALLERY_GLOBAL_IMG_DELETE_NOTIFY_SUBJECT
];
