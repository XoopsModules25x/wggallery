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
$modversion['name'] = _MI_WGGALLERY_NAME;
$modversion['version'] = 1.09;
$modversion['description'] = _MI_WGGALLERY_DESC;
$modversion['author'] = 'Wedega';
$modversion['author_mail'] = 'webmaster@wedega.com';
$modversion['author_website_url'] = 'https://wedega.com';
$modversion['author_website_name'] = 'Wedega - Webdesign Gabor';
$modversion['credits'] = 'XOOPS Project (www.xoops.org)';
$modversion['license'] = 'GPL 2.0 or later';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-3.0.en.html';
$modversion['help'] = 'page=help';
$modversion['release_info'] = 'release_info';
$modversion['release_file'] = XOOPS_URL . '/modules/wggallery/docs/release_info file';
$modversion['release_date'] = '2018/03/19';
$modversion['manual'] = 'link to manual file';
$modversion['manual_file'] = XOOPS_URL . '/modules/wggallery/docs/install.txt';
$modversion['min_php'] = '7.0';
$modversion['min_xoops'] = '2.5.10';
$modversion['min_admin'] = '1.1';
$modversion['min_db'] = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['image'] = 'assets/images/wggallery_logo.png';
$modversion['dirname'] = basename(__DIR__);
$modversion['dirmoduleadmin'] = 'Frameworks/moduleclasses/moduleadmin';
$modversion['sysicons16'] = '../../Frameworks/moduleclasses/icons/16';
$modversion['sysicons32'] = '../../Frameworks/moduleclasses/icons/32';
$modversion['modicons16'] = 'assets/icons/16';
$modversion['modicons32'] = 'assets/icons/32';
$modversion['demo_site_url'] = 'https://xoops.wedega.com';
$modversion['demo_site_name'] = 'Wedega XOOPS Demo Site';
$modversion['support_url'] = 'https://xoops.wedega.com';
$modversion['support_name'] = 'Wedega - Webdesign Gabor';
$modversion['module_website_url'] = 'https://xoops.wedega.com';
$modversion['module_website_name'] = 'Wedega XOOPS Demo Site';
$modversion['release'] = '01/01/2018';
$modversion['module_status'] = 'Beta 1';
$modversion['system_menu'] = 1;
$modversion['hasAdmin'] = 1;
$modversion['hasMain'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';
$modversion['onInstall'] = 'include/install.php';
$modversion['onUpdate'] = 'include/update.php';
// ------------------- Templates ------------------- //
// Admin
$modversion['templates'][] = array('file' => 'wggallery_admin_about.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_header.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_index.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_albums.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_images.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_gallerytypes.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_albumtypes.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_watermarks.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_maintenance.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_permissions.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_import.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_footer.tpl', 'description' => '', 'type' => 'admin');
// User
$modversion['templates'][] = array('file' => 'wggallery_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_hovereffectideas.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_simple.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_bcards.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albums_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_album_images.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_1.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_2.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_hovereffectideas.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_simple.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_bcards.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_1.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_2.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_hovereffectideas.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_simple.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_bcards.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'wggallery_images_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_imageitem_2.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_images_manage.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'wggallery_gallery_jssor.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_jssor_arrows.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_jssor_bullets.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_jssor_thumbnails.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_jssor_loadings.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_viewerjs.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_blueimpgallery.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_justifiedgallery.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_lightbox2.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_lclightboxlite.tpl', 'description' => '');
// Blocks
// $modversion['templates'][] = array('file' => 'wggallery_block_albums_default.tpl', 'description' => 'blocks');
// $modversion['templates'][] = array('file' => 'wggallery_block_albums_full.tpl', 'description' => '');
// $modversion['templates'][] = array('file' => 'wggallery_block_albums_slider.tpl', 'description' => '');
// $modversion['templates'][] = array('file' => 'wggallery_block_images_default.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'wggallery_breadcrumbs.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_rate.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_rss.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_search.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_single.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_submit.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_trigger_uploads.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_upload.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_footer.tpl', 'description' => '');
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'][1] = 'wggallery_albums';
$modversion['tables'][2] = 'wggallery_images';
$modversion['tables'][3] = 'wggallery_gallerytypes';
$modversion['tables'][4] = 'wggallery_albumtypes';
$modversion['tables'][5] = 'wggallery_watermarks';
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
	$wggallery = WggalleryHelper::getInstance();
	$permissionsHandler = $wggallery->getHandler('permissions');
	
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
// Sub albums
// $modversion['sub'][1]['name'] = _MI_WGGALLERY_SMNAME1;
// $modversion['sub'][1]['url'] = 'albums.php';
// Sub images
// $modversion['sub'][2]['name'] = _MI_WGGALLERY_SMNAME2;
// $modversion['sub'][2]['url'] = 'images.php';
// Sub Submit
// $modversion['sub'][3]['name'] = _MI_WGGALLERY_SMNAME3;
// $modversion['sub'][3]['url'] = 'upload.php';
// ------------------- Blocks ------------------- //

// Albums default block
$modversion['blocks'][] = [
    'file'        => 'albums.php',
    'name'        => _MI_WGGALLERY_ALBUMS_BLOCKDEFAULT,
    'description' => _MI_WGGALLERY_ALBUMS_BLOCKDEFAULT_DESC,
    'show_func'   => 'b_wggallery_albums_show',
    'edit_func'   => 'b_wggallery_albums_edit',
	'template'    => $moduleDirName . '_block_albums_default.tpl',
    'options'     => 'default|4|0|20|0|20|1|1|0|0'    
];
// Images
$modversion['blocks'][] = [
    'file'        => 'images.php',
    'name'        => _MI_WGGALLERY_IMAGES_BLOCKDEFAULT,
    'description' => _MI_WGGALLERY_IMAGES_BLOCKDEFAULT_DESC,
    'show_func'   => 'b_wggallery_images_show',
    'edit_func'   => 'b_wggallery_images_edit',
	'template'    => $moduleDirName . '_block_images_default.tpl',
    'options'     => 'default|5|0|20|0|20|1|0'    
];

// ------------------- Config ------------------- //
$c = 1;
// Editor desc
xoops_load('xoopseditorhandler');
$editorHandlerDesc = XoopsEditorHandler::getInstance();
$modversion['config'][$c]['name'] = 'editor';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_EDITOR';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_EDITOR_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'dhtml';
$modversion['config'][$c]['options'] = array_flip($editorHandlerDesc->getList());
++$c;
/* // Get groups
$memberHandler  = xoops_gethandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
foreach($xoopsGroups as $key => $group) {
	$groups[$group]  = $key;
}
$modversion['config'][$c]['name'] = 'groups';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_GROUPS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_GROUPS_DESC';
$modversion['config'][$c]['formtype'] = 'select_multi';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = $groups;
$modversion['config'][$c]['options'] = $groups;
++$c;
// Get Admin groups
$criteria  = new CriteriaCompo();
$criteria->add( new Criteria( 'group_type', 'Admin' ) );
$memberHandler  = xoops_gethandler('member');
$adminXoopsGroups  = $memberHandler->getGroupList($criteria);
foreach($adminXoopsGroups as $key => $adminGroup) {
	$adminGroups[$adminGroup]  = $key;
}
$modversion['config'][$c]['name'] = 'admin_groups';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_GROUPS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_GROUPS_DESC';
$modversion['config'][$c]['formtype'] = 'select_multi';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = $adminGroups;
$modversion['config'][$c]['options'] = $adminGroups;
++$c; */
// Keywords
$modversion['config'][$c]['name'] = 'keywords';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_KEYWORDS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_KEYWORDS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'wggallery, albums, images';
++$c;
// Uploads : maxsize of image
$modversion['config'][$c]['name'] = 'maxsize';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXSIZE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXSIZE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 3145728;
$modversion['config'][$c]['options'] = array('0.5 MB' => 524288,
'1 MB' => 1048576,
'1.5 MB' => 1572864,
'2 MB' => 2097152,
'2.5 MB' => 2621440,
'3 MB' => 3145728,
'3.5 MB' => 3670016,
'4 MB' => 4194304,
'4.5 MB' => 4718592,
'5 MB' => 5242880,
'5.5 MB' => 5767168,
'6 MB' => 6291456,
'6.5 MB' => 6815744,
'7 MB' => 7340032,
'7.5 MB' => 7864320,
'8 MB' => 8388608,
'8.5 MB' => 8912896,
'9 MB' => 9437184,
'9.5 MB' => 9961472,
'10 MB' => 10485760,
);
// Uploads : mimetypes of image
++$c;
$modversion['config'][$c]['name'] = 'mimetypes';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_FILEEXT';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_FILEEXT_DESC';
$modversion['config'][$c]['formtype'] = 'select_multi';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = array('image/gif', 'image/jpeg', 'image/png');
$modversion['config'][$c]['options'] = array('gif' => 'image/gif', 'jpeg, jpg, jpe' => 'image/jpeg', 'png' => 'image/png');
++$c;
// Uploads : max width of images for upload
$modversion['config'][$c]['name'] = 'maxwidth';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXWIDTH';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXWIDTH_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 4000;
++$c;
// Uploads : max height of images for upload
$modversion['config'][$c]['name'] = 'maxheight';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXHEIGHT';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXHEIGHT_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 4000;
++$c;
// Uploads : max width for large images
$modversion['config'][$c]['name'] = 'maxwidth_large';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXWIDTH_LARGE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXWIDTH_LARGE_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 2000;
++$c;
// Uploads : max height for large images
$modversion['config'][$c]['name'] = 'maxheight_large';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXHEIGHT_LARGE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 2000;
++$c;
// Uploads : max width for medium images
$modversion['config'][$c]['name'] = 'maxwidth_medium';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXWIDTH_MEDIUM';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1000;
++$c;
// Uploads : max height for medium images
$modversion['config'][$c]['name'] = 'maxheight_medium';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXHEIGHT_MEDIUM';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1000;
++$c;
// Uploads : max width for thumbs
$modversion['config'][$c]['name'] = 'maxwidth_thumbs';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXWIDTH_THUMBS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 100;
++$c;
// Uploads : max height for thumbs
$modversion['config'][$c]['name'] = 'maxheight_thumbs';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXHEIGHT_THUMBS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 100;
++$c;
// Uploads : max width for album images
$modversion['config'][$c]['name'] = 'maxwidth_albimage';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXWIDTH_ALBIMAGE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 800;
++$c;
// Uploads : max height for album images
$modversion['config'][$c]['name'] = 'maxheight_albimage';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 600;
++$c;
// Admin pager
$modversion['config'][$c]['name'] = 'adminpager';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_ADMIN_PAGER';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_ADMIN_PAGER_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 10;
++$c;
// User pager
$modversion['config'][$c]['name'] = 'userpager';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_USER_PAGER';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_USER_PAGER_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 10;
++$c;
// target for gallery page
$modversion['config'][$c]['name'] = 'gallery_target';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_GALLERY_TARGET';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_GALLERY_TARGET_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = '_self';
$modversion['config'][$c]['options'] = array('_MI_WGGALLERY_GALLERY_TARGET_SELF' => '_self', '_MI_WGGALLERY_GALLERY_TARGET_BLANK' => '_blank');
++$c;
// Bookmarks
$modversion['config'][$c]['name'] = 'addjquery';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_ADDJQUERY';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_ADDJQUERY_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 0;
++$c;
/* // style of album items on index page
$modversion['config'][$c]['name'] = 'index_album_numbcola';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = 1;
$modversion['config'][$c]['options'] = array(1 => 1, 2 => 2, 3 => 3, 4 => 4);
++$c;
// style of album items on index page
$modversion['config'][$c]['name'] = 'index_album_numbcolc';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = 1;
$modversion['config'][$c]['options'] = array(1 => 1, 2 => 2, 3 => 3, 4 => 4);
++$c;
++$c; */
/* // type of gallery
$modversion['config'][$c]['name'] = 'gallery_type';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_GALLERY_TYPE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_GALLERY_TYPE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = 'none';
$modversion['config'][$c]['options'] = array('none' => 'none', 'PwgSlideshow' => 'pwgslideshow');
++$c; */
/* // Number column
$modversion['config'][$c]['name'] = 'numb_col';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_NUMB_COL';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_NUMB_COL_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
$modversion['config'][$c]['options'] = array(1 => '1', 2 => '2', 3 => '3', 4 => '4');
++$c;
// Divide by
$modversion['config'][$c]['name'] = 'divideby';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_DIVIDEBY';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_DIVIDEBY_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
$modversion['config'][$c]['options'] = array(1 => '1', 2 => '2', 3 => '3', 4 => '4');
++$c;*/
// Store exif 
$modversion['config'][$c]['name'] = 'store_exif';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_STOREEXIF';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_STOREEXIF_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c; 
// Panel by
$modversion['config'][$c]['name'] = 'panel_type';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_PANEL_TYPE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_PANEL_TYPE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'default';
$modversion['config'][$c]['options'] = array('default' => 'default', 'primary' => 'primary', 'success' => 'success', 'info' => 'info', 'warning' => 'warning', 'danger' => 'danger');
++$c;
// Show breadcrumb
$modversion['config'][$c]['name'] = 'show_breadcrumbs';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_SHOWBCRUMBS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_SHOWBCRUMBS_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c;
// Show module name
$modversion['config'][$c]['name'] = 'show_bcrumb_mname';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_SHOWBCRUMBS_MNAME';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c;
// Maintained by
$modversion['config'][$c]['name'] = 'maintainedby';
$modversion['config'][$c]['title'] = '_CO_WGGALLERY_MAINTAINEDBY';
$modversion['config'][$c]['description'] = '_CO_WGGALLERY_MAINTAINEDBY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'https://xoops.wedega.com';
++$c;
// Show copyright
$modversion['config'][$c]['name'] = 'show_copyright';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_SHOWCOPYRIGHT';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_SHOWCOPYRIGHT_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c;
unset($c);
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
    'subscribe_from' => ['albums.php', 'images.php'],
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
