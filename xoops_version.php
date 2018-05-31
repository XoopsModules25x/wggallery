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
 * @version        $Id: 1.0 xoops_version.php 1 Mon 2018-03-19 07:47:33Z XOOPS Project (www.xoops.org) $
 */

// 
$dirname  = basename(__DIR__);
// ------------------- Informations ------------------- //
$modversion['name'] = _MI_WGGALLERY_NAME;
$modversion['version'] = 1.03;
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
$modversion['min_php'] = '5.3';
$modversion['min_xoops'] = '2.5.7';
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
$modversion['templates'][] = array('file' => 'wggallery_admin_permissions.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'wggallery_admin_footer.tpl', 'description' => '', 'type' => 'admin');
// User
$modversion['templates'][] = array('file' => 'wggallery_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_index_hovereffectideas.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_1.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_albumitem_2.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_1.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_categoryitem_2.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'wggallery_albums_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_images_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_pgwslideshow.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_pgwslider.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_tarasdimagesgrid.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_viewerjs.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_blueimpgallery.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_justifiedgallery.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_gallery_lightbox.tpl', 'description' => '');
// Blocks
$modversion['templates'][] = array('file' => 'wggallery_block_albums_default.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'wggallery_block_albums_slider.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'wggallery_gallery_pwgslideshow.tpl', 'description' => '');
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
if ($dirname == $currdirname) {
    $subcount = 1;
    $pathname = XOOPS_ROOT_PATH . '/modules/' . $dirname;
    include_once $pathname . '/include/common.php';
	$wggallery = WggalleryHelper::getInstance();
	$permissionsHandler = $wggallery->getHandler('permissions');
	
	if (0 < $permissionsHandler->permGlobalSubmit()) {
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME1;
		$modversion['sub'][$subcount]['url'] = 'albums.php';
		$subcount++;
		// Sub Submit
		$modversion['sub'][$subcount]['name'] = _MI_WGGALLERY_SMNAME3;
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
$b = 1;
// Albums
$modversion['blocks'][$b]['file'] = 'albums.php';
$modversion['blocks'][$b]['name'] = _MI_WGGALLERY_ALBUMS_BLOCK;
$modversion['blocks'][$b]['description'] = _MI_WGGALLERY_ALBUMS_BLOCK_DESC;
$modversion['blocks'][$b]['show_func'] = 'b_wggallery_albums_show';
$modversion['blocks'][$b]['edit_func'] = 'b_wggallery_albums_edit';
$modversion['blocks'][$b]['template'] = 'wggallery_block_albums.tpl';
$modversion['blocks'][$b]['options'] = 'default|5|25|3|1|1|0|0';
++$b;
// Images
$modversion['blocks'][$b]['file'] = 'images.php';
$modversion['blocks'][$b]['name'] = _MI_WGGALLERY_IMAGES_BLOCK;
$modversion['blocks'][$b]['description'] = _MI_WGGALLERY_IMAGES_BLOCK_DESC;
$modversion['blocks'][$b]['show_func'] = 'b_wggallery_images_show';
$modversion['blocks'][$b]['edit_func'] = 'b_wggallery_images_edit';
$modversion['blocks'][$b]['template'] = 'wggallery_block_images.tpl';
$modversion['blocks'][$b]['options'] = 'img|5|25|3|1|0';
++$b;
unset($b);
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
// Get groups
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
++$c;
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
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 5000000;
// Uploads : mimetypes of image
++$c;
$modversion['config'][$c]['name'] = 'fileext';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_FILEEXT';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_FILEEXT_DESC';
$modversion['config'][$c]['formtype'] = 'select_multi';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = array('gif', 'jpg', 'jpeg', 'png');
$modversion['config'][$c]['options'] = array('gif' => 'gif', 'jpeg' => 'jpeg','jpg' => 'jpg','jpe' => 'jpe', 'png' => 'png');
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
// show submitter album
$modversion['config'][$c]['name'] = 'album_showsubmitter';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_ALBUM_SHOWSUBMITTER';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_ALBUM_SHOWSUBMITTER_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c;
// show submitter image
$modversion['config'][$c]['name'] = 'image_showsubmitter';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_IMAGE_SHOWSUBMITTER';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_IMAGE_SHOWSUBMITTER_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 1;
++$c;
// style of album index page
$modversion['config'][$c]['name'] = 'index_album_style';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_INDEX_ALBUM_STYLE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_INDEX_ALBUM_STYLE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = '_default';
$modversion['config'][$c]['options'] = array('default' => '_default', 'label style 1' => '_style1','style 2' => '_style2');
++$c;
// style of album items on index page
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
// style of image index page
$modversion['config'][$c]['name'] = 'style_index_image';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_STYLE_INDEX_IMAGE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_STYLE_INDEX_IMAGE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = '_default';
$modversion['config'][$c]['options'] = array('default' => '_default', 'label style 1' => '_style1','style 2' => '_style2');
++$c;
/* // type of gallery
$modversion['config'][$c]['name'] = 'gallery_type';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_GALLERY_TYPE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_GALLERY_TYPE_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'array';
$modversion['config'][$c]['default'] = 'none';
$modversion['config'][$c]['options'] = array('none' => 'none', 'PwgSlideshow' => 'pwgslideshow');
++$c; */
// Number column
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
++$c;
// Table type
$modversion['config'][$c]['name'] = 'table_type';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_TABLE_TYPE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_DIVIDEBY_DESC';
$modversion['config'][$c]['formtype'] = 'select';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 'bordered';
$modversion['config'][$c]['options'] = array('bordered' => 'bordered', 'striped' => 'striped', 'hover' => 'hover', 'condensed' => 'condensed');
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
// Advertise
$modversion['config'][$c]['name'] = 'advertise';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_ADVERTISE';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_ADVERTISE_DESC';
$modversion['config'][$c]['formtype'] = 'textarea';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = '';
++$c;
// Bookmarks
$modversion['config'][$c]['name'] = 'bookmarks';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_BOOKMARKS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_BOOKMARKS_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 0;
++$c;
// Facebook Comments
$modversion['config'][$c]['name'] = 'facebook_comments';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_FACEBOOK_COMMENTS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_FACEBOOK_COMMENTS_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 0;
++$c;
// Disqus Comments
$modversion['config'][$c]['name'] = 'disqus_comments';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_DISQUS_COMMENTS';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_DISQUS_COMMENTS_DESC';
$modversion['config'][$c]['formtype'] = 'yesno';
$modversion['config'][$c]['valuetype'] = 'int';
$modversion['config'][$c]['default'] = 0;
++$c;
// Maintained by
$modversion['config'][$c]['name'] = 'maintainedby';
$modversion['config'][$c]['title'] = '_MI_WGGALLERY_MAINTAINEDBY';
$modversion['config'][$c]['description'] = '_MI_WGGALLERY_MAINTAINEDBY_DESC';
$modversion['config'][$c]['formtype'] = 'textbox';
$modversion['config'][$c]['valuetype'] = 'text';
$modversion['config'][$c]['default'] = 'https://xoops.wedega.com';
unset($c);
// ------------------- Notifications ------------------- //
$modversion['hasNotification'] = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'wggallery_notify_iteminfo';
// Global Notify
$modversion['notification']['category'][1]['name'] = 'global';
$modversion['notification']['category'][1]['title'] = _MI_WGGALLERY_GLOBAL_NOTIFY;
$modversion['notification']['category'][1]['description'] = _MI_WGGALLERY_GLOBAL_NOTIFY_DESC;
$modversion['notification']['category'][1]['subscribe_from'] = array('index.php', 'albums.php', 'images.php');
// Category Notify
$modversion['notification']['category'][2]['name'] = 'category';
$modversion['notification']['category'][2]['title'] = _MI_WGGALLERY_CATEGORY_NOTIFY;
$modversion['notification']['category'][2]['description'] = _MI_WGGALLERY_CATEGORY_NOTIFY_DESC;
$modversion['notification']['category'][2]['subscribe_from'] = array('albums.php', 'images.php');
$modversion['notification']['category'][2]['item_name'] = 'img_albid';
$modversion['notification']['category'][2]['allow_bookmark'] = 1;
// Image Notify
$modversion['notification']['category'][3]['name'] = 'image';
$modversion['notification']['category'][3]['title'] = _MI_WGGALLERY_IMAGE_NOTIFY;
$modversion['notification']['category'][3]['description'] = _MI_WGGALLERY_IMAGE_NOTIFY_DESC;
$modversion['notification']['category'][3]['subscribe_from'] = 'images.php';
$modversion['notification']['category'][3]['item_name'] = 'img_id';
$modversion['notification']['category'][3]['allow_bookmark'] = 1;
// GLOBAL Notify
$modversion['notification']['event'][1]['name'] = 'new_category';
$modversion['notification']['event'][1]['category'] = 'global';
$modversion['notification']['event'][1]['admin_only'] = 0;
$modversion['notification']['event'][1]['title'] = _MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY;
$modversion['notification']['event'][1]['caption'] = _MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION;
$modversion['notification']['event'][1]['description'] = _MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_DESC;
$modversion['notification']['event'][1]['mail_template'] = 'global_newcategory_notify';
$modversion['notification']['event'][1]['mail_subject'] = _MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT;
// GLOBAL Notify
$modversion['notification']['event'][2]['name'] = 'image_modify';
$modversion['notification']['event'][2]['category'] = 'global';
$modversion['notification']['event'][2]['admin_only'] = 1;
$modversion['notification']['event'][2]['title'] = _MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY;
$modversion['notification']['event'][2]['caption'] = _MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_CAPTION;
$modversion['notification']['event'][2]['description'] = _MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_DESC;
$modversion['notification']['event'][2]['mail_template'] = 'global_imagemodify_notify';
$modversion['notification']['event'][2]['mail_subject'] = _MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_SUBJECT;
// GLOBAL Notify
$modversion['notification']['event'][3]['name'] = 'image_submit';
$modversion['notification']['event'][3]['category'] = 'global';
$modversion['notification']['event'][3]['admin_only'] = 1;
$modversion['notification']['event'][3]['title'] = _MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY;
$modversion['notification']['event'][3]['caption'] = _MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_CAPTION;
$modversion['notification']['event'][3]['description'] = _MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_DESC;
$modversion['notification']['event'][3]['mail_template'] = 'global_imagesubmit_notify';
$modversion['notification']['event'][3]['mail_subject'] = _MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_SUBJECT;
// GLOBAL Notify
$modversion['notification']['event'][4]['name'] = 'new_image';
$modversion['notification']['event'][4]['category'] = 'global';
$modversion['notification']['event'][4]['admin_only'] = 0;
$modversion['notification']['event'][4]['title'] = _MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY;
$modversion['notification']['event'][4]['caption'] = _MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_CAPTION;
$modversion['notification']['event'][4]['description'] = _MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_DESC;
$modversion['notification']['event'][4]['mail_template'] = 'global_newimage_notify';
$modversion['notification']['event'][4]['mail_subject'] = _MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_SUBJECT;
// CATEGORY Notify
$modversion['notification']['event'][5]['name'] = 'image_submit';
$modversion['notification']['event'][5]['category'] = 'category';
$modversion['notification']['event'][5]['admin_only'] = 1;
$modversion['notification']['event'][5]['title'] = _MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY;
$modversion['notification']['event'][5]['caption'] = _MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_CAPTION;
$modversion['notification']['event'][5]['description'] = _MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_DESC;
$modversion['notification']['event'][5]['mail_template'] = 'category_imagesubmit_notify';
$modversion['notification']['event'][5]['mail_subject'] = _MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_SUBJECT;
// CATEGORY Notify
$modversion['notification']['event'][6]['name'] = 'new_image';
$modversion['notification']['event'][6]['category'] = 'category';
$modversion['notification']['event'][6]['admin_only'] = 0;
$modversion['notification']['event'][6]['title'] = _MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY;
$modversion['notification']['event'][6]['caption'] = _MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_CAPTION;
$modversion['notification']['event'][6]['description'] = _MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_DESC;
$modversion['notification']['event'][6]['mail_template'] = 'category_newimage_notify';
$modversion['notification']['event'][6]['mail_subject'] = _MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_SUBJECT;
// IMAGE Notify
$modversion['notification']['event'][7]['name'] = 'approve';
$modversion['notification']['event'][7]['category'] = 'image';
$modversion['notification']['event'][7]['admin_only'] = 1;
$modversion['notification']['event'][7]['title'] = _MI_WGGALLERY_IMAGE_APPROVE_NOTIFY;
$modversion['notification']['event'][7]['caption'] = _MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_CAPTION;
$modversion['notification']['event'][7]['description'] = _MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_DESC;
$modversion['notification']['event'][7]['mail_template'] = 'image_approve_notify';
$modversion['notification']['event'][7]['mail_subject'] = _MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_SUBJECT;
