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
 * @version        $Id: 1.0 admin.php 1 Mon 2018-03-19 10:04:52Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Admin Index ----------------
define('_AM_WGGALLERY_STATISTICS', 'Statistiken');
// There are
define('_AM_WGGALLERY_THEREARE_ALBUMS', "Es gibt <span class='bold'>%s</span> Alben in der Datenbank");
define('_AM_WGGALLERY_THEREARE_IMAGES', "Es gibt <span class='bold'>%s</span> Bilder in der Datenbank");
define('_AM_WGGALLERY_THEREARE_GALLERYTYPES', "Es gibt <span class='bold'>%s</span> Galerietypen in der Datenbank");
define('_AM_WGGALLERY_THEREARE_ALBUMTYPES', "Es gibt <span class='bold'>%s</span> Albumtypen in der Datenbank");
define('_AM_WGGALLERY_THEREARE_WATERMARKS', "Es gibt <span class='bold'>%s</span> Wasserzeichen in der Datenbank");
// There aren't
define('_AM_WGGALLERY_THEREARENT_GALLERYTYPES', "Es gibt keine Galerietypen! Für eine Initialisierung bzw. Wiederherstellung gehen Sie bitte auf 'Wartung' => 'Wartung Galerietypen' und klicken Sie auf die Schaltfläche 'Standardeinstellungen wiederherstellen'");
define('_AM_WGGALLERY_THEREARENT_ALBUMTYPES', "Es gibt keine Albumtypen! Für eine Initialisierung bzw. Wiederherstellung gehen Sie bitte auf 'Wartung' => 'Wartung Albumtypen' und klicken Sie auf die Schaltfläche 'Standardeinstellungen wiederherstellen''");
define('_AM_WGGALLERY_THEREARENT_WATERMARKS', 'Derzeit sind keine Wasserzeichen definiert!');
// ---------------- Admin Files ----------------
// Buttons
define('_AM_WGGALLERY_ADD_ALBUM', 'Neues Album hinzufügen');
define('_AM_WGGALLERY_ADD_IMAGE', 'Neues Bild hinzufügen');
define('_AM_WGGALLERY_ADD_GALLERYTYPE', 'Neuen Galerietyp hinzufügen');
define('_AM_WGGALLERY_ADD_ALBUMTYPE', 'Neuen Albumtyp hinzufügen');
// Lists
define('_AM_WGGALLERY_ALBUMS_LIST', 'Liste der Alben');
define('_AM_WGGALLERY_ALBUMS_APPROVE', 'Auf Freigabe wartende Alben');
define('_AM_WGGALLERY_IMAGES_LIST', 'Liste der Bilder');
define('_AM_WGGALLERY_IMAGES_APPROVE', 'Auf Freigabe wartende Bilder');
define('_AM_WGGALLERY_GALLERYTYPES_LIST', 'Liste der Galerietypen');
define('_AM_WGGALLERY_ALBUMTYPES_LIST', 'Liste der Albumtypen');
define('_AM_WGGALLERY_WATERMARKS_LIST', 'Liste der Wasserzeichen');
//Gallerytype/Albumtypes
define('_AM_WGGALLERY_GT_AT_ID', 'Id');
define('_AM_WGGALLERY_GT_AT_PRIMARY', 'Primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_1', 'Derzeit primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_0', 'Derzeit nicht primär');
define('_AM_WGGALLERY_GT_AT_PRIMARY_SET', 'Auf primär setzen');
define('_AM_WGGALLERY_GT_AT_NAME', 'Name');
define('_AM_WGGALLERY_GT_AT_CREDITS', 'Credits');
define('_AM_WGGALLERY_GT_AT_TEMPLATE', 'Vorlage');
define('_AM_WGGALLERY_GT_AT_OPTIONS', 'Optionen');
define('_AM_WGGALLERY_GT_AT_DATE', 'Datum');
// Gallerytype add/edit
define('_AM_WGGALLERY_GALLERYTYPE_ADD', 'Galerietyp hinzufügen');
define('_AM_WGGALLERY_GALLERYTYPE_EDIT', 'Galerietyp bearbeiten');
// Elements of Gallery options
define('_AM_WGGALLERY_OPTION_GT_SET', 'Optionen für ausgewählten Galerietyp definieren');
define('_AM_WGGALLERY_OPTION_GT_SOURCE', 'Slideshow Quelle');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_DESC',
       "Achtung: wenn der Benutzer nicht das Recht zum Herunterladen eines großen Bildes hat wird die Quelle für diesen Benutzer automatisch auf 'mittlere Bilder' reduziert um den unerlaubten Download von großen Bildern durch das Klicken mit der rechten Maustaste zu verhindern.<br>Den Benutzern mit dem Recht zum Herunterladen großer Bilder werden diese auch angezeigt, wenn Sie 'große Bilder' ausgewählt haben.");
