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
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 blocks.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 */
// Admin Edit
\define('_MB_WGGALLERY_BLOCKTYPE', 'Block Typ');
\define('_MB_WGGALLERY_BLOCKTYPE_DEFAULT', 'Standard (sortiert nach Datum absteigend)');
\define('_MB_WGGALLERY_BLOCKTYPE_RECENT', 'Neueste Einträge');
\define('_MB_WGGALLERY_BLOCKTYPE_RANDOM', 'Zufällige Einträge');
\define('_MB_WGGALLERY_TITLE_SHOW', 'Titel anzeigen');
\define('_MB_WGGALLERY_TITLE_LENGTH', 'Länge des Titels (0 bedeutet ohne Limit)');
\define('_MB_WGGALLERY_DESC_SHOW', 'Beschreibung anzeigen');
\define('_MB_WGGALLERY_DESC_LENGTH', 'Länge der Beschreibung (0 bedeutet ohne Limit)');
\define('_MB_WGGALLERY_SHOW', 'Aktion nach Klick auf ein Album');
\define('_MB_WGGALLERY_SHOW_GALLERY', 'Bildershow anzeigen (sofern ein Galerietyp ausgewählt wurde)');
\define('_MB_WGGALLERY_SHOW_INDEX', 'Bildindexseite anzeigen');
\define('_MB_WGGALLERY_NUMB_ALBUMS', 'Anzahl der Alben für Anzeige pro Reihe');
\define('_MB_WGGALLERY_ALBUMS_DISPLAYLIST', 'Wieviele Alben sollen für die Anzeigeliste geladen werden');
\define('_MB_WGGALLERY_ALBUMS_TO_DISPLAY', 'Anzuzeigende Alben');
\define('_MB_WGGALLERY_ALL_ALBUMS', "Alle Alben mit Status 'online'");
\define('_MB_WGGALLERY_IMAGES_DISPLAYLIST', 'Wieviele Bilder sollen für die Anzeigeliste geladen werdent');
\define('_MB_WGGALLERY_ALBUMTYPES', 'Folgenden Albumtyp für Anzeige verwenden');
\define('_MB_WGGALLERY_ALBUMTYPES_PRIMARY', 'Primären Albumtyp verwenden');
\define('_MB_WGGALLERY_ALBUMTYPES_OTHER', "Unabhängig vom primären Albumtyp '%s' verwenden");
\define('_MB_WGGALLERY_NUMB_IMAGES', 'Anzahl der Bilder für Anzeige pro Reihe');
