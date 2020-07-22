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
define('_MA_WGGALLERY_DESC', 'Questo modulo è una galleria di immagini per XOOPS');
define('_MA_WGGALLERY_INDEX_DESC', "Benvenuto nella homepage del tuo nuovo modulo wgGallery!<br>
Come puoi vedere, hai creato una pagina con un elenco di collegamenti in alto per navigare tra le pagine del tuo modulo. Questa descrizione è visibile solo sulla homepage di questo modulo, nelle altre pagine vedrai il contenuto che hai creato quando hai creato questo modulo con il modulo TDMCreate e dopo aver creato un nuovo contenuto nella amministrazione di questo modulo. Per espandere questo modulo con altre risorse, basta aggiungere il codice necessario per estendere le funzionalità dello stesso. I file sono raggruppati per tipo, dall'intestazione al piè di pagina per vedere come diviso il codice sorgente. <br> <br> Se vedi questo messaggio, è perché non hai creato alcun contenuto per questo modulo. Una volta creato qualsiasi tipo di contenuto, non vedrai più questo messaggio. <br> <br> Se ti è piaciuto il modulo TDMCreate e grazie al lungo processo per dare l'opportunità al nuovo modulo di essere creato, considera di fare una donazione per mantenere il modulo TDMCreate ed effettua una donazione usando questo pulsante <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donazione a Txmod Xoops'> <img src = 'https: //www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt = 'Pulsante donazione'> </a> <br> Grazie! <br> <br> Usa il link qui sotto per andare in amministrazione e creare contenuti. ");
define('_MA_WGGALLERY_NO_PDF_LIBRARY', 'Librerie TCPDF non ancora presenti, caricarle nella root /Frameworks');
define('_MA_WGGALLERY_NO', 'No');
// ---------------- Contents ----------------
//Colorbox and Lightbox
define('_MA_WGGALLERY_CURRENT_LABEL', 'immagine {current} di {total}');
// Colorbox
define('_MA_WGGALLERY_COLORBOX_CLOSE', 'chiudi');
define('_MA_WGGALLERY_COLORBOX_PREVIOUS', 'precedente');
define('_MA_WGGALLERY_COLORBOX_NEXT', 'prossimo');
define('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTART', 'Inizia presentazione');
define('_MA_WGGALLERY_COLORBOX_SLIDESHOWSTOP', 'Ferma presentazione');
// LC_Lightbox lite
define('_MA_WGGALLERY_LCL_CLOSE', 'chiudi');
define('_MA_WGGALLERY_LCL_PREVIOUS', 'precedente');
define('_MA_WGGALLERY_LCL_NEXT', 'prossimo');
define('_MA_WGGALLERY_LCL_PLAY', 'riproduci');
define('_MA_WGGALLERY_LCL_COUNTER', 'contatore');
define('_MA_WGGALLERY_LCL_FULLSCREEN', 'schermo intero');
define('_MA_WGGALLERY_LCL_TXT_TOGGLE', 'attiva/disattiva il testo');
define('_MA_WGGALLERY_LCL_DOWNLOAD', 'scaricamento');
define('_MA_WGGALLERY_LCL_THUMBS_TOGGLE', 'attiva/disattiva miniature');
define('_MA_WGGALLERY_LCL_SOCIALS', 'social');
// Admin link
define('_MA_WGGALLERY_ADMIN', 'Admin');
// ---------------- Errors ----------------
define('_MA_WGGALLERY_FAILSAVEIMG_MEDIUM', 'Errore durante la creazione della immagine media: %s');
define('_MA_WGGALLERY_FAILSAVEIMG_THUMBS', 'Errore durante la creazione della immagine miniatura: %s');
define('_MA_WGGALLERY_FAILSAVEWM_MEDIUM', 'Errore durante la aggiunta di filigrana alla immagine media: %s (causa: %g)');
define('_MA_WGGALLERY_FAILSAVEWM_LARGE', 'Errore durante la aggiunta di filigrana alla immagine grande: %s (causa: %g)');
define('_MA_WGGALLERY_ERROR_NO_IMAGE_SET', "Non hai specificato la immagine. Seleziona prima l'album");
// search
define('_MA_WGGALLERY_SEARCH', 'Cerca immagine per criteri specifici');
define('_MA_WGGALLERY_SEARCH_CATS', 'Cerca per categorie');
define('_MA_WGGALLERY_SEARCH_TEXT', 'Cerca testo');
define('_MA_WGGALLERY_SEARCH_SUBM', 'Cerca da mittente specifico');
define('_MA_WGGALLERY_SEARCH_CATS_DESC', 'Le immagini e gli album saranno selezionati, se sono collegati a una delle categorie selezionate. Se un album è collegato a una di queste categorie, verranno visualizzate tutte le immagini dell\'album, anche se la immagine stessa non è collegata alla categoria.');
define('_MA_WGGALLERY_SEARCH_TEXT_DESC',
       'Verranno selezionati immagini e album se il nome, la descrizione, il nome della categoria o uno dei tag contengono questo testo. Se un album è collegato a una di queste categorie, verranno visualizzate tutte le immagini dell\'album, anche se la immagine stessa non è collegata alla categoria.');
define('_MA_WGGALLERY_SEARCH_SUBM_DESC', 'Le immagini e gli album verranno selezionati, se inviati dall\'utente selezionato.');
define('_MA_WGGALLERY_SEARCH_ERROR_NO_FILTER', 'Seleziona almeno uno dei filtri!');
define('_MA_WGGALLERY_SEARCH_RESULT', 'Risultato della tua ricerca');
define('_MA_WGGALLERY_SEARCH_NO_RESULT', 'Nessuna immagine trovata');
define('_MA_WGGALLERY_SEARCH_ACT', 'Cerca per attività utente');
define('_MA_WGGALLERY_SEARCH_ACT_DOWNLOADS', 'La più scaricata');
define('_MA_WGGALLERY_SEARCH_ACT_VIEWS', 'La più visualizzata');
define('_MA_WGGALLERY_SEARCH_ACT_RATINGS', 'La migliore valutazione');
define('_MA_WGGALLERY_SEARCH_ACT_VOTES', 'La più votata');
// ---------------- Ratings ----------------
define('_MA_WGGALLERY_RATING_CURRENT_1', 'Valutazione: %c / %m (%t voto in totale)');
define('_MA_WGGALLERY_RATING_CURRENT_X', 'Valutazione: %c / %m (%t voti in totale)');
define('_MA_WGGALLERY_RATING_CURRENT_SHORT_1', '%c (%t voto)');
define('_MA_WGGALLERY_RATING_CURRENT_SHORT_X', '%c (%t voti)');
define('_MA_WGGALLERY_RATING1', '1 of 5');
define('_MA_WGGALLERY_RATING2', '2 of 5');
define('_MA_WGGALLERY_RATING3', '3 of 5');
define('_MA_WGGALLERY_RATING4', '4 of 5');
define('_MA_WGGALLERY_RATING5', '5 of 5');
define('_MA_WGGALLERY_RATING_10_1', '1 of 10');
define('_MA_WGGALLERY_RATING_10_2', '2 of 10');
define('_MA_WGGALLERY_RATING_10_3', '3 of 10');
define('_MA_WGGALLERY_RATING_10_4', '4 of 10');
define('_MA_WGGALLERY_RATING_10_5', '5 of 10');
define('_MA_WGGALLERY_RATING_10_6', '6 of 10');
define('_MA_WGGALLERY_RATING_10_7', '7 of 10');
define('_MA_WGGALLERY_RATING_10_8', '8 of 10');
define('_MA_WGGALLERY_RATING_10_9', '9 of 10');
define('_MA_WGGALLERY_RATING_10_10', '10 of 10');
define('_MA_WGGALLERY_RATING_VOTE_BAD', 'Voto non valido');
// define('_MA_WGGALLERY_RATING_VOTE_ALREADY', 'You have already voted');
define('_MA_WGGALLERY_RATING_VOTE_THANKS', 'Grazie per aver votato');
define('_MA_WGGALLERY_RATING_NOPERM', "Spiacenti, non sei autorizzato a valutare gli articoli");
define('_MA_WGGALLERY_RATING_LIKE', 'Mipiace');
define('_MA_WGGALLERY_RATING_DISLIKE', 'Nonmipiace');
define('_MA_WGGALLERY_ERROR_CREATE_ZIP', 'Errore: Impossibile creare archivio ZIP');