define('_AM_WGGALLERY_OPTION_GT_SOURCE_PREVIEW', 'Quelle Vorschaubild');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_LARGE', 'große Bilder');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_MEDIUM', 'mittlere Bilder');
define('_AM_WGGALLERY_OPTION_GT_SOURCE_THUMB', 'Vorschaubilder');
// jssor
define('_AM_WGGALLERY_OPTION_GT_ARROWS', 'Pfeilarten');
define('_AM_WGGALLERY_OPTION_GT_BULLETS', 'Bullet-Arten');
define('_AM_WGGALLERY_OPTION_GT_BULLETS_DESC', 'Verwenden Sie Bullets nicht zusammen mit Vorschaubildern');
define('_AM_WGGALLERY_OPTION_GT_THUMBNAILS', 'Art der Liste Vorschaubilder');
define('_AM_WGGALLERY_OPTION_GT_LOADINGS', 'Art des Ladesymbols');
define('_AM_WGGALLERY_OPTION_GT_AUTOPLAY', 'Automatisch abspielen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTIONS', 'Abspieloptionen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_1', 'Wiederkehrend abspielen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_2', 'Bei letztem Bild stoppen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_4', 'Bei Klick stoppen');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_8', 'Stop bei Benutzeraktion (klick auf Pfeil/Bullet/Vorschaubild, swipe slide, Drücken der Links- oder Rechtstaste)');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_12', 'Bei Klick stoppen oder bei jeder Benutzeraktion');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE', 'Optionen für Bildfüllung');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_0', 'Stretch');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_1', 'Container (Seitenverhältnisse beibehalten/Bild an inneren Container anpassen)');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_2', 'Cover (Seitenverhältnisse beibehalten/Bild an äußeren Container anpassen');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_4', 'Aktuelle Größe');
define('_AM_WGGALLERY_OPTION_GT_FILLMODE_5', 'Container für große Bilder, aktuelle Größe für kleine Bilder');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE', 'Slideshow Typ');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_1', 'Definierte Größen');
define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2', 'Volle Templatebreite');
// define('_AM_WGGALLERY_OPTION_GT_SLIDERTYPE_3', 'Ganzes Fenster');
define('_AM_WGGALLERY_OPTION_GT_MAXWIDTH', 'Maximale Bildbreite');
define('_AM_WGGALLERY_OPTION_GT_MAXWIDTH_DESC', "Definieren Sie die maximale Bildbreite des Bildercontainers in Pixel. Nicht gültig für '" . _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2 . "'");
define('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT', 'Maximale Bildhöhe');
define('_AM_WGGALLERY_OPTION_GT_MAXHEIGHT_DESC', 'Definieren Sie die maximale Bildhöhe des Bildercontainers in Pixel. Nicht gültig für ' . _AM_WGGALLERY_OPTION_GT_SLIDERTYPE_2 . "'");
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION', 'Ausrichtung');
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION_H', 'Horizontal');
define('_AM_WGGALLERY_OPTION_GT_ORIENTATION_V', 'Vertikal');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER', 'Reihenfolge Transition');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER_RANDOM', 'Zufällig');
define('_AM_WGGALLERY_OPTION_GT_TRANSORDER_INORDER', 'In Reihenfolge der Liste');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBSDOTS', 'Vorschaubilder oder Dots anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOWTHUMBS', 'Vorschaubilder anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SHOWDOTS', 'Dots anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED', 'Bildershow Geschwindigkeit');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOWSPEED_DESC', 'Interval in Millisekunden bevor das nächste Bild angezeigt wird');
define('_AM_WGGALLERY_OPTION_GT_PLAYOPTION_DESC', 'Bildershow nach dem Öffnen automatisch starten');
define('_AM_WGGALLERY_OPTION_GT_ROWHEIGHT', 'Reihenhöhe');
define('_AM_WGGALLERY_OPTION_GT_LASTROW', 'Letzte Reihe');
define('_AM_WGGALLERY_OPTION_GT_LASTROW_DESC', 'Soll die letzte Reihe auf die volle Breite der vorherigen Reihen angepasst werden.');
define('_AM_WGGALLERY_OPTION_GT_MARGINS', 'Abstand zwischen den Bildern');
define('_AM_WGGALLERY_OPTION_GT_OUTERBORDER', 'Äußerer Abstand des Bildcontainers');
define('_AM_WGGALLERY_OPTION_GT_RANDOMIZE', 'Bilder in zufälliger Reihenfolge anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW', 'Bildershow anzeigen');
define('_AM_WGGALLERY_OPTION_GT_SLIDESHOW_OPTIONS', 'Optionen für Bildershow (nicht alle Optionen werden bei jedem Colorbox-Style angewendet):');
define('_AM_WGGALLERY_OPTION_GT_COLORBOXSTYLE', 'Colorbox Style');
define('_AM_WGGALLERY_OPTION_GT_TRANSEFFECT', 'Transition-Effekt');
define('_AM_WGGALLERY_OPTION_GT_SPEEDOPEN', 'Geschwindigkeit zum Öffnen der Bildershow');
define('_AM_WGGALLERY_OPTION_GT_AUTOOPEN', 'Bildershowfenster automatisch öffnen');
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
define('_AM_WGGALLERY_OPTION_GT_LCLSKIN', 'Style Schaltflächen');
define('_AM_WGGALLERY_OPTION_GT_ANIMTIME', 'Geschwindigkeit Animation');
define('_AM_WGGALLERY_OPTION_GT_ANIMTIME_DESC', 'Zeit für die Übergangsanimation (Größenänderung) zwischen 2 Bildern in Millisekunden');
define('_AM_WGGALLERY_OPTION_GT_LCLCOUNTER', 'Bildzähler anzeigen');
define('_AM_WGGALLERY_OPTION_GT_LCLPROGRESSBAR', 'Fortschrittsleiste anzeigen');
define('_AM_WGGALLERY_OPTION_GT_LCLMAXWIDTH', 'Maximale Galeriebreite (in % des Fensters)');
define('_AM_WGGALLERY_OPTION_GT_LCLMAXHEIGTH', 'Maximale Galeriehöhe (in % des Fensters)');
define('_AM_WGGALLERY_OPTION_GT_BACKGROUND', 'Hintergrund');
define('_AM_WGGALLERY_OPTION_GT_BACKHEIGHT', 'Hintergrundhöhe');
define('_AM_WGGALLERY_OPTION_GT_BORDER', 'Rahmen');
define('_AM_WGGALLERY_OPTION_GT_BORDERWIDTH', 'Stärke');
define('_AM_WGGALLERY_OPTION_GT_BORDERCOLOR', 'Farbe');
define('_AM_WGGALLERY_OPTION_GT_BORDERPADDING', 'Abstand');
define('_AM_WGGALLERY_OPTION_GT_BORDERRADIUS', 'Radius');
define('_AM_WGGALLERY_OPTION_GT_SHADOW', 'Schatten anzeigen');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION', 'Anzeigeposition Daten');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_UNDER', 'Darunter');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER', 'Darüber');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_RSIDE', 'Rechte Seite');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_LSIDE', 'Linke Seite');
define('_AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_DESC', "Beachten Sie bitte, dass Lightbox im Falle eines zu kleinen Bildes/Fensters automatisch '" . _AM_WGGALLERY_OPTION_GT_LCLDATAPOSITION_OVER . "' verwendet");
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION', 'Anzeigeposition Schaltflächen');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_INNER', 'Innerhalb');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER', 'Außerhalb');
define('_AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_DESC', "Beachten Sie bitte, dass Lightbox im Falle eines zu kleinen Bildes/Fensters automatisch '" . _AM_WGGALLERY_OPTION_GT_LCLCMDPOSITION_OUTER . "' verwendet");
define('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSWIDTH', 'Breite Vorschaubilder (in Pixel)');
define('_AM_WGGALLERY_OPTION_GT_LCLTHUMBSHEIGTH', 'Höhe Vorschaubilder (in Pixel)');
define('_AM_WGGALLERY_OPTION_GT_LCLFULLSCREEN', "Schaltfläche 'Ganzer Bildschirm' anzeigen");
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR', "Bildverhalten bei 'Ganzer Bildschirm'");
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FIT', 'fit - Bild wird vollständig angezeigt (eventuell entstehen dadurch Leerflächen)');
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_FILL', 'fill - Bild wird auf Bildschirmgröße angepasst (eventuell werden Bildteile nicht mehr angezeigt)');
define('_AM_WGGALLERY_OPTION_GT_LCLFSIMGBEHAVIOUR_SMART', "smart - LC Lightbox verwendet 'fit' und ändert nur auf 'fill' wenn das Bildverhältnis dem verfügbaren Platz entspricht");
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS', "Schaltfläche 'Socials' anzeigen");
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB', 'Facebook App ID');
define('_AM_WGGALLERY_OPTION_GT_LCLSOCIALS_FB_DESC', 'Vergessen Sie nicht, Facebook SDK in Ihrer Seite einzufügen');
define('_AM_WGGALLERY_OPTION_GT_LCLDOWNLOAD', "Schaltfläche 'Download' anzeigen");
define('_AM_WGGALLERY_OPTION_GT_LCLRCLICK', 'Klick mit rechter Maustaste deaktivieren');
define('_AM_WGGALLERY_OPTION_GT_LCLTOGGLETXT', "Schaltfläche 'Text' anzeigen");
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS', 'Position der Navigationspfeile');
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_N', 'Normal');
define('_AM_WGGALLERY_OPTION_GT_LCLNAVBTNPOS_M', 'Mittig');
define('_AM_WGGALLERY_OPTION_GT_LCLSLIDESHOW', "Schaltfläche 'Abspielen' anzeigen");

