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
 * @version        $Id: 1.0 admin.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */

include_once 'common.php'; 
 
// ---------------- Admin Index ----------------
define('_AM_WGGALLERY_STATISTICS', 'Statistiken');
// There are
define('_AM_WGGALLERY_THEREARE_ALBUMS', "Es gibt <span class='bold'>%s</span> Alben in der Datenbank");
define('_AM_WGGALLERY_THEREARE_IMAGES', "Es gibt <span class='bold'>%s</span> Bilder in der Datenbank");
define('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "Es gibt <span class='bold'>%s</span> Gallerietypen in der Datenbank");
define('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "Es gibt <span class='bold'>%s</span> Albumtypen in der Datenbank");
// There aren't
define('_AM_WGGALLERY_THEREARENT_GALLERYTYPES', "Es gibt keine Gallerietypen! Für eine Initialisierung bzw. Wiederherstellung gehen Sie bitte auf 'Wartung' => 'Wartung Gallerietypen' und klicken Sie auf die Schaltfläche 'Nur alle wiederherstellen'");
define('_AM_WGGALLERY_THEREARENT_ALBUMTYPES', "Es gibt keine Albumtypen! Für eine Initialisierung bzw. Wiederherstellung gehen Sie bitte auf 'Wartung' => 'Wartung Albumtypen' und klicken Sie auf die Schaltfläche 'Nur alle wiederherstellen'");
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGGALLERY_ADD_ALBUM', 'Neues Album hinzufügen');
define('_AM_WGGALLERY_ADD_IMAGE', 'Neues Bild hinzufügen');
define('_AM_WGGALLERY_ADD_GALLERYTYPE', 'Neuen Gallerietyp hinzufügen');
define('_AM_WGGALLERY_ADD_ALBUMTYPE', 'Neuen Albumtyp hinzufügen');
// Lists
define('_AM_WGGALLERY_ALBUMS_LIST', 'Liste der Alben');
define('_AM_WGGALLERY_IMAGES_LIST', 'Liste der Bilder');
define('_AM_WGGALLERY_GALLERYTYPES_LIST', 'Liste der Gallerietypen');
define('_AM_WGGALLERY_ALBUMTYPES_LIST', 'Liste der Albumtypen');
//Gallerytype/Albumtypes
define('_AM_WGGALLERY_GT_AT_PRIMARY', 'Primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_1', 'Derzeit primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_0', 'Derzeit nicht primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_SET', 'Auf primär setzen');
define('_AM_WGGALLERY_GT_AT_ID', 'Id');
define('_AM_WGGALLERY_GT_AT_NAME', 'Name');
define('_AM_WGGALLERY_GT_AT_CREDITS', 'Credits');
define('_AM_WGGALLERY_GT_AT_TEMPLATE', 'Vorlage');
define('_AM_WGGALLERY_GT_AT_OPTIONS', 'Optionen');
define('_AM_WGGALLERY_GT_AT_DATE', 'Datum');
// Gallerytype add/edit
define('_AM_WGGALLERY_GALLERYTYPE_ADD', 'Gallerietyp hinzufügen');
define('_AM_WGGALLERY_GALLERYTYPE_EDIT', 'Gallerietyp bearbeiten');
// Elements of Gallery options
define('_AM_WGGALLERY_OPTION_GT_SET', 'Optionen für ausgewählten Gallerietyp definieren');
define('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Slideshow Quelle');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC', ' (große oder mittlere Bilder)');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Quelle Vorschaubild');
// jssor
define('_AM_WGGALLERY_OPTION_GT_ARROWS', 'Pfeilarten');
define('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Bullet-Arten');
define('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Verwenden Sie Bullets nicht zusammen mit Vorschaubildern');
define('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Art der Liste Vorschaubilder');
define('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'Art des Ladesybols');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Automatisch abspielen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'Abspieloptionen');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_1', 'Wiederkehren abspielen');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_2', 'Bei letztem Bild stoppen');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_4', 'Bei Klick stoppen');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_8', 'Stop bei Benutzeraktion (klick auf Pfeil/Bullet/Vorschaubild, swipe slide, Drücken der Links- oder Rechtstaste)');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_12', 'Bei Klick stoppen oder bei jeder Benutzeraktion');

