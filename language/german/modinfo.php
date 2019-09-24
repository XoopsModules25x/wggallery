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
 * @version        $Id: 1.0 modinfo.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
define('_MI_WGGALLERY_NAME', 'wgGallery');
define('_MI_WGGALLERY_DESC', 'Dieses Modul ist einer Bildergalerie für XOOPS');
// ---------------- Admin Menu ----------------
define('_MI_WGGALLERY_ADMENU1', 'Übersicht');
define('_MI_WGGALLERY_ADMENU2', 'Alben');
define('_MI_WGGALLERY_ADMENU3', 'Bilder');
define('_MI_WGGALLERY_ADMENU4', 'Galerietypen');
define('_MI_WGGALLERY_ADMENU5', 'Albumtypen');
define('_MI_WGGALLERY_ADMENU7', 'Berechtigungen');
define('_MI_WGGALLERY_ADMENU8', 'Wartung');
define('_MI_WGGALLERY_ADMENU9', 'Wasserzeichen');
define('_MI_WGGALLERY_ADMENU10', 'Import');
define('_MI_WGGALLERY_FEEDBACK', 'Feedback');
define('_MI_WGGALLERY_ABOUT', 'Über');
// ---------------- Admin Nav ----------------
define('_MI_WGGALLERY_ADMIN_PAGER', 'Listeneinträge Adminseite');
define('_MI_WGGALLERY_ADMIN_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Administrations-Bereich');
// User
define('_MI_WGGALLERY_USER_PAGER', 'Listeneinträge Benutzerseite');
define('_MI_WGGALLERY_USER_PAGER_DESC', 'Definieren Sie die Anzahl der Einträge pro Liste im Benutzer-Bereich');
// Submenu
define('_MI_WGGALLERY_SMNAME1', 'Indexseite');
define('_MI_WGGALLERY_SMNAME2', 'Albenmanagement');
define('_MI_WGGALLERY_SMNAME3', 'Neues Album erstellen');
define('_MI_WGGALLERY_SMNAME4', 'Upload von Bildern');
define('_MI_WGGALLERY_SMNAME5', 'Bildermanagement');
// Blocks
define('_MI_WGGALLERY_ALBUMS_BLOCK', 'Block Alben');
define('_MI_WGGALLERY_ALBUMS_BLOCK_DESC', 'Zeige einen Block mit den existierenden Alben (Sortierung wählbar)');
define('_MI_WGGALLERY_IMAGES_BLOCK', 'Block Bilder');
define('_MI_WGGALLERY_IMAGES_BLOCK_DESC', 'Zeige einen Block mit den existierenden Bildern (Sortierung wählbar)');
// Config
define('_MI_WGGALLERY_EDITOR', 'Editor');
define('_MI_WGGALLERY_EDITOR_DESC', 'Bitte den zu verwendenden Editor wählen');
define('_MI_WGGALLERY_KEYWORDS', 'Schlüsselworter');
define('_MI_WGGALLERY_KEYWORDS_DESC', 'Bitte Schlüsselwörter angeben (getrennt durch ein Komma)');
define('_MI_WGGALLERY_SIZE_MB', 'MB');
define('_MI_WGGALLERY_MAXSIZE', 'Maximale Dateigröße');
define('_MI_WGGALLERY_MAXSIZE_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Dateigröße definieren');
define('_MI_WGGALLERY_FILEEXT', 'Zulässige Dateierweiterungen');
define('_MI_WGGALLERY_FILEEXT_DESC', 'Bitte die für den Upload von Dateien zulässigen Dateierweiterungen definieren');
define('_MI_WGGALLERY_MAXWIDTH', 'Maximale Breite Upload');
define('_MI_WGGALLERY_MAXWIDTH_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildbreite definieren (in pixel)');
define('_MI_WGGALLERY_MAXHEIGHT', 'Maximale Höhe Upload');
define('_MI_WGGALLERY_MAXHEIGHT_DESC', 'Bitte die für den Upload von Dateien maximal zulässige Bildhöhe definieren (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_LARGE', 'Maximale Breite für große Bilder');
define('_MI_WGGALLERY_MAXWIDTH_LARGE_DESC',
       'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE', 'Maximale Höhe für große Bilder');