// Albumtype add/edit
define('_AM_WGGALLERY_ALBUMTYPE_ADD', 'Albumtyp hinzufügen');
define('_AM_WGGALLERY_ALBUMTYPE_EDIT', 'Albumtyp bearbeiten');
// options  of Albumtypes
define('_AM_WGGALLERY_OPTION_AT_SET', 'Optionen für das entsprechende Album einstellen');
define('_AM_WGGALLERY_OPTION_AT_SETINFO', 'Die Albumeinstellungen werden auf der Indexseite sowie für die Album Blöcke verwendet');
define('_AM_WGGALLERY_OPTION_AT_HOVER', 'Hover Effekt');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_ALB', 'Anzahl der Spalten für Albumliste');
define('_AM_WGGALLERY_OPTION_AT_NB_COLS_CAT', 'Anzahl der Spalten für Kategorieliste');
// common options
define('_AM_WGGALLERY_OPTION_OPACITIY', 'Opacity');
define('_AM_WGGALLERY_OPTION_SHOWTITLE', 'Titel anzeigen');
define('_AM_WGGALLERY_OPTION_SHOWDESCR', 'Beschreibung anzeigen');
define('_AM_WGGALLERY_OPTION_CSS', 'CSS für den Stil wählen');
define('_AM_WGGALLERY_OPTION_SHOWSUBMITTER', 'Einsender anzeigen');
// Maintenance
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DR', 'Löschen und wiederherstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_R', 'Standardeinstellungen wiederherstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIM', 'Mittlere Bilder neu erstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_RIT', 'Vorschaubilder neu erstellen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI', 'Nicht verwendete Bilder löschen');
define('_AM_WGGALLERY_MAINTENANCE_EXECUTE_DUI_SHOW', 'Liste der nicht verwendeten Bilder anzeigen');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESET', 'Erfolgreich wiederhergestellt: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_CREATE', 'Erfolgreich erstellt: ');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_RESIZE', 'Größenänderung erfolgreich: %s von %t Bildern');
define('_AM_WGGALLERY_MAINTENANCE_SUCCESS_DELETE', 'Erfolgreich gelöscht: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESET', 'Fehler beim Wiederherstellen: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_CREATE', 'Fehler beim Erstellen: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_DELETE', 'Fehler beim Löschen: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_RESIZE', 'Fehler bei Größenänderung: ');
define('_AM_WGGALLERY_MAINTENANCE_ERROR_READDIR', 'Fehler beim Einlesen des Verzeichnisses: ');
define('_AM_WGGALLERY_MAINTENANCE_TYP', 'Art der Wartung');
define('_AM_WGGALLERY_MAINTENANCE_DESC', 'Beschreibung');
define('_AM_WGGALLERY_MAINTENANCE_RESULTS', 'Ergebnisse');
define('_AM_WGGALLERY_MAINTENANCE_GT', 'Wartung Galerietypen');
define('_AM_WGGALLERY_MAINTENANCE_GT_DESC', 'Nicht mehr unterstützte Galerietypen löschen und/oder Galerietypen auf Standardeinstellungen zurücksetzen');
define('_AM_WGGALLERY_MAINTENANCE_GT_SURERESET', 'Alle derzeit bestehenden Galerieeinstellungen werden durch die Standardeinstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_GT_SUREDELETE', 'Alle derzeit bestehenden Galerietypen (inklusive deren Einstellungen) werden gelöscht bzw. durch die aktuellen Galerien/Einstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_AT', 'Wartung Albumtypen');
define('_AM_WGGALLERY_MAINTENANCE_AT_DESC', 'Nicht mehr unterstützte Albumtypen löschen und/oder Albumtypen auf Standardeinstellungen zurücksetzen');
define('_AM_WGGALLERY_MAINTENANCE_AT_SURERESET', 'Alle derzeit bestehenden Albumeinstellungen werden durch die Standardeinstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_AT_SUREDELETE', 'Alle derzeit bestehenden Albumtypen (inklusive deren Einstellungen) werden gelöscht bzw. durch die aktuellen Albumtypen/Einstellungen ersetzt! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE', 'Größenänderung Bilder');
define('_AM_WGGALLERY_MAINTENANCE_RESIZE_DESC',
       'Erneute Größenänderung der mittleren Bilder oder Vorschaubilder entsprechend der vorgegeben Höhe in den Moduleinstellungen.<br>Aktuelle Einstellungen:<br>a) Mittlere Bilder: maximale Breite %mw px / maximale Höhe %mh px<br>b) Vorschaubilder: maximale Breite %tw px / maximale Höhe %th px');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED', 'Bilderverzeichnis bereinigen');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_DESC', 'Alle derzeit nicht verwendeten Albumbilder in folgenden Verzeichissen werden gelöscht:<ul>