define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Vorschaubilder oder Dots anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Vorschaubilder anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOWDOTS', 'Dots anzeigen');
// define('_AM_WGGALLERY_OPTION_GT_TITLE', 'Show image title');
// define('_AM_WGGALLERY_OPTION_GT_DESCRIPTION', 'Show image decription');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'Bildershow Geschwindigkeit');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Interval in Millisekunden bevor das nächste Bild angezeigt wird');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY_DESC', 'Bildershow nach dem Öffnen automatisch starten');
define('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Reihenhöhe');
define('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Letzte Reihe');
define('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'Soll die letzte Reihe auf die volle Breite der vorherigen Reihen angepasst werden.');
define('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Abstand zwischen den Bildern');
define('_AM_WGGALLERY_OPTION_GT_BORDER', 'Äußerer Abstand des Bildcontainers');
define('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Bilder in zufälliger Reihenfolge anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Bildershow anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Optionen für Bildershow (nicht alle Optionen werden bei jedem Colorbox-Style angewendet):');
define('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox Style');
define('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'Transition-Effekt');
define('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Geschwindigkeit zum Öffnen der Bildershow');
define('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Colorbox automatisch öffnen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWTYPE', 'Art der Bildershow');
define('_AM_WGGALLERY_OPTION_GT_BUTTTONCLOSE', 'Schließen-Schaltfäche anzeigen');
define('_AM_WGGALLERY_OPTION_GT_NAVBAR', 'Navigationsleiste mit Vorschaubildern anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOW_1', 'Immer anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOW_2', 'Nur anzeigen, wenn Bildschirmbreite größer als 768 Pixel ist');
define('_AM_WGGALLERY_OPTION_GT_SHOW_3', 'Nur anzeigen, wenn Bildschirmbreite größer als 992 Pixel ist');
define('_AM_WGGALLERY_OPTION_GT_SHOW_4', 'Nur anzeigen, wenn Bildschirmbreite größer als 1200 Pixel ist');
define('_AM_WGGALLERY_OPTION_GT_TOOLBAR', 'Werkzeugleiste anzeigen');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARZOOM', 'Zoom-Schaltflächen in der Werkzeugleiste anzeigen');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD', 'Download-Schaltfläche in der Werkzeugleiste anzeigen');
define('_AM_WGGALLERY_OPTION_GT_TOOLBARDOWNLOAD_DESC', 'Wenn Sie diese Option ermöglichen kann die Quelldatei immer heruntergeladen werden. Etwaige Einstellungen zu den Albumberechtigungen werden dabei ignoriert.');
define('_AM_WGGALLERY_OPTION_GT_FULLSCREEN', 'Anzeige auf ganze Seite wechseln, sobald die Bildershow startet');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Geschwindigkeit Bildübergang');
define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION_DESC', 'Zeit für die Übergangsanimation zwischen 2 Bildern in Millisekunden');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMG', 'Bildart auf der Indexseite');
define('_AM_WGGALLERY_OPTION_GT_INDEXIMGHEIGHT', 'Bildhöhe');
define('_AM_WGGALLERY_OPTION_GT_SHOWLABEL', 'Bildindex anzeigen (Bild {current} von {total}%)');

// define('_AM_WGGALLERY_OPTION_GT_INTDURATION', 'Interval duration');
// define('_AM_WGGALLERY_OPTION_GT_INTDURATION_DESC', 'Interval in milliseconds before displaying of the next image');




// 
// define('_AM_WGGALLERY_OPTION_GT_ADAPDURATION', 'Adaptive duration:<br>This duration is the period in milliseconds, during the adjustment of the previous option runs');

// define('_AM_WGGALLERY_OPTION_GT_TRANSDURATION', 'Transition duration:<br>Period of animation in milliseconds between 2 images');
// define('_AM_WGGALLERY_OPTION_GT_INTDURATION', 'Interval duration for autoslide:<br>Interval in milliseconds before displaying of the next image');
// define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Auto playing');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYCONTROLS', 'Display control for the previous or next image');
// define('_AM_WGGALLERY_OPTION_GT_ADAPTHEIGT', 'Adaptive height:<br>If your images have a different height, this option adjusts automatically the global height of the slider.');
// define('_AM_WGGALLERY_OPTION_GT_VERTCENTER', 'Vertical centering:<br>If the height of the list or the main container is smaller than the height of the image, this option can vertically center the element.');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYLIST', 'Display thumbs list');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS', 'Position of thumbs list');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_LEFT', 'Left');
// define('_AM_WGGALLERY_OPTION_GT_DISPLAYPOS_RIGHT', 'Right');
// 
// 