define('_MI_WGGALLERY_MAXHEIGHT_LARGE_DESC',
       'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Große Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Wenn ein Bild kleiner ist als die angegebenen Maximalwerte, so wird das Bild nicht vergrößert, sondern es wird in Originalgröße abgespeichert');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM', 'Maximale Breite für mittlere Bilder');
define('_MI_WGGALLERY_MAXWIDTH_MEDIUM_DESC',
       'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Mittlere Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Sofern das Originalbild kleiner sein sollte, so wird dieses nicht vergrößert (eine Kopie des Originalbildes wird als mittleres Bild abgespeichert).');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM', 'Maximale Höhe für mittlere Bilder');
define('_MI_WGGALLERY_MAXHEIGHT_MEDIUM_DESC',
       'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Mittlere Bilder" automatisch verkleinert werden sollen (in pixel)<br>0 bedeutet, dass Bilder die Originalgröße behalten. <br>Sofern das Originalbild kleiner sein sollte, so wird dieses nicht vergrößert (eine Kopie des Originalbildes wird als mittleres Bild abgespeichert).');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS', 'Maximale Breite für Vorschaubilder');
define('_MI_WGGALLERY_MAXWIDTH_THUMBS_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel).');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS', 'Maximale Höhe für Vorschaubilder');
define('_MI_WGGALLERY_MAXHEIGHT_THUMBS_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Vorschaubilder" automatisch verkleinert werden sollen (in pixel)');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE', 'Maximale Breite für Albumbilder');
define('_MI_WGGALLERY_MAXWIDTH_ALBIMAGE_DESC', 'Definieren Sie die maximale Breite, auf die die hochgeladenen Bilder für Format "Albumbilder" automatisch verkleinert werden sollen (in pixel)<br>Wenn Sie ein Bild aus dem Album verwenden so hat diese Option keine Auswirkung');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE', 'Maximale Höhe für Albumbilder');
define('_MI_WGGALLERY_MAXHEIGHT_ALBIMAGE_DESC', 'Definieren Sie die maximale Höhe, auf die die hochgeladenen Bilder für Format "Albumbilder" automatisch verkleinert werden sollen (in pixel)<br>Wenn Sie ein Bild aus dem Album verwenden so hat diese Option keine Auswirkung');
define('_MI_WGGALLERY_GALLERY_TARGET', 'Ziel für Galerien');
define('_MI_WGGALLERY_GALLERY_TARGET_DESC', 'Bitte legen Sie fest, wo eine Bildergalerie (Slideshow) geöffnet werden soll');
define('_MI_WGGALLERY_GALLERY_TARGET_SELF', 'Gleiches Fenster/gleicher Tab');
define('_MI_WGGALLERY_GALLERY_TARGET_BLANK', 'Neues Fenster/neuer Tab');
define('_MI_WGGALLERY_ADDJQUERY', 'jquery library hinzufügen');
define('_MI_WGGALLERY_ADDJQUERY_DESC', 'Wenn Sie bereits jquery implentiert haben (z.B. durch Ihr Theme), dann bitte "Nein" wählen');
define('_MI_WGGALLERY_PANEL_TYPE', 'Panel Type');
define('_MI_WGGALLERY_PANEL_TYPE_DESC', 'Panel Type is the bootstrap html div.');
define('_MI_WGGALLERY_SHOWBCRUMBS', 'Brotkrumen-Navigation (breadcrumbs) anzeigen');
define('_MI_WGGALLERY_SHOWBCRUMBS_DESC', 'Eine Brotkrumen-Navigation zeigt den aktuellen Seitenstand innerhalb der Websitestruktur');
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME', 'Modulnamen anzeigen');
define('_MI_WGGALLERY_SHOWBCRUMBS_MNAME_DESC', 'Den Modulnamen in der Brotkrumen-Navigation anzeigen');
define('_MI_WGGALLERY_SHOWCOPYRIGHT', 'Copyright anzeigen');
define('_MI_WGGALLERY_SHOWCOPYRIGHT_DESC', 'Sie können das Copyright bei der Galerie entfernen, jedoch wird ersucht, an einer beliebigen Stelle einen Backlink auf www.wedega.com anzubringen');
define('_MI_WGGALLERY_STOREEXIF', 'Metadaten (exif) speichern');
define('_MI_WGGALLERY_STOREEXIF_DESC', 'Definieren sie, ob Sie die Metadaten der Bilder (exif-Daten) speichern wollen');
define('_MI_WGGALLERY_SHOWBUTTONTEXT', 'Schaltflächentext anzeigen');
define('_MI_WGGALLERY_SHOWBUTTONTEXT_DESC', 'Anzeigen des Schaltflächentextes. Bei NEIN wird nur das Schaltflächenbild angezeigt');
// Notifications
define('_MI_WGGALLERY_GLOBAL_NOTIFY', 'Globale Benachrichtigungen');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY', 'Sende Benachrichtigung wenn ein neues Album erstellt wird');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_CAPTION', 'Benachrichtige mich über neue Alben');
define('_MI_WGGALLERY_GLOBAL_ALB_NEW_ALL_NOTIFY_SUBJECT', 'Benachrichtigung über ein neues Album');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY', 'Sende Benachrichtigung wenn irgendein Album bearbeitet wurde');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_CAPTION', 'Benachrichtige mich über alle Albumbarbeitungen');
define('_MI_WGGALLERY_GLOBAL_ALB_MODIFY_ALL_NOTIFY_SUBJECT', 'Benachrichtigung über bearbeitete Alben');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY', 'Sende Benachrichtigung wenn ein Album auf Freigabe wartet');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_CAPTION', 'Benachrichtige mich über anstehende Freigaben von Alben');
define('_MI_WGGALLERY_GLOBAL_ALB_APPROVE_ALL_NOTIFY_SUBJECT', 'Benachrichtigung dass ein Album auf Freigabe wartet');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY', 'Sende Benachrichtigung wenn irgendein Album gelöscht wurde');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_CAPTION', 'Benachrichtige mich über alle Albumlöschungen');
define('_MI_WGGALLERY_GLOBAL_ALB_DELETE_ALL_NOTIFY_SUBJECT', 'Benachrichtigung über Albumlöschung');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY', 'Sende Benachrichtigung wenn neue Bilder hochgeladen wurden');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_CAPTION', 'Benachrichtige mich wenn irgendein Bild hochgeladen wurde');
define('_MI_WGGALLERY_GLOBAL_IMG_NEW_ALL_NOTIFY_SUBJECT', 'Benachrichtigung über hochgeladenes Bild');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY', 'Sende Benachrichtigung wenn ein Bild aus diesem Album gelöscht wurde');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_CAPTION', 'Benachrichtige mich über Löschung eines Bildes aus diesem Album');
define('_MI_WGGALLERY_GLOBAL_IMG_DELETE_ALL_NOTIFY_SUBJECT', 'Benachrichtigung über Löschung eines Bildes');
define('_MI_WGGALLERY_ALBUMS_NOTIFY', 'Benachrichtigugen Album');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY', 'Sende Benachrichtigung wenn dieses Album bearbeitet wurde');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_CAPTION', 'Benachrichtige mich Bearbeitung dieses Albums');
define('_MI_WGGALLERY_ALBUMS_ALB_MODIFY_NOTIFY_SUBJECT', 'Benachrichtigung über Bearbeitung eines Albums');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY', 'Sende Benachrichtigung wenn dieses Album gelöscht wurde');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_CAPTION', 'Benachrichtige mich über Löschung dieses Albums');
define('_MI_WGGALLERY_ALBUMS_ALB_DELETE_NOTIFY_SUBJECT', 'Benachrichtigung über Albumlöschung');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY', 'Sende Benachrichtigung wenn neue Bilder in dieses Album hochgeladen wurden');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_CAPTION', 'Benachrichtige mich über hochgeladenes Bild in dieses Album');
define('_MI_WGGALLERY_ALBUMS_IMG_NEW_NOTIFY_SUBJECT', 'Benachrichtigung über ein hochgeladenes Bild');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY', 'Sende Benachrichtigung wenn wenn ein Bild auf Freigabe wartet');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_CAPTION', 'Benachrichtige mich über anstehende Freigaben von Bildern');
define('_MI_WGGALLERY_ALBUMS_IMG_APPROVE_NOTIFY_SUBJECT', 'Benachrichtigung dass ein Bild auf Freigabe wartet');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY', 'Sende Benachrichtigung wenn wenn ein Bild dieses Albums gelöscht wurde');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_CAPTION', 'Benachrichtige mich über Bilderlöschungen dieses Albums');
define('_MI_WGGALLERY_ALBUMS_IMG_DELETE_NOTIFY_SUBJECT', 'Benachrichtigung über Bilderlöschung');
// ---------------- End ----------------
