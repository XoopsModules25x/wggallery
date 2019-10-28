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
 * @version        $Id: 1.0 main.php 1 Mon 2018-03-19 10:04:56Z XOOPS Project (www.xoops.org) $
 */
require_once __DIR__ . '/common.php';

// ---------------- Main ----------------
define('_MA_WGGALLERY_INDEX', 'Home');
define('_MA_WGGALLERY_TITLE', 'wgGallery');
define('_MA_WGGALLERY_DESC', 'This module is a picture gallery for XOOPS');
define('_MA_WGGALLERY_INDEX_DESC', "Welcome to the homepage of your new module wgGallery!<br>
As you can see, you have created a page with a list of links at the top to navigate between the pages of your module. This description is only visible on the homepage of this module, the other pages you will see the content you created when you built this module with the module TDMCreate, and after creating new content in admin of this module. In order to expand this module with other resources, just add the code you need to extend the functionality of the same. The files are grouped by type, from the header to the footer to see how divided the source code.<br><br>If you see this message, it is because you have not created content for this module. Once you have created any type of content, you will not see this message.<br><br>If you liked the module TDMCreate and thanks to the long process for giving the opportunity to the new module to be created in a moment, consider making a donation to keep the module TDMCreate and make a donation using this button <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations'></a><br>Thanks!<br><br>Use the link below to go to the admin and create content.");
define('_MA_WGGALLERY_NO_PDF_LIBRARY', 'Libraries TCPDF not there yet, upload them in root/Frameworks');
define('_MA_WGGALLERY_NO', 'No');
// ---------------- Contents ----------------
/* // Submit
define('_MA_WGGALLERY_SUBMIT', 'Submit');
define('_MA_WGGALLERY_SUBMIT_IMAGE', 'Submit Image');
define('_MA_WGGALLERY_SUBMIT_ALLPENDING', 'All image/script information are posted pending verification.');
define('_MA_WGGALLERY_SUBMIT_DONTABUSE', 'Username and IP are recorded, so please do not abuse the system.');
define('_MA_WGGALLERY_SUBMIT_ISAPPROVED', 'Your image has been approved');
define('_MA_WGGALLERY_SUBMIT_PROPOSER', 'Submit a image');
define('_MA_WGGALLERY_SUBMIT_RECEIVED', 'We have received your image info. Thank you !');
define('_MA_WGGALLERY_SUBMIT_SUBMITONCE', 'Submit your image/script only once.');
define('_MA_WGGALLERY_SUBMIT_TAKEDAYS', 'This will take many days to see your image/script added successfully in our database.'); */
//Colorbox and Lightbox
define('_MA_WGGALLERY_CURRENT_LABEL', 'Bild {current} von {total}');
// Colorbox
define('_MA_WGGALLERY_COLORBOX_CLOSE', 'Schließen');
define('_MA_WGGALLERY_COLORBOX_PREVIOUS', 'Vorheriges');
define('_MA_WGGALLERY_COLORBOX_NEXT', 'Nächstes');
define('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTART', 'Bildershow starten');
define('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTOP', 'Bildershow anhalten');
// LC_Lightbox lite
define('_MA_WGGALLERY_LCL_CLOSE', 'Schließen');
define('_MA_WGGALLERY_LCL_PREVIOUS', 'Vorheriges');
define('_MA_WGGALLERY_LCL_NEXT', 'Nächstes');
define('_MA_WGGALLERY_LCL_PLAY', 'Abspielen');
define('_MA_WGGALLERY_LCL_COUNTER', 'Zähler');
define('_MA_WGGALLERY_LCL_FULLSCREEN', 'Ganzer Bildschirm');
define('_MA_WGGALLERY_LCL_TXT_TOGGLE', 'Text ein/ausschalten');
define('_MA_WGGALLERY_LCL_DOWNLOAD', 'Herunterladen');
define('_MA_WGGALLERY_LCL_THUMBS_TOGGLE', 'Vorschaubilder ein/ausschalten');
define('_MA_WGGALLERY_LCL_SOCIALS', 'Teilen');
// Admin link
define('_MA_WGGALLERY_ADMIN', 'Admin');
// ---------------- Errors ----------------
define('_MA_WGGALLERY_FAILSAVEIMG_MEDIUM', 'Fehler beim Erstellen des mittelgroßen Bildes: %s');
define('_MA_WGGALLERY_FAILSAVEIMG_THUMBS', 'Fehler beim Erstellen des Vorschaubildes: %s');
define('_MA_WGGALLERY_FAILSAVEWM_MEDIUM', 'Fehler beim Hinzufügen Wasserzeichen zu mittelgroßem Bild: %s (Grund: %g)');
define('_MA_WGGALLERY_FAILSAVEWM_LARGE', 'Fehler beim Hinzufügen Wasserzeichen zu großem Bild: %s (Grund: %g)');
define('_MA_WGGALLERY_ERROR_NO_IMAGE_SET', "You didn't specify the image. Please select the album first");
// search
define('_MA_WGGALLERY_SEARCH', 'Suche Bilder nach speziellen Kriterien');
define('_MA_WGGALLERY_SEARCH_CATS', 'Suche nach Kategorien');
define('_MA_WGGALLERY_SEARCH_CATS_DESC', 'Ausgewählt werden Bilder oder Alben, die einer dieser Kategorien zugeordnet wurden. Sofern ein Album einer Kategorie zugeordnet werden, so werden alle Bilder dieses Albums angezeigt, unabhängig davon, ob die einzelnen Bilder dieser Kategorie zugeordnet wurden');
define('_MA_WGGALLERY_SEARCH_TEXT_DESC', 'Ausgewählt werden Bilder oder Alben, deren Name, Beschreibung, Name der Kategorie oder einer der verwendeten Tags diesen Text enthalten. Sofern ein Album einer Kategorie zugeordnet werden, so werden alle Bilder dieses Albums angezeigt');
define('_MA_WGGALLERY_SEARCH_SUBM_DESC', 'Ausgewählt werden Bilder oder Alben, die vom ausgewählten Benutzer eingesendet wurden');

define('_MA_WGGALLERY_SEARCH_TEXT', 'Suche nach Text');
define('_MA_WGGALLERY_SEARCH_SUBM', 'Suche nach Einsender');
define('_MA_WGGALLERY_SEARCH_ERROR_NO_FILTER', 'Bitte minimum ein Filterkriterium wählen!');
define('_MA_WGGALLERY_SEARCH_RESULT', 'Suchergebnis');
define('_MA_WGGALLERY_SEARCH_NO_RESULT', 'Keine Bilder gefunden');
define('_MA_WGGALLERY_SEARCH_ACT', 'Suche Bilder nach Benutzeraktivitäten');
define('_MA_WGGALLERY_SEARCH_ACT_DOWNLOADS', 'Am meisten heruntergeladen');
define('_MA_WGGALLERY_SEARCH_ACT_VIEWS', 'Am meisten angesehen');
define('_MA_WGGALLERY_SEARCH_ACT_RATINGS', 'Am besten bewertet');
define('_MA_WGGALLERY_SEARCH_ACT_VOTES', 'Mit den meisten Bewertungen');
// ---------------- Ratings ----------------
define('_MA_WGGALLERY_RATING_CURRENT', 'Bewertung: %c / %m (%t Bewertung(en) insgesamt)');
define('_MA_WGGALLERY_RATING_CURRENT_SHORT', '%c (%t Bewertung(en))');
define('_MA_WGGALLERY_RATING1', '1 von 5');
define('_MA_WGGALLERY_RATING2', '2 von 5');
define('_MA_WGGALLERY_RATING3', '3 von 5');
define('_MA_WGGALLERY_RATING4', '4 von 5');
define('_MA_WGGALLERY_RATING5', '5 von 5');
define('_MA_WGGALLERY_RATING_10_1', '1 von 10');
define('_MA_WGGALLERY_RATING_10_2', '2 von 10');
define('_MA_WGGALLERY_RATING_10_3', '3 von 10');
define('_MA_WGGALLERY_RATING_10_4', '4 von 10');
define('_MA_WGGALLERY_RATING_10_5', '5 von 10');
define('_MA_WGGALLERY_RATING_10_6', '6 von 10');
define('_MA_WGGALLERY_RATING_10_7', '7 von 10');
define('_MA_WGGALLERY_RATING_10_8', '8 von 10');
define('_MA_WGGALLERY_RATING_10_9', '9 von 10');
define('_MA_WGGALLERY_RATING_10_10', '10 von 10');
define('_MA_WGGALLERY_RATING_VOTE_BAD', 'Ungültige Bewertung');
// define('_MA_WGGALLERY_RATING_VOTE_ALREADY', 'Sie haben bereits eine Bewertung abgegeben');
define('_MA_WGGALLERY_RATING_VOTE_THANKS', 'Danke für Ihre Bewertung');
define('_MA_WGGALLERY_RATING_NOPERM', 'Verzeichung, aber Sie haben keine Berechtigung zum Bewerten von Einträgen');
define('_MA_WGGALLERY_RATING_LIKE', 'Gefällt mir');
define('_MA_WGGALLERY_RATING_DISLIKE', 'Gefällt mir nicht');