<li>%p/albums/</li>
<li>%p/large/</li>
<li>%p/medium/</li>
<li>%p/thumbs/</li>
</ul>');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID', "Löschen von ungültigen Einträge in Tabelle 'Bilder'");
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_DESC', "Löschen von ungültigen Einträge in Tabelle 'Bilder', z.B. wenn zwar ein Eintrag im der Tabelle erstellt wurde, jedoch beim Upload etwas fehlgeschlagen ist");
define('_AM_WGGALLERY_MAINTENANCE_DELETE_INVALID_IMG', 'Ungültigen Eintrag: img_id ');
define('_AM_WGGALLERY_MAINTENANCE_DELETE_UNUSED_NONE', 'Es wurden keine nicht verwendeten Albumbilder gefunden');
define('_AM_WGGALLERY_MAINTENANCE_DUI_SUREDELETE', 'Alle derzeit nicht verwendeten Albumbilder werden gelöscht! Wollen Sie wirklich fortsetzen?');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK', 'Wasserzeichen zu Album nachträglich hinzufügen');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK_DESC', 'Ein Wasserzeichen zu einem Album hinzufügen.<br>Achtung: bestehende Wasserzeichen werden nicht entfernt.<br>Wenn bereits ein Wasserzeichen vorhanden ist, wird den Bildern ein zusätzliches Wasserzeichen hinzugefügt.');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK_SELECT', 'Album auswählen');
define('_AM_WGGALLERY_MAINTENANCE_WATERMARK_SUCCESS', 'Erfolgreich');
define('_AM_WGGALLERY_MAINTENANCE_IMGDIR', 'Fehlerhafte Einträge Bilder zu Verzeichnis');
define('_AM_WGGALLERY_MAINTENANCE_IMGDIR_DESC', 'Es werden Einträge in der Tabelle Bilder gesucht, die im Uploadverzeichnis nicht gefunden werden.');
define('_AM_WGGALLERY_MAINTENANCE_IMGALB', 'Fehlerhafte Einträge Bilder zu Album');
define('_AM_WGGALLERY_MAINTENANCE_IMGALB_DESC', 'Es werden Einträge in der Tabelle Bilder gesucht, deren angegebenes Album nicht (mehr) existiert.');
define('_AM_WGGALLERY_MAINTENANCE_IMG_SEARCH', 'Einträge suchen');
define('_AM_WGGALLERY_MAINTENANCE_IMG_SEARCHOK', 'Keine fehlerhafte Einträge Bilder gefunden');
define('_AM_WGGALLERY_MAINTENANCE_IMG_CLEAN', 'Fehlerhafte Einträge bereinigen');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEM', 'Systemchecks');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_SYSTEMDESC', 'Übreprüfung ob die PHP-Einstellungen mit den Moduleinstellungen kommpatibel sind');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_RESULTS', 'Ergebnis Systemchecks');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_TYPE', "Überprüfung PHP-Einstellung '%s'");
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_DESC', 'Die Moduleinstellung erlauben %s bytes');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_INFO', 'Setzt die maximal erlaubte Größe von POST-Daten');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_PMS_DESC', 'Maximale Dateigröße für Upload: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_INFO', 'Bestimmt, ob ein Dateiupload über html erlaubt ist');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_FU_DESC', 'Dateiupload erlaubt: ');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_INFO', 'Setzt die maximal erlaubte Größe für Dateiuploads');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_UMF_DESC', 'Maximale Dateigröße für Upload: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO1', 'Setzt den Maximalwert des Speichers in Byte, den ein Skript verbrauchen darf');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_INFO2', 'Wenn Sie Probleme beim Upload großer Bilder haben, dann erhöhen Sie diesen Wert');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_ML_DESC', 'Maximaler Speicherbedarf: %s (%b Bytes)');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR1', 'Bitte reduzieren sie die Moduleinstellug oder erhöhen sie die PHP-Einstellung');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR2', 'Bitte in den PHP-Einstellungen einschalten');
define('_AM_WGGALLERY_MAINTENANCE_CHECK_MS_ERROR3', 'memory_limit muss höher sein als upload_max_filesize und muss höher sein als post_max_size');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF', 'Lesen Exif-Daten');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_DESC', 'Erneutes Lesen und Speichern der Exif-Daten für alle Bilder');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READ', 'Fehlende Exif-Daten einlesen');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_READALL', 'Alle Exif-Daten einlesen');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_SUCCESS', 'Exif erfolgreich eingelesen');
define('_AM_WGGALLERY_MAINTENANCE_READ_EXIF_ERROR', 'Fehler beim Lesen Exif-Daten');
// Albums
define('_AM_WGGALLERY_ALBUMS_ERRNOTFOUND', 'Fehler: Bild nicht gefunden (Bild-Id %s)');
// Import
define('_AM_WGGALLERY_IMPORT', 'Daten und Dateien aus anderen Galeriemodulen importieren');
define('_AM_WGGALLERY_IMPORT_LIST', 'Liste der unterstützten Module');
define('_AM_WGGALLERY_IMPORT_SUPPORT', 'Unterstützte Module für Import');
define('_AM_WGGALLERY_IMPORT_SUP_INSTALLED', 'Modul ist installiert');
define('_AM_WGGALLERY_IMPORT_SUP_NOTINSTALLED', 'Modul ist installiert');
define('_AM_WGGALLERY_IMPORT_FOUND', 'Suchergebnis');
define('_AM_WGGALLERY_IMPORT_READ', 'Moduldaten lesen');
define('_AM_WGGALLERY_IMPORT_EXEC', 'Daten und Dateien importieren');
define('_AM_WGGALLERY_IMPORT_NUMALB', 'Anzahl der Alben');
define('_AM_WGGALLERY_IMPORT_NUMIMG', 'Anzahl der Bilder');
define('_AM_WGGALLERY_IMPORT_INFO_SIZE', 'Achtung: die Bilder werden nicht an die Größeneinstellungen entsprechend den Moduleinstellungen angepasst. Wenn Sie die Größen anpassen wollen dann führen Sie nach dem Import "Wartung" aus.');
define('_AM_WGGALLERY_IMPORT_ERR', 'Das Importieren von Daten ist nur möglich, wenn die Album- und Bildertabellen noch leer sind');
define('_AM_WGGALLERY_IMPORT_ERR_ALBEXIST', 'Es gibt bereits Alben');
define('_AM_WGGALLERY_IMPORT_ERR_IMGEXIST', 'Es gibt bereits Bilder');
define('_AM_WGGALLERY_IMPORT_SUCCESS', '%a Alben und %i Bilder erfolgreich importiert');
define('_AM_WGGALLERY_IMPORT_ERROR', 'Während des Imports ist ein Fehler aufgetreten');
// ---------------- Admin Others ----------------
// ---------------- End ----------------