// 

// define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Automatically start slideshow when opened');



// Albumtype add/edit
define('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Albumtyp hinzufügen');
define('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Albumtyp bearbeiten');
// options  of Albumtypes
define('_AM_WGGALLERY_OPTION_AT_SET', 'Optionen für das entsprechende Album einstellen');
define('_AM_WGGALLERY_OPTION_AT_SETINFO', 'Die Albumeinstellungen werden auf der Indexseite sowie für die Album Blöcke verwendet');
define('_AM_WGGALLERY_OPTION_AT_HOVER', 'Hover Effekt');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Anzahl der Spalten für Albumliste');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Anzahl der Spalten für Kategorieliste');
define('_AM_WGGALLERY_OPTION_AT_SHOWSUBMITTER', 'Einsender des Albums anzeigen');
// common options
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
define('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Titel anzeigen');
define('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Beschreibung anzeigen');
define('_AM_WGGALLERY_OPTION_CSS', 'CSS für den Stil wählen');
// Maintenance
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Löschen und wiederherstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'Standardeinstellungen anwenden');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Mittlere Bilder neu erstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Vorschaubilder neu erstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI', 'Nicht verwendete Bilder löschen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW', 'Liste der nicht verwendeten Bilder anzeigen');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'Erfolgreich wiederhergestellt: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Erfolgreich erstellt: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Größenänderung erfolgreich: %s von %t Bildern');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE', 'Erfolgreich gelöscht: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Fehler beim Wiederherstellen: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Fehler beim Löschen: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Fehler bei Größenänderung: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_READDIR', 'Fehler beim Einlesen des Verzeichnisses: ');
define('_AM_WGGALLERY_MAINTENANCE_TYP', 'Art der Wartung');
define('_AM_WGGALLERY_MAINTENANCE_DESC', 'Beschreibung');
define('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Ergebnisse');
define('_AM_WGGALLERY_MAINTENANCE_GT', 'Wartung Gallerietypen');
define('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Nicht mehr unterstützte Gallerietypen löschen und/oder Gallerietypen auf Standardeinstellungen zurücksetzen');
define('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'Alle derzeit bestehenden Gallerieeinstellungen werden durch die Standardeinstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'Alle derzeit bestehenden Gallerietypen (inklusive deren Einstellungen) werden gelöscht bzw. durch die aktuellen Galerien/Einstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_AT', 'Wartung Albumtypen');
define('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Nicht mehr unterstützte Albumtypen löschen und/oder Albumtypen auf Standardeinstellungen zurücksetzen');
define('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'Alle derzeit bestehenden Albumeinstellungen werden durch die Standardeinstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'Alle derzeit bestehenden Albumtypen (inklusive deren Einstellungen) werden gelöscht bzw. durch die aktuellen Albumtypen/Einstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Größenänderung Bilder');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC', 'Erneute Größenänderung der mittleren Bilder oder Vorschaubilder entsprechend der vorgegeben Höhe in den Moduleinstellungen:<br>Mittlere Bilder: maximale Breite %mw px / maximale Höhe %mh px<br>Vorschaubilder: maximale Breite %tw px / maximale Höhe %th px');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED', 'Bilderverzeichnis bereinigen');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC', 'Alle derzeit nicht verwendeten Albumbilder (nicht in einem Album enthalten) in folgenden Verzeichissen werden gelöscht:<ul>
<li>%p/large/</li>
<li>%p/medium/</li>
<li>%p/thumbs/</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE', 'Es wurden keine nicht verwendeten Albumbilder gefunden');
define('_AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE', 'Alle derzeit nicht verwendeten Albumbilder (nicht in einem Album enthalten) werden gelöscht! Wollen Sie wirklich fortsetzen?');
// ---------------- Admin Others ----------------
define('_AM_WGGALLERY_MAINTAINEDBY', ' wird unterstützt von ');
// ---------------- End ----------------