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
 * @version        $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */
 
// defines for state
define('_CO_WGGALLERY_STATE_OFFLINE', 'Offline');
define('_CO_WGGALLERY_STATE_ONLINE', 'Online');
define('_CO_WGGALLERY_STATE_APPROVAL', 'Wartet auf Freigabe');
// defines for download

// General
define('_CO_WGGALLERY_NONE', 'Keine');
define('_CO_WGGALLERY_BACK', 'Zurück');
define('_CO_WGGALLERY_ALL', 'Alle');
define('_CO_WGGALLERY_UPDATE', 'Aktualisieren');
define('_CO_WGGALLERY_DOWNLOAD', 'Download');
define('_CO_WGGALLERY_FORM_UPLOAD', 'Dateien hochladen');
define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Dateien in %s ');
define('_CO_WGGALLERY_FORM_ACTION', 'Aktion');
define('_CO_WGGALLERY_FORM_EDIT', 'Anpassung');
define('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'Alle aus-/abwählen');
define('_CO_WGGALLERY_FORM_IMAGEPICKER', 'Ein Bild auswählen');
define('_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD', 'Absenden und zum Bilderupload wechseln');

// Save/Delete
define('_CO_WGGALLERY_FORM_OK', 'Erfolgreich gespeichert');
define('_CO_WGGALLERY_FORM_DELETE_OK', 'Erfolgreich gelöscht');
define('_CO_WGGALLERY_FORM_SURE_DELETE', "Wollen Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>"); //default xoops confirm
define('_CO_WGGALLERY_FORM_SURE_RENEW', "Wollen Sie wirklich aktualisieren: <b><span style='color : Red;'>%s </span></b>");
define('_CO_WGGALLERY_FORM_DELETE', 'Löschen'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_DELETE_SURE', 'Wollen Sie wirklich löschen?'); //wggallery xoops confirm
// There aren't
define('_CO_WGGALLERY_THEREARENT_ALBUMS', 'Es gibt keine Alben');
define('_CO_WGGALLERY_THEREARENT_IMAGES', 'Es gibt keine Bilder');
// Album buttons
define('_CO_WGGALLERY_ALBUM_ADD', 'Album hinzufügen');
define('_CO_WGGALLERY_ALBUM_EDIT', 'Album bearbeiten'); 

// Elements of categories
define('_CO_WGGALLERY_CATS_TITLE', 'Verfügbare Kategorien');
define('_CO_WGGALLERY_CATS_ALBUMS', 'Enthaltene Alben anzeigen');
// Elements of Album
define('_CO_WGGALLERY_ALBUMS_TITLE', 'Galerie unserer Alben');
define('_CO_WGGALLERY_ALBUMS_COUNT', 'Anzahl der Alben');
define('_CO_WGGALLERY_ALBUM', 'Album');
define('_CO_WGGALLERY_ALBUMS', 'Alben');
define('_CO_WGGALLERY_ALBUMS_DESC', 'wgGallery ist ein XOOPS-Modul für die Präsentation Ihrer Bilder in Alben und Kategorien');
define('_CO_WGGALLERY_ALBUM_CAT', 'Kategorie');
define('_CO_WGGALLERY_ALBUM_NB_CATS', 'Alben in dieser Kategorie');
define('_CO_WGGALLERY_ALBUM_NB_IMAGES', 'Bilder in diesem Album');
define('_CO_WGGALLERY_ALBUM_ID', 'Id');
define('_CO_WGGALLERY_ALBUM_PID', 'Übergeordnetes Album');
define('_CO_WGGALLERY_ALBUM_ISCAT', 'Album ist Kategorie');
define('_CO_WGGALLERY_ALBUM_NAME', 'Name');
define('_CO_WGGALLERY_ALBUM_DESC', 'Beschreibung');
define('_CO_WGGALLERY_ALBUM_WEIGHT', 'Reihung');
define('_CO_WGGALLERY_ALBUM_IMAGE', 'Albumbild');
define('_CO_WGGALLERY_ALBUM_IMGCAT', 'Quelle für Albumbild');
define('_CO_WGGALLERY_ALBUM_USE_EXIST', 'Verwende eines der im Album enthaltenen Bilder');
define('_CO_WGGALLERY_ALBUM_IMGID', 'In diesem Album enthaltene Bilder');
define('_CO_WGGALLERY_ALBUM_USE_UPLOADED', 'Ein dafür hochgeladenes Bild verwenden');
// define('_CO_WGGALLERY_ALBUM_USE_GRID', 'Create a grid of top 4');
define('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'Neues Bild hochladen');
define('_CO_WGGALLERY_ALBUM_STATE', 'Status');
define('_CO_WGGALLERY_ALBUM_DATE', 'Datum');
define('_CO_WGGALLERY_ALBUM_SUBMITTER', 'Einsender'); 
define('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Achtung: Alle mit diesem Album verknüpften Bilder werden auch gelöscht');
define('_CO_WGGALLERY_ALBUM_SELECT', 'Album auswählen');
define('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Bitte wählen Sie ein Album zum Hochladen der Bilder');
define('_CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD', 'Größe für Bilderdownload');
define('_CO_WGGALLERY_ALBUM_DOWNLOAD_MEDIUM', 'Mittlere Bilder');
define('_CO_WGGALLERY_ALBUM_DOWNLOAD_LARGE', 'Große Bilder');
define('_CO_WGGALLERY_ALBUMS_SHOW', 'Alle Alben anzeigen');
define('_CO_WGGALLERY_ALBUMS_SORT', 'Sortierung der Alben');
define('_CO_WGGALLERY_ALBUM_SORT_SHOWHIDE', 'Zum Anzeigen/Verstecken der Listeneinträge anklicken');

define('_CO_WGGALLERY_IMAGE', 'Bild');
define('_CO_WGGALLERY_IMAGES', 'Bilder');
define('_CO_WGGALLERY_IMAGES_TITLE', 'Bildergalerie');
define('_CO_WGGALLERY_IMAGES_COUNT', 'Anzahl der Bilder');
define('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Album anzeigen');
define('_CO_WGGALLERY_IMAGES_INDEX', 'Bilderindex anzeigen'); 
define('_CO_WGGALLERY_IMAGES_UPLOAD', 'Bilder hochladen'); 
// Image add/edit
define('_CO_WGGALLERY_IMAGE_ADD', 'Bild hinzufügen');
define('_CO_WGGALLERY_IMAGE_EDIT', 'Bild bearbeiten');
// Elements of Image
define('_CO_WGGALLERY_IMAGE_ID', 'Id');
define('_CO_WGGALLERY_IMAGE_TITLE', 'Titel');
define('_CO_WGGALLERY_IMAGE_DESC', 'Beschreibung');
define('_CO_WGGALLERY_IMAGE_NAME', 'Name');
define('_CO_WGGALLERY_IMAGE_NAMEORIG', 'Originalname');
define('_CO_WGGALLERY_IMAGE_MIMETYPE', 'Erweiterungen (Mimetype)');
define('_CO_WGGALLERY_IMAGE_SIZE', 'Größe');
define('_CO_WGGALLERY_IMAGE_RESX', 'Resx');
define('_CO_WGGALLERY_IMAGE_RESY', 'Resy');
define('_CO_WGGALLERY_IMAGE_DOWNLOADS', 'Downloads');
define('_CO_WGGALLERY_IMAGE_RATINGLIKES', 'Gefällt mir');
define('_CO_WGGALLERY_IMAGE_VOTES', 'Stimmen');
define('_CO_WGGALLERY_IMAGE_WEIGHT', 'Reihung');
define('_CO_WGGALLERY_IMAGE_ALBID', 'Album-ID');
define('_CO_WGGALLERY_IMAGE_STATE', 'Status');
define('_CO_WGGALLERY_IMAGE_DATE', 'Datum');
define('_CO_WGGALLERY_IMAGE_SUBMITTER', 'Einsender');
define('_CO_WGGALLERY_IMAGE_IP', 'Ip');
// ---------------- Admin Permissions ----------------
// Permissions
define('_CO_WGGALLERY_PERMS_GLOBAL', 'Globale Berechtigungen');
define('_CO_WGGALLERY_PERMS_GLOBAL_APPROVE', 'Globale Berechtigung zum Freigeben');
define('_CO_WGGALLERY_PERMS_GLOBAL_APPROVE_DESC', 'Gruppen mit der Berechtigung zum Freigeben eingesendeter Alben');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL', 'Globale Berechtigung zum Bearbeiten aller Alben');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC', 'Gruppen mit der Berechtigung zum <ul><li>Erstellen von Alben</li><li>Bearbeiten aller Alben</li><li>Hochladen von Bildern in alle Alben</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMIT', 'Globale Berechtigung zum Bearbeiten eigener Alben');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMIT_DESC', 'Gruppen mit der Berechtigung zum <ul><li>Erstellen von Alben</li><li>Bearbeiten der eigenen Alben</li><li>Hochladen von Bildern in eigene Alben</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_APPROVE . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_APPROVE_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC. '</li>
												<li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMIT . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMIT_DESC. '</li>
										   </ul>');
define('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Berechtigung zum Ansehen');
define('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Gruppen mit der Berechtigung zum Ansehen der Alben');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Berechtigung zum Download des gesamten Albums');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Gruppen mit der Berechtigung zum Download der Alben als Ganzes');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE', 'Berechtigung zum Download von Bildern');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_DESC', 'Gruppen mit der Berechtigung zum Download der Bilder');
define('_CO_WGGALLERY_PERMS_NOTSET', 'Keine Berechtigung gesetzt');

// ---------------- Errors ----------------
define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Fehler: Albumbild wurde nicht gefundnen');
define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Fehler beim Löschen des Bildes: das Bild wurde aus der Datenbank entfernt, jedoch ist beim Löschen des Bildes selbst ein Fehler aufgetreten');

// ---------------- End ----------------
