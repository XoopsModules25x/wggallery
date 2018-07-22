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
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
 
include_once 'common.php'; 
 
// ---------------- Admin Main ----------------
define('_MI_WGGALLERY_NAME', 'wgGallery');
define('_MI_WGGALLERY_DESC', 'Dieses Modul ist einer Bildergalerie für XOOPS');
// ---------------- Admin Menu ----------------
define('_MI_WGGALLERY_ADMENU1', 'Übersicht');
define('_MI_WGGALLERY_ADMENU2', 'Alben');
define('_MI_WGGALLERY_ADMENU3', 'Bilder');
define('_MI_WGGALLERY_ADMENU4', 'Gallerietypen');
define('_MI_WGGALLERY_ADMENU5', 'Albumtypen');
define('_MI_WGGALLERY_ADMENU7', 'Berechtigungen');
define('_MI_WGGALLERY_ADMENU8', 'Wartung');
define('_MI_WGGALLERY_ABOUT', 'Über');
// ---------------- Admin Nav ----------------
define('_MI_WGGALLERY_ADMIN_PAGER', 'Listenienträge Administrationsseite');
define('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Admin-Bereich');
// User
define('_MI_WGGALLERY_USER_PAGER', 'Benutzerseite');
define('_MI_WGGALLERY_USER_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Benutzer-Bereich');
// Submenu
define('_MI_WGGALLERY_SMNAME1', 'Indexseite');
define('_MI_WGGALLERY_SMNAME2', 'Albenmanagement');
define('_MI_WGGALLERY_SMNAME3', 'Neues Album erstellen');
define('_MI_WGGALLERY_SMNAME4', 'Upload von Bildern');
// Blocks
define('_MI_WGGALLERY_ALBUMS_BLOCK', 'Block Alben');
define('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Zeige einen Block mit den existierenden Alben (sortiert nach Reihung und Datum)');
// define('_MI_WGGALLERY_ALBUMS_BLOCK_LAST', 'Last albums block');
// define('_MI_WGGALLERY_ALBUMS_BLOCK_LAST_DESC', 'Show a block with last albums');
// define('_MI_WGGALLERY_IMAGES_BLOCK', 'Images block');
// define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Images block description');
define('_MI_WGGALLERY_IMAGES_BLOCK', 'Block Bilder');
define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Zeige einen Block mit den existierenden Bildern (sortiert nach Reihung und Datum)');
// define('_MI_WGGALLERY_IMAGES_BLOCK_LAST', 'Images block last');
// define('_MI_WGGALLERY_IMAGES_BLOCK_LAST_DESC', 'Images block last description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_NEW', 'Images block new');
// define('_MI_WGGALLERY_IMAGES_BLOCK_NEW_DESC', 'Images block new description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_HITS', 'Images block hits');
// define('_MI_WGGALLERY_IMAGES_BLOCK_HITS_DESC', 'Images block hits description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_TOP', 'Images block top');
// define('_MI_WGGALLERY_IMAGES_BLOCK_TOP_DESC', 'Images block top description');
// define('_MI_WGGALLERY_IMAGES_BLOCK_RANDOM', 'Images block random');
// define('_MI_WGGALLERY_IMAGES_BLOCK_RANDOM_DESC', 'Images block random description');
// Config
define('_MI_WGGALLERY_EDITOR', 'Editor');
define('_MI_WGGALLERY_EDITOR_DESC', 'Bitte den zu verwendenden Editor wählen');
define('_MI_WGGALLERY_KEYWORDS', 'Schlüsselworter');
define('_MI_WGGALLERY_KEYWORDS_DESC', 'Bitte Schlüsselwörter angeben (getrennt durch ein Komma)');
define('_MI_WGGALLERY_MAXSIZE', 'Maximale Dateigröße');
define('_MI_WGGALLERY_MAXSIZE_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Dateigröße definieren');
define('_MI_WGGALLERY_FILEEXT', 'Zulässige Dateierweiterungen');
define('_MI_WGGALLERY_FILEEXT_DESC', 'Bitte die für den Upload von Dateien zulässigen Dateierweiterungen definieren');
define('_MI_WGGALLERY_MAXWIDTH', 'Maximale Breite Upload');
define('_MI_WGGALLERY_MAXWIDTH_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildbreite definieren (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT', 'Maximale Höhe Upload');
define('_MI_WGGALLERY_MAXHEIGHT_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildhöhe definieren (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_LARGE', 'Maximale Breite für große Bilder');
define('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br />0 bedeutet, dass Bilder die Originalgröße behalten. <br />Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Maximale Höhe für große Bilder');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br />0 bedeutet, dass Bilder die Originalgröße behalten. <br />Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Maximale Breite für mittlere Bilder');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Mittlere Bilder" automatisch verkleinert werden sollen (in pixel)<br />0 bedeutet, dass Bilder die Originalgröße behalten. <br>Sofern das Originalbild kleiner sein sollte, so wird dieses nicht vergrößert (eine Kopie des Originalbildes wird als mittleres Bild abgespeichert).');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Maximale Höhe für mittlere Bilder');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Mittlere Bilder" automatisch verkleinert werden sollen (in pixel)<br />0 bedeutet, dass Bilder die Originalgröße behalten. <br>Sofern das Originalbild kleiner sein sollte, so wird dieses nicht vergrößert (eine Kopie des Originalbildes wird als mittleres Bild abgespeichert).');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Maximale Breite für Vorschaubilder');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel).');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Maximale Höhe für Vorschaubilder');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel)');
// define('_MI_WGGALLERY_ALBUM_SHOWSUBMITTER', 'Show submitter album');
// define('_MI_WGGALLERY_ALBUM_SHOWSUBMITTER_DESC', 'Show submitter of album on index page');
define('_MI_WGGALLERY_IMAGE_SHOWSUBMITTER', 'Einsender des Bildes anzeigen');
define('_MI_WGGALLERY_IMAGE_SHOWSUBMITTER_DESC', 'Definieren Sie, ob die Einsender der Bilder beim jeweiligen  Bild angezeigt werden sollen');
// define('_MI_WGGALLERY_INDEX_ALBUM_STYLE', 'Style album index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_STYLE_DESC', 'Please select a style for your album index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA', 'Number columns albums index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLA_DESC', 'Please select the number of albums per row on index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC', 'Number columns categories index page');
// define('_MI_WGGALLERY_INDEX_ALBUM_NUMBCOLC_DESC', 'Please select the number of categories per row on index page');
// define('_MI_WGGALLERY_STYLE_INDEX_IMAGE', 'Style image index page');
// define('_MI_WGGALLERY_STYLE_INDEX_IMAGE_DESC', 'Please select a style for your image index page');
// define('_MI_WGGALLERY_GALLERY_TYPE', 'Gallery type');
// define('_MI_WGGALLERY_GALLERY_TYPE_DESC', 'Please select a gallery type for displaying your images');
define('_MI_WGGALLERY_ALLOW_DOWNLOAD', 'Downloads erlauben');
define('_MI_WGGALLERY_ALLOW_DOWNLOAD_DESC', 'Bitte entscheiden Sie, welche Bilder heruntergeladen werden dürfen');
define('_MI_WGGALLERY_GALLERY_TARGET', 'Ziel für Gallerien');
define('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Bitte legen Sie fest, wo eine Bildergallerie (Slideshow) geöffnet werden soll');
define('_MI_WGGALLERY_GALLERY_TARGET_SELF', 'Gleiches Fenster/gleicher Tab');
define('_MI_WGGALLERY_GALLERY_TARGET_BLANK', 'Neues Fenster/neuer Tab');
define('_MI_WGGALLERY_ADDJQUERY', 'jquery library hinzufügen');
define('_MI_WGGALLERY_ADDJQUERY_DESC', 'Wenn Sie bereits jquery implentiert haben (z.B. durch Ihr Theme), dann bitte "Nein" wählen');
// define('_MI_WGGALLERY_NUMB_COL', 'Number Columns');
// define('_MI_WGGALLERY_NUMB_COL_DESC', 'Number Columns to View.');
// define('_MI_WGGALLERY_DIVIDEBY', 'Divide By');
// define('_MI_WGGALLERY_DIVIDEBY_DESC', 'Divide by columns number.');
// define('_MI_WGGALLERY_TABLE_TYPE', 'Table Type');
// define('_MI_WGGALLERY_TABLE_TYPE_DESC', 'Table Type is the bootstrap html table.');
define('_MI_WGGALLERY_PANEL_TYPE', 'Panel Type');
define('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGGALLERY_IDPAYPAL', 'Paypal ID');
define('_MI_WGGALLERY_IDPAYPAL_DESC', 'Insert here your PayPal ID for donactions.');
define('_MI_WGGALLERY_ADVERTISE', 'Advertisement Code');
define('_MI_WGGALLERY_ADVERTISE_DESC', 'Insert here the advertisement code');
define('_MI_WGGALLERY_MAINTAINEDBY', 'Maintained By');
define('_MI_WGGALLERY_MAINTAINEDBY_DESC', 'Allow url of support site or community');
define('_MI_WGGALLERY_BOOKMARKS', 'Social Bookmarks');
define('_MI_WGGALLERY_BOOKMARKS_DESC', 'Show Social Bookmarks in the single page');
define('_MI_WGGALLERY_FACEBOOK_COMMENTS', 'Facebook comments');
define('_MI_WGGALLERY_FACEBOOK_COMMENTS_DESC', 'Allow Facebook comments in the single page');
define('_MI_WGGALLERY_DISQUS_COMMENTS', 'Disqus comments');
define('_MI_WGGALLERY_DISQUS_COMMENTS_DESC', 'Allow Disqus comments in the single page');
// Notifications
define('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Global notify');
define('_MI_WGGALLERY_GLOBAL_NOTIFY_DESC', 'Global notify desc');
define('_MI_WGGALLERY_CATEGORY_NOTIFY', 'Category notify');
define('_MI_WGGALLERY_CATEGORY_NOTIFY_DESC', 'Category notify desc');
define('_MI_WGGALLERY_IMAGE_NOTIFY', 'Image notify');
define('_MI_WGGALLERY_IMAGE_NOTIFY_DESC', 'Image notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY', 'Global newcategory notify');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION', 'Global newcategory notify caption');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_DESC', 'Global newcategory notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT', 'Global newcategory notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY', 'Global imagemodify notify');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_CAPTION', 'Global image modify notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_DESC', 'Global imagemodify notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGEMODIFY_NOTIFY_SUBJECT', 'Global image modify notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY', 'Global image broken notify');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_CAPTION', 'Global imagebroken notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_DESC', 'Global imagebroken notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGEBROKEN_NOTIFY_SUBJECT', 'Global imagebroken notify subject');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY', 'Global image submit notify');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_CAPTION', 'Global image submit notify caption');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_DESC', 'Global imagesubmit notify desc');
define('_MI_WGGALLERY_GLOBAL_IMAGESUBMIT_NOTIFY_SUBJECT', 'Global imagesubmit notify subject');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY', 'Global newimage notify');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_CAPTION', 'Global newimage notify caption');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_DESC', 'Global newimage notify desc');
define('_MI_WGGALLERY_GLOBAL_NEWIMAGE_NOTIFY_SUBJECT', 'Global newimage notify subject');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY', 'Category imagesubmit notify');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_CAPTION', 'Category image submit notify caption');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_DESC', 'Category image submit notify desc');
define('_MI_WGGALLERY_CATEGORY_IMAGESUBMIT_NOTIFY_SUBJECT', 'Category image submit notify subject');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY', 'Category newimage notify');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_CAPTION', 'Category newimage notify caption');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_DESC', 'Category newimage notify desc');
define('_MI_WGGALLERY_CATEGORY_NEWIMAGE_NOTIFY_SUBJECT', 'Category newimage notify subject');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY', 'Image approve notify');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_CAPTION', 'Image approve notify caption');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_DESC', 'Image approve notify desc');
define('_MI_WGGALLERY_IMAGE_APPROVE_NOTIFY_SUBJECT', 'Image approve notify subject');
// Permissions Groups
// define('_MI_WGGALLERY_GROUPS', 'Groups access');
// define('_MI_WGGALLERY_GROUPS_DESC', 'Select general access permission for groups.');
// define('_MI_WGGALLERY_ADMIN_GROUPS', 'Admin Group Permissions');
// define('_MI_WGGALLERY_ADMIN_GROUPS_DESC', 'Which groups have access to tools and permissions page');
// ---------------- End ----------------