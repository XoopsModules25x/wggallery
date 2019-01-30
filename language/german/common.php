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
 * @copyright module for xoops
 * @license   GPL 2.0 or later
 * @package   wggallery
 * @since     1.0
 * @min_xoops 2.5.7
 * @author    Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version   $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */

// defines for state
define('_CO_WGGALLERY_STATE_OFFLINE', 'Offline');
define('_CO_WGGALLERY_STATE_ONLINE', 'Online');
define('_CO_WGGALLERY_STATE_APPROVAL', 'Warten auf Freigabe');
// General
define('_CO_WGGALLERY_NONE', 'Keine');
define('_CO_WGGALLERY_BACK', 'Zurück');
define('_CO_WGGALLERY_ALL', 'Alle');
define('_CO_WGGALLERY_UPDATE', 'Aktualisieren');
define('_CO_WGGALLERY_EXEC', 'Ausführen');
define('_CO_WGGALLERY_DOWNLOAD', 'Download');
define('_CO_WGGALLERY_FORM_UPLOAD', 'Dateien hochladen');
define('_CO_WGGALLERY_FORM_IMAGE_PATH', 'Dateien in %s ');
define('_CO_WGGALLERY_FORM_ACTION', 'Aktion');
define('_CO_WGGALLERY_FORM_EDIT', 'Anpassung');
define('_CO_WGGALLERY_FORM_TOGGLE_SELECT', 'Alle aus-/abwählen');
define('_CO_WGGALLERY_FORM_IMAGEPICKER', 'Ein Bild auswählen');
define('_CO_WGGALLERY_FORM_SUBMIT_SUBMITUPLOAD', 'Absenden und zum Bilderupload wechseln');
define('_CO_WGGALLERY_FORM_SUBMIT_WMTEST', 'Absenden und Testbildanzeigen');
define('_CO_WGGALLERY_FORM_ERROR_INVALIDID', 'Ungültige ID');
// Save/Delete
define('_CO_WGGALLERY_FORM_OK', 'Erfolgreich gespeichert');
define('_CO_WGGALLERY_FORM_DELETE_OK', 'Erfolgreich gelöscht');
define('_CO_WGGALLERY_FORM_SURE_DELETE', "Wollen Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>"); //default xoops confirm
define('_CO_WGGALLERY_FORM_SURE_RENEW', "Wollen Sie wirklich aktualisieren: <b><span style='color : Red;'>%s </span></b>");
define('_CO_WGGALLERY_FORM_DELETE', 'Löschen'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_DELETE_SURE', 'Wollen Sie wirklich löschen?'); //wggallery xoops confirm
define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE1', 'Fehler beim Zurücksetzen der Verwendung der Wasserzeichen');
define('_CO_WGGALLERY_FORM_ERROR_RESETUSAGE2', 'Fehler beim Zurücksetzen der Wasserzeichenverwendung in den Alben');
define('_CO_WGGALLERY_FORM_ERROR_ALBPID', 'Fehler: übergeordnetes Album nicht gefunden');
define('_CO_WGGALLERY_FORM_OK_APPROVE', 'Änderungen Album erfolgreich gespeichert. Sie werden zur Freigabe der Bilder weitergeleitet');
// There aren't
define('_CO_WGGALLERY_THEREARENT_ALBUMS', 'Es gibt keine Alben');
define('_CO_WGGALLERY_THEREARENT_IMAGES', 'Es gibt keine Bilder');
// general
define('_CO_WGGALLERY_DATE', 'Datum');
define('_CO_WGGALLERY_SUBMITTER', 'Einsender');
// fine uploader
define('_CO_WGGALLERY_FU_SUBMIT', 'Einsenden Bild: ');
define('_CO_WGGALLERY_FU_SUBMITTED', 'Bilder erfolgreich überprüft, bitte Hochladen');
define('_CO_WGGALLERY_FU_UPLOAD', 'Hochladen Bild: ');
define('_CO_WGGALLERY_FU_FAILED', 'Während des Hochladens der Bilder sind Fehler aufgetreten');
define('_CO_WGGALLERY_FU_SUCCEEDED', 'Alle Bilder erfolgreich hochgeladen');
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
define('_CO_WGGALLERY_ALBUM_NO_IMAGES', 'Album enthält keine Bilder');
define('_CO_WGGALLERY_ALBUM_ID', 'Id');
define('_CO_WGGALLERY_ALBUM_PID', 'Übergeordnetes Album');
define('_CO_WGGALLERY_ALBUM_ISCAT', 'Album ist Kategorie');
define('_CO_WGGALLERY_ALBUM_NAME', 'Name');
define('_CO_WGGALLERY_ALBUM_DESC', 'Beschreibung');
define('_CO_WGGALLERY_ALBUM_WEIGHT', 'Reihung');
define('_CO_WGGALLERY_ALBUM_IMAGE', 'Albumbild');
define('_CO_WGGALLERY_ALBUM_IMGCAT', 'Quelle für Albumbild');
define('_CO_WGGALLERY_ALBUM_USE_EXIST', 'Verwende im Album enthaltenes Bild');
define('_CO_WGGALLERY_ALBUM_IMGID', 'In diesem Album enthaltene Bilder');
define('_CO_WGGALLERY_ALBUM_USE_UPLOADED', 'Ein dafür hochgeladenes Bild verwenden');
define('_CO_WGGALLERY_ALBUM_CREATE_GRID', 'Gitterbild erstellen');
define('_CO_WGGALLERY_ALBUM_CROP_IMAGE', 'Bild zuschneiden');
define('_CO_WGGALLERY_ALBUM_FORM_UPLOAD_IMAGE', 'Neues Bild hochladen');
define('_CO_WGGALLERY_ALBUM_STATE', 'Status');
define('_CO_WGGALLERY_ALBUM_DELETE_DESC', 'Achtung: Alle mit diesem Album verknüpften Bilder werden auch gelöscht');
define('_CO_WGGALLERY_ALBUM_SELECT', 'Album auswählen');
define('_CO_WGGALLERY_ALBUM_SELECT_DESC', 'Bitte wählen Sie ein Album zum Hochladen der Bilder');
// define('_CO_WGGALLERY_ALBUM_ALLOWDOWNLOAD', 'Größe für Bilderdownload');
// define('_CO_WGGALLERY_ALBUM_DOWNLOAD_MEDIUM', 'Mittlere Bilder');
// define('_CO_WGGALLERY_ALBUM_DOWNLOAD_LARGE', 'Große Bilder');
define('_CO_WGGALLERY_ALBUMS_SHOW', 'Alle Alben anzeigen');
define('_CO_WGGALLERY_ALBUMS_SORT', 'Sortierung der Alben');
define('_CO_WGGALLERY_ALBUM_SORT_SHOWHIDE', 'Zum Anzeigen/Verstecken der Listeneinträge anklicken');
// album image handler
define('_CO_WGGALLERY_ALBUM_IH_APPLY', 'Anwenden');
define('_CO_WGGALLERY_ALBUM_IH_IMAGE_EDIT', 'Albumbild bearbeiten');
define('_CO_WGGALLERY_ALBUM_IH_CURRENT', 'Aktuell');
define('_CO_WGGALLERY_ALBUM_IH_GRID4', '4 Bilder verwenden');
define('_CO_WGGALLERY_ALBUM_IH_GRID6', '6 Bilder verwenden');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC1', 'Bild 1 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC2', 'Bild 2 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC3', 'Bild 3 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC4', 'Bild 4 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC5', 'Bild 5 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_SRC6', 'Bild 6 auswählen');
define('_CO_WGGALLERY_ALBUM_IH_GRID_CREATE', 'Gitterbild erstellen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_CREATE', 'Bild erstellen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE', 'Verschieben');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMIN', 'Hineinzoomen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ZOOMOUT', 'Herauszoomen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_LEFT', 'Nach links verschieben');
define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_RIGHT', 'Nach rechts verschieben');
define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_UP', 'Nach oben verschieben');
define('_CO_WGGALLERY_ALBUM_IH_CROP_MOVE_DOWN', 'Nach unten verschieben');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ROTATE_LEFT', 'Links drehen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ROTATE_RIGHT', 'Rechts drehen');
define('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_HORIZONTAL', 'Horizontal spiegeln');
define('_CO_WGGALLERY_ALBUM_IH_CROP_FLIP_VERTICAL', 'Vertikal spiegeln');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO', 'Seitenverhältnis');
define('_CO_WGGALLERY_ALBUM_IH_CROP_ASPECTRATIO_FREE', 'Frei');

define('_CO_WGGALLERY_IMAGE', 'Bild');
define('_CO_WGGALLERY_IMAGES', 'Bilder');
define('_CO_WGGALLERY_IMAGES_TITLE', 'Bildergalerie von ');
define('_CO_WGGALLERY_IMAGES_COUNT', 'Anzahl der Bilder');
define('_CO_WGGALLERY_IMAGES_ALBUMSHOW', 'Album anzeigen');
define('_CO_WGGALLERY_IMAGES_INDEX', 'Bilderindex anzeigen');
define('_CO_WGGALLERY_IMAGES_UPLOAD', 'Bilder hochladen');
define('_CO_WGGALLERY_IMAGE_MANAGE', 'Bildermanagement');
define('_CO_WGGALLERY_IMAGE_MANAGE_DESC', 'Sortieren Sie Ihre Bilder durch Drag&Drop neu');
// Image add/edit/show
define('_CO_WGGALLERY_IMAGE_ADD', 'Bild hinzufügen');
define('_CO_WGGALLERY_IMAGE_EDIT', 'Bild bearbeiten');
define('_CO_WGGALLERY_IMAGE_SHOW', 'Bild anzeigen');
// Elements of Image
define('_CO_WGGALLERY_IMAGE_ID', 'Id');
define('_CO_WGGALLERY_IMAGE_TITLE', 'Titel');
define('_CO_WGGALLERY_IMAGE_DESC', 'Beschreibung');
define('_CO_WGGALLERY_IMAGE_NAME', 'Name');
define('_CO_WGGALLERY_IMAGE_NAMEORIG', 'Originalname');
define('_CO_WGGALLERY_IMAGE_NAMELARGE', 'Name große Bilder');
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
define('_CO_WGGALLERY_IMAGE_IP', 'Ip');
define('_CO_WGGALLERY_IMAGE_RESIZE', 'Bild auf folgende Größe ändern:');
define('_CO_WGGALLERY_IMAGE_THUMB', 'Vorschaubild');
define('_CO_WGGALLERY_IMAGE_MEDIUM', 'Mittleres Bild');
define('_CO_WGGALLERY_IMAGE_LARGE', 'Großes Bild');
define('_CO_WGGALLERY_IMAGE_EXIF', 'Exif-Daten');
// Watermark add/edit
define('_CO_WGGALLERY_WATERMARK_ADD', 'Wasserzeichen hinzufügen');
define('_CO_WGGALLERY_WATERMARK_EDIT', 'Wasserzeichen bearbeiten');
// Elements of Watermark
define('_CO_WGGALLERY_WATERMARK', 'Wasserzeichen');
define('_CO_WGGALLERY_WATERMARKS', 'Wasserzeichen');
define('_CO_WGGALLERY_WATERMARK_ID', 'Id');
define('_CO_WGGALLERY_WATERMARK_PREVIEW', 'Vorschau');
define('_CO_WGGALLERY_WATERMARK_NAME', 'Name');
define('_CO_WGGALLERY_WATERMARK_TYPE', 'Typ');
define('_CO_WGGALLERY_WATERMARK_TYPETEXT', 'Text verwenden');
define('_CO_WGGALLERY_WATERMARK_TYPEIMAGE', 'Bild verwenden');
define('_CO_WGGALLERY_WATERMARK_POSITION', 'Position');
define('_CO_WGGALLERY_WATERMARK_POSTOPLEFT', 'Oben links');
define('_CO_WGGALLERY_WATERMARK_POSTOPRIGHT', 'Oben rechts');
define('_CO_WGGALLERY_WATERMARK_POSTOPCENTER', 'Oben mitte');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLELEFT', 'Mitte links');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLERIGHT', 'Mitte rechts');
define('_CO_WGGALLERY_WATERMARK_POSMIDDLECENTER', 'Mitte mitte');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMLEFT', 'Unten links');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMRIGHT', 'Unten rechts');
define('_CO_WGGALLERY_WATERMARK_POSBOTTOMCENTER', 'Unten mitte');
define('_CO_WGGALLERY_WATERMARK_USAGENONE', 'Derzeit nicht verwenden');
define('_CO_WGGALLERY_WATERMARK_USAGEALL', 'Verwendung in allen Alben');
define('_CO_WGGALLERY_WATERMARK_USAGESINGLE', 'In jedem Album seperat definiert');
define('_CO_WGGALLERY_WATERMARK_MARGIN', 'Rand');
define('_CO_WGGALLERY_WATERMARK_MARGINLR', 'Links/rechts');
define('_CO_WGGALLERY_WATERMARK_MARGINTB', 'Oben/unten');
define('_CO_WGGALLERY_WATERMARK_IMAGE', 'Bild');
define('_CO_WGGALLERY_FORM_UPLOAD_IMAGE_WATERMARKS', 'Bilder im Uploadverzeichnis');
define('_CO_WGGALLERY_WATERMARK_TEXT', 'Text');
define('_CO_WGGALLERY_WATERMARK_FONT', 'Schrift');
define('_CO_WGGALLERY_WATERMARK_FONTFAMILY', 'Schriftart');
define('_CO_WGGALLERY_WATERMARK_FONTSIZE', 'Schriftgröße');
define('_CO_WGGALLERY_WATERMARK_COLOR', 'Farbe');
define('_CO_WGGALLERY_WATERMARK_USAGE', 'Verwendung');
define('_CO_WGGALLERY_WATERMARK_TARGET', 'Bildart für Hinzufügen Wasserzeichen');
define('_CO_WGGALLERY_WATERMARK_TARGET_A', 'Bei allen hinzufügen');
define('_CO_WGGALLERY_WATERMARK_TARGET_M', 'Nur bei mittleren Bildern hinzufügen');
define('_CO_WGGALLERY_WATERMARK_TARGET_L', 'Nur bei großen Bildern hinzufügen');
// ---------------- Admin Permissions ----------------
// Permissions
define('_CO_WGGALLERY_PERMS_GLOBAL', 'Globale Berechtigungen');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL', 'Globale Berechtigung zum Bearbeiten aller Alben');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC', '<ul><li>Erstellen von Alben</li><li>Bearbeiten aller Alben</li><li>Freigabe aller Alben</li><li>Hochladen von Bildern in alle Alben</li><li>Freigabe aller Bilder</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN', 'Globale Berechtigung zum Bearbeiten eigener Alben ohne Freigabe');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC', '<ul><li>Erstellen von Alben</li><li>Bearbeiten der eigenen Alben</li><li>Hochladen von Bildern in eigene Alben</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR', 'Globale Berechtigung zum Bearbeiten eigener Alben, jedoch ist eine Freigabe erforderlich');
define('_CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC', '<ul><li>Erstellen von Alben (Freigabe erforderlich)</li><li>Bearbeiten der eigenen Alben (Freigabe erforderlich)</li><li>Hochladen von Bildern in eigene Alben (Freigabe erforderlich)</li></ul>');
define('_CO_WGGALLERY_PERMS_GLOBAL_DESC', '<ul>
                                                <li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITALL_DESC . '</li>
                                                <li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITOWN_DESC . '</li>
                                                <li>' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR . ': ' . _CO_WGGALLERY_PERMS_GLOBAL_SUBMITAPPR_DESC . '</li>
                                           </ul>');
define('_CO_WGGALLERY_PERMS_ALB_VIEW', 'Berechtigung zum Ansehen');
define('_CO_WGGALLERY_PERMS_ALB_VIEW_DESC', 'Gruppen mit der Berechtigung zum Ansehen der Alben');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB', 'Berechtigung zum Download des gesamten Albums');
define('_CO_WGGALLERY_PERMS_ALB_DLFULLALB_DESC', 'Gruppen mit der Berechtigung zum Download der Alben als Ganzes');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE', 'Berechtigung zum Download großer Bildern');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_LARGE_DESC', 'Gruppen mit der Berechtigung zum Download der großen Bilder');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM', 'Berechtigung zum Download mittlerer Bildern');
define('_CO_WGGALLERY_PERMS_ALB_DLIMAGE_MEDIUM_DESC', 'Gruppen mit der Berechtigung zum Download der mittleren Bilder');
define('_CO_WGGALLERY_PERMS_NOTSET', 'Keine Berechtigung gesetzt');
define('_CO_WGGALLERY_PERMS_NODOWNLOAD', 'Sie haben keine Berechtigung zum Download');
// ---------------- Misc ----------------
define('_CO_WGGALLERY_ALBUM_IMAGE_ERRORNOTFOUND', 'Fehler: Albumbild wurde nicht gefundnen');
define('_CO_WGGALLERY_IMAGE_ERRORUNLINK', 'Fehler beim Löschen des Bildes: das Bild wurde aus der Datenbank entfernt, jedoch ist beim Löschen des Bildes selbst ein Fehler aufgetreten');
define('_CO_WGGALLERY_MAINTAINEDBY', 'Unterstützt von');
define('_CO_WGGALLERY_MAINTAINEDBY_DESC', 'Erlaubt den Url zur Supportseite oder Community');
// ---------------- End ----------------
